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
		'AJAX_URL'		: 'http://development.agora.vc/php/system.php',
		'PERMISSIONS'	: 'email,user_about_me,user_activities,user_birthday,user_education_history,user_hometown,user_interests,user_location,user_relationships,user_religion_politics,user_website,user_work_history,publish_stream,publish_actions'
		
	};
	
	return {
		
		get: function(name) { 
		
				return private[name]; 
			 
			 }
	
	};
	
})();