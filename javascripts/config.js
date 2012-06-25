/**
* Developed by Evandro Eisinger
* http://agora.vc
*/

var CONFIG = (function() {
    
	var isLocal = window.location.hostname == "local.agora.vc";
	
	var production = {
		
		'APP_ID'		: '202465246524252',
		'APP_SECRET'	: 'a126bbc85bb7dd4c3b8a452c0cbe902d',
		'APP_NAME'		: 'agora-master',
		'APP_ACTION'	: 'apoiar',
		'APP_OBJECT'	: 'candidato',
		'CHANNEL_URL'	: 'http://development.agora.vc/hypertext-preprocessor/library/channel.php',
		'HOST'			: window.location.hostname,
		'STATUS'		: true,
		'COOKIE'		: true,
		'XFBML'			: true,
		'AJAX_URL'		: 'http://development.agora.vc/hypertext-preprocessor/library/ajax.php',
		'CHECK_USER'	: '8b5b422abef67a034aac2d83f07afbcd',
		'SUPPORT'		: '256fc6e4dbf98308ceca2b9b924b25af',
		'UNSUPPORT'		: '89e3d438a10459f93076b8750c1a664f',
		'CANDIDATES_LIST' : "75720f54472ffabfca3fcb0a08e19bd9",
		'SET_HOMETOWN'  : 'dc82dd58115798afdb98d8ea2efefbc3',
		'SAYT_CITY'		: '9d86a3d362bbb5c7b2b2b54b90940904',
		'PERMISSIONS'	: ['email,user_about_me,user_birthday,user_education_history,user_hometown,user_interests,user_location,user_relationships,user_religion_politics,user_work_history,publish_actions']
		
	};
	
	var development = {
		
		'APP_ID'		: '196526257128071',
		'APP_SECRET'	: '3150c34907ad4e82e727405f32f4f863',
		'APP_NAME'		: 'agora-local',
		'APP_ACTION'	: 'apoiar',
		'APP_OBJECT'	: 'candidato',
		'CHANNEL_URL'	: 'http://local.agora.vc/hypertext-preprocessor/library/channel.php',
		'HOST'			: window.location.hostname,
		'STATUS'		: true,
		'COOKIE'		: true,
		'XFBML'			: true,
		'AJAX_URL'		: 'http://local.agora.vc/hypertext-preprocessor/library/ajax.php',
		'CHECK_USER'	: '8b5b422abef67a034aac2d83f07afbcd',
		'SUPPORT'		: '256fc6e4dbf98308ceca2b9b924b25af',
		'UNSUPPORT'		: '89e3d438a10459f93076b8750c1a664f',
		'CANDIDATES_LIST' : "75720f54472ffabfca3fcb0a08e19bd9",
		'SET_HOMETOWN'  : 'dc82dd58115798afdb98d8ea2efefbc3',
		'SAYT_CITY'		: '9d86a3d362bbb5c7b2b2b54b90940904',
		'PERMISSIONS'	: ['email,user_about_me,user_birthday,user_education_history,user_hometown,user_interests,user_location,user_relationships,user_religion_politics,user_work_history,publish_actions']
		
	}
	
	return {
		
		get : function(name) { 
				
				if (isLocal) {
					
					return development[name]; 
				
				} else {
					
					return production[name];
					
				}
				
			 }
	
	};
	
})();