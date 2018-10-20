<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Vsure Consulting</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<base href="<?php echo url('/'); ?>">
<style>
#loader {
  transition: all .3s ease-in-out;
  opacity: 1;
  visibility: visible;
  position: fixed;
  height: 100vh;
  width: 100%;
  background: #fff;
  z-index: 90000
}
#loader.fadeOut {
  opacity: 0;
  visibility: hidden
}
.spinner {
  width: 40px;
  height: 40px;
  position: absolute;
  top: calc(50% - 20px);
  left: calc(50% - 20px);
  background-color: #333;
  border-radius: 100%;
  -webkit-animation: sk-scaleout 1s infinite ease-in-out;
  animation: sk-scaleout 1s infinite ease-in-out
}
@-webkit-keyframes sk-scaleout {
0% {
-webkit-transform:scale(0)
}
100% {
-webkit-transform:scale(1);
opacity:0
}
}
@keyframes sk-scaleout {
0% {
-webkit-transform:scale(0);
transform:scale(0)
}
100% {
-webkit-transform:scale(1);
transform:scale(1);
opacity:0
}
}
</style>
<link href="<?php echo asset('public/admin/css') ?>/style.css" rel="stylesheet">
</head>
<body class="app">
<div class="peers ai-s fxw-nw h-100vh">
  <div class="d-n@sm- peer peer-greed h-100 pos-r bgr-n bgpX-c bgpY-c bgsz-cv" style="background-image:url(<?php echo asset('public/admin/images') ?>/bg.jpg)">
    <div class="pos-a centerXY">
      <div class="bgc-white bdrs-50p pos-r" style="width:120px;height:120px"><img class="pos-a centerXY" src="<?php echo asset('public/admin/images') ?>/logo.png" alt=""></div>
    </div>
  </div>
  <div class="col-12 col-md-4 peer pX-40 pY-80 h-100 bgc-white scrollable pos-r" style="min-width:320px">
    <h4 class="fw-300 c-grey-900 mB-40">Login</h4>
    @if (Session::has('success'))
      <div class="alert alert-info">{{ Session::get('success') }}</div>
    @endif
    @if (Session::has('warning'))
      <div class="alert alert-warning">{{ Session::get('warning') }}</div>
    @endif
    @if (Session::has('error'))
      <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif
    <?php echo Form::open(array('url' => 'admin/login', 'method' => 'post')) ?>
      <div class="form-group">
        <label class="text-normal text-dark">Username</label>
        <input type="email" name="email" class="form-control" value="<?php echo old('email'); ?>" autocomplete="of" placeholder="example@gmail.com">
      </div>
      <div class="form-group">
        <label class="text-normal text-dark">Password</label>
        <input type="password" name="password" class="form-control" value="" autocomplete="off" placeholder="Password">
      </div>
      <div class="form-group">
        <div class="peers ai-c jc-sb fxw-nw">
          <div class="peer">
            <button class="btn btn-primary" type="submit">Login</button>
          </div>
        </div>
      </div>
    <?php echo Form::close(); ?>
  </div>
</div>
<script type="text/javascript" src="<?php echo asset('public/admin/js') ?>/vendor.js"></script>
<script type="text/javascript" src="<?php echo asset('public/admin/js') ?>/bundle.js"></script>
</body>

</html>