(function ($) {
    $(document).ready(function () {
		
		
		$('[data-toggle=tooltip]').tooltip({
		  	container: 'body',
			trigger:'click'// bug on hover
		 });
		 
		 $('select,input,textarea').on('mouseenter', function (event) {
			 
			 var label = $('label[for="'+$(this).attr('id')+'"]');
			 
			 label.trigger('click');
			 
		 }).on('mouseleave', function (event) {
			  var label = $('label[for="'+$(this).attr('id')+'"]');
			label.trigger('click');
		 });
		 
		 
		
        $('#addshortcode').click(function (event) {
            event.preventDefault();
            var color 		= $('select[name=color]').val();
			var closebutton = $('select[name=closebutton]').val();
			var iconsize 	= $('select[name=iconsize]').val();
			var iconalign 	= $('select[name=iconalign]').val();
            var icon 		= $('input[name=icon]').val();
            var borderstyle = $('select[name=borderstyle]').val();
            var radius 		= $('select[name=radius]').val();
            var title 		= $('input[name=title]').val();
			var content 	= $('textarea[name=content]').val();
			
			var noteiconclass = iconalign + icon + iconsize;

			
		 var notifications ='[yjsgnote ';
			 notifications +='color="' + color + '" ';
			 notifications +='close="' + closebutton + '" ';
			 notifications +='title="' + title + '" ';
			 notifications +='border="' + borderstyle + '" ';
			 notifications +='radius="' + radius + '" ';
			 notifications +='icon="' + noteiconclass + '"]';
			 notifications +=content;
			 notifications +='[/yjsgnote]';
			
			if (content == '') {
				alert(jstr_content_required);
				return;
				
			}
			var findEditor = $("#editor-xtd-buttons", parent.document.body).parent().find('textarea').attr('id');
			
			if( findEditor !='undefined' ){
				window.parent.jInsertEditorText(notifications, findEditor);
			}
			
        });

    });
}(jQuery));