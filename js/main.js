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
		
			// PAGE INITIALIZE	
			
			FB.getLoginStatus(page.init);
			
		}
		
		/**
		 * page
		 * * ELEMENTS
		 */
		 
		 page.init = function(response) {
		
		 	// INITIALIZE
			
			page.elements();
			
			page.auth(response);
			
			FB.Event.subscribe('auth.statusChange', page.auth);
			 
		 }
		
		/**
		 * page
		 * * ELEMENTS
		 */
		 
		 page.elements = function() {
		
		 	// ELEMENTS INITIALIZE
			
			$(page.elements.support).bind('click', page.support);
			
		 }
		 
	 		/**
			 * page
			 * * ELEMENTS
			 */
			 
			 page.elements.login   			= "#login";
			 page.elements.logout  			= "#logout";
			 
			 page.elements.user_info  		= "#user-info";
			 page.elements.user_name    	= "#user-name";
			 page.elements.user_picture 	= "#user-picture";
			 
			 page.elements.cadidates		= "#candidates";
			 page.elements.support 			= ".support";
			 
		
		/**
		 * page
		 * * CANDIDATES
		 */
		 
		 page.candidates = function() {
		
		 	// CANDIDATES INITIALIZE
			
		    /** 
			 * Start cadidates load
			 * * Need to implement
			 */
			
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

			var target 	= e.target;
			var candidate 	= $(this).siblings("h3").children("a").attr("href");
			
			if(page.auth.status) {
				
				//After support server-side process be done. Put this FP.api into page.support.process sucess data.
				FB.api(
					'/me/agora-master:apoiar?candidato=http://' + document.location.host + "/" + candidate,
					'post',
					
					function(response) {

						if (!response || response.error) {

							$(target).text(response.error.message);
							$(target).css({"background-color":"red", "color" : "white"});
							$(target).unbind('click');

						} else {
							
						   $(target).text('Apoiado: ' + response.id);
						   $(target).css({"background-color":"#2cc008", "color" : "white"});
						   $(target).unbind('click');
						
						}


					 }
				);

			} else {

				FB.login(function(response) {}, {scope: CONFIG.get('PERMISSIONS')});

			}

		 }
		
	 		/**
			 * page
			 * * SUPPORT
			 * * * PROCESS
			 */

			 page.support.process = function(response) {

				if(data.sucess) {

					console.log(data);

				} else {

					console.log(data.error);	

				}

			 }

			 /**
			 * page
			 * * SUPPORT
			 * * * ERROR
			 */

			page.support.error = function(response) {

				console.log(String(error).toLowerCase());

			}
		
		/**
		 * page
		 * * AUTH
		 */
		 
		 page.auth = function(response){
			
			// AUTH INITIALIZE
			
			$(page.elements.login).fadeOut();
			$(page.elements.user_info).fadeOut();
			
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
			 * * * ALLOWED
			 */
			 
			page.auth.allowed = function(acessToken){
				
				if(acessToken) {
				
					page.auth.token  = acessToken;
					page.auth.status = true;

					FB.api('/me', function(response) {

						$(page.elements.login).unbind('click');
						$(page.elements.logout).bind('click',function(){ FB.logout(); });	  

						$(page.elements.user_name).text(response.name);
						$(page.elements.user_picture).attr('src','https://graph.facebook.com/' + response.username + '/picture');

						//Verify the user in our database
						page.user(response);

					});

					$(page.elements.user_info).fadeIn();
				
				}

			}
			 
			 /**
			 * page
			 * * AUTH
			 * * * REFUSED
			 */
			 
			 page.auth.refused = function(){
				
				page.auth.status = false;
				
				$(page.elements.login).fadeIn(function(){
					
					$(page.elements.logout).unbind('click');
					$(this).bind('click',function(){ 
					
						FB.login(function(response) {}, {scope: CONFIG.get('PERMISSIONS')});
						
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
 js.src = "//connect.facebook.net/en_US/all.js";
 ref.parentNode.insertBefore(js, ref);
}(document));