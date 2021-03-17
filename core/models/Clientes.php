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

    // ====================================================================
    public function emailValid($purl)
    {
        // validar email do novo cliente
        $bd = new Database();
        $params = [
            ':purl' => $purl
        ];
        $res = $bd->select("SELECT * FROM clientes WHERE purl = :purl", $params);

        if (count($res) != 1) {
            return false;
        }

        // foi encontrado esse cliente com o id indicado
        $id_cliente = $res[0]->id_cliente;

        // atualizar os dados dos clientes
        $params = [
            ':id_cliente' => $id_cliente
        ];
        $bd->update(
            "UPDATE clientes SET 
            purl = NULL, 
            status = 1, 
            updated_at = NOW() 
            WHERE 
            :id_cliente = $id_cliente",
            $params
        );

        return true;
    }

    // ====================================================================
    public function validarLogin($user, $password)
    {
        //verifica se o login é válido
        $params = [
            ':user' => $user
        ];

        $bd =  new Database();
        $res = $bd->select(
            "SELECT * FROM clientes 
            WHERE email = :user 
            AND status = 1  
            AND deleted_at IS NULL",
            $params
        );


        if (count($res) != 1) {
            // Não existe usuário
            return false;
        } else {

            // Temos usuário
            $user = $res[0];

            //verifica a password e a hash
            if (!password_verify($password, $user->password)) {
                // Password inválida
                return false;
            } else {

                // login válido
                return $user;
            }
        }
    }
}
