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
    $("#package_ids").select2({
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
    $("#question_ids").select2({
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
    $("#feature_ids").select2({
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
    $("#document_ids").select2({
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
    $("#process_ids").select2({
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
});
function AJAXURL(string) {
    var url = jQuery('base').attr('href');
    return url+'/'+string;
}