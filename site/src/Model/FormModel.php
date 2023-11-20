<?php


class FormModel extends FormModel{
public function getForm($data = array(), $loadData = true)
{
    $form = $this->loadForm('com_stars.form', 'planet', array('control' => 'jform', 'load_data' => $loadData));

    if (empty($form))
    {
        return false; 
    }

    return $form;
}

public function getTable($name = 'Planet', $prefix = 'Administrator', $options = [])
{
    return parent::getTable($name, $prefix, $options);
}
}