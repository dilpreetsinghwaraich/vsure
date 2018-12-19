<script type="text/javascript">
  function readCookie(name) {
      var nameEQ = name + "=";
      var ca = document.cookie.split(';');
      for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
      }
      return null;
  };
  var isAnAdult = readCookie('isAnAdult');
  if (isAnAdult) {
      document.write("<style> #prompt-background { display: none; }</style>");
  };
</script>
<div id="prompt-background">
  <div id="age-check-prompt" class="modal-prompt">
    <div style="display:none;">
      <select name="bmonth" id="bmonth" value="1">
      </select>
      <select name="bday" id="bday" value="1">
      </select>
      <select name="byear" id="byear" value="1950">
      </select>
      <div style="clear:both; margin-bottom:15px"></div>
    </div>    
    <div class="thumbnail center well well-sm text-center">
      <h2>Newsletter</h2>
      <p>Subscribe to our weekly Newsletter and stay tuned.</p>
      <?php echo Form::open(array('url' => 'email/subscribe', 'id'=>'emailSubscriber', 'method' => 'post')) ?>
        <div class="messageResponsedSubs"></div>
        <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-envelope"></i> </span>
          <input class="form-control" type="email" required="" id="subscribeEmail" name="email" placeholder="your@email.com">
        </div>
        <input type="submit" value="Subscribe" class="btn btn-large btn-primary" />
      </form>
    </div>
  </div>
</div>
<style>
.modal-prompt {
  background: #fff;
  border-radius: 2px;
  box-shadow: 0px 0px 10px rgba(0,0,0,0.5);
  width: 330px;
  height: auto;
  margin: 0 auto;
  padding: 0;
  position: relative;
  top: 25%;
  z-index: 1000000;
}
.modal-prompt p, .modal-prompt h1 {
  color: #555555;
}input.btn-primary {
    margin-top: 15px;
}
#prompt-background {
  background: #00000069;
  width: 100%;
  height: 100%;
  position: fixed;
  left: 0;
  top: 0;
  z-index: 9999999;
}
  
.modal-prompt select { float: left; margin-right: 10px; }
</style>

<div id="shopify-section-header" class="shopify-section">
  <style>
.site-header__logo img {
  max-width: 450px;
}
</style>