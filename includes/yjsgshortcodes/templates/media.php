<?php
require 'framework.php';
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="<?php echo $base_link	.'plugins/system/yjsg/' ?>assets/bootstrap3/css/bootstrap.min.css" />
<script type="text/javascript" src="<?php echo $base_link	.'plugins/system/yjsg/' ?>assets/src/libraries/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $base_link	.'plugins/system/yjsg/' ?>assets/bootstrap3/js/bootstrap.min.js"></script>
<script type="text/javascript" src="media.js"></script>
</head>
<body>
    <div class="container">
        <h2> Media shortcode </h2>
        <form role="form">
            <div class="form-group">
                <label for="mediatype" data-toggle="tooltip" data-placement="top" title="Select media type">Media type</label>
                <select class="form-control" id="mediatype" name="mediatype">
                    <option value="html5" selected>Html5 video</option>
                    <option value="vimeo">Vimeo video</option>
                    <option value="youtube">Youtube</option>
					<option value="audio">Audio</option>
                </select>
            </div>
            <div class="form-group">
                <label for="link" data-toggle="tooltip" data-placement="top" title="Link to your media"> Media link </label>
                <input type="text" class="form-control" id="link" name="link" placeholder="media link" onClick="this.select()" />
            </div>
            <div class="form-group poster">
                <label for="poster" data-toggle="tooltip" data-placement="top" title="Add link to poster image">Poster</label>
                <input type="text" class="form-control" id="poster" name="poster" placeholder="link to poster image" onClick="this.select()" />
            </div>
			 <div class="form-inline">
            <div class="form-group sizes">
                <label for="width" data-toggle="tooltip" data-placement="top" title="Media width. No px just numbers.">Width</label>
                <input type="text" class="form-control" id="width" name="width" placeholder="640" onClick="this.select()" />
            </div>
            <div class="form-group sizes">
                <label for="height" data-toggle="tooltip" data-placement="top" title="Media height. No px just numbers.">Height</label>
                <input type="text" class="form-control" id="height" name="height" placeholder="360" onClick="this.select()" />
            </div>
            <div class="form-group">
                <label for="responsive" data-toggle="tooltip" data-placement="top" title="Responsive media element?">Responsive</label>
                <select class="form-control" id="responsive" name="responsive">
                    <option value="yes" selected>Yes</option>
                    <option value="no">no</option>
                </select>
            </div>
			 </div><br/>
            <button type="submit" id="addshortcode" class="btn btn-primary">Insert shortcode</button>
        </form>
    </div>
</body>
</html>