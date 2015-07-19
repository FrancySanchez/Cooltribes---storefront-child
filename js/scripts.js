// This first and last line to use jQuery selectors with $ symbol. Ref: https://digwp.com/2011/09/using-instead-of-jquery-in-wordpress/
(function($) { 


	jQuery('.post-type-archive-product .product a').click(function(event){
		 event.preventDefault();
		 $( "#jquery-ui-product-dialog" ).dialog();
	});
	
})( jQuery );