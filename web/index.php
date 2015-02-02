<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/helpers.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;
use Symfony\Component\EventDispatcher\EventDispatcher;
 
function render_template($request)
{
    extract($request->attributes->all());
    ob_start();
    include sprintf(__DIR__.'/../src/pages/%s.php', $_route);
 
    return new Response(ob_get_clean());
}
 
$request = Request::createFromGlobals();
$routes = include __DIR__.'/../src/app.php';
 
$context = new Routing\RequestContext();
$context->fromRequest($request);
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);
$resolver = new HttpKernel\Controller\ControllerResolver();

$dispatcher = new EventDispatcher;
$dispatcher->addSubscriber(new Simplex\ContentLengthListener);
//$dispatcher->addSubscriber(new Simplex\GoogleListener);
 
$framework = new Simplex\Framework($matcher, $resolver, $dispatcher);
$response = $framework->handle($request);

$response->send();