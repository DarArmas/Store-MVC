<?php

class Database{
    public static function connect(){
        $db = new mysqli("localhost", "dar", "12345", "gamer-x","3308");
        $db->query("SET NAMES 'utf-8'");
        return $db;
    }
}

