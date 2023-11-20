<?php

class PlanetsController extends AdminController
{
    public function getModel($name = 'Planet', $prefix = 'Administrator', $config = array('ignore_request' => true))
    {
        return parent::getModel($name, $prefix, $config);
    }
    
}