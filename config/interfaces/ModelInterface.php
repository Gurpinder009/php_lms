<?php
namespace Config\Interfaces;

interface ModelInterface{
    public static function insert($data);
    public static function find($id);
    public static function all();
    public static function update($id,$data);
    public static function delete($id);
}