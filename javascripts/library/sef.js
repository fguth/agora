/**
 * CONVERT ANY SHIT TO A SEARCH ENGINE FRIENDLY NAME
 * 
 * @param {String} name
 * 
 * @return {String}
 * 
 * @example
 * sef("Bob's Place") will output bobs-place
 */

function sef(name) {
	var change = ["-", "a", "a", "a", "a", "a", "a", "c", "e", "e", "e", "e", "i", "i", "i", "i", "n", "o", "o", "o", "o", "o", "u", "u", "u", "u", "y"];
	var index = 0;
	var search = [" ", "à", "á", "â", "ã", "ä", "å", "ç", "è", "é", "ê", "ë", "ì", "í", "î", "ï", "ñ", "ò", "ó", "ô", "õ", "ö", "ù", "ú", "û", "ü", "ý"];
	
	name = name.toLowerCase();
	
	for (index; index < search.length; index += 1) {
		name = name.replace(new RegExp(search[index], "gi"), change[index]);
	}
	
	name = name.replace(/[^a-z-]/g, "");
	
	return name;
}