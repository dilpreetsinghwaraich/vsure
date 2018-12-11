<!--HEADER-->
  <div class="header">
    <div class="bg-color" style="background: url('<?php echo asset('/public'); ?>/images/home-back.jpg')">
      <div class="wrapper">
        <div class="banner-info contact-page-banner banners-home wow fadeIn delay-05s animated" style="visibility: visible; animation-name: fadeIn;">
          <h1 class="bnr-title  text-center gallery">Reset Forgot Password</h1>
          <h2 class="text-center gallery"><a href="<?php echo url('/'); ?>"><span>Home</span></a></h2>
        </div>
      </div>
    </div>
  </div>
<!--/ HEADER--> 
<section id="feature" class="register-page-content section-padding wow fadeIn delay-05s animated" style="visibility: visible; animation-name: fadeIn;">
      <div class="text-center">
           <div class="register-page">
             <div class="row">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 botom">
                  <div class="modal-body">
                    <?php echo Form::open(array('url' => 'auth/reset/forgot/password/'.$activation_key, 'method' => 'post','files'=>true)) ?>
                    @if (Session::has('success'))
                      <div class="alert alert-info">{{ Session::get('success') }}</div>
                    @endif
                    @if (Session::has('warning'))
                      <div class="alert alert-warning">{{ Session::get('warning') }}</div>
                    @endif
                    @if (Session::has('error'))
                      <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
                      <input class="password" type="password" placeholder="Password" name="password" required>
                      <input class="Confirm Password" name="confirmed" type="password" placeholder="Confirm Password" required>  
                      <button type="submit">Reset</button>
                    </form>
                  </div>
               </div>
             </div>
           </div>
      </div>
    </section>