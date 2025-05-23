<?php

namespace Core;

use PDO;

class Database
{
    public $connection;
    public $statement;

    public function __construct($config, $username='root', $password='R00t')
    {

        //$dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";
        $dsn = 'mysql:'.http_build_query($config, '', ';');

        //die("this: $password");

        $this->connection =new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        
    }

    public function query($query, $params=[])
    {
        

        $this->statement = $this->connection ->prepare($query);

        $this->statement->execute($params);


        return $this;

    }

    public function get()
    {
        return $this->statement ->fetchAll();
    }

    public function find()
    {
        return $this->statement ->fetch();
    }

    public function findOrFail()
    {
        $result = $this->find();
        if( !$result)
        {
            abort(404);
        }

        return $result;

    }



}
