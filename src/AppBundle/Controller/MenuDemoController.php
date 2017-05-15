<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MenuDemoController extends Controller
{
    public function routeDataAction()
    {
        $mainRequest = $this->get('request_stack')->getMasterRequest();
        $variables = array();
        if ($mainRequest) {
            $variables = array(
                'data' => $this->getRouteData($mainRequest),
            );
        }

        return $this->render(':menu_demo:route_data_block.html.twig', $variables);
    }

    private function getRouteData(Request $request)
    {
        $data = array('Route' => $request->attributes->get('_route'));
        $routeParams = $request->attributes->get('_route_params') ? $request->attributes->get('_route_params') : array();

        foreach ($routeParams as $param => $value) {
            $data["Param [$param]"] = $value;
        }

        return $data;
    }
}
