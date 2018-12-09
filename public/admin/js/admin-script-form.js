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
    $('.serviceRequestLeftSidebarNavTab').click(function(event) {
        event.preventDefault();
        $('.serviceRequestLeftSidebarNavTab').removeClass('active');
        $(this).addClass('active');
        var href = $(this).attr('href');
        $('.company_profile').removeClass('in');
        $(href).addClass('in');
    });
    $('.add_field').click(function(event) {
        var fieldKey = $(this).data('key');
        var tab_count = $('.append_tab_content').length;
        if(tab_count != 0 && fieldKey == 'tab')
        {
            var tabDataAttr = [];
            $.each($('.append_tab_content'), function(index, val) {
                 tabDataAttr.push($(this).attr('data-tabcount'));
            });
            tabDataMax = Math.max.apply(Math, tabDataAttr);
            tab_count = tabDataMax+1;
        }
        if (tab_count == 0 && fieldKey != 'tab') {
            window.alert('Please select tab to add field');
            return false;
        }
        if ($('.append_tab_content.open').length == 0 && fieldKey != 'tab') {
            window.alert('Please open tab to add field');
            return false;
        }
        if (fieldKey != 'tab') {
            var tab_count = $('.append_tab_content.open').attr('data-tabCount');
        }
        
        var field_count = $('.field_tab_'+tab_count).length;
        if(field_count != 0)
        {
            var fieldDataAttr = [];
            $.each($('.commonGroup'), function(index, val) {
                 fieldDataAttr.push($(this).attr('data-fieldCount'));
            });
            fieldDataMax = Math.max.apply(Math, fieldDataAttr);
            field_count = fieldDataMax+1;
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