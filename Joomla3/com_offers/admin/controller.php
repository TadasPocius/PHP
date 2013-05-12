<?php
defined('_JEXEC') or die;

class OffersController extends JControllerLegacy
{
    protected $view;

    protected $layout;

    protected $id;

    public function display($cachable = false, $urlparams = false)
    {
        require_once JPATH_COMPONENT.'/helpers/offers.php';

        $view   = $this->input->get('view', 'offers');
        $layout = $this->input->get('layout', 'default');
        $id     = $this->input->getInt('id');
        $action = JRequest::getVar('action');

        $helper = new OffersHelper();

        if($action == "update"){
            $helper->UpdateOffer();
        }
        elseif($action == "save"){
            $helper->NewOffer();
        }
        elseif($action == "delete"){
            $helper->DeleteOffer();
        }

        parent::display();

        return $this;
    }
}