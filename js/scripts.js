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
	// $('.entry-summary .mspc-accordion .mspc-variation').click(function(event){
	// 	var 

	// 		imageObject = $(this).find('img'),
	// 		imageURL = $(this).find('img').attr('href'),
	// 		previewImages = $('.js-previewImagenes');

	// 	// Si no está
	// 	if ($.inArray( imageURL, arrayOfPreviewImages) == -1) {
	// 		arrayOfPreviewImages.push(imageURL); 
	// 		$(imageObject).clone().appendTo('.js-previewImagenes');
	// 		console.log(arrayOfPreviewImages);
	// 	}
	// 	else{
	// 		console.log('Si esta');
	// 		console.log(arrayOfPreviewImages);
	// 	};
		
	// });

	//$( ".mspc-variations" ).each(function( index ) {

	//	var mainClass = $(this).attr('class'),
	//		mainClass = mainClass.replace(/ /g,"_");

	//		mainClass.wrap('<div></div>').appendTo('.js-previewImagenes');

  	//		console.log( index + ": " + mainClass );

	//});
	
})( jQuery );