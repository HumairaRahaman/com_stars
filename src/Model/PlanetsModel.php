<?php
namespace Joomla\Component\Stars\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\AdminModel;

class PlanetModel extends AdminModel
{
        public function __construct($config = [])
    {
        $config['filter_fields'] = array(
            'id', 'a.id',
            'title', 'a.title',
            'alias', 'a.alias',
            'published', 'a.published',
            'created', 'a.created',
            'modified', 'a.modified',
            'access', 'a.access',
            'hits', 'a.hits',
        );

        parent::__construct($config);
    }

    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm('com_stars.planet', 'planet', array('control' => 'jform', 'load_data' => $loadData));

        if (empty($form))
        {
            return false;
        }
        
        return $form;
    }

    protected function loadFormData()
    {
    $app  = Factory::getApplication();
    $data = $app->getUserState('com_stars.edit.planet.data', []);

    if (empty($data)) 
    {
        $data = $this->getItem();
    }

    return $data;
    }
    public function save($data)
    {
    /* Add code to modify data before saving */
        if (empty($data['alias']))
        {
            if (Factory::getConfig()->get('unicodeslugs') == 1)
            {
                $data['alias'] = OutputFilter::stringURLUnicodeSlug($data['title']);
            }
            else
            {
                $data['alias'] = OutputFilter::stringURLSafe($data['title']);
            }
        }

    
        if (!$data['ordering'])
        {
            $db = Factory::getDbo();
            $query = $db->getQuery(true)
                ->select('MAX(ordering)')
                ->from('#__planets');

            $db->setQuery($query);
            $max = $db->loadResult();
        
            $data['ordering'] = $max + 1;
        }


        return parent::save($data);
    }

    public function bind($array, $ignore = '')
    {
        if (isset($array['attribs']) && \is_array($array['attribs'])) 
        {
            $registry = new Registry($array['attribs']);
            $array['attribs'] = (string) $registry;
        }

        return parent::bind($array, $ignore);
    }
    public function check()
    {
        try 
        {
            parent::check();
        } 
        catch (\Exception $e) 
        {
            $this->setError($e->getMessage());

            return false;
        }

        if (trim($this->title) == '') 
        {
            $this->setError('Title (title) is not set.');

            return false;
        }

        if (trim($this->alias) == '') 
        {
            $this->alias = $this->title;
        }

            $this->alias = ApplicationHelper::stringURLSafe($this->alias, $this->language);

        // Ensure any new items have compulsory fields set
        if (!$this->id)
        {
            // Hits must be zero on a new item
            $this->hits = 0;
        }

            // Set publish_up to null if not set
        if (!$this->publish_up) 
        {
            $this->publish_up = null;
        }

        // Set publish_down to null if not set
        if (!$this->publish_down) 
        {
            $this->publish_down = null;
        }

        // Check the publish down date is not earlier than publish up.
        if (!is_null($this->publish_up) && !is_null($this->publish_down) && $this->publish_down < $this->publish_up) 
        {
            // Swap the dates
            $temp = $this->publish_up;
            $this->publish_up = $this->publish_down;
            $this->publish_down = $temp;
        }

        return true;
    }
    public function store($updateNulls = true)
    {
        $app = Factory::getApplication();
        $date = Factory::getDate()->toSql();
        $user = Factory::getUser();

        if (!$this->created)
        {
            $this->created = $date;
        }

        if (!$this->created_by)
        {
            $this->created_by = $user->get('id');
        }

        if ($this->id) 
        {
            // Existing item
            $this->modified_by = $user->get('id');
            $this->modified = $date;
        }
        else
        {
            // Set modified to created date if not set
            if (!$this->modified) 
            {
                $this->modified = $this->created;
            }

            // Set modified_by to created_by user if not set
            if (empty($this->modified_by)) 
            {
                $this->modified_by = $this->created_by;
            }
        }

        // Verify that the alias is unique
        $table = $app->bootComponent('com_stars')->getMVCFactory()->createTable('Planet', 'Administrator');
        if ($table->load(['alias' => $this->alias]) && ($table->id != $this->id || $this->id == 0)) 
        {
            $this->setError('Alias is not unique.');

            if ($table->state == -2) 
            {
                $this->setError('Alias is not unique. The item is in Trash.');
            }

            return false;
        }
        

        return parent::store($updateNulls);
    }   
    protected function getListQuery()
    {
        $db = $this->getDatabase();
        $query = $db->getQuery(true);
        
        // Select statement
        $query->select('*')
            ->from($db->quoteName('#__planets', 'a'));
            
        // Order by
        $query->order('a.id DESC');
        return $query;

        // Filter: like / search
        $search = $this->getState('filter.search');
        if (!empty($search))
        {
            $like = $db->quote('%' . $search . '%');
            $query->where('title LIKE ' . $like);
        }

        // Published filter
        $published = $this->getState('filter.published');
        if (is_numeric($published))
        {
            $query->where($db->quoteName('published') . ' = ' . $db->quote($published));
        }
        elseif ($published === '')
        {
            $query->whereIn($db->quoteName('published'), array(0, 1));
        }

        // Add list ordering clause
        $orderCol = $this->state->get('list.ordering', 'id');
        $orderDirn = $this->state->get('list.direction', 'desc');

        $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));
    }

    public function getTable($name = 'Planet', $prefix = 'Table', $options = array())
    {
    if ($table = $this->_createTable($name, $prefix, $options))
    {
        return $table;
    }
    }
}
