<?php
namespace Controller\tc;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;

class numbersController implements ControllerProviderInterface {

	public function connect(Application $app) {
		$index = $app['controllers_factory'];
		$index->get('/','Controller\tc\numbersController::index')->bind('numbers.index');
		$index->post('/ticket','Controller\tc\numbersController::regAndgen')->bind('numbers.ticket');
		$index->get('/reporte','Controller\tc\numbersController::reporte')->bind('numbers.reporte');
		return $index;
	}

	public function index(Request $request, Application $app) {
		return $app['twig']->render('pages/tc/numbers/index.twig', array(
			'title' =>''
		));
	}

	public function regAndgen(Request $request, Application $app){
		$rq 	= $request->request;
		$mail = $rq->get('correo');
		$json = array(
								'st' 			=> false,
								'msg' 		=> '',
								'yt' 			=> false,
								'ticket' 	=> 0,
								'correo' 	=> ''
		);
		$chkMail = $this->chkMail($mail,$app);
		if(!empty($chkMail)){
			$json = array(
									'st' 			=> true,
									'msg' 		=> 'Este correo ya participo',
									'yt' 			=> true,
									'ticket' 	=> $chkMail['numero'],
									'correo' 	=> $mail
			);
		}
		else{
			$numbers 	= $this->getNumbers($app);
			$max   		= 300;
			$rnd 			= $this->getRamdom($numbers,$max,$app);
			$reg      = $this->reg($rq,$rnd,$app);
			$json = array(
									'st' 		=> true,
									'msg' 	=> '',
									'ticket' => $rnd,
									'correo' 	=> $mail
			);
		}
		return $app->json($json);
	}



	private function getRamdom($numbers,$max,$app){
		$rnd = mt_rand(1, $max);
		if(in_array($rnd, $numbers)){
      $numbers  = $this->getNumbers($app);
			$this->getRamdom($numbers,$max,$app);
		}
		else{
			return $rnd;
		}
	}

	private function chkMail($mail,$app){
		$model 	=	$app["appsModel"];
		$arr 		= array();
		if(empty($model->chkMail($mail))){
			$arr = $arr;
		}
		else{
			$arr = $app["serializer"]->toArray($model->chkMail($mail));
		}
		return $arr;
	}

	private function getNumbers($app){
		$model 		=	$app["appsModel"];
		$numbers  = array();
		$anumbers = $app["serializer"]->toArray($model->getNumbers());
		if(!empty($anumbers)){
			$numbers = array_column($anumbers, "numero");
		}
		return $numbers;
	}

	private function reg($rq,$rnd,$app){
		$model 		=	$app["appsModel"];
		$rq 			= $model->reg($rq,$rnd);
	}
	
    public function reporte(Application $app) {	
        $model    = $app["appsModel"];
        $reg      = $model->getAll();
        $records  = $app["serializer"]->toArray($reg);
        $vfields  = array(
              'id'      => 'ID',
              'correo'  => 'Correo',
              'numero'  => 'Número',
              'premio'  => 'Premio'
        );
        $fp     = fopen( 'php://temp/maxmemory:'. (12*1024*1024) , 'r+' );
        $fn     = new Functions;
        $isDate = array();
        $isTime = array();
        $fields  = array();
        $keys   = array();
        $r_ = array();
        foreach ($vfields as $kf => $vf) {
            array_push($fields,$vf);
            array_push($keys,$kf);
        }
        fputcsv( $fp, $fields );
        foreach ($records as $kr => $vr) {
          foreach ($vr as $kv => $vv) {
            if(in_array($kv,$keys)){
              $vv = utf8_decode($vv);
              $vv = is_null($vv) ? '' : $vv;
              if(in_array($kv,$isDate) && !empty($vv)){
                $vv = $fn->d2h($vv);
              }
              if(in_array($kv,$isTime) && !empty($vv)){
                $vv = $fn->d2h($vv,true);
              }
              array_push($r_,$vv);
            }
          }
          fputcsv( $fp, $r_);
          $r_ = array();
        }
        rewind( $fp );
        $output = stream_get_contents( $fp );
        fclose( $fp );
    
        header('Content-Type: text/csv; charset=utf-8');
    
        header('Content-Disposition: attachment; filename=numerosRifa.csv' );
    
        header('Content-Length: '. strlen($output) );
    
        echo $output;
        exit;
  }	

}

?>
