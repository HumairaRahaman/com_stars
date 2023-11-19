<?php
namespace TechFry\Component\Stars\Administrator\View\Planets;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;


class HtmlView extends BaseHtmlView 
{
    protected $form;
    protected $item;
    
    public function display($tpl = null) 
    {
        $this->form = $this->get('Form');
        $this->item  = $this->get('Item');
        
        $this->addToolbar();

        parent::display($tpl);

        // Adding Filters
        $this->filterForm = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');
    
    }


    protected function addToolbar()
    {
        Factory::getApplication()->getInput()->set('hidemainmenu', true);
        ToolbarHelper::title('Planet: Add');
        
        ToolbarHelper::apply('planet.apply');
        ToolbarHelper::save('planet.save');
        ToolbarHelper::cancel('planet.cancel', 'JTOOLBAR_CLOSE');
    }
}
