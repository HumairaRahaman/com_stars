<?php
$show_title = $this->params->get('show_title', 1);
$this->params->def('page_heading', $this->params->get('page_title', $active->title));
?>

<h1><?php echo $this->item->title; ?></h1>

<?php if ($show_title) : ?>
    <h1><?php echo $this->item->title; ?></h1>
<?php endif; ?>

<h1>Planets</h1> 
<table class="table table-striped table-hover">
    <?php foreach ($this->items as $i => $item) : ?>
        <?php $link = Route::_('index.php?option=com_stars&view=planet&id=' . (int) $item->id); ?>
        <tr>
            <td><a href="/<?php echo $link; ?>"><?php echo $item->title; ?></a></td>
        </tr>
    <?php endforeach; ?>
</table>

<!-- single Item -->

<h1><?php echo $this->item->title; ?></h1>
<?php echo $this->item->description; ?>