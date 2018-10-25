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
});
function AJAXURL(string) {
    var url = jQuery('base').attr('href');
    return url+'/'+string;
}