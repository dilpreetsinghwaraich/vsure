<div id="prompt-background">
  <div id="age-check-prompt" class="modal-prompt">
    <?php echo Form::open(array('url' => 'email/subscribe', 'id'=>'emailSubscriber', 'method' => 'post')) ?>
      <div class="form-group">
        <label class="label" style="color: #555;">Enter your email to subscribe</label>
        <input type="text" class="form-control name" placeholder="Email ID" name="name" required="">
      </div>
      <button type="submit" class="btn btn-info">Submit</button> 
    </form>
  </div>
</div>
<script>
 function ageCheck() {
   var min_age = 19;  // Set the minimum age. 
   var year =   parseInt(document.getElementById('byear').value);
   var month =  parseInt(document.getElementById('bmonth').value);
   var day =    parseInt(document.getElementById('bday').value);
   var theirDate = new Date((year + min_age), month, day);
   var today = new Date;
   if ((today.getTime() - theirDate.getTime()) < 0) {
     window.location = 'http://google.com/'; //enter domain url where you would like the underaged visitor to be sent to.
   } else {
     var days = 14; //number of days until they must go through the age checker again.
     var date = new Date();
     date.setTime(date.getTime()+(days*24*60*60*1000));
     var expires = "; expires="+date.toGMTString();
     document.cookie = 'isAnAdult=true;'+expires+"; path=/";
     location.reload();
   };
  };
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