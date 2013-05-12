<?php

defined('_JEXEC') or die;


class OffersViewUpdate extends JViewLegacy
{
    protected $item;

    protected $editor;

    public function display($tpl = null)
    {
        // Initialiase variables.
        $this->item	= $this->GetData();
        $this->item = $this->item[0];
        $this->editor =& JFactory::getEditor();

        if($this->item == null)
        {
            JError::raiseError(500, "Invalid id provided.");
            return false;
        }

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

        JToolbarHelper::title(JText::_('COM_OFFERS_MANAGER_EDIT'), 'offers.png');

        JToolBarHelper::save();
        JToolBarHelper::cancel();
    }

    private function GetData(){

        $id = JRequest::getVar('id');

        // Get a db connection.
        $db = JFactory::getDbo();

        // Create a new query object.
        $query = $db->getQuery(true);

        // Select all records from the user profile table where key begins with "custom.".
        // Order it by the ordering field.
        $query->select(array('id', 'offerTitle', 'offerDescription', 'offerImageUrl', 'offerOrder'));
        $query->from('#__custom_offers');
        $query->where($db->quoteName('id')." = ".$id);

        // Reset the query using our newly populated query object.
        $db->setQuery($query);

        // Load the results as a list of stdClass objects.
        return $db->loadObjectList();
    }
}