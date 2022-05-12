<?php
namespace Config\Interfaces;

interface ModelInterface{
    public static function insert($data);
    public static function find(int $id);
    public static function all();
    public static function update(int $id,$data);
    public static function delete(int $id);
}