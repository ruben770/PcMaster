<?php

class Database
{
    public static function connect()
    {
        $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

        $server = $url["host"];
        $username = $url["user"];
        $password = $url["pass"];
        $database = substr($url["path"], 1);

        $db = new mysqli($server, $username, $password, $database);
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}
