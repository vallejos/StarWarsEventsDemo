<?php

namespace Yoda\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        // get the EM from the doctrine service container
        // $em = $this->container->get('doctrine')->getManager();

        $em = $this->getDoctrine()->getManager(); // we can do this because we're extending the base Controller

        $repo = $em->getRepository('EventBundle:Event'); // 'EventBundle:Event' = the same we used when we generated the entity

        $event = $repo->findOneBy(array(
            'name' => 'Fabian\'s new post!'
        ));

        return $this->render('EventBundle:Default:index.html.twig',
            array('name' => $name, 'event' => $event));
    }
}
