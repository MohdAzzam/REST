<?php

use Dcblogdev\PdoWrapper\Database;

class Category
{
    public $db;

    public function __construct()
    {
        // make a connection to mysql here
        $options = [
            //required
            'username' => 'root',
            'database' => 'portfolio',
            //optional
            'password' => '',
            'type' => 'mysql',
            'charset' => 'utf8',
            'host' => 'localhost',
            'port' => '3306'
        ];

        $this->db = new Database($options);
    }


    public function all()
    {
        $data = $this->db->rows("SELECT * FROM category");
        return $data;
    }

    public function add($data)
    {
        $data = $this->db->insert("category", $data);
        return $data;
    }


    public function update($data, $id)
    {
        $data = $this->db->update("category", $data, $id);
        return $data;
    }

    public function delete($id)
    {
        return $this->db->delete("category", $id);

    }

}