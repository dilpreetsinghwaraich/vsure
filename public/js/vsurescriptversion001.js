jQuery(document).ready(function($) {
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
});
function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
}