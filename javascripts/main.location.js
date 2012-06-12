(function(jQuery) {
	/**
	 * System for the location header field, responsible for the behavior of the field and for suggesting cities
	 */

	page.location = function() {
		page.location.elements.$cityname.bind("keyup", page.location.key);
	}

	page.location.elements.container = ".header__nav";
	
	page.location.elements.$cityname = $(".citynav__cityname", page.location.container);
	page.location.elements.$dropdown = $("citynav__searchdropdown", page.location.container);

	page.location.key = function(event) {
		// @todo search and suggest cities as the user types thought ajax
	}
})($);