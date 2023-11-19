<?php
defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Layout\LayoutHelper;

$wa = $this->document->getWebAssetManager();

$wa->useScript('keepalive');
$wa->useScript('form.validate');
?>


<h2><?php echo $this->title; ?></h2>
<h2>Welcome to Stars Component!</h2>
<input type="hidden" name="task" value=""/>
<input type="hidden" name="boxchecked" value="0"/>
<?php echo HTMLHelper::_('form.token'); ?>



<form action="<?php echo JRoute::_('index.php?option=com_planets&layout=edit&id=' . (int) $this->item->id); ?>" 
  method="post" name="adminForm" id="item-form" class="form-validate">
  <?php echo LayoutHelper::render('joomla.searchtools.default', ['view' => $this]); ?>

    <?php echo $this->form->renderField('title'); ?>
    
    <input type="hidden" name="task" value="planet.edit" />
    <?php echo HTMLHelper::_('form.token'); ?>
    
    <table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Title</th>
            <th>ID</th>
            <th>
                <a href="/<?php echo Route::_('index.php?option=com_planets&task=planet.edit&id=' . $row->id); ?>" title="<?php echo Text::_('JACTION_EDIT'); ?> <?php echo $this->escape($row->title); ?>">
                    <?php echo $this->escape($row->title); ?>
                </a>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($this->items as $i => $item) : ?>
            <tr>
                <td><?php echo $item->title; ?></td>
                <td><?php echo $item->id; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</form>

