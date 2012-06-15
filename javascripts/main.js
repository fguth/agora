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
		
		 	// candidates initialize 
			page.candidates.load(page.vars.$city,4,'mayor');
			page.candidates.load(page.vars.$city,7,'alderman');

			// candidates listEffect
			page.candidates.listEffect();
		    
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

			 	console.log(page.auth.id);
			 	console.log(page.auth.token);

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

				$('.more__candidateslist__item .' + post_type).fadeOut(500, function(){
					
					$('.more__candidateslist__item .' + post_type).remove();
					
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
				
				var candidates = response.candidates;
				var post_id	   = response.post_id;
				var post_type  = String(this);
				var context	   = $('.' + post_type);
				var output     = '';
				var more_btn   = '.more__candidateslist__item.' + post_type;
				var more_loader = '.loading__candidateslist__item.' + post_type;
				var loader 	   = '.' + post_type + '__loader';
				var last       = '.' + post_type + ':last';

				console.log(response);
				
				$(more_loader).fadeOut(500,function(){ $(this).remove(); })
				
				var support     = '<a href="javascript:void(0);" class="support__button">';
				support        += 	'<img src="images/icon-support.png" alt="Apoiar candidato" class="support__button__icon" /><span class="support__button__text">Apoiar</span>';
				support        += '</a>';

				var unsupport   = '<a href="javascript:void(0);" class="unsupport__button">';
				unsupport  	   +=   '<span class="unsupport__button__text">Desfazer</span>';
				unsupport      += '</a>';

				var more        = '<dd class="more__candidateslist__item ' + post_type + '"><a id="' + post_id +'" href="javascript:void(0);" class="' + post_type + '">Carregar mais.</a></dd>';

				$(candidates).each(function(key, candidate) { 

					console.log(candidate.supported);

					isSupported = candidate.supported == 0 || candidate.supported == null ? support : unsupport;
					isFirst		= key % 4 == 0 ? 'is-first-of-row' : '';

					output += '<dd class="candidateslist__item ' + isFirst + ' ' + post_type + '">';
					output += 	'<a href="http://' + window.location.hostname + '/' + candidate.state_sa.toLowerCase() + '/' + candidate.city_url.toLowerCase() + '/' + candidate.post_name.toLowerCase() + '/' + candidate.url.toLowerCase() + '" class="candidatecard">';
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

				output 	   += candidates.length ? more : '';

				$(loader).fadeOut(500, function(){ $(this).remove(); });

				$(last).after(output);

				$(more_btn).unbind("click", page.candidates.more);
				$(more_btn).bind("click", page.candidates.more);

				
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


console.log(response.status);
console.log(page.auth.status);
console.log(page.auth.token);

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
			console.log(response);
			window.location.assign("http://" + window.location.hostname + "/oooops/")
		}
		
		/**
		 * System for the location header field, responsible for the field's behavior and for suggesting cities
		 */
		
		page.location = function() {
			page.location.original = page.location.elements.$cityname.val();
			
			page.location.elements.$cityname.bind("focus", page.location.focus).bind("blur", page.location.blur);
			
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
		
		page.location.error = function(xhr, status, error) {
			
		}
		
		page.location.focus = function(event) {
			$(this).select();
		}
		
		page.location.process = function(data, status, xhr) {
			var html;
			
			if (data.sucess && data.cities.length) {
				html = "";
				
				$(data.cities).each(function(index) {
					// Highlight the difference
					this.name = this.name.replace(new RegExp("^(" + data.query + ")(.*)", "i"), "$1<strong>$2</strong>");
					
					html += "<li data-city-id=\"" + this.id + "\" data-city-url=\"" + this.url + "\" class=\"citynav__searchdropdown__item\">";
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
			// Enter, up and down keys have urgent treatment, the other ones can wait
			
			window.clearTimeout(page.location.interval);
			
			if (event.type = "keydown" && $.inArray(event.which, [13, 27, 38, 40]) != -1) {
				event.preventDefault();
				
				switch (event.which) {
					case 13:
						// Enter
						
						
						break;
					case 27:
						page.location.elements.$cityname.val("");
						page.location.elements.$dropdown.addClass("is-hidden");
						
						break;
					case 38:
						// Up
						
						
						break;
					case 40:
						// Down
						
						
						break;
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