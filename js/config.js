/**
* Developed by Evandro Eisinger
* http://agora.vc
*/

var CONFIG = (function() {
    
	var private = {
		
		'APP_ID'		: '202465246524252',
	 	'CHANNEL_URL'	: 'http://development.agora.vc/php/channel.php',
		'STATUS'		: true,
		'COOKIE'		: true,
		'XFBML'			: true,
		'AJAX_URL'		: 'http://development.agora.vc/php/system.php'
		
	};
	
	return {
		
		get: function(name) { 
		
				return private[name]; 
			 
			 }
	
	};
	
})();