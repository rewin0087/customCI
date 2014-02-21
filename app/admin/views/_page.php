<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title; ?></title>

        <link rel="icon" href="<?php echo base_url(); ?>assets/images/new-logo.png" type="image/ico" />
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/styles/bootstrap.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/styles/responsive.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/styles/base.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/styles/admin.css" type="text/css" />

        <script type="text/javascript" src="<?php echo base_url(); ?>assets/scripts/jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/scripts/jquery-ui-1.8.13.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/scripts/bootstrap.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/scripts/jquery.dataTables.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/scripts/ckeditor/ckeditor.js"></script>
    </head>

    <body class="<?php echo $class; ?>">
        <div class="html-content">
            <header class="header clearfix">
                <?php echo $head; ?>
            </header>
            <section class="clearfix container">
                <?php echo $body; ?>
            </section>
            <footer class="footer container">
                <?php echo $foot; ?>
            </footer>
        </div>
        <div class="ajax-message"></div>
        <div class="loader">
        	<div class="loader-ui">
            	<h5>Processing... </h5>
            </div>
        </div>
        <div class="custom-modal">
            <div class="modal-container">
            <div class="modal-close-holder clearfix">
                <a href="#" class="close-modal btn btn-primary pull-right">close</a>
            </div>
            <div class="modal-content clearfix"></div>
            </div>
        </div>
        <script>
        	var base_url = '<?php echo base_url(); ?>';
        </script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/scripts/base.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/scripts/admin.js"></script>
    </body>
</html>