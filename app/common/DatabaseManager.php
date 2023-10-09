<?php
        //$servername = "database";
        //$username = "root";
        //$password = "root";
        //
        //$pdo_object = new PDO("mysql:host=$servername;dbname=test", $username, $password);
        //// set the PDO error mode to exception
        ////("mysql:host=" . DB::$servername . ";dbname=" . DB::$dbname . "," . DB::$username . "," . DB::$password)
        //
        //$pdo_object->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //
        //$pdo = $pdo_object;

class DatabaseManager
{
    private static $servername = "database";
    private static $dbname     = "doggo_test";
    private static $username   = "doggo";
    private static $password   = "alina_mega_pihar_2008";
    private static $_instance;
    private $pdo_object;

    private function __construct() {} // нельзя создать экземпляр через new
    public static function getInstance()
    {
        if (self::$_instance != NULL)
        {
            return self::$_instance;
        }
        self::$_instance = new self();
        self::$_instance->pdo_object = new PDO("mysql:host=" . self::$servername . ";dbname=" . self::$dbname, self::$username, self::$password);
        //$pdo = new PDO("mysql:host=$servername;dbname=test", $username, $password);
        self::$_instance->pdo_object->exec("set names utf8mb4");
        self::$_instance->pdo_object->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$_instance;
    }
//TODO: сделать метод query, который внутри будет использовать prepare + execute
//
//TODO: DB::get()->query($strQuery);
//TODO: DB::get()->query($strQuery, $data);
    function query($strQuery, $data = []): ?PDOStatement
    {
        $stmt = self::$_instance->pdo_object->prepare($strQuery);
        $result = $stmt->execute($data); // NOTE: returns false if fails

        if ($result)
            return $stmt;

        return null;
    }
    function test_query($strQuery, $data = [])
    {
//        var_dump($strQuery);
        var_dump($data);
    }
}


