<?php

use Joomla\CMS\MVC\Controller\FormController;

class PlanetController extends FormController
{
    public function save($key = null, $urlVar = null)
    {
        $this->checkToken();

        $app = $this->app;
        $model = $this->getModel('Form');
        $table = $model->getTable();
        $data = $this->input->post->get('jform', [], 'array');
        $context = "$this->option.edit.$this->context";

        if (empty($key)) 
        {
            $key = $table->getKeyName();
        }

        if (empty($urlVar)) 
        {
            $urlVar = $key;
        }

        $recordId = $this->input->getInt($urlVar);

        $data[$key] = $recordId;

        if (!$model->save($data))
        {
            $app->setUserState($context . '.data', $data);

            // Redirect back to the edit screen
            $this->setMessage(Text::sprintf('JLIB_APPLICATION_ERROR_SAVE_FAILED', $model->getError()), 'error');

            $this->setRedirect(Route::_('index.php?option=' . $this->option . '&view=form&layout=edit' . $this->getRedirectToItemAppend($recordId, $urlVar), false));

            return false;
        }

        $this->setMessage('Form successfully saved.');

        $this->setRedirect(Route::_('index.php?option=' . $this->option . '&view=planets', false));

        return true;
    }
}