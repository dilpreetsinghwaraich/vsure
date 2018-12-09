<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo (isset($title) && !empty($title) ?$title:'Vsure Consulting'); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo asset('/public'); ?>/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset('/public'); ?>/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo asset('public/admin/css') ?>/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset('/public'); ?>/css/animate.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset('/public'); ?>/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset('/public'); ?>/css/default-style.css">
<link rel="icon" href="<?php echo asset('/public'); ?>/images/favicon.png" type="image/gif" sizes="64x64">
<meta name="csrf-token" content="{{ csrf_token() }}">
<base href="<?php echo url('/'); ?>">
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-127207130-1"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'UA-127207130-1');
</script>
</head>
<body>
<div id="myDiv"> 
  <!--HEADER-->
  <div class="header">
    <div class="bg-color">
      <header id="main-header">
        <nav class="navbar navbar-default navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
              <a href="<?php echo url('/') ?>"> <img src="<?php echo asset('/public'); ?>/images/logo.png" style="width: 240px; "></a> </div>
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav navbar-right">
                <?php echo Helper::getServiceSubMenu(); ?>
                <?php
                  if (empty(session('token'))) {
                    ?>
                      <li>
                        <ul class="nav navbar-nav navbar-right">
                          <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="modal" data-target="#loginModal">
                            <button type="button" class="btn btn-info btn-lg" ><span class="fa fa-user-o"></span> Sign In </button>
                            </a> </li>
                        </ul>
                      </li>
                    <?php
                  }else{
                    ?>
                    <li class=""><a href="<?php echo url('/auth/logout'); ?>">Logout</a></li>
                    <li><a href="<?php echo url('/my-account'); ?>"><button type="button" class="btn btn-info btn-lg" >My Account</button></a></li>
                    <?php
                  }
                ?>
                
              </ul>
            </div>
          </div>
        </nav>
      </header>
    </div>
  </div>
