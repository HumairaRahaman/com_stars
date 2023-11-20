<?php

use Joomla\CMS\MVC\Controller\BaseController;

class DisplayController extends BaseController
{
    protected $default_view = 'planets';

    public function display($cachable = false, $urlparams = array()) 
    {        
        return parent::display($cachable, $urlparams);
    }
}