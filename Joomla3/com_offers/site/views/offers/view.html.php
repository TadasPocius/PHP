<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_wrapper
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

class OffersViewOffers extends JViewLegacy
{

	public function display($tpl = null)
	{
		$app		= JFactory::getApplication();
		$document	= JFactory::getDocument();

		$menus	= $app->getMenu();
		$menu	= $menus->getActive();

		$params = $app->getParams();

		// because the application sets a default page title, we need to get it
		// right from the menu item itself
		$title = $params->get('page_title', '');
		if (empty($title))
		{
			$title = $app->getCfg('sitename');
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 1)
		{
			$title = JText::sprintf('JPAGETITLE', $app->getCfg('sitename'), $title);
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 2)
		{
			$title = JText::sprintf('JPAGETITLE', $title, $app->getCfg('sitename'));
		}
		$this->document->setTitle($title);

		if ($params->get('menu-meta_description'))
		{
			$this->document->setDescription($params->get('menu-meta_description'));
		}

		if ($params->get('menu-meta_keywords'))
		{
			$this->document->setMetadata('keywords', $params->get('menu-meta_keywords'));
		}

		if ($params->get('robots'))
		{
			$this->document->setMetadata('robots', $params->get('robots'));
		}

        $offer = $this->getOffers();

		$this->params = &$params;
		$this->offer = &$offer;

		parent::display($tpl);
	}

    public function getOffers()
    {
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
}
