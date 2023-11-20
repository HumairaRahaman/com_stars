<?php
namespace Joomla\Component\Stars\Administrator\Table;

defined('_JEXEC') or die;

use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;

class PlanetTable extends Table
{
    function __construct(DatabaseDriver $db)
    {
        parent::__construct('#__planets', 'id', $db);
    }
}