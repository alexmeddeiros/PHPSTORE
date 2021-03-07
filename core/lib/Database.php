<?php

namespace core\lib;

use Exception;
use PDO;
use PDOException;

class Database
{
    private $ligacao;

    //===================================================
    private function ligar()
    {
        // ligar à base de dados
        $this->ligacao = new PDO(
            'mysql:' . 'host=' . MYSQL_SERVER . ';' . 'dbname=' . MYSQL_DATABASE . ';' . 'charset=' . MYSQL_CHARSET,
            MYSQL_USER,
            MYSQL_PASS,
            array(PDO::ATTR_PERSISTENT => true)
        );

        // debug
        $this->ligacao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    //==================================================
    private function desligar()
    {
        $this->ligacao = null;
    }

    //==================================================
    // CREATE
    public function select($sql, $parametros = null)
    {
        // verufuca se é uma instrulçao SELCT
        if (!preg_match("/^SELECT/i", $sql)) {
            throw new Exception("Base de dados - nao é uma instrução SELECT.");
        }

        //executa a pesquisa sql
        $this->ligar();
        $resultados = null;

        //comunicar
        try {
            //comunicação com bd
            if (!empty($parametros)) {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
                $resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            } else {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
                $resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            }
        } catch (PDOException $e) {
            //caso return error
            return false;
        }

        //desligar
        $this->desligar();

        //devolver sesultador obtidos
        return $resultados;
    }

    //==================================================
    // INSERT
    //===================================================
    public function insert($sql, $parametros = null)
    {
        // verufuca se é uma instrulçao INSERT
        if (!preg_match("/^INSERT/i", $sql)) {
            throw new Exception("Base de dados - nao é uma instrução INSERT.");
        }

        //executa a pesquisa sql
        $this->ligar();

        //comunica
        try {
            //comunicação com bd
            if (!empty($parametros)) {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
            } else {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
            }
        } catch (PDOException $e) {
            //caso return error
            return false;
        }

        //desliga
        $this->desligar();
    }

    //==================================================
    // UPDATE
    //==================================================
    public function update($sql, $parametros = null)
    {
        // verufuca se é uma instrulçao update
        if (!preg_match("/^INSERT/i", $sql)) {
            throw new Exception("Base de dados - nao é uma instrução UPDATE.");
        }

        //executa a pesquisa sql
        $this->ligar();

        //comunica
        try {
            //comunicação com bd
            if (!empty($parametros)) {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
            } else {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
            }
        } catch (PDOException $e) {
            //caso return error
            return false;
        }

        //desliga
        $this->desligar();
    }

    //==================================================
    // DALETE
    //==================================================
    public function delete($sql, $parametros = null)
    {
        // verufuca se é uma instrulçao delete
        if (!preg_match("/^INSERT/i", $sql)) {
            throw new Exception("Base de dados - nao é uma instrução DELETE.");
        }

        //executa a pesquisa sql
        $this->ligar();

        //comunica
        try {
            //comunicação com bd
            if (!empty($parametros)) {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
            } else {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
            }
        } catch (PDOException $e) {
            //caso return error
            return false;
        }

        //desliga
        $this->desligar();
    }

    //==================================================
    // GENERICA
    //==================================================
    public function statment($sql, $parametros = null)
    {
        // verifica se é uma instrulçao diferente do CRUD
        if (preg_match("/^(SELECT|INSERT|UPDATE|DELETE)/i", $sql)) {
            throw new Exception("Base de dados - instruçao inválida.");
        }

        //executa a pesquisa sql
        $this->ligar();

        //comunica
        try {
            //comunicação com bd
            if (!empty($parametros)) {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
            } else {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
            }
        } catch (PDOException $e) {
            //caso return error
            return false;
        }

        //desliga
        $this->desligar();
    }
}
