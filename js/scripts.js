// This first and last line to use jQuery selectors with $ symbol. Ref: https://digwp.com/2011/09/using-instead-of-jquery-in-wordpress/

(function($) { 

	// Modal para mostrar un preview de la tela de los trajes antes de ir a la pantalla de configurar productos
	jQuery('.tax-product_cat .product a').click(function(event){

		// Deteniendo el evento on.click
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
				width: 700,
				closeText: "X",

				close: function (e) {
				
				 $('#js-modal-title').empty();
				 $('#js-modal-title').empty();
				 $('#js-modal-link').attr('href','');
				 $('#js-modal-image').empty();

	            $(this).dialog('destroy');
			}
		 });

	});

	// Agregando imagenes al preview del traje  
	// en la pagina de configuracion del traje
	// var arrayOfPreviewImages = new Array();
	
	$( document ).ready(function() {
		var previewlist = $('.js-previewImagenes');
		
		$.each($('.mspc-variations'), function( index, value ) {

			var mainClass = $(this).attr('class'),
				mainClass = mainClass.replace(/ /g,"_");
				// console.log( index + ": " + mainClass );
				$(this).attr('data-js', mainClass);

				//$('.js-previewImagenes ul').append( ' <li data-js="'+ mainClass + '"></li> ');

				var varOptions = $(this).find('.mspc-variation');
				
				$( varOptions ).click(function() {
					imageObject = $(this).find('img'),
					imageURL = $(this).find('img').attr('src');
					//imageParent = $(imageObject).closest('.mspc-variations').at tr('data-js');
					var img = $(this).find('img').clone().addClass(mainClass);
				 	//alert(imageParent);
				 	var existing = previewlist.find('.'+mainClass);
				 	if (existing.length) {
				 	 existing.replaceWith(img);
				 	} else {
				 		previewlist.append(img);
				 	}

						// if ($('.js-previewImagenes ul').attr('data-js') == imageParent ) {

						// 	this.apped(imageObject);

						// };

				});

			});

		
	});
	
})( jQuery );