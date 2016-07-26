<?php

namespace Mesour\ArrayManage\Changer;

use Mesour\ArrayManage\Searcher\Search,
	Mesour\ArrayManage\Translator;

/**
 * @author mesour <matous.nemec@mesour.com>
 * @package Mesour ArrayManager
 */
class Delete extends Search {

	/**
	 * @var array
	 */
	private $data_array = array();

	public function __construct(array & $data_array) {
		parent::__construct($data_array);
		$this->data_array = & $data_array;
	}

	public function execute() {
		$data = $this->getResults();

		if(!empty($data)){
			foreach($data as $key => $val) {
				unset($this->data_array[$key]);
			}
		}

		return $data;
	}

	public function test() {
		echo '<pre>';
		echo (new Translator(Translator::DELETE))->translate() . "\n" . $this->translate();
		echo '</pre>';
	}

}