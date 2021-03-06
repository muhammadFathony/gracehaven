<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo base_url()?>assets/Dashboard/images/favicon_1.ico">

        <title>Moltran - Responsive Admin Dashboard Template</title>

        <!-- Base Css Files -->
        <link href="<?php echo base_url()?>assets/Dashboard/css/bootstrap.min.css" rel="stylesheet" />

        <!-- Font Icons -->
        <link href="<?php echo base_url()?>assets/Dashboard/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
        <link href="<?php echo base_url()?>assets/Dashboard/assets/ionicon/css/ionicons.min.css" rel="stylesheet" />
        <link href="<?php echo base_url()?>assets/Dashboard/css/material-design-iconic-font.min.css" rel="stylesheet">
		<!-- sweet alerts -->
		<link href="<?php echo base_url()?>assets/Dashboard/assets/sweet-alert/sweet-alert.min.css" rel="stylesheet">
        <!-- animate css -->
        <link href="<?php echo base_url()?>assets/Dashboard/css/animate.css" rel="stylesheet" />

        <!-- Waves-effect -->
        <link href="<?php echo base_url()?>assets/Dashboard/css/waves-effect.css" rel="stylesheet">
		<!--Form Wizard-->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/Dashboard/assets/form-wizard/jquery.steps.css" />
		<!-- Dropzone css -->
        <link href="<?php echo base_url()?>assets/Dashboard/assets/dropzone/dropzone.css" rel="stylesheet" type="text/css" />
        <!-- Custom Files -->
        <link href="<?php echo base_url()?>assets/Dashboard/css/helper.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/Dashboard/css/style.css" rel="stylesheet" type="text/css" />
		 <!-- DataTables -->
		<link href="<?php echo base_url()?>assets/Dashboard/assets/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
		 <!-- Plugins css -->
		<link href="<?php echo base_url()?>assets/Dashboard/assets/notifications/notification.css" rel="stylesheet" />
        <!-- Time Picker -->
        <link href="<?php echo base_url()?>assets/Dashboard/assets/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" />
        <link href="<?php echo base_url()?>assets/Dashboard/assets/timepicker/bootstrap-datepicker.min.css" rel="stylesheet" />
        <!-- Date Picker -->
        <link href="<?php echo base_url()?>assets/Dashboard/assets/timepicker/bootstrap-datepicker.min.css" rel="stylesheet" />
        <link href="<?php echo base_url()?>assets/Dashboard/assets/colorpicker/colorpicker.css" rel="stylesheet" type="text/css" />
        <!-- toggle -->
        <link href="<?php echo base_url()?>assets/Dashboard/assets/toggles/toggles.css" rel="stylesheet" />
        <!--venobox lightbox-->
        <link rel="stylesheet" href="<?php echo base_url()?>assets/Dashboard/assets/magnific-popup/magnific-popup.css"/>
        
        <!-- rate -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/star-rating-svg.css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="<?php echo base_url()?>assets/Dashboard/js/modernizr.min.js"></script>
        
    </head>



    <body class="fixed-left">
        
        <!-- Begin page -->
        <div id="wrapper">
        
            <!-- Top Bar Start -->
            <?php 
				$this->load->view('layout/Topbar');
			?>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
			<?php 
				$this->load->view('layout/Sidebar');
			?>
            <!-- Left Sidebar End --> 



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->                      
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
						
						<?= $contents ?>
						
                    </div> <!-- container -->
                               
                </div> <!-- content -->

                <footer class="footer text-right">
                    2015 © Moltran.
                </footer>

            </div>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


            <!-- Right Sidebar -->
            <div class="side-bar right-bar nicescroll">
                <h4 class="text-center">Chat</h4>
                <div class="contact-list nicescroll">
                    <ul class="list-group contacts-list">
                        <li class="list-group-item">
                            <a href="#">
                                <div class="avatar">
                                    <img src="<?php echo base_url()?>assets/Dashboard/images/users/avatar-1.jpg" alt="">
                                </div>
                                <span class="name">Chadengle</span>
                                <i class="fa fa-circle online"></i>
                            </a>
                            <span class="clearfix"></span>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <div class="avatar">
                                    <img src="<?php echo base_url()?>assets/Dashboard/images/users/avatar-2.jpg" alt="">
                                </div>
                                <span class="name">Tomaslau</span>
                                <i class="fa fa-circle online"></i>
                            </a>
                            <span class="clearfix"></span>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <div class="avatar">
                                    <img src="<?php echo base_url()?>assets/Dashboard/images/users/avatar-3.jpg" alt="">
                                </div>
                                <span class="name">Stillnotdavid</span>
                                <i class="fa fa-circle online"></i>
                            </a>
                            <span class="clearfix"></span>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <div class="avatar">
                                    <img src="<?php echo base_url()?>assets/Dashboard/images/users/avatar-4.jpg" alt="">
                                </div>
                                <span class="name">Kurafire</span>
                                <i class="fa fa-circle online"></i>
                            </a>
                            <span class="clearfix"></span>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <div class="avatar">
                                    <img src="<?php echo base_url()?>assets/Dashboard/images/users/avatar-5.jpg" alt="">
                                </div>
                                <span class="name">Shahedk</span>
                                <i class="fa fa-circle away"></i>
                            </a>
                            <span class="clearfix"></span>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <div class="avatar">
                                    <img src="<?php echo base_url()?>assets/Dashboard/images/users/avatar-6.jpg" alt="">
                                </div>
                                <span class="name">Adhamdannaway</span>
                                <i class="fa fa-circle away"></i>
                            </a>
                            <span class="clearfix"></span>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <div class="avatar">
                                    <img src="<?php echo base_url()?>assets/Dashboard/images/users/avatar-7.jpg" alt="">
                                </div>
                                <span class="name">Ok</span>
                                <i class="fa fa-circle away"></i>
                            </a>
                            <span class="clearfix"></span>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <div class="avatar">
                                    <img src="<?php echo base_url()?>assets/Dashboard/images/users/avatar-8.jpg" alt="">
                                </div>
                                <span class="name">Arashasghari</span>
                                <i class="fa fa-circle offline"></i>
                            </a>
                            <span class="clearfix"></span>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <div class="avatar">
                                    <img src="<?php echo base_url()?>assets/Dashboard/images/users/avatar-9.jpg" alt="">
                                </div>
                                <span class="name">Joshaustin</span>
                                <i class="fa fa-circle offline"></i>
                            </a>
                            <span class="clearfix"></span>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <div class="avatar">
                                    <img src="<?php echo base_url()?>assets/Dashboard/images/users/avatar-10.jpg" alt="">
                                </div>
                                <span class="name">Sortino</span>
                                <i class="fa fa-circle offline"></i>
                            </a>
                            <span class="clearfix"></span>
                        </li>
                    </ul>  
                </div>
            </div>
            <!-- /Right-bar -->


        </div>
        <!-- END wrapper -->
    
        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="<?php echo base_url()?>assets/Dashboard/js/jquery.min.js"></script>
        <script src="<?php echo base_url()?>assets/Dashboard/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url()?>assets/Dashboard/js/waves.js"></script>
        <script src="<?php echo base_url()?>assets/Dashboard/js/wow.min.js"></script>
        <script src="<?php echo base_url()?>assets/Dashboard/js/jquery.nicescroll.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/Dashboard/js/jquery.scrollTo.min.js"></script>
        <script src="<?php echo base_url()?>assets/Dashboard/assets/jquery-detectmobile/detect.js"></script>
        <script src="<?php echo base_url()?>assets/Dashboard/assets/fastclick/fastclick.js"></script>
        <script src="<?php echo base_url()?>assets/Dashboard/assets/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="<?php echo base_url()?>assets/Dashboard/assets/jquery-blockui/jquery.blockUI.js"></script>
		<script src="<?php echo base_url()?>assets/Dashboard/assets/sweet-alert/sweet-alert.min.js"></script>
		<!-- dataTable -->
		<script src="<?php echo base_url()?>assets/Dashboard/assets/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url()?>assets/Dashboard/assets/datatables/dataTables.bootstrap.js"></script>
		<!--Form Wizard-->
		<script src="<?php echo base_url()?>assets/Dashboard/assets/form-wizard/jquery.steps.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/Dashboard/assets/jquery.validate/jquery.validate.min.js"></script>
		<script src="<?php echo base_url()?>assets/Dashboard/assets/notifications/notify.min.js"></script>
        <script src="<?php echo base_url()?>assets/Dashboard/assets/notifications/notify-metro.js"></script>
        <script src="<?php echo base_url()?>assets/Dashboard/assets/notifications/notifications.js"></script>
        <!--wizard initialization-->
        <script src="<?php echo base_url()?>assets/Dashboard/assets/form-wizard/wizard-init.js" type="text/javascript"></script>
		<!-- Page Specific JS Libraries -->
		<script src="<?php echo base_url()?>assets/Dashboard/assets/dropzone/dropzone.min.js"></script>
        <!-- CUSTOM JS -->
        <script src="<?php echo base_url()?>assets/Dashboard/js/jquery.app.js"></script>
        <!-- timepicker -->
	    <script src="<?php echo base_url()?>assets/Dashboard/assets/timepicker/bootstrap-timepicker.min.js"></script>
        <script src="<?php echo base_url()?>assets/Dashboard/assets/timepicker/bootstrap-datepicker.js"></script>
        <!-- Date Picker -->
        <script src="<?php echo base_url()?>assets/Dashboard/assets/timepicker/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>assets/Dashboard/assets/colorpicker/bootstrap-colorpicker.js"></script>
        <!-- togle -->
        <script src="<?php echo base_url()?>assets/Dashboard/assets/toggles/toggles.min.js"></script>
        <!-- image -->
        <script type="text/javascript" src="<?php echo base_url()?>assets/Dashboard/assets/gallery/isotope.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>assets/Dashboard/assets/magnific-popup/magnific-popup.js"></script> 
        <!-- rate -->
        <script src="<?php echo base_url()?>assets/js/src/jquery.star-rating-svg.js"></script>
	</body>
</html>
