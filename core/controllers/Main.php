<?php

namespace core\controllers;

use core\classes\Store;
use core\lib\Database;
use core\models\Clientes;

class Main
{
    // ======= pagina home ==========
    public function index()
    {

        // 2 - apresenta o layout (views) e envia os dados para as view
        Store::layout([
            'layouts/html_header',
            'layouts/header',
            'home',
            'layouts/footer',
            'layouts/html_footer'
        ]);
    }

    // ======= pagina da loja ==========
    public function store()
    {
        Store::layout([
            'layouts/html_header',
            'layouts/header',
            'store',
            'layouts/footer',
            'layouts/html_footer'
        ]);
    }


    // ======= pagina do cliente ==========
    public function newCostumer()
    {
        // Verifica se je existe cliente logado
        if (Store::logged()) {
            $this->index();
            return;
        }

        // Apresenta layout parar crir novo usuário
        Store::layout([
            'layouts/html_header',
            'layouts/header',
            'newCostumer',
            'layouts/footer',
            'layouts/html_footer'
        ]);
    }



    //==========================================================================================
    //================= Criar Cliente ==========================================================
    //==========================================================================================
    public function createCostumer()
    {
        // verifica se ja existe sessão
        if (Store::logged()) {
            $this->index();
            return;
        }

        // verifica se houve a submissao de dados por formulario
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->index();
            return;
        }

        // criação do novo usuário


        // verifica se senha 1 = senha 2
        if ($_POST['password_1'] !== $_POST['password_2']) {

            //as senhas sao diferentes
            $_SESSION['erro'] = 'As senhas não estão iguais.';
            $this->newCostumer();
            return;
        }

        // Verifica na base de dados se ja existe o email igual
        $cliente = new Clientes();
        if ($cliente->emailExist($_POST['email'])) {
            $_SESSION['erro'] = 'Email ja cadastrado na base de dados.';
            $this->newCostumer();
            return;
        }



        // Registrando cliente a base de dados e returnando o pURL
        $purl = $cliente->createCostumer();

        // Criar um link purl para enviar por email
        $link_purl = "http://localhost/PHPSTORE/public/?a=confirmar_email&purl=$purl";


        /**
         * 1 - verifica se as senhas são iguais                             ok
         * 2 - base de dados - ja existe outra conta om o mesmo email?      ok
         * 3 - registro                                                     to do
         *      - criar purl(personal url)
         *      - guardar dados na tabela clientes
         *      - enviar um email com o purl para o cliente
         *      - apresentar uma mensagem indicando que validar o email
         */
    }






    // ======= pagina do carrinho ==========
    public function cart()
    {
        Store::layout([
            'layouts/html_header',
            'layouts/header',
            'cart',
            'layouts/footer',
            'layouts/html_footer'
        ]);
    }
}