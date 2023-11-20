<?php

class HtmlView extends BaseHtmlView
{
    protected $form;
    
    protected $item;

    public function display($tpl = null)
    {
        $this->item = $this->get('Item');
        $this->form = $this->get('Form');

        parent::display($tpl);
    }
}