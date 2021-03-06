<?php

namespace Mesour\ArrayManage\Changer;

use Mesour\ArrayManage\Searcher\Search,
    Mesour\ArrayManage\Translator,
    Mesour\ArrayManage\Validator;

/**
 * @author mesour <matous.nemec@mesour.com>
 * @package Mesour ArrayManager
 */
class Upsert extends Search {

    private $update_array = array();

    /**
     * @var array
     */
    private $data_array = array();

    public function __construct(array & $data_array, $update_array) {
        parent::__construct($data_array);
        $this->data_array = &$data_array;
        $this->update_array = $update_array;
    }

    public function execute() {

        $result = $this->getResults();

        if(count($this->getResults()) > 0){
            foreach ($result as $key => $val) {
                foreach ($this->update_array as $_key => $_val) {
                    $this->data_array[$key][$_key] = $_val;
                }
            }
        }else{
            $this->data_array[] = $this->update_array;
        }
    }

    public function test() {
        echo '<pre>';
        echo (new Translator(Translator::UPDATE, $this->update_array))->translate() . "\n" . $this->translate();
        echo '</pre>';
    }

}