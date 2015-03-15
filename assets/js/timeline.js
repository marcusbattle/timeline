jQuery(document).ready(function($){
	
	$('#post-button').on( 'click', function( button_event ) {

		button_event.preventDefault();

		var post_title = '';
		var post_text = $('#post-text').val();
		var featured_image = $('#base64').val();

		request = $.ajax({
			url: timeline_ajax.ajax_url,
			type: "POST",
			data: { 
				action : 'save_post_ajax',
				post_title : post_title, 
				post_content : post_text,
				featured_image : featured_image
			},
			dataType: "JSON"
		});

		request.done( function( response ) {
			
			if ( ! response.success ) {
				alert( response.message );	
			} else {
				html = response.html.replace(/\\/g, '');
				$('.post.create-new').after( html );
			}
			
		});

		$('#post-text').val('');
		$('.create-new .thumbnail').fadeOut().removeAttr('style');

	});

	$('.add-image').on( 'click', function( button_event ) {

		button_event.preventDefault();

		$('#featured-image-input').click();

	});

	$('input:file').change( function( pick_file_event ) {
       
       	// var fileName = $(this).val();
       	// $('.add-image-filename').html( fileName );

       	var input = pick_file_event.target;
		// var image = input.files[0];
		var reader = new FileReader();

		var image = { filename: input.files[0].name, mime_type: input.files[0].type };
		

       	reader.onload = (function(){

       		image.base64 = $(reader)[0].result;

       		$('.create-new .thumbnail').attr( 'style', 'background-image: url(' + image.base64 + ')' );
	      	$('.create-new .thumbnail').fadeIn();
	      	$('#base64').val( image );

	      	

	      	console.log( image );

       	});

	    reader.readAsDataURL( input.files[0] );

    });	

});