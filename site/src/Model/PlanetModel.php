<?php

use Joomla\CMS\MVC\Model\ItemModel;

class PlanetModel extends ItemModel
{
    public function getItem($pk = null)
    {  
      if ($pk == null)
      {
          $pk = Factory::getApplication()->input->getInt('id');
      }
       
        $db = $this->getDatabase();
        $query = $db->getQuery(true);
       
        $query->select('*')
            ->from($db->quoteName('#__planets', 'a'))
            ->where(array(
                        $db->quoteName('a.id') . ' = ' . $db->quote($pk),
                        $db->quoteName('a.published') . ' = 1',
                        )
                    );
 
        $db->setQuery($query);
 
        $item = $db->loadObject();
 
      return $item;
    }

    protected function getListQuery()
    {
        $db = $this->getDatabase();
            
        $query = $db->getQuery(true);
            
        $query->select('*')
            ->from($db->quoteName('#__planets'))
            ->where($db->quoteName('published') . ' = ' . $db->quote(1));
                
        $query->order('id DESC');
            
        return $query;
    }

    public function getItemSingle($pk = null)
    {
        if ($pk == null)
        {
            $input = Factory::getApplication()->input;
            $pk = $input->get('id', 0, 'int');
        }
            
        $db = Factory::getDbo();
        $query = $db->getQuery(true);
            
        $query->select('*')
            ->from($db->quoteName('#__planets'))
            ->where($db->quoteName('id') . ' = '. $db->quote($pk));
                
        $db->setQuery($query);
            
        $row = $db->loadObject();
            
        return $row;
    }
}