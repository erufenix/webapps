<?php
namespace Model;

use Silex\Application;

class PanelModel {
	private $app 				= null;
	private $em 				= null;
	private $repository = null;
	private $qb        	= null;
	public function __construct(Application $app) {
		$this->app = $app;
		$this->em = $this->app['orm.em'];
        		$this->qb = $this->em->createQueryBuilder();

		$token = $this->app['security.token_storage']->getToken();
		if (null != $token) {
			$this->user = $token->getUser();
		}

		$this->em = $this->app['orm.em'];
		$this->repository = $this->em->getRepository('Entity\Usuarios');
		$this->qb = $this->em->createQueryBuilder();
	}

	public function getUser() {
		//$usuario = $this->repository->findOneBy(array('usuarioCorreo' => $this->user->getUsername()));
		$usuario = $this->repository->findOneByUsuarioCorreo($this->user->getUsername());
		return $usuario;
	}
}