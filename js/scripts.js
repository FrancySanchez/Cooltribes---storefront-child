// This first and last line to use jQuery selectors with $ symbol. Ref: https://digwp.com/2011/09/using-instead-of-jquery-in-wordpress/

(function($) { 

	jQuery('.tax-product_cat .product a').click(function(event){
		 event.preventDefault();

		 // Variables
		 var 
		 	link    = $(this), 
		 	product = link.closest('.product'),
		 	title   = product.find('h3'),
		 	price   = product.find('.amount'),
		 	url   	= product.find('a').attr('href'),
		 	img		= product.find('img').clone().addClass('.imageThumb');
		 	des     = product.find('')

		 ;
		 // Llenando los campos del modal (usar como referencia desde la linea 137 de functions.php )

		 $('#js-modal-title').html(title.html());
		 $('#js-modal-title').append(' - ' + price.html());
		 $('#js-modal-link').attr('href', url);
		 $('#js-modal-image').append(img);

		 // Modal window usando jQuery UI, ref: http://api.jqueryui.com/dialog/
		 $( "#jquery-ui-product-dialog" ).dialog({
				width: 500,

				close: function (e) {
				
				 $('#js-modal-title').empty();
				 $('#js-modal-title').empty();
				 $('#js-modal-link').attr('href','');
				 $('#js-modal-image').empty();

	            $(this).dialog('destroy');
			}
		 });

	});
	
	
})( jQuery );