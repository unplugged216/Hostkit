jQuery( function ( $ ) {


	var hk_admin = {

		// register the click listener
		init: function() {
			$( 'a.hk-ajax-task' ).on( 'click', this.ajax_update_values );

			hk_admin.init_values();

		},


		// get hte initial values for a page
		init_values: function() {
			var element = $('.hk-init-valwrap'),
				data    = element.data('action') + '&security=' + hk_admin_values.security,
				branch  = element.data('function')


			console.log(data);

			$.ajax({
				url    : ajaxurl,
				data   : data,
				type   : 'POST',
				success: function( response ) {	

					var details = response.results,
						income  = details.income_thismonth.split(' ');

					$('.hk-quickstats-income').find('.hk-hero-stats').html(income[0]);
					$('.hk-quickstats-pending-orders').find('.hk-hero-stats').html(details.orders_pending);
					$('.hk-quickstats-tickets-open').find('.hk-hero-stats').html(details.tickets_open);

				}					
			});

		},


		update_vitals()


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
