jQuery(document).ready(function($) {	
    $('#add_new_service_form').click(function(event) {        
        var service_id = $('#service_id').val();
        if (service_id == '') {
            alert('Please Select service');
            return false;
        }
        var url = AJAXURL('admin/edit/form/service/'+service_id);        
        window.location.href = url;
        return false;
    });
    $('.add_field').click(function(event) {
        var fieldKey = $(this).data('key');
        var tab_count = $('.append_tab_content').length;
        if (tab_count == 0 && fieldKey != 'tab') {
            window.alert('Please select tab to add field');
            return false;
        }
        if ($('.append_tab_content.open').length == 0 && fieldKey != 'tab') {
            window.alert('Please open tab to add field');
            return false;
        }
        var field_count = 0;
        switch (fieldKey) {
            case 'text':
                var tab_count = $('.append_tab_content.open').attr('data-tabCount');
                var field_count = $('.textField').length;
                break;
            case 'email':
                var tab_count = $('.append_tab_content.open').attr('data-tabCount');
                var field_count = $('.emailField').length;
                break;
            case 'number':
                var field_count = $('.numberField').length;
                var tab_count = $('.append_tab_content.open').attr('data-tabCount');
                break;
            case 'textarea':
                var field_count = $('.textareaField').length;
                var tab_count = $('.append_tab_content.open').attr('data-tabCount');
                break;
            case 'checkbox':
                var field_count = $('.checkboxField').length;
                var tab_count = $('.append_tab_content.open').attr('data-tabCount');
                break;
            case 'radio':
                var field_count = $('.radioField').length;
                var tab_count = $('.append_tab_content.open').attr('data-tabCount');
                break;
            case 'select':
                var field_count = $('.selectField').length;
                var tab_count = $('.append_tab_content.open').attr('data-tabCount');
                break;
        }

        $.ajax({
            url: AJAXURL('/admin/get/form/field/'+fieldKey),
            type: 'GET',
            data: {field_count: field_count, tab_count: tab_count, fieldKey: fieldKey},
        })
        .done(function(data) {
            if (fieldKey == 'tab') {
                $('.append_tab_content.open').removeClass('open');
                $('.append_field').append(data);
            }else{
                $('.append_tab_content.open').append(data);
            }            
        })
        .fail(function() {
            window.alert('Something Went Wrong, Please try after sometime');
        });        
    });
    $(document).on('click', '.OPenCloseTab', function(event) {
        event.preventDefault();
        
        var current_tab = $(this).attr('data-tab_id');
        $('#'+current_tab).siblings('.append_tab_content').removeClass('open');
        $('#'+current_tab).toggleClass('open');
    });
    $(document).on('click', '.removeTab', function(event) {
        event.preventDefault();        
        var current_tab = $(this).attr('data-tab_id');
        $('#'+current_tab).remove();
    });
    $(document).on('click', '.removeField', function(event) {
        event.preventDefault(); 
        $(this).closest('.commonGroup').remove();
    });
});
function AJAXURL(string) {
    var url = jQuery('base').attr('href');
    return url+'/'+string;
}