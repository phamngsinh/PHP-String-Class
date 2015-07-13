<?php
class Arr extends ArrayObject {
	private static $ret_obj = true;

	public function add () {
		$val = 0;
		foreach($this as $vals) {
			$val += $vals;
		}
		return $val;
	}

	public function get ($i) {
		$val = $this->offsetGet($i);
		if(is_array($val)) {
			return new self($val);
		}
		if(is_string($val) && self::$ret_obj) {
			return new String($val);
		}
		return $val;
	}

	public function each ($callback) {
		foreach($this as $key => $val) {
			call_user_func_array($callback, array(
				$val, $key, $this
			));
		}
		return $this;
	}

	public function set ($i, $v) {
		$this->offsetSet($i, $v);
		return $this;
	}

	public function push ($value) {
		$this[] = $value;
		return $this;
	}

	public function join ($paste = '') {
		return implode($paste, $this->getArrayCopy());
	}

	public function sort () {
		$this->asort();
		return $this;
	}

	public function toArray () {
		return $this->getArrayCopy();
	}

	public function natsort () {
		parent::natsort();
		return $this;
	}

	public function rsort () {
		parent::uasort('Arr::sort_alg');
		return $this;
	}

	public static function sort_alg ($a,$b) {
	    if ($a == $b) {
			return 0;
		}
		return ($a < $b) ? 1 : -1;
	}
}