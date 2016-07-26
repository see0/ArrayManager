<?php

namespace Mesour\ArrayManage;

use Mesour\ManagerException;

/**
 * @author mesour <matous.nemec@mesour.com>
 * @package Mesour ArrayManager
 */
class Validator {

	static public function validateArray(array $array) {
		if(!empty($array)){
			if(!self::isMulti2($array)) {
				throw new ValidatorException('Array must be two dimensional.');
			}
		}
	}

	static public function isMulti2(array $a) {
		$valid = TRUE;
		foreach ($a as $v) {
			if (!is_array($v)) {
				$valid = FALSE;
			}
		}
		return $valid;
	}

	static public function isMulti3(array $a) {
		foreach ($a as $v) {
			if (is_array($v)) {
				foreach($v as $c) {
					if (!is_array($c)) return FALSE;
				}
			}
		}
		return TRUE;
	}

}

class ValidatorException extends ManagerException {

}