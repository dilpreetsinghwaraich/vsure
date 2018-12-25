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
<link rel="stylesheet" type="text/css" href="<?php echo asset('/public'); ?>/css/res.css">
<link rel="icon" href="<?php echo asset('/public'); ?>/images/favicon.png" type="image/gif" sizes="64x64">
<script src="<?php echo asset('/public'); ?>/js/jquery.min.js"></script>
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
  <?php $user = \Helper::getCurrentUser(); ?>
<div id="myDiv"> 
  <!--HEADER-->
  <div class="header">
    <div class="bg-color">
      <header id="main-header">
        <nav class="navbar navbar-default navbar-fixed-top">

         <div class="vsure-header-top">
          <div class="row">
            <div class="col-md-2 col-xs-2 col-sm-2">
              <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
              <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
              <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
            </div>

            <div class="col-md-10 col-xs-10 col-sm-10">
              <ul> 
                <li class=""><a href="<?php echo url('/blog'); ?>">Learning Center</a></li>
                <?php 
                  if ($user->role == 'admin') {
                    ?>
                    <li><a href="<?php echo url('cache'); ?>">Purge Cache</a></li>
                    <?php
                  }
                ?>
                <?php
                  if (empty(session('token'))) {
                    ?>
                    <li><a href="#" class="dropdown-toggle btn btn-info btn-lg" data-toggle="modal" data-target="#loginModal">Sign In</a></li>                      
                    <?php
                  }else{
                    ?>
                    <li class=""><a href="<?php echo url('/auth/logout'); ?>">Logout</a></li>
                    <li><a href="<?php echo url('/my-account'); ?>" class="dropdown-toggle btn btn-info btn-lg">My Account</a></li>
                    <?php
                  }
                ?>
              </ul>
            </div>
          </div>
        </div>

        <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
              <a href="<?php echo url('/') ?>"> <img class="vsure-logo-image" src="<?php echo asset('/public'); ?>/images/logo.png" style="width: 240px; "></a> 
              <?php
                  if (empty(session('token'))) {
                    ?>
                    <a class="navbar-sign-in-button" href="#" data-toggle="modal" data-target="#loginModal">sign in</a>                     
                    <?php
                  }else{
                    ?>
                    <a class="navbar-sign-in-button" href="<?php echo url('/my-account'); ?>" >My Account</a>
                    <?php
                  }
                ?>
              </div>
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav navbar-right">
                <?php echo Helper::getServiceSubMenu(); ?>
                <?php
                  if (!empty(session('token'))) {
                    ?>
                    <li><a class="" href="<?php echo url('/auth/logout'); ?>">Logout</a></li>
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
