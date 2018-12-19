jQuery(document).ready(function($) {
	$('body').on('focus',".vsureDatepicker", function(){
		$(this).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd',
			minDate: new Date(), 
			yearRange: "1900:+0",
		});
    });    
    $(".InputNumber").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    $("#package_terms").select2({
        placeholder: "Search Packages",
        ajax: { 
            url: AJAXURL('admin/get/service/remote/package'),
            dataType: 'json',
            quietMillis: 250,
            data: function (term, page) {
                return {
                    q: term, 
                };
            },
            results: function (data, page) {                              
                return {                   
                  results: data.items 
                };
            },
            success: function( data ) {              
            },
            cache: true
        },         
    });
    $("#question_terms").select2({
        placeholder: "Search Questions",
        ajax: { 
            url: AJAXURL('admin/get/service/remote/question'),
            dataType: 'json',
            quietMillis: 250,
            data: function (term, page) {
                return {
                    q: term, 
                };
            },
            results: function (data, page) {                              
                return {                   
                  results: data.items 
                };
            },
            success: function( data ) {              
            },
            cache: true
        },         
    });
    $("#feature_terms").select2({
        placeholder: "Search Features",
        ajax: { 
            url: AJAXURL('admin/get/service/remote/feature'),
            dataType: 'json',
            quietMillis: 250,
            data: function (term, page) {
                return {
                    q: term, 
                };
            },
            results: function (data, page) {                              
                return {                   
                  results: data.items 
                };
            },
            success: function( data ) {              
            },
            cache: true
        },         
    });
    $("#document_terms").select2({
        placeholder: "Search Documents",
        ajax: { 
            url: AJAXURL('admin/get/service/remote/document'),
            dataType: 'json',
            quietMillis: 250,
            data: function (term, page) {
                return {
                    q: term, 
                };
            },
            results: function (data, page) {                              
                return {                   
                  results: data.items 
                };
            },
            success: function( data ) {              
            },
            cache: true
        },         
    });
    $("#process_terms").select2({
        placeholder: "Search Documents",
        ajax: { 
            url: AJAXURL('admin/get/service/remote/process/results'),
            dataType: 'json',
            quietMillis: 250,
            data: function (term, page) {
                return {
                    q: term, 
                };
            },
            results: function (data, page) {                              
                return {                   
                  results: data.items 
                };
            },
            success: function( data ) {              
            },
            cache: true
        },         
    });
    $("#receiver_ids").select2({
        placeholder: "Search User",
        ajax: { 
            url: AJAXURL('admin/get/inbox/remote/user'),
            dataType: 'json',
            quietMillis: 250,
            data: function (term, page) {
                return {
                    q: term, 
                };
            },
            results: function (data, page) {                              
                return {                   
                  results: data.items 
                };
            },
            success: function( data ) {              
            },
            cache: true
        },         
    });
    $('.post_parent_group').prop('disabled', true);
    $('.post_parent_type').change(function(event) {
        $('.post_parent_group').prop('disabled', true);
        $('.post_parent option:selected').removeAttr("selected");
        if ($(this).is(':checked')) {
            var targetID = $(this).val();
            $('#'+targetID).prop('disabled', false);    
        }        
    });
    var targetID = $('.post_parent_type:checked').val();
    $('#'+targetID).prop('disabled', false);
    $('.view_media_image').click(function(event) {
        $('.media_popup').show();
        $('.media_popup_body').html('');
        var post_id = $(this).data('post_id');
        $.ajax({
            url: AJAXURL('admin/view/media')+'/'+post_id,
            type: 'GET',
        })
        .done(function(html) {
            $('.media_popup_body').html(html);
        });        
    });
    $('.hide_media_popup').click(function(event) {
        $('.media_popup').hide();
    });
    $(document).on('click', '.getUserDocumentDetails', function(event) {
        event.preventDefault();
        var user_id = $(this).data('user_id');
        $.ajax({
            url: AJAXURL('admin/get/user/document/details/'+user_id),
            type: 'GET',
        })
        .done(function(data) {
            $('#publishDocumentDetals').html(data);
        })
        .fail(function() {
            window.alert('Something Went Wrong, Please try after some time.');
        });
    });
});
function AJAXURL(string) {
    var url = jQuery('base').attr('href');
    return url+'/'+string;
}