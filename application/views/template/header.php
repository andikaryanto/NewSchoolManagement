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
    <link href="<?php echo base_url('assets/material-dashboard/assets/css/material-dashboard.min.css');?>" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="<?php echo base_url('assets/material-dashboard/assets/demo/demo.css');?>" rel="stylesheet" />
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
                    <span class="sidebar-normal"> <?php echo $resource[$master->Resource]?> </span>
                  </a>
                </li>
              <?php }?>
              </ul>
            </div>
          </li>

          <li class="nav-item ">
            <a class="nav-link" href="<?php echo base_url("muser");?>">
              <i class="material-icons">face</i>
              <p> <?php echo $resource['res_user']?> </p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="<?php echo base_url("mgroupuser");?>">
              <i class="material-icons">face</i>
              <p> <?php echo $resource['res_groupuser']?> </p>
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
                  <a class="dropdown-item" href="#">Profile</a>
                  <a class="dropdown-item" href="#">Settings</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Log out</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <script type = "text/javascript">
        $(document).ready(function(e){
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
        })

        function setNotification(message, title, position, align){

          if(title == 1){
            var titlestr = "<?php echo $resource['res_warning'] ?>";
            var type = "warning";
          }
          else if(title == 2){
            var titlestr = "<?php echo $resource['res_success'] ?>";
            var type = "success";
          }
          else if(title == 3){
            var titlestr = "<?php echo $resource['res_danger'] ?>";
            var type = "danger";
          }
          else{
            var titlestr = "<?php echo $resource['res_info'] ?>";
            var type = "info";
          }

          $.notify({
            // options
            icon: 'glyphicon glyphicon-warning-sign',
            title: titlestr + " : ",//'Bootstrap notify',
            message: message //'Turning standard Bootstrap alerts into "notify" like notifications',
            //url: 'https://github.com/mouse0270/bootstrap-notify',
            //target: '_blank'
          },{
            // settings
            element: 'body',
            position: null,
            type: type,
            allow_dismiss: true,
            newest_on_top: false,
            showProgressbar: false,
            placement: {
              from: position,
              align: align
            },
            offset: 20,
            spacing: 10,
            z_index: 1031,
            delay: 5000,
            timer: 1000,
            url_target: '_blank',
            mouse_over: 'pause',
            animate: {
              enter: 'animated fadeInRight',
              exit: 'animated fadeOutRight'
            },
            onShow: null,
            onShown: null,
            onClose: null,
            onClosed: null,
            icon_type: 'class',
            template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
              '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
              '<span data-notify="icon"></span> ' +
              '<span data-notify="title"><b>{1}</b></span> ' +
              '<span data-notify="message">{2}</span>' +
              '<div class="progress" data-notify="progressbar">' +
                '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
              '</div>' +
              '<a href="{3}" target="{4}" data-notify="url"></a>' +
            '</div>' 
          });
        }

        function deleteData(name, callback){
          bootbox.confirm({
          //title: "Destroy planet?",
          message: "<?php echo $resource['res_want_delete']?> " + name + " ?",
            buttons: {
                cancel: {
                    label: "<?php echo $resource['res_cancel']?>"
                },
                confirm: {
                    label: "<?php echo $resource['res_confirm']?>"
                }
            },
            callback: function (result) {
              callback(result);
            }
          });
        }
      </script>
    
    