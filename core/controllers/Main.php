<?php

namespace core\controllers;

use core\classes\SendEmail;
use core\classes\Store;
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
        $emailCostumer = strtolower(trim($_POST['email']));

        // Envio do Email para o cliente
        $email = new SendEmail();
        $res = $email->sendEmailConfirm($emailCostumer, $purl);
    }


    public function confirmEmail()
    {
        // Verifica se je existe cliente logado
        if (Store::logged()) {
            $this->index();
            return;
        }

        // verifica a existencia de uma query string purl
        if (!isset($_GET['purl'])) {
            $this->index();
            return;
        };

        $purl = $_GET['purl'];

        // verifica se o PURL é valido
        if (strlen($purl) != 20) {
            $this->index();
            return;
        }

        $cliente = new Clientes();
        $res = $cliente->emailValid($purl);

        if ($res) {
            echo 'Conta validada';
        } else {
            echo 'A conta nao foi validada';
        }
    }
}
