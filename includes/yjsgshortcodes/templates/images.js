(function ($) {
    $(document).ready(function () {
				
		$('[data-toggle=tooltip]').tooltip({
		  	container: 'body',
			trigger:'click'// bug on hover
		 });
		 
		 $('select,input').on('mouseenter', function (event) {
			 
			 var label = $('label[for="'+$(this).attr('id')+'"]');
			 
			 label.trigger('click');
			 
		 }).on('mouseleave', function (event) {
			  var label = $('label[for="'+$(this).attr('id')+'"]');
			label.trigger('click');
		 });
		
        $('#addshortcode').click(function (event) {
            event.preventDefault();
             
			var radius 			= $('select[name=radius]').val();
			var fadeto 			= $('input[name=fadeto]').val();
			var fadespeed 		= $('input[name=fadespeed]').val();
			var effect 			= $('select[name=effect]').val();
            var group 			= $('select[name=group]').val();
			var hideptitle 		= $('select[name=hideptitle]').val();
            var type 			= $('select[name=type]').val();
            var title 			= $('input[name=title]').val();
			var alink 			= $('input[name=alink]').val();
			var target 			= $('select[name=target]').val();
			var imagelink 		= $('input[name=imagelink]').val();
			var lightbox 		= $('select[name=lightbox]').val();
			var lightboximage 	= $('input[name=lightboximage]').val();
			
			var imageeffectclass = type + radius +  group + lightbox + hideptitle;
			
			
			var effectparams = effect;
			
			if (effect == 'fade' && ( fadeto !='' || fadespeed!='') ) {
				
				effectparams ='fade|'+fadeto+'|'+fadespeed+'';
			}
			
			if (lightboximage !=''){
				
				alink = lightboximage;
				
			}

			
		 var imageeffect ='[yjsgimgs ';
		 	 imageeffect +='image="' + imagelink + '" ';
			 imageeffect +='class="' + imageeffectclass.trim() + '" ';
			 imageeffect +='title="' + title + '" ';
			 imageeffect +='link="' + alink + '" ';
			 imageeffect +='target="' + target + '" ';
			 imageeffect +='effect="' + effectparams + '"]';
			
			
			if (effect == 'fade' && ( fadeto =='' || fadespeed=='') ) {
				alert('Fade speed and fade to is required');
				return;
				
			}
			
			if (imagelink == '' || (lightbox !='' && lightboximage == '' )) {
				alert('Image is required');
				return;
				
			}
						
			var findEditor = $("#editor-xtd-buttons", parent.document.body).parent().find('textarea').attr('id');
			
			if( findEditor !='undefined' ){
				window.parent.jInsertEditorText(imageeffect, findEditor);
			}
			
        });
		

		var sadmin ='';
        var iframe = $('<iframe frameborder="0" marginwidth="0" marginheight="0" allowfullscreen></iframe>');
        var dialog = $("<div></div>").append(iframe).appendTo("body").dialog({
            autoOpen: false,
            modal: true,
            resizable: false,
            width: "auto",
            height: "auto",
            draggable: false,
            open: function () {
                $('.ui-widget-overlay').css({
                    'background-image': 'none',
                    'background-color': '#000000',
                    'position': 'fixed'
                });
            },
            close: function () {
                iframe.attr("src", "");
                $('.ui-widget-overlay').css('position', 'absolute');
            },
            buttons: {
                "Close": function () {
                    $(this).dialog("close");
                }
            }
        });
        window.jInsertFieldValue = function (value, id) {
            var element = $('#' + id);
            element.val(value);
            element.trigger('change');
        }
        window.yjsgCloseModal = function (getElem) {
            dialog.dialog('close');
        };
		
		var siteroot 	= window.parent.siteroot;
		var imagemedia 	= window.parent.imagemedia;
		
		
		
        $('.add_image').on('click', function (event) {
            event.preventDefault();
			var element = $(this).parent().find('input').attr('id');
            var src = siteroot + sadmin + imagemedia + element + '&folder=';   
            var title = 'Add image';
            iframe.attr({
                width: 600,
                height: 450,
                src: src
            });
            dialog.dialog("option", "title", title).dialog("open");

        });
		
		
        $('select[name=type]').change(function () {
            if ($(this).val() == 'yjt_polaroid') {
                $('.group,.hideptitle').removeClass('hide');
            } else {
                $('.group,.hideptitle').addClass('hide');
            }
        });
		
        $('select[name=effect]').change(function () {
            if ($(this).val() == 'fade') {
                $('.efade').removeClass('hide');
            } else {
                $('.efade').addClass('hide');
            }
        });
		
        $('select[name=lightbox]').change(function () {
            if ($(this).val() != '') {
                $('.lighboximage').removeClass('hide');
				$('.alink').addClass('hide');
				$('.atarget').addClass('hide');
            } else {
                $('.lighboximage').addClass('hide');
				$('.alink').removeClass('hide');
				$('.atarget').removeClass('hide');
            }
        });
		
    });
	
}(jQuery));