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
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/styles/web.css" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/scripts/jquery.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/scripts/bootstrap.js"></script>
    </head>

    <body class="<?php echo $class; ?>">
        <div class="html-content">
            <header class="header clearfix">
                <?php echo $head; ?>
            </header>
            <section class="body clearfix">
				<div class="container">
					<?php echo $body; ?>
                </div>
            </section>
            <footer class="footer clearfix">
                <?php echo $foot; ?>
            </footer>
        </div>
        <div class="ajax-message"></div>
        <div class="loader">
        	<div class="loader-ui">
            	<h5>Processing... </h5>
            </div>
        </div>
        <div id="fb-root"></div>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/scripts/base.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/scripts/web.js"></script>
    </body>
</html>