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
			var iconsize = $('select[name=iconsize]').val();
            var icon = $('input[name=icon]').val();
			var iconspin = $('select[name=iconspin]').val();
			var iconborder = $('select[name=iconborder]').val();
			var iconrotate = $('select[name=iconrotate]').val();
			


			if(icon ==''){
				
				alert('Click on any icon');
				return;
				
			}

			var iconclass = icon + iconsize + iconspin + iconborder + iconrotate;
			
		 	var addicon ='[yjsgfa ';
			 addicon +='name="' + iconclass + '"]';
			
			
			
			var findEditor = $("#editor-xtd-buttons", parent.document.body).parent().find('textarea').attr('id');
			
			if( findEditor !='undefined' ){
				window.parent.jInsertEditorText(addicon, findEditor);
			}

			
        });

    });
}(jQuery));