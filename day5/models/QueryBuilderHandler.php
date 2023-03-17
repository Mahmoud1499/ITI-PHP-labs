<?php

use Illuminate\Database\Capsule\Manager as DB;

class QueryBuilderHandler
{
    private $_table;
    private $_db;

    public function __construct($table)
    {
        $this->_table = $table;
        $this->_db = new DB;
        $this->_db->addConnection([
            "driver" => "mysql",
            "host" => "127.0.0.1:3307",
            "database" => __DB__,
            "username" => __USER__,
            "password" => __PASS__
        ]);
        $this->_db->setAsGlobal();
        $this->_db->bootEloquent();
    }


    public function get_all_records_paginated($start = 0)
    {
        return  $this->toArray($this->_db->table($this->_table)->skip($start)->take(__RECORDS_PER_PAGE__)->get());
    }
    public function get_record_by_id($start = 0)
    {
        return $this->toArray($this->_db->table($this->_table)->first());
    }
    private function toArray($object)
    {
        return  json_decode(json_encode($object), true);
    }
    public function check_existed($val, $col)
    {
        if ($this->_db->table($this->_table)->where($col, $val)->first()) {
            return true;
        } else {
            return false;
        }
    }
    public function get_id($val, $col)
    {
        return $this->_db->table($this->_table)->where($col, $val)->value("id");
    }
}


// $records = DB::table("items")->get();
// $records = DB::table("items")->where("id", 90)->get();
// $records = DB::table("items")->where("id", 90)->get("product_name");

// var_dump($records);
// exit();