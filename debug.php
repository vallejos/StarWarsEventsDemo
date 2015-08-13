<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;

$loader = require_once __DIR__.'/app/bootstrap.php.cache';
Debug::enable();

require_once __DIR__.'/app/AppKernel.php';

$kernel = new AppKernel('dev', true);
$kernel->loadClassCache();
$request = Request::createFromGlobals();

$kernel->boot();

$container = $kernel->getContainer();
$container->enterScope('request');
$container->set('request', $request);

/*
// Template
$templating = $container->get('templating');

echo $templating->render(
    'EventBundle:Default:index.html.twig',
    array('name' => 'Fabian Vallejos')
);
*/

use Yoda\EventBundle\Entity\Event;

$event = new Event();
$event->setName('Fabian\'s new post!');
$event->setLocation('fabianvallejos.com');
$event->setTime(new \DateTime('today'));
//$event->setDetails('An hack to quickly debug Symfony2 apps');


$em = $container->get('doctrine')->getManager();
$em->persist($event);
$em->flush();
