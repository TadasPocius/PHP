<?php

defined('_JEXEC') or die;

class OffersController extends JControllerLegacy
{
	public function display($cachable = false, $urlparams = false)
	{
		$cachable = false;

		// Set the default view name and format from the Request.
		$vName = $this->input->get('view', 'offers');
		$this->input->set('view', $vName);

		return parent::display($cachable, array('Itemid' => 'INT'));
	}
}
