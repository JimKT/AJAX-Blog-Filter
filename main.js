$(document).ready(function(){
	$( ".filter-category, .filter-date" ).on( "change", function() {
		var category = $( '.filter-category' ).val();
		var date = $( '.filter-date' ).val()

		data = {
			'action': 'filterposts',
			'category': category,
			'date': date
		};

		$.ajax({
			url : ajaxurl,
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
				$('.filtered-posts').html( 'Loading...' );
				$('.filter-category').attr( 'disabled', 'disabled' );
				$('.filter-date').attr( 'disabled', 'disabled' );
			},
			success : function( data ) {
				if ( data ) {
					$('.filtered-posts').html( data.posts );

					$('.filter-category').removeAttr('disabled');
					$('.filter-date').removeAttr('disabled');
				} else {
					$('.filtered-posts').html( 'No posts found.' );
				}
			}
		});
	});
});