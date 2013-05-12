<script language="javascript" type="text/javascript">
    Joomla.submitbutton = function(task)
    {
        document.forms["offers-form"].action = "index.php?option=com_offers&view=create";
        document.forms["offers-form"].submit();
    }

    function deleteOffer(id){
        document.forms["offers-form"].action = "index.php?option=com_offers&action=delete&id=" + id;
        document.forms["offers-form"].submit();
    }

    function editOffer(id){
        document.forms["offers-form"].action = "index.php?option=com_offers&view=update&id=" + id;
        document.forms["offers-form"].submit();
    }
</script>
<form action="<?php echo JRoute::_('index.php?option=com_offers&view=create'); ?>" method="post" name="adminForm" id="offers-form">

    <div class="clearfix"> </div>
    <table class="table table-striped" id="articleList">
        <thead>
        <tr>
            <th width="70%" class="nowrap hidden-phone">
                <?php echo JText::_('COM_OFFERS_HEADING_TITLE'); ?>
            </th>
            <th width="20%" class="nowrap hidden-phone center">
                <?php echo JText::_('COM_OFFERS_HEADING_OPTIONS'); ?>
            </th>
            <th width="20%" class="nowrap hidden-phone center">
                <?php echo JText::_('COM_OFFERS_HEADING_ORDER'); ?>
            </th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <td colspan="3"></td>
        </tr>
        </tfoot>
        <tbody>
			<?php foreach ($this->items as $i => $item) : ?>
                <tr>
                    <td class="nowrap has-context">
                        <div class="pull-left">
                            <?php echo $item->offerTitle; ?>
                        </div>
                    </td>
                    <td class="center hidden-phone center">
                        <div id="toolbar" class="btn-toolbar">
                            <div id="toolbar-edit" class="btn-group">
                                <button class="btn btn-small" type="button" onclick="editOffer(<?php echo $item->id; ?>)">
                                    <i class="icon-edit"> </i> Edit
                                </button>
                            </div>
                            <div id="toolbar-delete" class="btn-group">
                                <button class="btn btn-small" type="button" onclick="deleteOffer(<?php echo $item->id; ?>)">
                                    <i class="icon-delete"> </i> Delete
                                </button>
                            </div>
                        </div>
                    </td>
                    <td class="center hidden-phone center">
                        <?php echo $item->offerOrder; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</form>