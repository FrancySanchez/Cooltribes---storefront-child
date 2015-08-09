// This first and last line to use jQuery selectors with $ symbol. Ref: https://digwp.com/2011/09/using-instead-of-jquery-in-wordpress/
(function($) {

    // Modal para mostrar un preview de la tela de los trajes antes de ir a la pantalla de configurar productos
    jQuery('.tax-product_cat .product a').click(function(event) {

        // Deteniendo el evento on.click
        event.preventDefault();

        // Variables
        var
            link = $(this),
            product = link.closest('.product'),
            title = product.find('h3'),
            price = product.find('.amount'),
            url = product.find('a').attr('href'),
            img = product.find('img').clone().addClass('.imageThumb'),
        	description = product.find('.product-description-custom').clone();

        ;
        // Llenando los campos del modal (usar como referencia desde la linea 137 de functions.php )

        $('#js-modal-title').html(title.html());
        $('#js-modal-title').append(' - ' + price.html());
        $('#js-modal-link').attr('href', url);
        $('#js-modal-image').append(img);
        $('#js-modal-description').append(description);

        // Modal window usando jQuery UI, ref: http://api.jqueryui.com/dialog/
        $("#jquery-ui-product-dialog").dialog({
            width: 700,
            closeText: "X",
            modal:true,

            close: function(e) {

                $('#js-modal-title').empty();
                $('#js-modal-title').empty();
                $('#js-modal-link').attr('href', '');
                $('#js-modal-image').empty();
                $('#js-modal-description').empty();

                $(this).dialog('destroy');
            }
        });

    });


    // Agregando imagenes al preview del traje  
    // en la pagina de configuracion del traje
    $(document).ready(function() {
        var previewlist = $('.js-previewImagenes');

        // Usando un .each() para recorrer cada grupo de atributos
        $.each($('.mspc-variations'), function(index, value) {

        	// Metiendo las clases de cada grupo en una variable para diferenciarlos
        	// en el preview y remplazando los espacios con _
            var mainClass = $(this).attr('class').replace(/ /g, "_");

            // Metiendo cada version del atributo del grupo en una variable
            var varOptions = $(this).find('.mspc-variation');

            // Y agarrando el evento .click()
            $(varOptions).click(function() {

            	// Duplicando la imagen, dándole una clase y metiéndola en una variable
                var img = $(this).find('img').clone().addClass(mainClass);

                // Recorriendo el div de js-previewList en busca de la mainClass
                var existing = previewlist.find('.' + mainClass);

               // Si existe una imagen con esa clase, remplázela con la nueva
                if (existing.length) {
                    existing.replaceWith(img);

                }
                // Si no, agréguela
                else {
                    previewlist.append(img);
                }

            });

        });
    });
    //end preview del traje  



	// Navegación fija
    $("document").ready(function($) {
        var nav = $('#menu_top');

        $(window).scroll(function() {
            if ($(this).scrollTop() > 125) {
                nav.addClass("f-nav");
            } else {
                nav.removeClass("f-nav");
            }
        });
    });

	// Moviendo primera imagen del producto al preview
	$('.single-product .images > a').appendTo('.js-previewImagenes');

//-------------------------------Caledario date---------------------------------
$(document).ready(function(){
   $('.date__calendar').datepicker({
        inline: true,
        altField: '.date__input',
        autoSize: true,
        dateFormat: "dd.mm.yy"
    });

    $('.date__input').change(function(){
        $('.date__calendar').datepicker('setDate', $(this).val());
    });
});


})(jQuery);