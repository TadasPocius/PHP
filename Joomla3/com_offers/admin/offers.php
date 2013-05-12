<?php

defined('_JEXEC') or die;

if (!JFactory::getUser()->authorise('core.manage', 'com_offers'))
{
return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// Execute the task.
jimport('joomla.application.component.controller');
$controller	= JControllerLegacy::getInstance('Offers');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();