<?php

/**
 * Created by PhpStorm.
 * User: jasonsee
 * Date: 7/26/16
 * Time: 1:50 PM
 */
class ArrayManagerTest extends PHPUnit_Framework_TestCase
{

    function test_select(){
        $arr = array();

        $m =  new \Mesour\ArrayManager($arr);

        $m->insert(array("user" => "love"))->execute();
        $m->insert(array("user" => "watever", "data" => "killer"))->execute();

        $find = $m->select();

        $find->where("data" , "killer", \Mesour\ArrayManage\Searcher\Condition::EQUAL, 'or')
            ->where('user', 'love', \Mesour\ArrayManage\Searcher\Condition::EQUAL, 'or');

        $this->assertEquals(count($find->fetchAll()), 2);

        //test whther it find extra keys..

        $find = $m->select();

        $find->where("data" , "killer", \Mesour\ArrayManage\Searcher\Condition::EQUAL);

        $this->assertEquals(count($find->fetchAll()), 1);


        //test change updated

        $m->update(array( "data" => "updated"))
            ->where('user', 'watever', \Mesour\ArrayManage\Searcher\Condition::EQUAL)
            ->execute();

        $find = $m->select();

        $find->where("data" , "updated", \Mesour\ArrayManage\Searcher\Condition::EQUAL);

        $this->assertEquals(count($find->fetchAll()), 1);
    }


    function test_upsert(){
        $arr = array();

        $m =  new \Mesour\ArrayManager($arr);

        $m->insert(array("user" => "love"))->execute();
        $m->insert(array("user" => "watever", "data" => "killer"))->execute();

        $m->upsert(array( "data" => "updated"))
            ->where('user', 'watever', \Mesour\ArrayManage\Searcher\Condition::EQUAL)
            ->execute();

        $this->assertEquals(count($arr), 2);
        $this->assertEquals($arr[1]['data'], 'updated');

        $m->upsert(array( "data" => "upserted"))
            ->where('user', 'new_man', \Mesour\ArrayManage\Searcher\Condition::EQUAL)
            ->execute();

        $this->assertEquals(count($arr), 3);

    }





}
