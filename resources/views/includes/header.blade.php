<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Vsure Consulting</title>
<link rel="stylesheet" type="text/css" href="<?php echo asset('/public'); ?>/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset('/public'); ?>/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset('/public'); ?>/css/animate.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset('/public'); ?>/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset('/public'); ?>/css/default-style.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
<base href="<?php echo url('/'); ?>">
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
              <a href="<?php echo url('/') ?>"> <img src="<?php echo asset('/public'); ?>/images/logo.jpg"></a> </div>
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav navbar-right">
                <li class=""><a href="<?php echo url('/') ?>">Home</a></li>
                <li class=""><a href="<?php echo url('/about-us') ?>">About Us</a></li>
                <li>
                  <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Our Services <span class="fa fa-angle-down"></span> </a>
                      <ul class="dropdown-menu">
                        <li>
                          <div class="service_box">
                            <div class="row">
                              <div class="col-lg-6"><a href="<?php echo url('/Service-details'); ?>">Public Limited Company Registration</a></div>
                              <div class="col-lg-6"><a href="<?php echo url('/') ?>">One Person Company Registration</a></div>
                              <div class="col-lg-6"><a href="<?php echo url('/') ?>">Limited Liability Partnership</a></div>
                              <div class="col-lg-6"><a href="<?php echo url('/service/partnership-firm-registration'); ?>">Partnership Firm Registration</a></div>
                              <div class="col-lg-6"><a href="<?php echo url('/service/proprietorship-firm'); ?>">Proprietorship Firm</a></div>
                              <div class="col-lg-6"><a href="<?php echo url('/service/food-license-registration'); ?>">Food License Registration</a></div>
                              <div class="col-lg-6"><a href="<?php echo url('/service/msme-udyog-aadhar-registration'); ?>">MSME Udyog Aadhar Registration</a></div>
                              <div class="col-lg-6"><a href="<?php echo url('/service/shop-and-establishment-act-registration'); ?>">Shop and Establishment act Registration</a></div>
                              <div class="col-lg-6"><a href="<?php echo url('/service/gst-registration'); ?>">GST Registration</a></div>
                              <div class="col-lg-6"><a href="<?php echo url('/service/service-tax-registration'); ?>">Service Tax Registration</a></div>
                              <div class="col-lg-6"><a href="<?php echo url('/service/import-export-code'); ?>">Import-Export Code</a></div>
                              <div class="col-lg-6"><a href="<?php echo url('/service/income-tax-compliance'); ?>">Income tax compliance</a></div>
                              <div class="col-lg-6"><a href="<?php echo url('/service/gst-compliance'); ?>">GST Compliance</a></div>
                              <div class="col-lg-6"><a href="<?php echo url('/service/company-law-compliance'); ?>">Company Law Compliance</a></div>
                              <div class="col-lg-6"><a href="<?php echo url('/service/private-limited-company-incorp'); ?>">Private Limited Company Incorporation</a></div>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li class=""><a href="<?php echo url('/learning-center'); ?>">Learning Center</a></li>
                <li class=""><a href="<?php echo url('/contact-us'); ?>">Contact Us</a></li>
                <li>
                  <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown"> <a href="<?php echo url('/login'); ?>" class="dropdown-toggle">
                      <button> <span class="fa fa-user-o"></span> Sign In </button>
                      </a> </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
    </div>
  </div>
