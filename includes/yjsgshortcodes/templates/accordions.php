<?php
include 'framework.php';
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="<?php echo $base_link	.'plugins/system/yjsg/assets/' ?>bootstrap3/css/bootstrap.min.css" />
<script type="text/javascript" src="<?php echo $base_link	.'plugins/system/yjsg/assets/' ?>src/libraries/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $base_link	.'plugins/system/yjsg/assets/' ?>bootstrap3/js/bootstrap.min.js"></script>
<script type="text/javascript" src="accordions.js"></script>
</head>
<body>
    <div class="container">
        <h2> Accordion shortcode </h2>
        <form role="form">
            <div class="form-group">
                <label for="accid" data-toggle="tooltip" data-placement="top" title="Add an id for your accordion. It should be unique for each accordion instance."> Accordion id </label>
                <input type="text" class="form-control" id="accid" name="accid" placeholder="accordion id" onClick="this.select()" />
            </div>
            <div class="form-group poster">
                <label for="groups" data-toggle="tooltip" data-placement="top" title="How many groups should this accordion have?">Number of groups</label>
                <input type="text" class="form-control" id="groups" name="groups" value="3" onClick="this.select()"/>
            </div>
            <div class="form-group">
                <label for="activetab" data-toggle="tooltip" data-placement="top" title="Set active accordion index. The count begins at 0. Example;0,1,2">Active accordion</label>
                <input type="text" class="form-control" id="activetab" name="activetab" value="0" onClick="this.select()" />
            </div>
            <button type="submit" id="addshortcode" class="btn btn-primary">Insert shortcode</button>
        </form>
    </div>
</body>
</html>