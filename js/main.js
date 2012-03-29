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
			
			var _target 	= e.target;
			var _candidate 	= e.target.id;
			
			if(page.auth.status) {
			
				console.log("Start Ajax - Need to implement: Data Base Issue and Server Side Issue;");
				
			/*
				$.ajax({
					data: {
						acao: SUPPORT,
						candidate : _candidate
					},
					dataType: "json",
					error: page.support.error,
					success: page.support.process,
					type: "post",
					url: CONFIG.get('AJAX_URL')
				});
			*/		
				
			} else {

				FB.login();
				
			}
			
		 }
		 
	 		/**
			 * page
			 * * SUPPORT
			 * * * PROCESS
			 */
			 
			 page.support.process = function(data, status, xhr) {
			
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
			 
			 page.support.error = function(xhr, status, error) {
			
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
			 
			if (response.authResponse) {
			
				page.auth.allowed();
			
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
			 * * * ALLOWED
			 */
			 
			 page.auth.allowed = function(){
				 
				page.auth.status = true;
				
				FB.api('/me', function(response) {
				
					$(page.elements.login).unbind('click');
					$(page.elements.logout).bind('click',function(){ FB.logout(); });	  
					
					$(page.elements.user_name).text(response.name);
					$(page.elements.user_picture).attr('src','https://graph.facebook.com/' + response.username + '/picture');
					
				});
				
				$(page.elements.user_info).fadeIn(); 
				
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
					$(this).bind('click',function(){ FB.login(); });	
					
				}); 
				
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