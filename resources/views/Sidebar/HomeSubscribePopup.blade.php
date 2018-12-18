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
    <?php echo Form::open(array('url' => 'email/subscribe', 'id'=>'emailSubscriber', 'method' => 'post')) ?>
    <div class="messageResponsedSubs"></div>
      <div class="form-group">
        <label class="label" style="color: #555;">Enter your email to subscribe</label>
        <input type="email" class="form-control name" id="subscribeEmail" placeholder="Email ID" name="email" required="">
      </div>
      <button type="submit" class="btn btn-info">Submit</button> 
    </form>
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
  padding: 20px 35px 30px 35px;
  position: relative;
  top: 25%;
  z-index: 1000000;
}
.modal-prompt p, .modal-prompt h1 {
  color: #555555;
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