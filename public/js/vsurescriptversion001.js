jQuery(document).ready(function($) {
    $(document).on('keydown', ".InputNumber", function(e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    $(document).on('submit', '#authLogin', function(event) {
        event.preventDefault();
        var current = $(this);
        var url = current.attr('action');
        var dataString = current.serialize();
        current.find('.messageResponsed').html('');
        if (current.find('.email').val() == '') {
            current.find('.messageResponsed').html('<div class="alert alert-warning">Email is required</div>');
            return false;
        }
        else if(!isValidEmailAddress(current.find('.email').val()))
        {
            current.find('.messageResponsed').html('<div class="alert alert-warning">The email must be a valid email address</div>');
            return false;
        }
        else if (current.find('.password').val() == '') {
            current.find('.messageResponsed').html('<div class="alert alert-warning">Password is required</div>');
            return false;
        }        
        $.ajax({
            url: url,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: dataString,
        })
        .done(function(result) {
            var data = jQuery.parseJSON(result);            
            current.find('.messageResponsed').html(data.message);
            if (data.status == 'true') {
                $('#authLogin')[0].reset();
                window.location.reload();
                return false;
            }
            return false;
        })
        .fail(function() {
            current.find('.messageResponsed').html('<div class="alert alert-warning">Something Went Wrong, Please try after sometime.</div>');
            return false;
        });
    });
    $('.contactUsFromSubmit').click(function(event) {
        var current = $(this);
        var url = current.closest('form').attr('action');
        var dataString = current.closest('form').serialize();
        current.closest('form').find('.messageResponsed').html('');
        if (current.closest('form').find('.contactName').val() == '') {
            current.closest('form').find('.messageResponsed').html('<div class="alert alert-warning">Name is required</div>');
            return false;
        }
        if (current.closest('form').find('.contactEmail').val() == '') {
            current.closest('form').find('.messageResponsed').html('<div class="alert alert-warning">Email is required</div>');
            return false;
        }
        if(!isValidEmailAddress(current.closest('form').find('.contactEmail').val()))
        {
            current.closest('form').find('.messageResponsed').html('<div class="alert alert-warning">The email must be a valid email address</div>');
            return false;
        }
        $.ajax({
            url: url,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: dataString,
        })
        .done(function(data) {
            current.closest('form').find('.messageResponsed').html(data);
            current.closest('form')[0].reset();
            return false;
        })
        .fail(function() {
            alert('Something Went Wrong, Please try after sometime');
            return false;
        });        
    });
    $(document).on('click', '.dashboardLink', function(event) {
        event.preventDefault();
        var $this = $(this);
        $.ajax({
            url: $this.data('url'),
        })
        .done(function(data) {
            $('.dashboardLink').removeClass('active');
            $this.addClass('active');
            $('#dashboardViw').html(data);
        })
        .fail(function() {
            console.log("error");
        });        
    });
    $('#profile_image').on("click", function(e){
       e.stopPropagation();
    })
    $(document).on('change', '#profile_image', function(event) {
        event.preventDefault();
        var formData = new FormData();
        formData.append( 'image', $( '#profile_image' )[0].files[0] );
        $.ajax({
            url: AJAXURL('update/profile/image'),
            type: 'POST',
            data:formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            cache:false,
            contentType: false,
            processData: false,
        })
        .done(function(data) {
            if (data == 'wrong') {
                window.alert('Something wrong with your profile image, please select valid image');
                return false;    
            }
            $('.profile_image_prview').attr('src', AJAXURL(data));
        })
        .fail(function() {
            window.alert('Something Went Wrong, Please try after sometime');
        });        
    });
    $(document).on('change', '#state', function(event) {
        if ($(this).val() == '') {
            return false;
        }
      var state = $(this).val();
      $.ajax({
        url: AJAXURL('getStateCity/')+state,
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
      })
      .done(function(data) {
        $('#city').html(data);
      })
      .fail(function() {
        window.alert('Something Went wrong, Please try After Sometime');
      });      
    });
    $(document).on('submit', '.editProfileForm', function(event) {
        event.preventDefault();
        var current = $(this);
        var dataString = current.serialize();
        current.find('.messageResponsed').html('');
        if (current.find('.name').val() == '') {
            current.find('.messageResponsed').html('<div class="alert alert-warning">Name is required</div>');
            return false;
        }
        if (current.find('.phone').val() == '') {
            current.find('.messageResponsed').html('<div class="alert alert-warning">Phone Number is required</div>');
            return false;
        }
        if (current.find('.email').val() == '') {
            current.find('.messageResponsed').html('<div class="alert alert-warning">Email is required</div>');
            return false;
        }
        else if(!isValidEmailAddress(current.find('.email').val()))
        {
            current.find('.messageResponsed').html('<div class="alert alert-warning">The email must be a valid email address</div>');
            return false;
        }       
        $.ajax({
            url: AJAXURL('update/profile'),
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: dataString,
        })
        .done(function(result) {
            var data = jQuery.parseJSON(result);            
            current.find('.messageResponsed').html(data.message);
            
            return false;
        })
        .fail(function() {
            current.find('.messageResponsed').html('<div class="alert alert-warning">Something Went Wrong, Please try after sometime.</div>');
            return false;
        });
    });
    $(document).on('click', '.varifyEmail', function(event) {
        event.preventDefault();
        var current = $('.showProfile');
        current.find('.messageResponsed').html('');
        $.ajax({
            url: AJAXURL('varify/email'),
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        })
        .done(function(result) {
            var data = jQuery.parseJSON(result);            
            current.find('.messageResponsed').html(data.message);            
            return false;
        })
        .fail(function() {
            current.find('.messageResponsed').html('<div class="alert alert-warning">Something Went Wrong, Please try after sometime.</div>');
            return false;
        });
    });
    $(document).on('click', '#sendNotification', function(event) {
        event.preventDefault();
        var dataString = $(this).closest('form').serialize();
        $.ajax({
            url: AJAXURL('send/notification'),
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: dataString,
        })
        .done(function(data) {
            if (data == 'subject') {
                alert('Subject is empty');
                return false;
            }
            if (data == 'message') {
                alert('Message is empty');
                return false;
            }
            $('#dashboardViw').html(data);            
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });        
    });
    $(document).on('click', '.td-subcat-more', function(event) {
        event.preventDefault();
        $('.td-pulldown-filter-list').toggle();        
    });
    $('#phone_otp_send').change(function(event) {
        var phone = $(this).val();
        if (phone == '') {
            return false;
        }
        $('.serviceRequestResponse').html('');
        $.ajax({
            url: AJAXURL('phone/otp/send/varification'),
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {phone: phone},
        })
        .done(function(data) {
            if (data == 'empty') {
                $('.serviceRequestResponse').html('<div class="alert alert-warning">Please enter phone.</div>');
                return false;
            }

            $('.serviceRequestResponse').html('<div class="alert alert-success">'+data+'</div>');
            $('#otp_code').show().prop('required', true);
            $('.otp_code_label, .resend_code').show();
            return false;          
        })
        .fail(function() {
            window.alert('Something Went Wrong, Please Try After Sometime.');
        }); 
    });
    $('.serviceRequestLeftSidebarNavTab').click(function(event) {
        event.preventDefault();
        $('.serviceRequestLeftSidebarNavTab').removeClass('active');
        $(this).addClass('active');
        var href = $(this).attr('href');
        $('.company_profile').removeClass('in');
        $(href).addClass('in');
    });
});
function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
}
function AJAXURL(string) {
    var url = jQuery('base').attr('href');
    return url+'/'+string;
}