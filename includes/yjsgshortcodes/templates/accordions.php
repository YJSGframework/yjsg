<?php
include 'framework.php';
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="<?php echo $base_link.'plugins/system/yjsg/assets/'; ?>bootstrap3/css/bootstrap.min.css" />
<script type="text/javascript" src="<?php echo $base_link.'plugins/system/yjsg/assets/'; ?>src/libraries/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $base_link.'plugins/system/yjsg/assets/'; ?>bootstrap3/js/bootstrap.min.js"></script>
<script type="text/javascript" src="accordions.js"></script>
</head>
<body>
    <div class="container">
        <h2><?php echo JText::_('YJSG_SHORTCODES_ACCORDIONS_TITLE'); ?></h2>
        <form role="form">
            <div class="form-group">
                <label for="accid" data-toggle="tooltip" data-placement="top" title="<?php echo JText::_('YJSG_SHORTCODES_ACCORDIONS_ACCID_DESC'); ?>"><?php echo JText::_('YJSG_SHORTCODES_ACCORDIONS_ACCID_LABEL'); ?></label>
                <input type="text" class="form-control" id="accid" name="accid" placeholder="<?php echo JText::_('YJSG_SHORTCODES_ACCORDIONS_ACCID_HINT'); ?>" onClick="this.select()" />
            </div>
            <div class="form-group poster">
                <label for="groups" data-toggle="tooltip" data-placement="top" title="<?php echo JText::_('YJSG_SHORTCODES_ACCORDIONS_GROUPS_DESC'); ?>"><?php echo JText::_('YJSG_SHORTCODES_ACCORDIONS_GROUPS_LABEL'); ?></label>
                <input type="text" class="form-control" id="groups" name="groups" value="3" onClick="this.select()"/>
            </div>
            <div class="form-group">
                <label for="activetab" data-toggle="tooltip" data-placement="top" title="<?php echo JText::_('YJSG_SHORTCODES_ACCORDIONS_ACTIVETAB_DESC'); ?>"><?php echo JText::_('YJSG_SHORTCODES_ACCORDIONS_ACTIVETAB_LABEL'); ?></label>
                <input type="text" class="form-control" id="activetab" name="activetab" value="0" onClick="this.select()" />
            </div>
            <button type="submit" id="addshortcode" class="btn btn-primary"><?php echo JText::_('YJSG_SHORTCODES_ACCORDIONS_BUTTON_SUBMIT'); ?></button>
        </form>
    </div>
</body>
</html>