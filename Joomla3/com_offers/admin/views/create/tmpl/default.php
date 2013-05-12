<script language="javascript" type="text/javascript">
    Joomla.submitbutton = function(task)
    {
        if(task == "save"){
            document.forms["offers-form"].action = "index.php?option=com_offers&action=save";
            document.forms["offers-form"].submit();
        }
        else if (task == "cancel"){
            document.forms["offers-form"].action = "index.php?option=com_offers";
            document.forms["offers-form"].submit();
        }
    }
</script>
<form action="<?php echo JRoute::_('index.php?option=com_offers&action=save'); ?>" method="post" name="adminForm" id="offers-form" enctype="multipart/form-data">
    <div class="span10 form-horizontal">
        <fieldset>
            <div class="title">
                <div class="tab-pane active" id="details">
                    <div class="control-group">
                        <div class="control-label">
                            <label title="" class="hasTip" for="jform_title" id="jform_title-lbl" aria-invalid="false"><?php echo JText::_('COM_OFFERS_FORM_TITLE'); ?></label>
                        </div>
                        <div class="controls">
                            <input type="text" size="40" class="inputbox" value="" id="jform_title" name="jform[title]" aria-invalid="false">
                        </div>
                    </div>
                </div>
            </div>
            <div id="image">
                <div class="control-group">
                    <div class="control-label">
                        <label class="control-label" for="upload-file"><?php echo JText::_('COM_OFFERS_FORM_UPLOAD_FILE'); ?></label>
                    </div>
                    <div class="controls">
                        <input type="file" multiple="" name="jform" id="upload-file">
                    </div>
                </div>
            </div>
            <div id="description">
                <div class="control-group">
                    <div class="control-label">
                        <label class="control-label" for="upload-file"><?php echo JText::_('COM_OFFERS_FORM_DESCRIPTION'); ?></label>
                    </div>
                    <div class="controls">
                        <?php echo $this->editor->display('jform[description]', '', '500', '400', '80', '15', false); ?>
                    </div>
                </div>
            </div>
            <div id="order">
                <div class="control-group">
                    <div class="control-label">
                        <label class="control-label" for="jform_order"><?php echo JText::_('COM_OFFERS_FORM_ORDER'); ?></label>
                    </div>
                    <div class="controls">
                        <input type="text" size="5" class="inputbox" value="" id="jform_order" name="jform[order]" aria-invalid="false">
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
</form>