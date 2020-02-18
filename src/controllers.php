<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

//Request::setTrustedProxies(array('127.0.0.1'));

$app->mount('/', new Controller\IndexController());
$app->mount('/MichelinPS4', new Controller\mPS4Controller());
$app->mount('/appointment', new Controller\appointmentController());
$app->mount('/reservacion', new Controller\reservacionController());
//$app->mount('/reservas', new Controller\Reservas\reservaController());
//$app->mount('/reservas/panel', new Controller\Reservas\reservaPanelController());
$app->mount('/mAlliance', new Controller\operaciones\allianceController());

$app->mount('/commimsa', new Controller\commimsa\commimsaController());
$app->mount('/CONEIC17', new Controller\eventos17\CLEIC17Controller());
$app->mount('/expoRail18', new Controller\eventos17\expoRail18Controller());
$app->mount('/mansionX', new Controller\eventos17\mansionxController());
$app->mount('/Paratuber', new Controller\eventos17\paratuberController());
$app->mount('/FEMECOG18', new Controller\eventos17\femecog18nController());
$app->mount('/CASMEP18', new Controller\eventos17\CASMEP18nController());
$app->mount('/CNH18', new Controller\eventos17\CNH18Controller());
$app->mount('/AMSOFAC', new Controller\eventos17\AMSOFACController());
$app->mount('/SMORL19', new Controller\eventos17\smorl19nController());
$app->mount('/3FFM', new Controller\eventos17\FFMController());
$app->mount('/EV18', new Controller\eventos17\EV18Controller());
$app->mount('/CNNSXXI', new Controller\eventos17\cnnsXXInController());
$app->mount('/ISOT', new Controller\eventos17\isotnController());
$app->mount('/FEMECOG19', new Controller\eventos17\femecog19nController());
$app->mount('/expoRail19', new Controller\eventos17\expoRail19Controller());
$app->mount('/STALYC', new Controller\eventos17\stalycController());
$app->mount('/ANEIC', new Controller\eventos17\aneicController());
$app->mount('/SMEP19', new Controller\eventos17\smep19nController());
$app->mount('/SMORLCCC20', new Controller\eventos17\smorl20nController());
$app->mount('/bodaSFLOOK', new Controller\eventos17\bodaSFLOOKController());
$app->mount('/SFLOOKwedding', new Controller\eventos17\bodaSFLOOKController());
$app->mount('/LIICNCP', new Controller\eventos17\LIICNCPController());
$app->mount('/expoRail20', new Controller\eventos17\expoRail20Controller());
$app->mount('/ANCAM', new Controller\eventos17\ancamController());

$app->mount('/hookSB', new Controller\PP\hooksbController());
//$app->mount('/mAlliance', new Controller\operaciones\allianceController());

$app->mount('/Aippi', new Controller\aippi\AippiController());
$app->mount('/AippiPanel', new Controller\aippi\adminAippiController());

$app->mount('/transportCMI', new Controller\transportCMI\transportCMIController());
$app->mount('/transportCMI/panel/', new Controller\transportCMI\adminCMIController());

$app->mount('/tecnoPay', new Controller\eventos17\tecnoController());


$app->mount('/kickOff19', new Controller\operaciones\kickoff19Controller());
//$app->mount('/kickOff19/admin/', new Controller\operaciones\kickoff19AdminController());

$app->mount('/michelin19', new Controller\operaciones\michelin19Controller());



$app->mount('/tcNumbers', new Controller\tc\numbersController());
$app->mount('/citasExporail', new Controller\apps\citasExporailController());


$app->mount('/WMCtours/', new Controller\WMC\WMCtoursController());

$app->mount('/upfront20/', new Controller\apps\upFrontController());

$app->mount('/michelin20', new Controller\operaciones\michelin20Controller());
$app->mount('/torneoNavistar', new Controller\operaciones\torneoNavistarController());

$app['debug'] = true;

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
        'errors/'.$code.'.html',
        'errors/'.substr($code, 0, 2).'x.html',
        'errors/'.substr($code, 0, 1).'xx.html',
        'errors/default.html',
    );
    var_dump($app);
    return false;
    //return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});
