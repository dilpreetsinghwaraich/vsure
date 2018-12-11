<div class="header">
  <div class="modal fade" id="loginModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Sign in</h4>
        </div>
        <div class="modal-body">
          <?php echo Form::open(array('url' => 'auth/login','id'=>'authLogin', 'method' => 'post','files'=>true)) ?>
            <div class="image">
            <img src="<?php echo asset('/public/images') ?>/login_image.png">
            </div>
            <div class="messageResponsed"></div>
            <input class="email" type="text" placeholder="Login ID" name="user_login" required>
            <input class="password" type="password" placeholder="Password" name="password" required>            
            <button type="submit">Sign In</button>
            <!-- <div class="sign-in-login-with">
              <p>Login with</p>
              <a href="#"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
              <a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
              <a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a>
            </div> -->
            <button class="forgot-btn" id="forgotPasswordClick" type="button">Forgot Your Password?</button>
          </form>
        </div>
        <div class="modal-footer">
          <p>Dont have a account? </p>
          <a href="<?php echo url('auth/register') ?>" class="btn btn-default">Register</a>
        </div>
      </div>
      
    </div>
  </div>
</div>
<div class="header">
  <div class="modal fade" id="ForgotPasswordModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Sign in</h4>
        </div>
        <div class="modal-body">
          <?php echo Form::open(array('url' => 'auth/forgot/password','id'=>'authForgotPassword', 'method' => 'post','files'=>true)) ?>
            <div class="image">
            <img src="<?php echo asset('/public/images') ?>/login_image.png">
            </div>
            <div class="messageResponsed"></div>
            <label>Login ID, Email ID OR Phone Number</label>
            <input class="email" type="text" placeholder="Login ID, Email ID OR Phone Number" name="user_login" required>          
            <button type="submit">Submit</button>
          </form>
        </div>
      </div>      
    </div>
  </div>
</div>