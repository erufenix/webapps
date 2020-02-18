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
$app->mount('/commimsa', new Controller\commimsa\commimsaController());
$app->mount('/CONEIC17', new Controller\eventos17\CLEIC17Controller());
$app->mount('/expoRail18', new Controller\eventos17\expoRail18Controller());
$app->mount('/mansionX', new Controller\eventos17\mansionxController());
$app->mount('/Paratuber', new Controller\eventos17\paratuberController());
$app->mount('/FEMECOG18', new Controller\eventos17\femecog18Controller());
$app->mount('/CASMEP18', new Controller\eventos17\CASMEP18Controller());
$app->mount('/CNH18', new Controller\eventos17\CNH18Controller());
$app->mount('/AMSOFAC', new Controller\eventos17\AMSOFACController());


$app->mount('/mAlliance', new Controller\operaciones\allianceController());


//$app->mount('/kickOff18', new Controller\operaciones\kickoff18Controller());




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

    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});
