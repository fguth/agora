/**
* Developed by Evandro Eisinger & Gibran Malheiros
* http://agora.vc
*/

(function($) {
	
	window.fbAsyncInit = function() {
		
		/**
		 * page
		 */
		 
		var page = function() {
			
			// facebook initialize
			FB.init({
			  appId      : CONFIG.get('APP_ID'),
			  channelUrl : CONFIG.get('CHANNEL_URL'),
			  status     : CONFIG.get('STATUS'),
			  cookie     : CONFIG.get('COOKIE'),
			  xfbml      : CONFIG.get('XFBML')
			});
			
			FB.Event.subscribe('auth.statusChange', page.auth);
			
			// elements initialize
			page.elements();
			
			// url initialize
			page.url();
						
		}
		
		/**
		 * page
		 * * ELEMENTS INITIALIZE
		 */
		 
		 page.elements = function() {
			
			// tooltips
			page.elements.$tooltips.tooltipsy({delay:0});
			
			// filter input animation
			page.elements.$filterfield.focusin(function(){
				$(this).animate({width: "160px"}, 500);
				$(this).val() == "Filtrar" ? $(this).val("") : $(this).val();
			});
			
			page.elements.$filterfield.focusout(function(){
				$(this).animate({width: "80px"}, 500);
				$(this).val() == "" ? $(this).val("Filtrar") : $(this).val();
			});
			
			// comments
			page.elements.$comments.hide();
			
			// tabs
			page.elements.$nav_discussion.click(function(){
				page.elements.$candidates_list.hide();
				page.elements.$comments.show();
				$(this).addClass('is-active');
				page.elements.$nav_candidates.removeClass('is-active');
			});
			
			page.elements.$nav_candidates.click(function(){
				console.log(true);
				page.elements.$candidates_list.show();
				page.elements.$comments.hide();
				$(this).addClass('is-active');
				page.elements.$nav_discussion.removeClass('is-active');
			});
			
			// support buttons
			page.support.handlers();
			page.unsupport.handlers();
			
			// hometown buttons
			page.elements.$star.bind('click',page.hometown);

			// DEPOIS COLOCAR NA CONSTRUTORA DO CANDIDATES
			// candidates listEffect
			page.candidates.listEffect(page.elements.$header_candidates);
			
			// login and logout buttons
			page.elements.$login.bind('click',page.login);
			page.elements.$logout.bind('click',page.logout);
			
		 }
			
	 		/**
			 * page
			 * * ELEMENTS
			 */
			
			 page.elements.$login   			= $(".fbconnect",".header__login");
			 page.elements.$logout  			= $(".userinfo__logout",".header__login");
			 page.elements.$user_info  			= $(".userinfo",".header__login");
			 page.elements.$user_name  	  		= $(".userinfo__name",".header__login");
			 page.elements.$user_picture 		= $(".userinfo__photo",".header__login");
			 page.elements.$support				= $(".support__button",".main__content__body");
			 page.elements.$unsupport			= $(".unsupport__button",".main__content__body");
			 page.elements.$comments			= $(".discussion");
			 page.elements.$header_candidates	= $('.candidateslist__header__wrapper');
			 page.elements.$nav					= $(".main__nav");
			 page.elements.$nav_discussion		= $(".contexttabs__discussion");
			 page.elements.$nav_candidates		= $(".contexttabs__candidates");
			 page.elements.$filterfield 		= $(".listfilter__filterfield");
			 page.elements.$tooltips			= $('.tooltip');
			 page.elements.$candidates_list     = $('.candidateslist');
			 page.elements.$location			= $('.citynav__cityname', '.header');
			 page.elements.$star				= $('.citynav__setmycity', '.header');
			 page.elements.$hometown			= $('.citynav__gotomycity', '.header');
			
		/**
		 * page
		 * * URL
		 */

		 page.url = function() {
			
			// set url 
			window.history.pushState(document.title,document.title,$('meta[name=path]').attr("content"));
			
		 }
		
		/**
		 * page
		 * * CANDIDATES
		 */
		 
		 page.candidates = function(location) {
		
		 	// candidates initialize INITIALIZE
			console.log(location);
		    /** 
			 * Start cadidates load
			 * * Need to implement
			 */
			
		 }

	 		/**
			 * page
			 * * CANDIDATES
			 * * * LISTEFFECT
			 */
			
			page.candidates.listEffect = function(list) {
				
				var blocks = [];
				
				for ( i = 0; i < list.length; i++ ) {
					blocks.push(list.eq(i));
				}
				
				//var limit  = blocks[0].offset().top;
				
				$(window).scroll(function(){

					var scroll = $(this).scrollTop();
					for (i=0; i<blocks.length; i++) {
						if(list.parent().offset().top < scroll) {
							if (scroll > blocks[i].offset().top) {
								list.removeClass('is-fixed');
								page.elements.$nav.addClass('is-fixed');
								blocks[i].addClass('is-fixed');
							}
						} else {
							list.removeClass('is-fixed');
							page.elements.$nav.removeClass('is-fixed');
						}
					}
				});
			}
			
	 		/**
			 * page
			 * * CANDIDATES
			 * * * LOAD
			 */
			 
			 page.candidates.load = function(type,filter,scroll) {
				
		 	 }
			
			 	/**
				 * page
				 * * CANDIDATES
				 * * * LOAD
				 */

				 page.candidates.load.more = function(start,limit,filter) {

			 	 }
			
	 		/**
			 * page
			 * * CANDIDATES
			 * * * PROCESS
			 */
			 
			 page.candidates.process = function() {
				
		 	 }
			 
			/**
			 * page
			 * * SUPPORT
			 */

			 page.support = function(e) {

				// SUPPORT INITIALIZE

				var candidate_url = $(this).parent().parent().find(".candidatecard").attr("href");
				var candidate_id  = $(this).parent().attr("id");

				if(page.auth.token) {
					//After support server-side process be done. Put this FP.api into page.support.process sucess data.
					FB.api(
						'/me/' + CONFIG.get('APP_NAME') + ':' + CONFIG.get('APP_ACTION') + '?' + CONFIG.get('APP_OBJECT') + '=' + candidate_url,
						'post',

						function(response) {

							if (response && !response.error) {

								console.log('Publish ID: ' + response.id);

								$.ajax({
									data: {
										action			: CONFIG.get('SUPPORT'),
										candidate_id	: candidate_id,
										user_id			: page.auth.id,
										user_token		: page.auth.token
									},
									dataType: "json",
									error: page.error,
									success: page.support.process,
									type: "post",
									url: CONFIG.get('AJAX_URL')
								});

							} else {
								page.error();
							}
					});
				} else {

					page.login();
				}

			 }
				
				/**
				 * page
				 * * SUPPORT
				 * * * TOGGLE
				 */
				
				page.support.toggle = function(candidate_id) {

					var support_button   = $("#" + candidate_id + " a.support__button",".candidateslist__row");
					var unsupport_button = $("#" + candidate_id + " a.unsupport__button",".candidateslist__row");

					if(support_button.hasClass("is-hidden")) {
						unsupport_button.addClass("is-hidden");
						support_button.removeClass("is-hidden");
					} else {				
					    support_button.addClass("is-hidden");
					    unsupport_button.removeClass("is-hidden");
					}

				}

				/**
				 * page
				 * * SUPPORT
				 * * * HANDLRES
				 */

				 page.support.handlers = function() {

					page.elements.$support.unbind('click', page.support);
				 	page.elements.$support.bind('click', page.support);

				 }

		 		/**
				 * page
				 * * SUPPORT
				 * * * PROCESS
				 */

				 page.support.process = function(response) {
					
					page.support.toggle(response.candidate_id);
					
					console.log("Support realized.");

					if(response.sucess) {	
						console.log(response);
					} else {
						console.log(response.error);	
					}

				 }
	
			/**
			 * page
			 * * UNSUPPORT
			 */

			 page.unsupport = function(e) {

				// UNSUPPORT INITIALIZE
				var candidate_id  = $(this).parent().attr("id");
				
				if(page.auth.token) {
					
					//SERVER-SIDE UNSUPPORT PROCESS
					$.ajax({
						data: {
							action			: CONFIG.get('UNSUPPORT'),
							candidate_id	: candidate_id,
							user_id			: page.auth.id,
							user_token		: page.auth.token
						},
						dataType: "json",
						error: page.error,
						success: page.unsupport.process,
						type: "post",
						url: CONFIG.get('AJAX_URL')
					});
					
				} else {
					page.login();
				}

			 }

				/**
				 * page
				 * * UNSUPPORT
				 * * * HANDLRES
				 */

				 page.unsupport.handlers = function() {
					
					//REDIRECT TO ERROR PAGE
					page.elements.$unsupport.unbind('click', page.unsupport);
				 	page.elements.$unsupport.bind('click', page.unsupport);

				 }

		 		/**
				 * page
				 * * UNSUPPORT
				 * * * PROCESS
				 */

				 page.unsupport.process = function(response) {
					
					if(response.support_id) {
						
						FB.api(response.support_id, 'delete', function(response) {
							if (response && !response.error) {
								page.support.toggle(response.candidate_id);
							} else {
								page.error();
							}
						});
						
					} else {	
						page.error();	
					}
					
				 }

		/**
		 * page
		 * * AUTH
		 */

		page.auth = function(response) {
			// set user and token id - Here we can treat the facebook status
			if (response.status === 'connected') {
				page.auth.id 	= response.authResponse.userID;
				page.auth.token = response.authResponse.accessToken;
			  } else {
			    page.auth.id 	= null;
				page.auth.token = null;
			  }
			console.log(response.status);
		 }
		
		/**
		 * page
		 * * AUTH
		 * * * PARAMETERS
		 */
		
		page.auth.id = null;
		page.auth.token = null;
		
		/**
		 * page
		 * * LOGIN
		 */
		 
		 page.login = function(e) {
			e.preventDefault();
			page.elements.$login.addClass('is-hidden');
			page.elements.$user_info.removeClass('is-hidden');
			FB.login(page.login.success, {scope: CONFIG.get('PERMISSIONS').join(',')});
		 }
		
			/**
			 * page
			 * * LOGIN
			 * * * SUCCESS
			 */
		
			page.login.success = function(response) {
				if (response.authResponse.accessToken) {
					document.location.reload();
				}
			}
		
		/**
		 * page
		 * * LOGOUT
		 */
		
		page.logout = function(e) {
			e.preventDefault();
			FB.logout(page.logout.success);
			
		}	
		
			/**
			 * page
			 * * LOGOUT
			 * * * SUCCESS
			 */
	
			page.logout.success = function(response) {
				FB.Auth.setAuthResponse(null, 'unknown');
				page.elements.$user_info.addClass('is-hidden');
				page.elements.$user_name.text('');
				page.elements.$user_picture.attr('src', 'images/loader-userphoto.gif');
				page.elements.$user_picture.attr('alt', 'carregando');
				page.elements.$login.removeClass('is-hidden');	
				page.elements.$hometown.attr('href','http://' + document.location.host);
				page.elements.$star.removeClass('is-active');
				page.elements.$star.addClass('is-normal');
				
			}

		/**
		 * page
		 * * SETHOME
		 */

		page.hometown = function(e) {
			e.preventDefault();
			$.ajax({
				data: {
					action			: CONFIG.get('SET_HOMETOWN'),
					city_id 		: page.elements.$star.attr('id'),
					user_id			: page.auth.id,
					user_token		: page.auth.token
				},
				dataType: "json",
				error: page.error,
				success: page.hometown.success,
				type: "post",
				url: CONFIG.get('AJAX_URL')
			});
		}	

			/**
			 * page
			 * * SETHOME
			 * * * SUCCESS
			 */

			page.hometown.success = function(response) {
				
				page.elements.$hometown.attr('href',document.location);
				
				if(page.elements.$star.hasClass('is-active')) { 
					page.elements.$star.removeClass('is-active');
					page.elements.$star.addClass('is-normal');
				} else { 
					page.elements.$star.addClass('is-active');
					page.elements.$star.removeClass('is-normal');
				}
			}
			
		/**
		 * page
		 * * ERROR
		 */
		
		page.error = function(response) {
			console.log(response);
			window.location.assign("http://" + window.location.hostname + "/oooops/")
		}
		
		$(page);

	}
	
})(jQuery);

(function(d){
 var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
 if (d.getElementById(id)) {return;}
 js = d.createElement('script'); js.id = id; js.async = true;
 js.src = "//connect.facebook.net/pt_BR/all.js";
 ref.parentNode.insertBefore(js, ref);
}(document));