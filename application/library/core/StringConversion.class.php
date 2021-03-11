<?php 
namespace library\core;

/**
 * Microdle Framework (https://microdle.com/).
 * String operations.
 * 
 * @author Vincent SOYSOUVANH
 * 
 * @version 0.1
 * 
 * @package library.core
 */
class StringConversion {
	/**
	 * Convert string to a valid URL in lower case.
	 * Accented characters are replaced by no accented characters equivalent, upper case is replaced by lower case, and non alphanumeric characters are replaced by "-" (hyphen).
	 * 
	 * @param string $string String.
	 * 
	 * @return string Valide Url.
	 */
	static public function toName(string $string): string {
		//Optimize process
		return trim(preg_replace('/([^a-z0-9]+)/', '-', html_entity_decode(preg_replace('/&(.)(acute|cedil|circ|grave|ring|tilde|uml);/', '$1', htmlentities(mb_strtolower($string, 'UTF-8'), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8')), " -\t\n\r\0\x0B");
	}
	
	/**
	 * Convert string to a valid URL in lower case.
	 * Accented characters are replaced by no accented characters equivalent, delimite upper case by "-", and non alphanumeric characters are replaced by "-" (hyphen).
	 * 
	 * @param string $string String.
	 * 
	 * @return string Valide Url.
	 */
	static public function toUrl(string $string): string {
		//Optimize process
		return trim(preg_replace('/([^a-z0-9]+)/', '-', html_entity_decode(preg_replace('/&(.)(acute|cedil|circ|grave|ring|tilde|uml);/', '$1', htmlentities(mb_strtolower(preg_replace('/([A-Z])/', '-$1', $string), 'UTF-8'), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8')), " -\t\n\r\0\x0B");
	}
	
	/**
	 * Convert first character in upper case of each word.
	 * 
	 * @param string $string String.
	 * 
	 * @return string All words begin with upper case.
	 */
	static public function toUcWords(string $string): string {
		//String example "je vais à l'école de jean-pierre" to "Je Vais A L'Ecole De Jean-Pierre"
		$string = htmlentities($string, ENT_COMPAT, 'UTF-8');
		$string = preg_replace('/(.?)&(.)(acute|cedil|circ|grave|ring|tilde|uml);/', '$1$2', $string);
		return ucwords($string, "-' \t\r\n\f\v");
	}
	
	/**
	 * Convert a string to camelCase.
	 * 
	 * @param string $string String
	 * 
	 * @return string
	 */
	static public function toCamelCase(string $string): string {
		return lcfirst(str_replace(' ', '', ucwords(str_replace(array('_', '-'), ' ', $string))));
	}
	
	/**
	 * Convert string to capital.
	 * 
	 * @param string $string String to capitalize.
	 * 
	 * @return string
	 */
	static public function capitalize(string $string): string {
		return html_entity_decode(preg_replace('/&(.)(acute|cedil|circ|grave|ring|tilde|uml);/', '$1', htmlentities(mb_strtoupper($string, 'UTF-8'), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');
	}
}
?>