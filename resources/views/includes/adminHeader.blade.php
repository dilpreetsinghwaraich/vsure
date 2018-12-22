<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Vsure Consulting</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<base href="<?php echo url('/'); ?>">

<link rel="icon" href="<?php echo asset('/public'); ?>/images/favicon.png" type="image/gif" sizes="64x64">
<link href="<?php echo asset('public/admin/css') ?>/jquery-ui.css" rel="stylesheet">
<link href="<?php echo asset('public/admin/css') ?>/style.css" rel="stylesheet">
<link href="<?php echo asset('/public/vendor');?>/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
</head>
<body class="app">
  <?php $user = \Helper::getCurrentUser(); ?>
<div>
  <div class="sidebar">
    <div class="sidebar-inner">
      <div class="sidebar-logo">
        <div class="peers ai-c fxw-nw">
          <div class="peer peer-greed"><a class="sidebar-link td-n" href="<?php echo url('/') ?>" class="td-n">
            <div class="peers ai-c fxw-nw">              
              <div class="peer">
                <img src="<?php echo asset('/public'); ?>/images/logo.png" style="width: 240px; ">
              </div>
            </div>
            </a></div>
          <div class="peer">
            <div class="mobile-toggle sidebar-toggle"><a href="#" class="td-n"><i class="ti-arrow-circle-left"></i></a></div>
          </div>
        </div>
      </div>
      <ul class="sidebar-menu scrollable pos-r">
        <li class="nav-item mT-30 active"><a class="sidebar-link" href="<?php echo url('admin/dashboard'); ?>" default><span class="icon-holder"><i class="c-blue-500 ti-home"></i> </span><span class="title">Dashboard</span></a></li>
        <?php 
          if ($user->role == 'admin') {
          ?>
          <li class="nav-item"><a class="sidebar-link" href="<?php echo url('admin/pages'); ?>"><span class="icon-holder"><i class="c-red-500 ti-files"></i> </span><span class="title">Pages</span></a></li> 
          <li class="nav-item"><a class="sidebar-link" href="<?php echo url('admin/sliders'); ?>"><span class="icon-holder"><i class="c-red-500 ti-files"></i> </span><span class="title">Sliders</span></a></li>
          <li class="nav-item"><a class="sidebar-link" href="<?php echo url('admin/menus'); ?>"><span class="icon-holder"><i class="c-teal-500 ti-view-list-alt"></i> </span><span class="title">Menus</span></a></li>  
          <li class="nav-item"><a class="sidebar-link" href="<?php echo url('admin/users'); ?>"><span class="icon-holder"><i class="c-pink-500 ti-palette"></i> </span><span class="title">Users</span></a></li>            
          <li class="nav-item"><a class="sidebar-link" href="<?php echo url('admin/orders'); ?>"><span class="icon-holder"><i class="c-orange-500 ti-layout-list-thumb"></i> </span><span class="title">Orders</span></a></li> 
          <li class="nav-item"><a class="sidebar-link" href="<?php echo url('admin/inboxs'); ?>"><span class="icon-holder"><i class="c-deep-purple-500 ti-comment-alt"></i> </span><span class="title">Notification Inbox</span></a></li> 
          <li class="nav-item"><a class="sidebar-link" href="<?php echo url('admin/contact/request'); ?>"><span class="icon-holder"><i class="c-brown-500 ti-email"></i> </span><span class="title">Contact Request</span></a></li> 
          <li class="nav-item"><a class="sidebar-link" href="<?php echo url('admin/service/requests'); ?>"><span class="icon-holder"><i class="c-blue-500 ti-share"></i> </span><span class="title">Service Request</span></a></li> 
          <li class="nav-item"><a class="sidebar-link" href="<?php echo url('admin/service/forms'); ?>"><span class="icon-holder"><i class="c-blue-500 ti-share"></i> </span><span class="title">Service Forms</span></a></li> 
          <?php
          }
        ?>
        <?php 
        if ($user->role == 'editor' || $user->role == 'admin') {
          ?>          
          <li class="nav-item"><a class="sidebar-link" href="<?php echo url('admin/media'); ?>"><span class="icon-holder"><i class="c-deep-orange-500 ti-calendar"></i> </span><span class="title">Media</span></a></li>
          <li class="nav-item"><a class="sidebar-link" href="<?php echo url('admin/posts'); ?>"><span class="icon-holder"><i class="c-red-500 ti-files"></i> </span><span class="title">Posts</span></a></li>
          <li class="nav-item"><a class="sidebar-link" href="<?php echo url('admin/terms'); ?>"><span class="icon-holder"><i class="c-indigo-500 ti-bar-chart"></i> </span><span class="title">Terms</span></a></li>
          <li class="nav-item dropdown">
            <a class="dropdown-toggle" href="javascript:void(0);">
              <span class="icon-holder"><i class="c-purple-500 ti-map"></i> </span>
              <span class="title">Service Templates</span> 
              <span class="arrow"><i class="ti-angle-right"></i></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo url('admin/services'); ?>"><span class="title">Services</span></a></li>
              <li><a href="<?php echo url('admin/questions'); ?>"><span class="title">Questions</span></a></li>
              <li><a href="<?php echo url('admin/features'); ?>"><span class="title">Features</span></a></li>
              <li><a href="<?php echo url('admin/process/results'); ?>"><span class="title">Process Results</span></a></li>  
              <li><a href="<?php echo url('admin/documents'); ?>"><span class="title">Documents</span></a></li>
              <li><a href="<?php echo url('admin/packages'); ?>"><span class="title">Packages</span></a></li>
            </ul>
          </li>         
          <?php
        } ?>        
      </ul>
    </div>
  </div>
  <div class="page-container">
    <div class="header navbar">
      <div class="header-container">
        <ul class="nav-left">
          <li><a id="sidebar-toggle" class="sidebar-toggle" href="javascript:void(0);"><i class="ti-menu"></i></a></li>
          <li class="search-box"><a class="search-toggle no-pdd-right" href="javascript:void(0);"><i class="search-icon ti-search pdd-right-10"></i> <i class="search-icon-close ti-close pdd-right-10"></i></a></li>
          <li class="search-input">
            <input class="form-control" type="text" placeholder="Search...">
          </li>
        </ul>
        <ul class="nav-right">   
        <?php 
          if ($user->role == 'admin') {
            ?>
            <li><a href="<?php echo url('cache'); ?>">Purge Cache</a></li>
            <?php
          }
        ?>       
          <li class="dropdown"><a href="#" class="dropdown-toggle no-after peers fxw-nw ai-c lh-1" data-toggle="dropdown">
            <div class="peer mR-10"><img class="w-2r bdrs-50p" src="<?php echo asset('public/admin') ?>/images/10.jpg" alt=""></div>
            <div class="peer"><span class="fsz-sm c-grey-900"><?php echo $user->name; ?></span></div>
            </a>
            <ul class="dropdown-menu fsz-sm">
              <li role="separator" class="divider"></li>
              <li><a href="<?php echo url('admin/logout') ?>" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i class="ti-power-off mR-10"></i> <span>Logout</span></a></li>

            </ul>
          </li>
        </ul>
      </div>
    </div>
    <main class="main-content bgc-grey-100">
      <div id="mainContent">
        <div class="container-fluid">
        @if (Session::has('success'))
          <div class="alert alert-info">{{ Session::get('success') }}</div>
          <?php Session::forget('success') ?>
        @endif
        @if (Session::has('warning'))
          <div class="alert alert-warning">{{ Session::get('warning') }}</div>
          <?php Session::forget('warning') ?>
        @endif
        @if (Session::has('error'))
          <div class="alert alert-danger">{{ Session::get('error') }}</div>
          <?php Session::forget('error') ?>
        @endif