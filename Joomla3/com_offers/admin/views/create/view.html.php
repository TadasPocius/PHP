<?php

defined('_JEXEC') or die;


class OffersViewCreate extends JViewLegacy
{
    protected $form;

    protected $item;

    protected $editor;

    public function display($tpl = null)
    {
        // Initialiase variables.
        $this->form		= $this->get('Form');
        $this->item		= $this->get('Item');
        $this->editor =& JFactory::getEditor();

        // Check for errors.
        if (count($errors = $this->get('Errors')))
        {
            JError::raiseError(500, implode("\n", $errors));
            return false;
        }

        $this->addToolbar();

        $this->sidebar = JHtmlSidebar::render();

        parent::display($tpl);
    }

    protected function addToolbar()
    {
        require_once JPATH_COMPONENT . '/helpers/offers.php';

        // Get the toolbar object instance
        $bar = JToolBar::getInstance('toolbar');

        JToolbarHelper::title(JText::_('COM_OFFERS_MANAGER_NEW'), 'offers.png');

        JToolBarHelper::save();
        JToolBarHelper::cancel();
    }
}