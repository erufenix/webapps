<?php
namespace Lib\Provider;

use Silex\Application;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

class TokenAuthProvider implements UserProviderInterface {
	private $app;

	public function __construct(Application $app) {
		$this->app = $app;
	}

	public function loadUserByUsername($username) {
		$em = $this->app['orm.em'];

		if ($em instanceof \Doctrine\ORM\EntityManager) {
			if (!$user = $em->getRepository('Entity\Usuarios')->findOneBy(array('usuarioCorreo' => $username))) {
				throw new UsernameNotFoundException(sprintf('El usuario: %s no existe!', $username));
			}
		}
		return new User($user->getUsuarioCorreo(), $user->getUsuarioPwd(), explode(',', $user->getRoles()), true, true, true, true);
	}

	public function refreshUser(UserInterface $user) {
		if (!$user instanceof User) {
			throw new UnsupportedUserException(sprintf('Instance of %s are nor supported', get_class($user)));
		}

		return $this->loadUserByUsername($user->getUsername()); // getUsername*/
	}

	public function supportsClass($class) {
		return $class === 'Symfony\Component\Security\Core\User\User';
	}
}