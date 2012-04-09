/**
* Developed by Evandro Eisinger
* http://agora.vc
*/

var CONFIG = (function() {
    
	var private = {
		
		//'APP_ID'		: '202465246524252',
		'APP_ID'		: '196526257128071',
		//'CHANNEL_URL'	: 'http://development.agora.vc/php/channel.php',
	 	'CHANNEL_URL'	: 'http://local.agora.vc/php/channel.php',
		'STATUS'		: true,
		'COOKIE'		: true,
		'XFBML'			: true,
		//'AJAX_URL'		: 'http://development.agora.vc/php/system.php',
		'AJAX_URL'		: 'http://local.agora.vc/php/system.php',
		'CHECK_USER'	: '8b5b422abef67a034aac2d83f07afbcd',
		'PERMISSIONS'	: 'email,user_about_me, ,user_birthday,user_education_history,user_hometown,user_interests,user_location,user_relationships,user_religion_politics,user_work_history,publish_stream,publish_actions'
		
	};
	
	return {
		
		get: function(name) { 
		
				return private[name]; 
			 
			 }
	
	};
	
})();