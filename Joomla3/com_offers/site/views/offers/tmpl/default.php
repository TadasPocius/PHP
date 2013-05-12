<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_wrapper
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<table>
    <?php
    $j = 0;
    foreach ($this->offer as $i => $item){
        if(file_exists(JPATH_SITE.'/images/offers/'.$item->offerImageUrl) && file_exists(JPATH_SITE.'/images/offers/thumb_'.$item->offerImageUrl)){
            if($j%2 == 0) echo "<tr>";
            ?>
            <td>
                <p><?php echo $item->offerTitle; ?></p>
                <p>
                    <a href="<?php echo JURI::root().'/images/offers/'.$item->offerImageUrl; ?>" target="_blank">
                        <img src="<?php echo JURI::root().'/images/offers/thumb_'.$item->offerImageUrl; ?>" border="0" />
                    </a>
                </p>
                <p><?php echo $item->offerDescription; ?></p>
            </td>
            <?php
            if($j%2 == 1) echo "</tr>";
            $j++;
        }
    }
?>
</table>