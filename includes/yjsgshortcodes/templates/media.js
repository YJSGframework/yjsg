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
            var mediatype 	= $('select[name=mediatype]').val();
            var medialink 	= $('input[name=link]').val();
            var poster 		= $('input[name=poster]').val();
            var width 		= $('input[name=width]').val();
            var height 		= $('input[name=height]').val();
			var resp 		= $('select[name=responsive]').val();
			
			
			

			  if (mediatype !='audio' && width == '') {
				  
				  width = '640';
				  
			  }else if(mediatype =='audio'){
				  
				   width = '';
			  }

			  if (mediatype !='audio' && height == '') {
				  
				  height = '360';
				  
			  }else if(mediatype =='audio'){
				  
				  height = '';
			  }
			  
			  if (mediatype !='html5') {
				  
				   poster =''; 
			  }
			
			var mediaid = 'yjsg_media' + Math.floor((Math.random()*888)+1);
			var mediashortcode = '[yjsgmedia link="' + medialink + '" poster="' + poster + '" width="' + width + '" height="' + height + '" resp="'+resp+'" id="'+mediaid+'"]';
			
			if (medialink == '') {
				alert('Media link is required');
				return;
				
			}
			var findEditor = $("#editor-xtd-buttons", parent.document.body).parent().find('textarea').attr('id');
			
			if( findEditor !='undefined' ){
				window.parent.jInsertEditorText(mediashortcode, findEditor);
			}
			
        });
        $('select[name=mediatype]').change(function () {
            if ($(this).val() == 'html5') {
                $('.poster').removeClass('hide');
            } else {
                $('.poster').addClass('hide');
            }
			
            if ($(this).val() == 'audio') {
                $('.sizes').addClass('hide');
            } else {
                $('.sizes').removeClass('hide');
            }
			
        });
		

		
    });
}(jQuery));