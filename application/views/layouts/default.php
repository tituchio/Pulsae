<!DOCTYPE html>
<html lang="en" ng-app="footballApp">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $template['title']; ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo base_url('assets-backend/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo base_url('assets-backend/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo base_url('assets-backend/css/ionicons.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url('assets-backend/css/AdminLTE.css'); ?>" rel="stylesheet" type="text/css" />

		<!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="../index.html" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                SportTracker
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <?php if($this->ion_auth->logged_in()): ?>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <?php
                        	$user = $this->ion_auth->user()->row();
							$user_group = $this->ion_auth->get_users_groups()->row();
						?>
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $user->username; ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="<?php echo base_url('assets-backend/img/avatar3.png'); ?>" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo "{$user->username} - {$user_group->name}"; ?>
                                        <small>Member since <?php echo date('Y-m-d', $user->created_on); ?></small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <a href="<?php echo base_url('auth/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <?php endif; ?>
            </nav>
        </header>
        
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li>
                            <a href="<?php echo base_url('field/realtime'); ?>">
                                <i class="fa fa-play"></i> <span>Real-Time Tracking</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('field/analysis'); ?>">
                                <i class="fa fa-play"></i> <span>Data Analysis</span>
                            </a>
                        </li>
                        <li class="<?php echo strpos(current_url(), 'backend/team') !== FALSE?'active':''; ?>">
                            <a href="<?php echo base_url('backend/team'); ?>">
                                <i class="fa fa-dashboard"></i> <span>Team</span>
                            </a>
                        </li>
                        <li class="<?php echo strpos(current_url(), 'backend/player') !== FALSE?'active':''; ?>">
                            <a href="<?php echo base_url('backend/player'); ?>">
                                <i class="fa fa-dashboard"></i> <span>Player</span>
                            </a>
                        </li>
                        <li class="<?php echo strpos(current_url(), 'backend/game') !== FALSE?'active':''; ?>">
                            <a href="<?php echo base_url('backend/game'); ?>">
                                <i class="fa fa-dashboard"></i> <span>Game</span>
                            </a>
                        </li>
                        <li class="<?php echo strpos(current_url(), 'backend/result') !== FALSE?'active':''; ?>">
                            <a href="<?php echo base_url('backend/result'); ?>">
                                <i class="fa fa-dashboard"></i> <span>Result</span>
                            </a>
                        </li>
                        <li class="<?php echo strpos(current_url(), 'backend/analysisreq') !== FALSE?'active':''; ?>"> 
                            <a href="<?php echo base_url('backend/analysisreq'); ?>">
                                <i class="fa fa-dashboard"></i> <span>Analysis Request</span>
                            </a>
                        </li>
                        <?php /*
                        <li>
                            <a href="<?php echo base_url('auth'); ?>">
                                <i class="fa fa-th"></i> <span>Administrator</span>
                            </a>
                        </li> */ ?>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side <?php //if(!$this->ion_auth->logged_in()) echo 'strech'; ?>">
                <?php echo $template['body']; ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- Bootstrap -->
        <script src="<?php echo base_url('assets-backend/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url('assets-backend/js/AdminLTE/app.js'); ?>" type="text/javascript"></script>
    </body>
</html>
