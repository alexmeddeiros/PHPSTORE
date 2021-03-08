<?php

namespace core\models;

use core\lib\Database;
use core\classes\Store;

class Clientes
{
    // ====================================================================
    public function emailExist($email)
    {
        $bd = new Database();
        $params = [
            ':e' => strtolower(trim($email))
        ];
        $res = $bd->select("SELECT email FROM clientes WHERE email = :e", $params);

        //se o cliente ja existe...
        if (count($res) != 0) {
            return true;
        } else {
            return false;
        };
    }
    // ====================================================================


    public function createCostumer()
    {
        // registra clientes na base de dados
        $bd = new Database();

        // criar purl(personal url) para registro de clientes
        $purl = Store::createHash();

        // parametros
        $params = [
            ':email' => strtolower(trim($_POST['email'])),
            ':password' => password_hash($_POST['password_1'], PASSWORD_DEFAULT),
            ':full_name' => (trim($_POST['full_name'])),
            ':address' => (trim($_POST['address'])),
            ':city' => (trim($_POST['city'])),
            ':phone' => (trim($_POST['phone'])),
            ':purl' => $purl,
            ':status' => 0
        ];

        $bd->insert("INSERT INTO clientes VALUES(
                0,
                :email,
                :password,
                :full_name,
                :address,
                :city,
                :phone,
                :purl,
                :status,
                NOW(),
                NOW(),
                NULL)", $params);

        // retorna o purl para ativar o cliente na base de dados
        return $purl;
    }
}
