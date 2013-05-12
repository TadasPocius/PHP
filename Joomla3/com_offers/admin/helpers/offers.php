<?php
defined('_JEXEC') or die;

class OffersHelper {

    public function UpdateOffer()
    {
        $jform = JRequest::get();
        $jform = $jform['jform'];

        $current = $this->GetCurrentOffer($jform['id']);

        if($current != null){
            $title = $jform['title'];
            $description = $jform['description'];
            $order = $jform['order'];

            if(empty($order))
                $order = $this->GetLastOrderIndex();

            $jFileInput = new JInput($_FILES);
            $theFiles = $jFileInput->get('jform',array(),'array');

            if(!empty($theFiles['name']))
                $image = $this->uploadImage($current->OfferImageUrl);

            $db = JFactory::getDbo();

            $query = $db->getQuery(true);

            $query->update("#__custom_offers");
            $query->set('offerTitle = '.$db->quote($title));
            $query->set('offerDescription = '.$db->quote($description));

            if(!empty($theFiles['name']))
                $query->set('offerImageUrl = '.$db->quote($image));

            $query->set('offerOrder = '.$db->quote($order));
            $query->where('id = '. $db->quote($jform['id']));
            $db->setQuery($query);

            try {
                $db->execute();
            } catch (Exception $e) {

            }
        }
    }

    public function NewOffer()
    {
        $jform = JRequest::get();
        $jform = $jform['jform'];


        $title = $jform['title'];
        $description = $jform['description'];
        $order = $jform['order'];

        if(empty($order))
            $order = $this->GetLastOrderIndex();

        $jFileInput = new JInput($_FILES);
        $theFiles = $jFileInput->get('jform',array(),'array');

        if(!empty($theFiles['name']))
            $image = $this->uploadImage('');
        else
            $image = '';

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $columns = array('offerTitle', 'offerDescription', 'offerImageUrl', 'offerOrder');
        $values = array($db->quote($title), $db->quote($description), $db->quote($image), $order);

        $query
            ->insert($db->quoteName('#__custom_offers'))
            ->columns($db->quoteName($columns))
            ->values(implode(',', $values));

        $db->setQuery($query);

        try {
            $db->query();
        } catch (Exception $e) {

        }
    }

    public function DeleteOffer(){

        $jget = JRequest::get();

        $current = $this->GetCurrentOffer($jget['id']);

        if(!empty($current)){

            if($current->offerImageUrl != ''){
                if(file_exists(JPATH_BASE.'/images/offers/'.$current)){
                    unlink(JPATH_BASE.'/images/offers/'.$current);
                }
            }

            $db = JFactory::getDbo();

            $query = $db->getQuery(true);

            $conditions = array('id='.$jget['id']);

            $query->delete($db->quoteName('#__custom_offers'));
            $query->where($conditions);

            $db->setQuery($query);

            try {
                $db->execute();
            } catch (Exception $e) {

            }
        }

    }

    public function GetCurrentOffer($id){

        $db = JFactory::getDbo();

        $query = $db->getQuery(true);

        $query->select(array('id', 'offerTitle', 'offerDescription', 'offerImageUrl', 'offerOrder'));
        $query->from('#__custom_offers');
        $query->where($db->quoteName('id')." = ".$id);

        $db->setQuery($query);

        return $db->loadObjectList();
    }

    private function uploadImage($current){

        if (!is_dir(JPATH_BASE.'/images/offers')) {
            mkdir(JPATH_BASE.'/images/offers', 0755, true);
        }

        if($current != ''){
            if(file_exists(JPATH_BASE.'/images/offers/'.$current)){
                unlink(JPATH_BASE.'/images/offers/'.$current);
            }
            if(file_exists(JPATH_BASE.'/images/offers/thumb_'.$current)){
                unlink(JPATH_BASE.'/images/offers/thumb_'.$current);
            }
        }

        jimport('joomla.filesystem.file');

        $jFileInput = new JInput($_FILES);
        $theFiles = $jFileInput->get('jform',array(),'array');

        $filepath = JPATH_SITE.'/images/offers/'.$theFiles['name'];
        JFile::upload( $theFiles['tmp_name'], $filepath );

        if(file_exists($filepath)){

            $this->resizeImage($theFiles['name']);

            return $theFiles['name'];
        }

        return '';
    }

    private function GetLastOrderIndex(){

        $db = JFactory::getDbo();

        // Create a new query object.
        $query = $db->getQuery(true);

        // Select all records from the user profile table where key begins with "custom.".
        // Order it by the ordering field.
        $query->select(array('max( offerOrder ) AS maxOrder'));
        $query->from('#__custom_offers');

        // Reset the query using our newly populated query object.
        $db->setQuery($query);

        // Load the results as a list of stdClass objects.
        $max = $db->loadObjectList();

        if($max[0]->maxOrder >= 0){
            return $max[0]->maxOrder + 1;
        }

        return 0;
    }

    private function resizeImage($fileName){

        $path = JPATH_SITE.'/images/offers/';

        $size = getimagesize($path.$fileName);

        $width = 400;
        $width = ($size[0] > $width ? $width : $size[0]);

        $height = ($width/$size[0])*$size[1];

        $thumb = imagecreatetruecolor($width, $height);
        $source = imagecreatefromjpeg($path.$fileName);

        imagecopyresampled($thumb, $source, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);

        imagejpeg($thumb, $path.'thumb_'.$fileName, 100);
    }
}