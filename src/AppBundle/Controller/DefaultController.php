<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * Renders the message block
     *
     * @return Response
     */
    public function messagesBlockAction()
    {
        return $this->render(':default:messages.html.twig');
    }
}
