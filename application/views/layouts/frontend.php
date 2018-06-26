<!DOCTYPE html>
<html lang="en" ng-app="pulsaeApp">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $template['title']; ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        
        <!-- Bootstrap core CSS -->
    	<link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
        
		<!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="<?php echo base_url('assets/js/libs/angular.min.js'); ?>" type="text/javascript"></script>
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
    	<header>
    		<div class="container text-center">
    			<h1>Pulsae.com</h1>
    		</div>	
    	</header>
        <main>
        	<div class="container">
        		<?php echo $template['body']; ?>        		
        	</div>
        </main>
        <!-- Bootstrap -->
        <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
    </body>
</html>
