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
			
			FB.getLoginStatus(page.auth);
			
			// elements initialize
			page.elements();
			
			// url initialize
			page.url();
			
			// Location city nav inicializa
			page.location();			
		}
		
		/**
		 * page
		 * * VARS
		 */
		 
		 page.vars = function() {
			
		 }
		
			 page.vars.$city = $(".citynav__setmycity", ".header").attr("id");
		
		/**
		 * page
		 * * ELEMENTS
		 */
		 
		 page.elements = function() {
			

			// tooltips
      		page.elements.$tooltips.tooltipsy({delay:0});
	
			// comments
			page.elements.$comments.hide();
			
			// tabs
			page.elements.$nav_discussion.click(function(){
				page.elements.$candidates_list.hide();
				page.elements.$candidates_info.hide();
				page.elements.$comments.show();
				$(this).addClass('is-active');
				page.elements.$nav_candidates.removeClass('is-active');
			});
			
			page.elements.$nav_candidates.click(function(){
				page.elements.$candidates_list.show();
				page.elements.$candidates_info.show();
				page.elements.$comments.hide();
				$(this).addClass('is-active');
				page.elements.$nav_discussion.removeClass('is-active');
			});
			
			
			// hometown buttons
			page.elements.$star.bind('click',page.hometown);
			
			// login and logout buttons
			page.elements.$login.bind('click',page.login);
			page.elements.$logout.bind('click',page.logout);
			
		 }
			
			 page.elements.$login   			= $(".fbconnect",".header__login");
			 page.elements.$logout  			= $(".userinfo__logout",".header__login");
			 page.elements.$user_info  			= $(".userinfo",".header__login");
			 page.elements.$user_name  	  		= $(".userinfo__name",".header__login");
			 page.elements.$user_picture 		= $(".userinfo__photo",".header__login");
			 page.elements.$comments			= $(".discussion");
			 page.elements.$header_candidates	= $(".candidateslist__header__wrapper");
			 page.elements.$nav					= $(".main__nav");
			 page.elements.$nav_discussion		= $(".contexttabs__discussion");
			 page.elements.$nav_candidates		= $(".contexttabs__candidates");
			 page.elements.$filterfield 		= $(".listfilter__filterfield");
			 page.elements.$tooltips			= $(".tooltip");
			 page.elements.$candidates_list     = $(".candidateslist");
			 page.elements.$candidates_info		= $(".candidateinfo")
			 page.elements.$location			= $(".citynav__cityname", ".header");
			 page.elements.$star				= $(".citynav__setmycity", ".header");
			 page.elements.$hometown			= $(".citynav__gotomycity", ".header");
		
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
		 
		 page.candidates = function() {
		 	// Search-as-you-type initialize
			page.candidates.sayt();

		 	// candidates initialize 
			page.candidates.load(page.vars.$city, 4, 'mayor');
			page.candidates.load(page.vars.$city, 7, 'alderman');

			// candidates listEffect
			page.candidates.listEffect();
		 }

		page.candidates.virgin = true;

			/**
			 * page
			 * * candidates
			 * * * clean
			 */

		 	page.candidates.clean = function(post) {
		 		var postName = post == 4 ? "mayor" : "alderman";

		 		page.candidates.virgin = true;

		 		$("dd." + postName).remove();
		 		$("dd." + postName + "__message").addClass("is-hidden");
		 		$("dd." + postName + "__loader").css({
					opacity: 1
				}).removeClass("is-hidden");
		 	}

	 		/**
			 * page
			 * * CANDIDATES
			 * * * LISTEFFECT
			 */
			
			page.candidates.listEffect = function() {
				
				var list   = page.elements.$header_candidates; 
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
			 
			 page.candidates.load = function(city,type,context,start,filter) {

			 	// console.log(page.auth.id);
			 	// console.log(page.auth.token);

				$.ajax({
					data: {
						action  		: CONFIG.get('CANDIDATES_LIST'),
						city_id			: city,
						post_id			: type,	
						user_id			: page.auth.id,
						user_token		: page.auth.token,
						start			: start,
						filter 			: filter
					},
					context: context,
					dataType: "json",
					error: page.error,
					success: page.candidates.process,
					type: "post",
					url: CONFIG.get('AJAX_URL')
				});
		 	 }
			
		 	/**
			 * page
			 * * CANDIDATES
			 * * * MORE
			 */

			 page.candidates.more = function(e) {
				
				var post_type   = $('a', this).attr('class');
				var post_id 	= $('a', this).attr('id');
				var count   	= $('.candidateslist__item.' + post_type).length;
				var loading 	= '<dd class="loading__candidateslist__item ' + post_type + '">Carregando</dd>';

				$('.more__candidateslist__item .' + post_type).parent().fadeOut(500, function(){
					$(this).remove();
					
					$('.' + post_type + ':last').after(loading).fadeIn(500, function(){
						page.candidates.load(page.vars.$city,post_id,post_type,count);
					});

				});

		 	 }
			
	 		/**
			 * page
			 * * CANDIDATES
			 * * * PROCESS
			 */
			 
			 page.candidates.process = function(response) {
				
				var candidates	= response.candidates;
				var post_id		= response.post_id;
				var post_type	= String(this);
				var context		= $('.' + post_type);
				var output		= '';
				var more_btn	= '.more__candidateslist__item.' + post_type;
				var more_loader	= '.loading__candidateslist__item.' + post_type;
				var loader		= '.' + post_type + '__loader';
				var last		= '.' + post_type + ':last';
				var message		= '.' + post_type + '__message';

				// console.log(response);
				
				$(more_loader).fadeOut(500,function(){ $(this).remove(); })

				var more        = '<dd class="more__candidateslist__item ' + post_type + '"><a id="' + post_id +'" href="javascript:void(0);" class="' + post_type + '">Carregar mais.</a></dd>';

				$(candidates).each(function(key, candidate) {

					var url 		= ('http://' + window.location.hostname + '/' + candidate.state_sa + '/' + candidate.city_url + '/' + candidate.post_name + '/' + candidate.url).toLowerCase() ;
					var id 			= candidate.id_tse;
					var support     = '<a id="' + id + '" href="' + url + '" class="support__button">';
					support        += 	'<img src="images/icon-support.png" alt="Apoiar candidato" class="support__button__icon" /><span class="support__button__text">Apoiar</span>';
					support        += '</a>';

					var unsupport   = '<a id="' + id + '" href="' + url + '" class="unsupport__button">';
					unsupport  	   +=   '<span class="unsupport__button__text">Desfazer</span>';
					unsupport      += '</a>';

					isSupported = candidate.supported == 0 || candidate.supported == null ? support : unsupport;
					isFirst		= key % 4 == 0 ? 'is-first-of-row' : '';

					output += '<dd class="candidateslist__item ' + isFirst + ' ' + post_type + '">';
					output += 	'<a href="' + url + '" class="candidatecard">';
					output += 		'<img src="images/candidates/' + candidate.id_tse + '.jpg" alt="' + candidate.name + '" class="candidatecard__photo" />';
					output += 		'<p class="candidatecard__name">' + candidate.name + '</p>';
					output += 	'</a>';
					output += 	'<div class="support">';
					output += 		'<div class="support__counter">';
					output += 			'<span class="support__counter__number">' + candidate.supports + '</span>';
					output += 		'</div>';
					output += 		isSupported;
					output += 	'</div>';
					output += '</dd>';

				});

				output += candidates.length ? more : '';

				$(loader).animate({
					opacity: 0
				}, {
					complete: function() {
						$(this).addClass("is-hidden");
					},
					duration: 500
				});

				if (page.candidates.virgin && candidates.length == 0) {
					$(message).removeClass("is-hidden");
				}

				$(last).after(output);

				$(candidates).each(function(key, candidate) {

					//$('#' + candidate.id_tse).bind("click",page.candidates.support);
				
				});

				$(more_btn).unbind("click", page.candidates.more);
				$(more_btn).bind("click", page.candidates.more);
				
				page.candidates.virgin = false;
		 	 }

		 	page.candidates.sayt = function() {
		 		page.elements.$filterfield.bind("keydown", page.candidates.sayt.keyOverload).bind("keyup", page.candidates.sayt.keyOverload);
		 	}

		 	page.candidates.sayt.interval = null;
		 	page.candidates.sayt.memory = { }

			page.candidates.sayt.key = function(event, element) {
				var post = $(element).attr("data-post");
				var postName = post == 4 ? "mayor" : "alderman";
				var query = $.trim($(element).val());

				if (page.candidates.sayt.memory[post] != query) {
					page.candidates.sayt.memory[post] = query;

					console.log(post, postName, query);

					page.candidates.clean(post);
					page.candidates.load(page.vars.$city, post, postName, null, query);
				}
			}
			
			page.candidates.sayt.keyOverload = function(event) {
				var post = $(this).attr("data-post");

				window.clearTimeout(page.candidates.sayt.interval);

				// Enter and esc keys have urgent treatment, the other ones should wait to avoid overload and give some room to the user

				if (event.type == "keydown") {
					if ($.inArray(event.which, [13, 27]) != -1) {
						event.preventDefault();
						
						switch (event.which) {
							case 13:
								// Enter

								page.candidates.sayt.key(event, this);

								break;
							case 27:
								// ESC

								$(this).val("");
								
								page.candidates.sayt.key(event, this);

								break;
						}
					}
				} else {
					if ($.inArray(event.which, [13, 27]) == -1) {
						page.candidates.sayt.interval = window.setTimeout(page.candidates.sayt.key, 125, event, this);
					}
				}
			}

	 		/**
			 * page
			 * * CANDIDATES
			 * * * SUPPORT
			 */

			 page.candidates.support = function(e) {
			 	e.preventDefault();

			 	//LOAD
			 	$(this).addClass("is-loading");

				//VAR
				var candidate_url = $(this).attr("href");
				var candidate_id  = $(this).attr("id");
				
				
				// SUPPORT INITIALIZE
				if(page.auth.token) {
					FB.api(
						'/me/' + CONFIG.get('APP_NAME') + ':' + CONFIG.get('APP_ACTION') + '?' + CONFIG.get('APP_OBJECT') + '=' + candidate_url,
						'post',
						function(response) {
							if (response && !response.error && page.auth.token && page.auth.id) {
								/*
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

								*/
								page.candidates.support.process()
								// console.log(response);
							} else {
								page.candidates.support.process(candidate_id);
								// console.log(response);
								//page.error();
							}
						}
					);
				} else {
					page.login();
				}

			 }

	 		/**
			 * page
			 * * SUPPORT
			 * * * PROCESS
			 */

			 page.candidates.support.process = function(response) {

				var id = response;

				if(response) {	
					//LOAD
					$('#' + response).unbind("click",page.candidates.support);
					$('#' + response).bind("click",page.candidates.unsupport);
			 		$(this).removeClass("is-loading support__button");
			 		$(this).addClass("unsupport__button");
				} else {
					page.error();	
				}

			 }

			/**
			 * page
			 * * UNSUPPORT
			 */

			 page.candidates.unsupport = function(e) {
			 	e.preventDefault();

			 	//LOAD
			 	$(this).addClass("is-loading");

				//VAR
				var candidate_id  = $(this).attr("id");
				
				if(page.auth.id && page.auth.token && candidate_id) {
					
					//SERVER-SIDE UNSUPPORT PROCESS
					/*$.ajax({
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
					*/
				} else {
					page.login();
				}

			 }
		 
		/* *
		 * page
		 * * AUTH
		 */

		page.auth = function(response) {
			

			// set user and token id
			page.auth.status = response.status  === 'connected' ? true : false;
			page.auth.id 	 = page.auth.status ? response.authResponse.userID : null;
			page.auth.token  = page.auth.status ? response.authResponse.accessToken : null;

			// candidates initialize
			page.candidates();

		 }
		
		/**
		 * page
		 * * AUTH
		 * * * PARAMETERS
		 */
		
		page.auth.status = false;
		page.auth.id 	 = null;
		page.auth.token  = null;
		
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
			page.elements.$user_info.addClass('is-hidden');
			page.elements.$user_name.text('');
			page.elements.$user_picture.attr('src', 'images/loader-userphoto.gif');
			page.elements.$user_picture.attr('alt', 'carregando');
			page.elements.$login.removeClass('is-hidden');	
			page.elements.$hometown.attr('href','http://' + document.location.host);
			page.elements.$star.removeClass('is-active');
			page.elements.$star.addClass('is-normal');
			FB.logout(page.logout.success);
			
		}	
		
			/**
			 * page
			 * * LOGOUT
			 * * * SUCCESS
			 */
	
			page.logout.success = function(response) {
				FB.Auth.setAuthResponse(null, 'unknown');
				window.location.href(document.URL);
			}

		/**
		 * page
		 * * SETHOME
		 */

		page.hometown = function(e) {
			page.elements.$star.removeClass('is-active');
			page.elements.$star.removeClass('is-normal');
			page.elements.$star.addClass('is-loading');
			
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
				page.elements.$star.removeClass('is-loading');
				page.elements.$star.addClass('is-active');
			}
			
		/**
		 * page
		 * * ERROR
		 */
		
		page.error = function(response) {
			// console.log(response);
			window.location.assign("http://" + window.location.hostname + "/oooops/")
		}
		
		/**
		 * System for the location header field, responsible for the field's behavior and for suggesting cities
		 */
		
		page.location = function() {
			page.location.original = page.location.elements.$cityname.val();
			
			page.location.elements.$cityname.bind("focus", page.location.focus).bind("blur", page.location.blur);
			page.location.elements.$dropdown.on("mouseover", "li", page.location.hover).on("mouseout", "li", page.location.hover).on("click", "li", page.location.click);
			
			// Listen to the key up event but don't flood the hell out of it,
			// wait at least 1 / 8 of a second before triggering the callback
			page.location.elements.$cityname.bind("keydown", page.location.keyOverload).bind("keyup", page.location.keyOverload);
		}
		
		page.location.elements = { }
		
		page.location.elements.container = ".header__nav";
		page.location.elements.$citynav = $(".citynav", page.location.container);
		page.location.elements.$cityname = $(".citynav__cityname", page.location.container);
		page.location.elements.$dropdown = $(".citynav__searchdropdown", page.location.container);
		
		page.location.interval = null;
		page.location.memory = null;
		page.location.original = null;
		
		page.location.blur = function(event) {
			page.location.elements.$cityname.val(page.location.original);
			page.location.elements.$dropdown.addClass("is-hidden");
		}
		
		page.location.click = function(event) {
			var city = page.location.elements.$dropdown.children("li.citynav__searchdropdown__item__highlighted");

			if (city.length) {
				window.location.assign("http://" + CONFIG.get("HOST") + "/" + city.attr("data-state-sa").toLowerCase() + "/" + city.attr("data-city-url"));
			}
		}

		page.location.error = function(xhr, status, error) {
			
		}
		
		page.location.focus = function(event) {
			$(this).select();
		}
		
		page.location.hover = function(event) {
			switch (event.type) {
				case "mouseover":
					$(this).addClass("citynav__searchdropdown__item__highlighted");

					break;
				case "mouseout":
					page.location.elements.$dropdown.children("li").removeClass("citynav__searchdropdown__item__highlighted");

					break;
			}
		}

		page.location.process = function(data, status, xhr) {
			var html;
			
			if (data.sucess && data.cities.length) {
				html = "";
				
				$(data.cities).each(function(index) {
					// Highlight the difference
					this.name = this.name.replace(new RegExp("^(" + data.query + ")(.*)", "i"), "$1<strong>$2</strong>");
					
					html += "<li data-city-id=\"" + this.id + "\" data-city-url=\"" + this.url + "\" data-state-sa=\"" + this.state_sa + "\" class=\"citynav__searchdropdown__item\">";
					html += this.name + ", " + this.state_sa;
					html += "</li>";
				});
				
				page.location.elements.$dropdown.html(html).removeClass("is-hidden");
			}
		}
		
		page.location.key = function(event) {
			var query = $.trim(page.location.elements.$cityname.val());
			
			if (page.location.memory != query && query.length > 2) {
				page.location.memory = query;
				
				$.ajax({
					data: {
						action: CONFIG.get("SAYT_CITY"),
						query: query
					},
					dataType: "json",
					error: page.location.error,
					success: page.location.process,
					type: "post",
					url: CONFIG.get("AJAX_URL")
				});
			}
		}
		
		page.location.keyOverload = function(event) {
			var city;
			var index;
			var total;

			// Enter, esc, up and down keys have urgent treatment, the other ones should wait to avoid overload and give some room to the user
			
			window.clearTimeout(page.location.interval);
			
			if (event.type == "keydown") {
				if ($.inArray(event.which, [13, 27, 38, 40]) != -1) {
					event.preventDefault();
					
					switch (event.which) {
						case 13:
							// Enter

							city = page.location.elements.$dropdown.children("li.citynav__searchdropdown__item__highlighted");

							if (city.length) {
								window.location.assign("http://" + CONFIG.get("HOST") + "/" + city.attr("data-state-sa").toLowerCase() + "/" + city.attr("data-city-url"));
							}
							
							break;
						case 27:
							// Esc

							page.location.elements.$cityname.val("");
							page.location.elements.$dropdown.addClass("is-hidden");
							
							break;
						case 38:
							// Up
							
							total = page.location.elements.$dropdown.children("li").length;

							if (page.location.elements.$dropdown.children("li.citynav__searchdropdown__item__highlighted").length) {
								index = page.location.elements.$dropdown.children("li.citynav__searchdropdown__item__highlighted").index();
								
								if (index > 0) {
									page.location.elements.$dropdown.children("li.citynav__searchdropdown__item__highlighted").removeClass("citynav__searchdropdown__item__highlighted");
									page.location.elements.$dropdown.children("li:eq(" + (index - 1) + ")").addClass("citynav__searchdropdown__item__highlighted");
								}
							} else {
								page.location.elements.$dropdown.children("li:last-child").addClass("citynav__searchdropdown__item__highlighted");
							}

							break;
						case 40:
							// Down

							total = page.location.elements.$dropdown.children("li").length;

							if (page.location.elements.$dropdown.children("li.citynav__searchdropdown__item__highlighted").length) {
								index = page.location.elements.$dropdown.children("li.citynav__searchdropdown__item__highlighted").index();

								if (index < total - 1) {
									page.location.elements.$dropdown.children("li.citynav__searchdropdown__item__highlighted").removeClass("citynav__searchdropdown__item__highlighted");
									page.location.elements.$dropdown.children("li:eq(" + (index + 1) + ")").addClass("citynav__searchdropdown__item__highlighted");
								}
							} else {
								page.location.elements.$dropdown.children("li:first-child").addClass("citynav__searchdropdown__item__highlighted");
							}
							
							break;
					}
				}
			} else {
				page.location.interval = window.setTimeout(page.location.key, 125, event);
			}
		}
		
		// Takeoff when DOM is ready to bounce
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