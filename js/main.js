
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
			  appId      : '202465246524252',
			  channelUrl : 'http://localhost/Agora/php/channel.php',
			  status     : true,
			  cookie     : true,
			  xfbml      : true
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
			 		 
			 page.elements.support 			= "#support";
		
		/**
		 * page
		 * * AUTH
		 */
		 
		 page.auth = function(response){
			 
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
			 * * * CHECK
			 */
			 
			
			/**
			 * page
			 * * AUTH
			 * * * ALLOWED
			 */
			 
			 page.auth.allowed = function(){
				
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