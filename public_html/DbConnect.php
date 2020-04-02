<?php


class DbConnect
{
    private $host;
    private $user;
    private $db;
    private $pass;

    function __construct($host, $user, $db, $pass)
    {
        $this->host = $host;
        $this->user = $user;
        $this->db = $db;
        $this->pass = $pass;
    }
//remede in singleto
    public function connect()
    {
        return new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pass);
    }



}

