jQuery( function ( $ ) {


	var hk_admin = {

		// register the click listener
		init: function() {
			$( 'a.hk-ajax-task' ).on( 'click', this.ajax_update_values );
		},


		// update ajax values
		ajax_update_values: function( e ){

			// prepare the form data and locate hte elements that will be targeted
			var el             = $(this),
				element_parent = el.parents('.hk-ajax-parent'),
				preval         = 'action=' + el.data('action') + '&' + element_parent.find(":input").serialize(),
				data           = preval + '&security=' + hk_admin_values.security,
				message        = element_parent.find('.hk-update-message'),
				cog            = el.find('.icon-hk-cog'),
				password       = el.find('#hk-whmcs-password');

			cog.show();

			// ajax
			$.ajax({
				url    : ajaxurl,
				data   : data,
				type   : 'POST',
				success: function( response ) {	

					console.log(response);


					var return_message = (response.message != '')? response.message : hk_admin_values.success_submit;
					
					return_message = (response.response === 100)? return_message : hk_admin_values.error_submit;

					cog.hide();
					message.html(return_message).show().delay(3000).fadeOut('slow');
					password.val('');
				}					
			});

		},
	}

	// innitiate the function
	hk_admin.init();
});
