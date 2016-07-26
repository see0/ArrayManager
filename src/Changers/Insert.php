<?php

namespace Mesour\ArrayManage\Changer;

use Mesour\ArrayManage\Searcher\Search,
    Mesour\ArrayManage\Translator,
    Mesour\ArrayManage\Validator;

/**
 * @author mesour <matous.nemec@mesour.com>
 * @package Mesour ArrayManager
 */
class Insert extends Search {

	private $values_array = array();

	/**
	 * @var array
	 */
	private $data_array = array();

	public function __construct(array & $data_array, $values_array) {
		parent::__construct($data_array);
		$this->data_array = &$data_array;
		$this->values_array = $values_array;
	}

	public function execute() {
		$this->data_array[] = $this->values_array;
	}


	public function test() {
		echo '<pre>';
		echo (new Translator(Translator::UPDATE, $this->update_array))->translate() . "\n" . $this->translate();
		echo '</pre>';
	}

}