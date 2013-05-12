<?php

defined('_JEXEC') or die;


class OffersViewOffers extends JViewLegacy
{
    protected $categories;

    protected $items;

    protected $pagination;

    protected $state;

    public function display($tpl = null)
    {
        $this->items = $this->LoadOffers();

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

    private function LoadOffers(){
        // Get a db connection.
        $db = JFactory::getDbo();

        // Create a new query object.
        $query = $db->getQuery(true);

        // Select all records from the user profile table where key begins with "custom.".
        // Order it by the ordering field.
        $query->select(array('id', 'offerTitle', 'offerDescription', 'offerImageUrl', 'offerOrder'));
        $query->from('#__custom_offers');
        $query->order('offerOrder ASC');

        // Reset the query using our newly populated query object.
        $db->setQuery($query);

        // Load the results as a list of stdClass objects.
        return $db->loadObjectList();
    }

    protected function addToolbar()
    {
        require_once JPATH_COMPONENT . '/helpers/offers.php';

        // Get the toolbar object instance
        $bar = JToolBar::getInstance('toolbar');

        JToolbarHelper::title(JText::_('COM_OFFERS_MANAGER_OFFERS'), 'offers.png');

        //JToolBarHelper::custom('newoffer', '', '', 'New', false);
        JToolBarHelper::addNew();
    }
}