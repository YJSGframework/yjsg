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
            var accid 		= $('input[name=accid]').val();
			var groups 		= $('input[name=groups]').val();
			var activetab 	= $('input[name=activetab]').val();
			
			
			if(accid ==''){
				accid ='myid';
			}
			
		  
		 var accordions ="<br/>\n";
		 	 accordions +='[yjsgacs ';
			 accordions +='id="' + accid + '"]';
			 accordions +="<br/>\n";

				for ( var i = 0; i < groups ; i++ ) {
					
					var activeacc= 0;
					
					if(i == activetab){
						
						activeacc= 1;
						
					}
					
					accordions +='[yjsgacgroup title="My title" active="'+activeacc+'"]Accordion content goes here...[/yjsgacgroup]';
					accordions +="<br/>\n";
				}


			 accordions +='[/yjsgacs]';
			 accordions +="<br/>\n";

			var findEditor = $("#editor-xtd-buttons", parent.document.body).parent().find('textarea').attr('id');
			
			if( findEditor !='undefined' ){
				window.parent.jInsertEditorText(accordions, findEditor);
			}
			
        });

    });
}(jQuery));