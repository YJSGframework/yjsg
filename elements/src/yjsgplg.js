/*======================================================================*\
|| #################################################################### ||
|| # Package - YJSG Framework                							||
|| # Copyright (C) since 2007  Youjoomla.com. All Rights Reserved.      ||
|| # license - PHP files are licensed under  GNU/GPL V2                 ||
|| # license - CSS  - JS - IMAGE files  are Copyrighted material        ||
|| # bound by Proprietary License of Youjoomla.com                      ||
|| # for more information visit http://www.youjoomla.com/license.html   ||
|| # Redistribution and  modification of this software                  ||
|| # is bounded by its licenses                                         || 
|| # websites - http://www.youjoomla.com | http://www.yjsimplegrid.com  ||
|| #################################################################### || 
\*======================================================================*/
(function ($) {

    var YjsgPlugin = {

        settings: {
            adminform: "#style-form"
        },

        initialize: function (options) {

            this.options = $.extend({}, this.settings, options);

            YjsgPlugin.start();

        },
        start: function () {

            var self = this;

            this.adminForm = $(this.settings.adminform);
            this.formTask = $('input[name=task]');

            YjsgPlugin.adminUpdate('checkTemplate');

            $('#update').on('click', function (event) {
                event.preventDefault();
                $(this).fadeOut(200);
                YjsgPlugin.adminUpdate('convertTemplate');
                $('.update_msg').html('<i class="fa fa-refresh fa-spin"></i> ' + updatingTemplate);

            });

            $('#restore').on('click', function (event) {
                event.preventDefault();
                $(this).fadeOut(200);
                YjsgPlugin.adminUpdate('restoreTemplate');
                $('.update_msg').html('<i class="fa fa-refresh fa-spin"></i> ' + restoringTemplate);

            });
			
			
            $('#cleanup').on('click', function (event) {
                event.preventDefault();
                $(this).fadeOut(200);
                YjsgPlugin.adminUpdate('cleanupTemplate');
                $('.update_msg').html('<i class="fa fa-refresh fa-spin"></i> ' + updatingTemplate);

            });
			
        },

        adminUpdate: function (setTask) {

            var self = this;

            this.formTask.val(setTask)

            this.adminForm.submit(function (event) {

                event.preventDefault();

                var values = $(this).serializeArray();

                $.ajax({
                    url: yjsgPlgpath + 'plugins/system/yjsg/elements/yjsgupdatetemplate.php',
                    type: "post",
                    data: $.extend(values, {
                        task: setTask
                    }),
                    dataType: 'json',
                    success: function (data, textStatus, jqXHR) {

                        setTimeout(function () {
							
							if (data.tupdate == 'cleanup') {
								
								$('#cleanup').fadeIn(800).css('display', 'inline-block');
							}
							
							
                            if (data.tupdate == 'yes') {

                                $('#update').fadeIn(800).css('display', 'inline-block');

                            }
                            if (data.tupdate == 'no') {

                                $('#update').fadeOut(800);
                            }
							
							
							
							
                            if (data.tupdate == 'done') {

                                $('#update').fadeOut(800, function () {
                                    $('#restore').fadeIn(800).css('display', 'inline-block');
                                });

                            }

                            if (data.tupdate == 'restored') {

                                $('#restore').fadeOut(800, function () {
                                    $('#update').fadeIn(800).css('display', 'inline-block');
                                });

                            }

                            $('.update_msg').html(data.message);

                        }, 1000);

                        self.adminForm.unbind();
                    },
                    error: function (request, textStatus, errorThrown) {

                        if (request.status === 0) {
                            $('.update_msg').html('<span class="error">Not connected.\n Verify Network.</span>');
                        } else if (request.status == 404) {
                            $('.update_msg').html('<span class="error">Requested page not found. [404]</span>');
                        } else if (request.status == 500) {
                            $('.update_msg').html('<span class="error">Internal Server Error [500].</span>');
                        } else if (textStatus === 'parsererror') {
                            $('.update_msg').html('<span class="error">Requested JSON parse failed.</span>');
                        } else if (textStatus === 'timeout') {
                            $('.update_msg').html('<span class="error">Time out error.</span>');
                        } else if (textStatus === 'abort') {
                            $('.update_msg').html('<span class="error">Ajax request aborted.</span>');
                        } else {
                            $('.update_msg').html('<span class="error">Uncaught Error.\n' + request.responseText + '</span>');
                        }

                        self.adminForm.unbind();

                    }
                });
            });
            this.adminForm.submit();
        }
    }

    $(document).on('ready', YjsgPlugin.initialize);

})(jQuery);