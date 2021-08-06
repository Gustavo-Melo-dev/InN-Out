<?php

class Database {

    public static function getConnection(){
        $envPath = realpath(dirname(__FILE__) . '/../env.ini');
        $env = parse_ini_file($envPath);
        $conn = new PDO("pgsql:host={$env['host']};port={$env['port']};dbname={$env['database']};user={$env['username']};password={$env['password']}");

        if($conn->connect_error){
            die("Erro: " . $conn->connect_error);
        }

        return $conn;
    }

    public static function getResultFromQuery($sql){
        $conn = self::getConnection();
        $result = $conn->query($sql);
        return $result;
    }

    public static function executeSQL($sql) {
        $conn = self::getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $conn->lastInsertId();
    }
}