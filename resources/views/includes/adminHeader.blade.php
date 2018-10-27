<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Vsure Consulting</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<base href="<?php echo url('/'); ?>">

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
                <div class="logo"><img src="<?php echo asset('public/admin/images') ?>/logo.png" alt=""></div>
              </div>
              <div class="peer peer-greed">
                <h5 class="lh-1 mB-0 logo-text">Vsure Consulting </h5>
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
        <li class="nav-item"><a class="sidebar-link" href="<?php echo url('admin/users'); ?>"><span class="icon-holder"><i class="c-blue-500 ti-home"></i> </span><span class="title">Users</span></a></li>
        <li class="nav-item"><a class="sidebar-link" href="<?php echo url('admin/terms'); ?>"><span class="icon-holder"><i class="c-blue-500 ti-home"></i> </span><span class="title">Terms</span></a></li>
        <li class="nav-item"><a class="sidebar-link" href="<?php echo url('admin/services'); ?>"><span class="icon-holder"><i class="c-blue-500 ti-home"></i> </span><span class="title">Services</span></a></li>
        <li class="nav-item"><a class="sidebar-link" href="<?php echo url('admin/questions'); ?>"><span class="icon-holder"><i class="c-blue-500 ti-home"></i> </span><span class="title">Questions</span></a></li>
        <li class="nav-item"><a class="sidebar-link" href="<?php echo url('admin/features'); ?>"><span class="icon-holder"><i class="c-blue-500 ti-home"></i> </span><span class="title">Features</span></a></li>
        <li class="nav-item"><a class="sidebar-link" href="<?php echo url('admin/process/results'); ?>"><span class="icon-holder"><i class="c-blue-500 ti-home"></i> </span><span class="title">Process Results</span></a></li>  
        <li class="nav-item"><a class="sidebar-link" href="<?php echo url('admin/documents'); ?>"><span class="icon-holder"><i class="c-blue-500 ti-home"></i> </span><span class="title">Documents</span></a></li>
        <li class="nav-item"><a class="sidebar-link" href="<?php echo url('admin/packages'); ?>"><span class="icon-holder"><i class="c-blue-500 ti-home"></i> </span><span class="title">Packages</span></a></li>          
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
        @endif
        @if (Session::has('warning'))
          <div class="alert alert-warning">{{ Session::get('warning') }}</div>
        @endif
        @if (Session::has('error'))
          <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif