<?php

defined('_JEXEC') or die;

$controller = JControllerLegacy::getInstance('Offers');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
