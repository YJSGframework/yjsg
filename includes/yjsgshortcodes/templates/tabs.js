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
			var tabtype 	= $('select[name=tabtype]').val();
            var tabid 		= $('input[name=tabid]').val();
			var tabs 		= $('input[name=tabs]').val();
			var activetab 	= $('input[name=activetab]').val();
			
			
			if(tabid ==''){
				tabid ='myid';
			}
			
		  
		 var addtabs ="<br/>\n";
		 	 addtabs +='[yjsgstabs ';
			 addtabs +='id="' + tabid + '" ';
			 addtabs +='type="' + tabtype + '"]';
			 addtabs +="<br/>\n";

				for ( var i = 0; i < tabs ; i++ ) {
					
					var activetablink= 0;
					
					if(i == activetab){
						
						activetablink= 1;
						
					}
					
					addtabs +='[yjsgstabsgroup title="Tab title" active="'+activetablink+'"]Tab content goes here...[/yjsgstabsgroup]';
					addtabs +="<br/>\n";
				}


			 addtabs +='[/yjsgstabs]';
			 addtabs +="<br/>\n";

			var findEditor = $("#editor-xtd-buttons", parent.document.body).parent().find('textarea').attr('id');
			
			if( findEditor !='undefined' ){
				window.parent.jInsertEditorText(addtabs, findEditor);
			}
			
        });

    });
}(jQuery));