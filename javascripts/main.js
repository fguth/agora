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
			
			// FACEBOOK INITIALIZE
			FB.init({
			  appId      : CONFIG.get('APP_ID'),
			  channelUrl : CONFIG.get('CHANNEL_URL'),
			  status     : CONFIG.get('STATUS'),
			  cookie     : CONFIG.get('COOKIE'),
			  xfbml      : CONFIG.get('XFBML')
			});
		
			// page initialize
			FB.getLoginStatus(page.init);
			
			// elements initialize
			page.elements();
			
			// location initialize
			page.location();
					
		}
		
		/**
		 * page
		 * * ELEMENTS
		 */
		 
		 page.init = function(response) {
			
		 	// INITIALIZE
			page.auth(response);
			
			FB.Event.subscribe('auth.statusChange', page.auth);
			 
		 }
		
		/**
		 * page
		 * * ELEMENTS INITIALIZE
		 */
		 
		 page.elements = function() {
			
		 	// background
			$.backstretch("images/bg-site.jpg");
			
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
			
			// candidates listEffect
			page.candidates.listEffect(page.elements.$header_candidates);
			
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
			 page.elements.$adress				= $('.citynav__cityname', '.header');
		
		/**
		 * page
		 * * LOCATION
		 */

		 page.location = function() {
		 	
			// get current location by url
			var address = false;
			
			if(address) {
				page.location.load(address);
			} else {
				page.location.load();
			}
			
		 }
	 		
			/**
			 * page
			 * * LOCATION
			 * * * LOAD
			 */
			
			page.location.load = function(address) {
				
				var lat 	 = geoip_latitude()
				var lng 	 = geoip_longitude();
				var geocoder = new google.maps.Geocoder();
				
				if (address) {
					// load location by url or home city
				} else {
					geocoder.geocode({ 'latLng': new google.maps.LatLng(lat, lng) }, function (results, status) {
				       if (status == google.maps.GeocoderStatus.OK) {
						    if (results) {
								page.location.apply(results[0].address_components[3].long_name + ', ' + results[0].address_components[4].short_name);
				            }
				        }
				    });
				}
				
			}
			
			/**
			 * page
			 * * LOCATION
			 * * * SET
			 */
			
			page.location.apply = function(address) {
				page.elements.$adress.val(address)
				// load candidates by address
				page.candidates(address);
			}
			
	 		/**
			 * page
			 * * LOCATION
			 * * * DEFAULT
			 */
			
			page.location.set = function(user,address) {
				//set user home location
			}

		/**
		 * page
		 * * ANIMATION
		 */

		 page.animation = function() {}

	 		/**
			 * page
			 * * ANIMATION
			 * * * TYPES
			 */

			page.animation.supportToggle = function(candidate_id) {

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
		 * * CANDIDATES
		 */
		 
		 page.candidates = function(address) {
		
		 	// CANDIDATES INITIALIZE
			
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
			 * * CANDIDATES
			 * * * PROCESS
			 */
			 
			 page.candidates.error = function() {
				
		 	 }
			
			/**
			 * page
			 * * SUPPORT
			 */

			 page.support = function(e) {

				// SUPPORT INITIALIZE

				var candidate_url = $(this).parent().parent().find(".candidatecard").attr("href");
				var candidate_id  = $(this).parent().attr("id");

				if(page.auth.status) {
					
					//After support server-side process be done. Put this FP.api into page.support.process sucess data.
					FB.api(
						'/me/' + CONFIG.get('APP_NAME') + ':' + CONFIG.get('APP_ACTION') + '?' + CONFIG.get('APP_OBJECT') + '=' + candidate_url,
						'post',

						function(response) {

							if (!response || response.error) {

								console.log(response.error.message);
								//REDIRECT TO ERROR PAGE

							} else {

								console.log('Publish ID: ' + response.id);

								//SERVER-SIDE SUPPORT PROCESS
								$.ajax({
									data: {
										action			: CONFIG.get('SUPPORT'),
										candidate_id	: candidate_id,
										user_id			: page.auth.id,
										token			: page.auth.token
									},
									dataType: "json",
									error: page.support.error,
									success: page.support.process,
									type: "post",
									url: CONFIG.get('AJAX_URL')
								});
							}


						 }
					);
					
				} else {

					FB.login(function(response) {}, {scope: CONFIG.get('PERMISSIONS').join(',')});

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
					
					page.animation.supportToggle(response.candidate_id);
					
					console.log("Support realized.");

					if(response.sucess) {	
						console.log(response);
					} else {
						console.log(response.error);	
					}

				 }

				 /**
				 * page
				 * * SUPPORT
				 * * * ERROR
				 */

				page.support.error = function(response) {
					
					//REDIRECT TO ERROR PAGE
					console.log("Support error.");
					console.log(String(response).toLowerCase());

				}
				
			/**
			 * page
			 * * UNSUPPORT
			 */

			 page.unsupport = function(e) {

				// UNSUPPORT INITIALIZE
				var candidate_id  = $(this).parent().attr("id");
				
				if(page.auth.status) {
					
					//SERVER-SIDE UNSUPPORT PROCESS
					$.ajax({
						data: {
							action			: CONFIG.get('UNSUPPORT'),
							candidate_id	: candidate_id,
							user_id			: page.auth.id,
							token			: page.auth.token
						},
						dataType: "json",
						error: page.unsupport.error,
						success: page.unsupport.process,
						type: "post",
						url: CONFIG.get('AJAX_URL')
					});
					
				} else {

					FB.login(function(response) {}, {scope: CONFIG.get('PERMISSIONS').join(',')});

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
						
						FB.api(response.support_id, 'delete', function(remove) {
							if (!remove || remove.error) {
							  console.log("Need to integrat with dinamic candidates supports - candidate.class.php : unsupport()");
							  console.log(remove.error);

							} else {
							  	console.log("Unsupported");
								page.animation.supportToggle(response.candidate_id);
							}
						});
						
					} else {
						console.log(response.error);	
					}
					
				 }

				 /**
				 * page
				 * * UNSUPPORT
				 * * * ERROR
				 */

				page.unsupport.error = function(response) {

					console.log("Unsupport error.");
					console.log(String(error).toLowerCase());

				}
				
		/**
		 * page
		 * * AUTH
		 */
		 
		 page.auth = function(response){
			
			// AUTH INITIALIZE
			
			page.elements.$login.unbind('click').hide();
			page.elements.$user_info.unbind('click').hide();
			
			page.auth.token = null;
			
			if (response.authResponse) {
				
				page.auth.allowed(response.authResponse.accessToken);
			
			} else {
				
				page.auth.refused();
			
			}
			 
		 }
			
			/**
			 * page
			 * * AUTH
			 * * * STATUS
			 */
			 
			page.auth.status = false;
			
			/**
			 * page
			 * * AUTH
			 * * * TOKEN
			 */
			
			page.auth.token = null;
			
			/**
			 * page
			 * * AUTH
			 * * * ID
			 */
			
			page.auth.id = null;
			
			
			/**
			 * page
			 * * AUTH
			 * * * ALLOWED
			 */
			 
			page.auth.allowed = function(acessToken){
				
				if(acessToken) {
				
					page.auth.token  = acessToken;
					page.auth.status = true;

					FB.api('/me', function(response) {
						
						page.auth.id = response.id;
						
						page.elements.$logout.bind('click',function(e){ e.preventDefault(); FB.logout(); });	  
						page.elements.$user_name.text(response.first_name);
						page.elements.$user_picture.attr('src','https://graph.facebook.com/' + response.username + '/picture');
						page.elements.$user_picture.attr('alt', response.name);

						//Verify the user in our database
						page.user(response);

					});
					
					page.elements.$user_info.fadeIn();
				
				}

			}
			 
			 /**
			 * page
			 * * AUTH
			 * * * REFUSED
			 */
			 
			 page.auth.refused = function(){
				
				page.auth.status = false;
				
				page.elements.$login.fadeIn(function(){
					
					$(this).bind('click',function(e){ 
						e.preventDefault();
						FB.login(function(response) {}, {scope: CONFIG.get('PERMISSIONS').join(',')});
					});	
					
				}); 
				
			 }
			
			/**
			 * page
			 * * USER
			 */

			 page.user = function(user) { 
				
				$.ajax({
					data: {
						action	: CONFIG.get('CHECK_USER'),
						user	: user,
						token	: page.auth.token
					},
					dataType: "json",
					error: page.user.error,
					success: page.user.process,
					type: "post",
					url: CONFIG.get('AJAX_URL')
				});
				 
			 }

		 		/**
				 * page
				 * * USER
				 * * * PROCESS
				 */

				 page.user.process = function(response) {

					if(response.sucess) {

						console.log(response);

					} else {

						console.log(response.mensage);	

					}

				 }

				 /**
				 * page
				 * * USER
				 * * * ERROR
				 */

				page.user.error = function(response) {

					console.log(String(response.error).toLowerCase());

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