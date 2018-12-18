<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('assets/material-dashboard/assets/img/apple-icon.png');?>">
  <link rel="icon" type="image/png" href="<?php echo base_url('assets/material-dashboard/assets/img/favicon.png');?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Material Dashboard by Creative Tim
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="<?php echo base_url('assets/material-dashboard/font-awesome/css/font-awesome.min.css')?>">
  <!-- CSS Files -->
  <link href="<?php echo base_url($_SESSION['usersetting']->CssPath);?>" rel="stylesheet" />
  <link href="<?php echo base_url('assets/material-dashboard/assets/css/animate.css');?>" rel="stylesheet" />
  <link href="<?php echo base_url($_SESSION['usersetting']->CssCustomPath);?>" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="<?php echo base_url('assets/material-dashboard/assets/demo/demo.css');?>" rel="stylesheet" />

  <script src="<?php echo base_url('assets/material-dashboard/assets/js/core/jquery.min.js');?>"></script>
  <script src="<?php echo base_url('assets/material-dashboard/assets/js/core/popper.min.js');?>"></script>
  <script src="<?php echo base_url('assets/material-dashboard/assets/js/core/bootstrap-material-design.min.js');?>"></script>
  <script src="<?php echo base_url('assets/material-dashboard/assets/js/plugins/perfect-scrollbar.jquery.min.js');?>"></script>
  <!-- Plugin for the momentJs  -->
  <script src="<?php echo base_url('assets/material-dashboard/assets/js/plugins/moment.min.js');?>"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="<?php echo base_url('assets/material-dashboard/assets/js/plugins/sweetalert2.js');?>"></script>
  <!-- Forms Validations Plugin -->
  <script src="<?php echo base_url('assets/material-dashboard/assets/js/plugins/jquery.validate.min.js');?>"></script>
  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="<?php echo base_url('assets/material-dashboard/assets/js/plugins/jquery.bootstrap-wizard.js');?>"></script>
  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="<?php echo base_url('assets/material-dashboard/assets/js/plugins/bootstrap-selectpicker.js');?>"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="<?php echo base_url('assets/material-dashboard/assets/js/plugins/bootstrap-datetimepicker.min.js');?>"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="<?php echo base_url('assets/material-dashboard/assets/js/plugins/jquery.dataTables.min.js');?>"></script>
  <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="<?php echo base_url('assets/material-dashboard/assets/js/plugins/bootstrap-tagsinput.js');?>"></script>
  
  
  <script src="<?php echo base_url('assets/material-dashboard/assets/js/plugins/jasny-bootstrap.min.js');?>"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="<?php echo base_url('assets/material-dashboard/assets/js/plugins/jasny-bootstrap.min.js');?>"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="<?php echo base_url('assets/material-dashboard/assets/js/plugins/fullcalendar.min.js');?>"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="<?php echo base_url('assets/material-dashboard/assets/js/plugins/jquery-jvectormap.js');?>"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="<?php echo base_url('assets/material-dashboard/assets/js/plugins/nouislider.min.js');?>"></script>
  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <!-- Library for adding dinamically elements -->
  <script src="<?php echo base_url('assets/material-dashboard/assets/js/plugins/arrive.min.js');?>"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <script async="" defer="" src="https://buttons.github.io/buttons.js"></script>
  <!-- Chartist JS -->
  <script src="<?php echo base_url('assets/material-dashboard/assets/js/plugins/chartist.min.js');?>"></script>
  <!--  Notifications Plugin    -->
  <script src="<?php echo base_url('assets/material-dashboard/assets/js/plugins/bootstrap-notify.js');?>"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <!-- script src="<?php echo base_url('assets/material-dashboard/assets/js/material-dashboard.min.js');?>"></script> -->
  <script src="<?php echo base_url('assets/material-dashboard/assets/js/material-dashboard.min.js');?>"></script>
  
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="<?php echo base_url('assets/material-dashboard/assets/demo/demo.js');?>"></script>
  <script src="<?php echo base_url('assets/material-dashboard/assets/demo/jquery.sharrre.js');?>"></script>
  
  <script src="<?php echo base_url('assets/material-dashboard/assets/js/bootstrap-notify.js');?>"></script>
  <script src="<?php echo base_url('assets/material-dashboard/assets/js/bootbox.min.js');?>"></script>
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="green" data-background-color="black" data-image="<?php echo base_url('assets/material-dashboard//assets/img/sidebar-1.jpg');?>">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo">
		<a href="http://www.creative-tim.com" class="simple-text logo-mini">
          CT
        </a>
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
          Creative Tim
        </a>
      </div>
      <div class="sidebar-wrapper ps-container ps-theme-default ps-active-y" data-ps-id="af8bc3a6-63f8-c37d-ec22-0c6794f3a10c">
        <div class="user">
          <div class="photo">
            <img src="<?php echo base_url('assets/material-dashboard/assets/img/faces/avatar.jpg');?>">
          </div>
          <div class="user-info">
            <a data-toggle="collapse" href="#collapseExample" class="username">
              <span>
                <?php echo $_SESSION['userdata']['username']?>
                <b class="caret"></b>
              </span>
            </a>
            <div class="collapse" id="collapseExample">
              <ul class="nav">
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <span class="sidebar-mini"> MP </span>
                    <span class="sidebar-normal"> My Profile </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <span class="sidebar-mini"> EP </span>
                    <span class="sidebar-normal"> Edit Profile </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <span class="sidebar-mini"> S </span>
                    <span class="sidebar-normal"> Settings </span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <ul class="nav">
          <li class="nav-item active ">
            <a class="nav-link" href="../examples/dashboard.html">
              <i class="material-icons">dashboard</i>
              <p> Dashboard </p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link collapsed" data-toggle="collapse" href="#pagesExamples" aria-expanded="false">
              <i class="material-icons">image</i>
              <p> Master
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse" id="pagesExamples" style="">
              <ul class="nav">
              <?php foreach($mastermenu as $master) {?>
              
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo base_url($master->IndexRoute);?>">
                    <!-- <span class="sidebar-mini"> E </span> -->
                    <span class="sidebar-normal"> <?php echo lang($master->Resource)?> </span>
                  </a>
                </li>
              <?php }?>
              </ul>
            </div>
          </li>

          <li class="nav-item ">
            <a class="nav-link" href="<?php echo base_url("muser");?>">
              <i class="material-icons">face</i>
              <p> <?php echo lang('ui_user')?> </p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="<?php echo base_url("mgroupuser");?>">
              <i class="material-icons">face</i>
              <p> <?php echo lang('ui_groupuser')?> </p>
            </a>
          </li>
        </ul>
      <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; height: 551px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 495px;"></div></div></div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
			<div class="navbar-minimize">
              <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
              <div class="ripple-container"></div></button>
            </div>
            <a class="navbar-brand" href="#pablo">School Management</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form">
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <i class="material-icons">dashboard</i>
                  <p class="d-lg-none d-md-block">
                    Stats
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">notifications</i>
                  <span class="notification">5</span>
                  <p class="d-lg-none d-md-block">
                    Some Actions
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Mike John responded to your email</a>
                  <a class="dropdown-item" href="#">You have 5 new tasks</a>
                  <a class="dropdown-item" href="#">You're now friend with Andrew</a>
                  <a class="dropdown-item" href="#">Another Notification</a>
                  <a class="dropdown-item" href="#">Another One</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="<?php echo base_url('changePassword')?>"><?php echo lang('ui_changepassword')?></a>
                  <a class="dropdown-item" href="<?php echo base_url('settings')?>"><?php echo lang('ui_setting')?></a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="<?php echo base_url('login/dologout')?>"><?php echo lang('ui_logout')?></a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <script type = "text/javascript">
        //$(document).ready(function(e){
          // var notify = $.notify('<strong>Saving</strong> Do not close this page...', {
          //   type: 'success',
          //   allow_dismiss: false,
          //   showProgressbar: true
          // });

          // setTimeout(function() {
          //   notify.update('message', '<strong>Saving</strong> Page Data.');
          // }, 1000);

          // setTimeout(function() {
          //   notify.update('message', '<strong>Saving</strong> User Data.');
          // }, 2000);

          // setTimeout(function() {
          //   notify.update('message', '<strong>Saving</strong> Profile Data.');
          // }, 3000);

          // setTimeout(function() {
          //   notify.update('message', '<strong>Checking</strong> for errors.');
          // }, 4000);
          
          // setTimeout(function() {
          //   setNotification("aaa",1, 'bottom','right');
          // }, 1000);
          
          // setTimeout(function() {
          //   setNotification("bbb",1, 'bottom','right');
          // }, 2000);
        //})

        
      </script>
    
    