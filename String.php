<?php

interface InterFaceString{
/* end magic methods */
	
	/* ArrayAccess Methods */
	
	/** offsetExists ( mixed $index )
		*
		* Similar to array_key_exists
		*/
	public function offsetExists ($index);
	
	/* offsetGet ( mixed $index ) 
	 *
	 * Retrieves an array value
	 */
	public function offsetGet ($index);
	
	/* offsetSet ( mixed $index, mixed $val ) 
	 *
	 * Sets an array value
	 */
	public function offsetSet ($index, $val);
	/* offsetUnset ( mixed $index ) 
	 *
	 * Removes an array value
	 */
	public function offsetUnset ($index);

	public static function create ($obj);
	
	
	/* public methods */
	public function substr ($start, $length);

	public function substring ($start, $end);

	public function charAt ($point);

	public function charCodeAt ($point);

	public function indexOf ($needle, $offset);

	public function lastIndexOf ($needle);

	public function match ($regex);

	public function replace ($search, $replace, $regex = false);

	public function first ();

	public function last ();

	public function search ($search, $offset = null);

	public function slice ($start, $end = null);

	public function toLowerCase ();

	public function toUpperCase ();

	public function toUpper ();

	public function toLower ();

	public function split ($at = '');

	public function trim ($charlist = null);

	public function ltrim ($charlist = null);

	public function rtrim ($charlist = null);

	public function toString ();
}

class String implements ArrayAccess,InterFaceString {
	public static $multibyte_encoding = null;
	public static $multibyte = false;
	private $value;
	private static $checked = false;

	/* magic methods */
	public function __construct ($string) {
		if(!self::$checked) {
			self::$multibyte = extension_loaded('mbstring');
		}
		if(is_null(self::$multibyte_encoding)) {
			if(self::$multibyte) {
				self::$multibyte_encoding = mb_internal_encoding();
			}
		}
		$this->value = (string)$string;
	}
	
	public function __toString () {
		return $this->value;
	}

	/* end magic methods */
	
	/* ArrayAccess Methods */
	
	/** offsetExists ( mixed $index )
		*
		* Similar to array_key_exists
		*/
	public function offsetExists ($index) {
		return !empty($this->value[$index]);
	}
	
	/* offsetGet ( mixed $index ) 
	 *
	 * Retrieves an array value
	 */
	public function offsetGet ($index) {
		return StaticString::substr($this->value, $index, 1)->toString();
	}
	
	/* offsetSet ( mixed $index, mixed $val ) 
	 *
	 * Sets an array value
	 */
	public function offsetSet ($index, $val) {
		$this->value = StaticString::substring($this->value, 0, $index) . $val . StaticString::substring($this->value, $index+1, StaticString::strlen($this->value));
	}
	
	/* offsetUnset ( mixed $index ) 
	 *
	 * Removes an array value
	 */
	public function offsetUnset ($index) {
		$this->value = StaticString::substr($this->value, 0, $index) . StaticString::substr($this->value, $index+1);
	}

	public static function create ($obj) {
		if($obj instanceof String) return new String($obj);
		return new String($obj);
	}
	
	/* public methods */
	public function substr ($start, $length) {
		return StaticString::substr($this->value, $start, $length);
	}

	public function substring ($start, $end) {
		return StaticString::substring($this->value, $start, $end);
	}

	public function charAt ($point) {
		return StaticString::substr($this->value, $point, 1);
	}

	public function charCodeAt ($point) {
		return ord(StaticString::substr($this->value, $point, 1));
	}

	public function indexOf ($needle, $offset) {
		return StaticString::indexOf($this->value, $needle, $offset);
	}

	public function lastIndexOf ($needle) {
		return StaticString::lastIndexOf($this->value, $needle);
	}

	public function match ($regex) {
		return StaticString::match($this->value, $regex);
	}

	public function replace ($search, $replace, $regex = false) {
		return StaticString::replace($this->value, $search, $replace, $regex);
	}

	public function first () {
		return StaticString::substr($this->value, 0, 1);
	}

	public function last () {
		return StaticString::substr($this->value, -1, 1);
	}

	public function search ($search, $offset = null) {
		return $this->indexOf($search, $offset);
	}

	public function slice ($start, $end = null) {
		return StaticString::slice($this->value, $start, $end);
	}

	public function toLowerCase () {
		return StaticString::toLowerCase($this->value);
	}

	public function toUpperCase () {
		return StaticString::toUpperCase($this->value);
	}

	public function toUpper () {
		return $this->toUpperCase();
	}

	public function toLower () {
		return $this->toLowerCase();
	}

	public function split ($at = '') {
		return StaticString::split($this->value, $at);
	}

	public function trim ($charlist = null) {
		return new String(trim($this->value, $charlist));
	}

	public function ltrim ($charlist = null) {
		return new String(ltrim($this->value, $charlist));
	}

	public function rtrim ($charlist = null) {
		return new String(rtrim($this->value, $charlist));
	}

	public function toString () {
		return $this->__toString();
	}
}
