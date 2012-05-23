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
			
								
		}
		
		/**
		 * page
		 * * ELEMENTS
		 */
		 
		 page.init = function(response) {
			
		 	// initialize
			page.auth(response);
			
			FB.Event.subscribe('auth.statusChange', page.auth);
			
			// elements initialize
			page.elements();
			
			// location initialize
			page.location();
			 
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
			 page.elements.$address				= $('.citynav__cityname', '.header');
		
		/**
		 * page
		 * * LOCATION
		 */

		 page.location = function() {
			
			// get current path by url
			var path      = window.location.pathname;
			
			// verify the url elements
			var url  	   	   = path.length == 1 ? false : path.split("/");
			
			// store elements
			var location   	   = new Object();
			location.state	   = url[1] ? url[1] : false;
			location.city	   = url[2] ? url[2] : false;
			location.post 	   = url[3] ? url[3] : false;
			location.candidate = url[4] ? url[4] : false;
			
			if(url) {
				if (location.state && location.city && !location.candidate) {
					// url - has state/city
					page.location.load(location);
				} else if (location.state && location.city && location.post && location.candidate) {
					// url - has state/city/post/candidate
					page.location.load(location);
				}
			} else {
				page.location.load();
			}
			
		 }
	 		
			/**
			 * page
			 * * LOCATION
			 * * * LOAD
			 */
			
			page.location.load = function(location) {
				
				if (location) {
					// load location by url or home city
					page.location.apply(location);
				} else {
					var geocoder = new google.maps.Geocoder();
					geocoder.geocode({ 'latLng': new google.maps.LatLng(geoip_latitude(), geoip_longitude()) }, function (results, status) {
				       if (status == google.maps.GeocoderStatus.OK) {
						    if (results) {
								location 	   	   = new Object();
								location.city      = results[1].address_components[0].long_name;
								location.state     = results[1].address_components[1].short_name;
								location.post	   = false;
								location.candidate = false;
							
								page.location.apply(location);
				            }
				        }
				    });
				}
				
			}
			
			/**
			 * page
			 * * LOCATION
			 * * * APPLY
			 */
			
			page.location.apply = function(location) {
				if (page.location.verify(location)) {
					
					location.title 	   = location.city + ', ' + location.state;
					location.url       = location.post && location.candidate ? "/" + sef(location.state) + "/" + sef(location.city) + "/" + sef(location.post) + "/" + sef(location.candidate)
															: "/" + sef(location.state) + "/" + sef(location.city); 
					
					// set input actual location
					page.elements.$address.val(location.title);
					
					// set url 
					window.history.pushState(location.title,location.title,location.url);
				    
					// load candidates by location or candidate
					page.candidates.load(location);	
					
				} else {
					//Error 404
				}
			}
			
	 		/**
			 * page
			 * * LOCATION
			 * * * SET
			 */
			
			page.location.set = function(user,address) {
				//set user home location
			}
			
			/**
			 * page
			 * * LOCATION
			 * * * VERIFY
			 */
			
			page.location.verify = function(state,city,candidate) {
				address = true;
				//verify if the city exist
				return address;
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
			
			// auth initialize
			
			page.elements.$login.unbind('click').hide();
			page.elements.$user_info.unbind('click').hide();
			
			page.auth.token = null;
			
			if (response.authResponse) {
				page.auth.status = true;
				page.auth.allowed(response.authResponse.accessToken);
			} else {
				page.auth.status = false;
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
					FB.api('/me', function(response) {
						
						page.auth.id = response.id;
						
						page.elements.$logout.bind('click',function(e){ e.preventDefault(); FB.logout(); });	  
						page.elements.$user_name.text(response.first_name);
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
						page.elements.$user_picture.attr('src','https://graph.facebook.com/' + response.user.data.username + '/picture');
							
						// load user hometowon
						page.location.load(false);
						
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
					page.user.hometown = false;
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