jQuery(document).ready(function() {
	jQuery( "#sortable" ).sortable();
	jQuery( "#sortable" ).disableSelection();
	
	jQuery( '.ui-state-default' ).on( 'mousedown', function() {
		jQuery( '#customize-header-actions #save' ).trigger( 'click' );
		
		console.log(jQuery('#sortable').html());
		
	});
});	