<?php

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

class HtmlView extends BaseHtmlView
{
    protected $item;
    
    public function display($tpl = null)
    {
        $this->item = $this->get('Item');

        // single item
        $this->itemsingle = $this->get('ItemSingle');


        $app = Factory::getApplication();
        $active = $app->getMenu()->getActive();
        $this->params = $active->params;
        $show_title = $this->params->get('show_title',1);


        //request parameters

        $input = Factory::getApplication()->input;
        $id = $input->get('id', 0, 'int');
        
        parent::display($tpl);
    }
}
