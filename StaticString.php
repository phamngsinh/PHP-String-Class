<?php



class StaticString {
	/* static methods wrapping multibyte */

	/**
	 * Wrapper for substr
	 */
	public static function substr ($string, $start, $length = null) {
		if(String::$multibyte) {
			return new String(mb_substr($string, $start, $length, String::$multibyte_encoding));
		}
		return new String(substr($string, $start, $length));
	}

	/**
	 * Equivelent of Javascript's String.substring
	 * @link http://www.w3schools.com/jsref/jsref_substring.asp
	 */
	public static function substring ($string, $start, $end) {
		if(empty($length)) {
			return self::substr($string, $start);
		}
		return self::substr($string, $end - $start);
	}

	public function charAt ($str, $point) {
		return self::substr($str, $point, 1);
	}

	public function charCodeAt ($str, $point) {
		return ord(self::substr($str, $point, 1));
	}

	public static function concat () {
		$args = func_get_args();
		$r = "";
		foreach($args as $arg) {
			$r .= (string)$arg;
		}
		return $arg;
	}

	public static function fromCharCode ($code) {
		return chr($code);
	}

	public static function indexOf ($haystack, $needle, $offset = 0) {
		if(String::$multibyte) {
			return mb_strpos($haystack, $needle, $offset, String::$multibyte_encoding);
		}
		return strpos($haystack, $needle, $offset);
	}

	public static function lastIndexOf ($haystack, $needle, $offset = 0) {
		if(String::$multibyte) {
			return mb_strrpos($haystack, $needle, $offset, String::$multibyte_encoding);
		}
		return strrpos($haystack, $needle, $offset);
	}

	public static function match ($haystack, $regex) {
		preg_match_all($regex, $haystack, $matches, PREG_PATTERN_ORDER);
		return new Arr($matches[0]);
	}

	public static function replace ($haystack, $needle, $replace, $regex = false) {
		if($regex) {
			$r = preg_replace($needle, $replace, $haystack);
		}
		else {
			if(String::$multibyte) {
				$r = mb_str_replace($needle, $replace, $haystack);
			}
			else {
				$r = str_replace($needle, $replace, $haystack);
			}
		}
		return new String($r);
	}

	public static function strlen ($string) {
		if(String::$multibyte) {
			return mb_strlen($string, String::$multibyte_encoding);
		}
		return strlen($string);
	}

	public static function slice ($string, $start, $end = null) {
		return self::substring($string, $start, $end);
	}

	public static function toLowerCase ($string) {
		if(String::$multibyte) {
			return new String(mb_strtolower($string, String::$multibyte_encoding));
		}
		return new String(strtolower($string));
	}

	public static function toUpperCase ($string) {
		if(String::$multibyte) {
			return new String(mb_strtoupper($string, String::$multibyte_encoding));
		}
		return new STring(strtoupper($string));
	}

	public static function split ($string, $at = '') {
		if(empty($at)) {
			if(String::$multibyte) {
				return new Arr(mb_str_split($string));
			}
			return new Arr(str_split($string));
		}
		return new Arr(explode($at, $string));
	}

	/* end static wrapper methods */
}