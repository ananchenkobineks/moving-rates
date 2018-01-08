jQuery(function($){
    $( "#rates-data #top-tabs" ).tabs();
    $( "#rates-data #weekdays-panel" ).tabs();
    $( "#rates-data #weekends-panel" ).tabs();

    var box;

    $('.postbox-upload').click(function(e) {
    	e.preventDefault();
    	box = $(this).data( "img" );
        tb_show('', 'media-upload.php?type=image&TB_iframe=true&post_id=0', false);
        return false;
    });

    window.send_to_editor = function(html) {
	    var image_url = $(html).attr('src');
	    var $input = $('input[name="'+box+'"]');
	    var $input_parent = $input.parent();
	    $input.val(image_url);

	   	$input_parent.parent().find(".postbox-img").remove();
	    $input_parent.prepend( '<p class="postbox-img"><img src="'+image_url+'"></p>' );
	    tb_remove();
	}

    $('.image-remove').click(function(e) {
        e.preventDefault();
        var name = $(this).data( "img" );
        $(this).parent().parent().find('.postbox-img').remove();
        var $input = $('input[name="'+name+'"]');
        $input.val(0);
    });
});