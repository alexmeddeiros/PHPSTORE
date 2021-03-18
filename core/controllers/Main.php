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


        //Apresenta o layout do envio de email e apresenta a mensagem
        //usuário criado com sucesso!
        if (!$res) {
            Store::layout([
                'layouts/html_header',
                'layouts/header',
                'costumer_created',
                'layouts/footer',
                'layouts/html_footer'
            ]);
            return;
        }
    }

    // Função é faz a confirmação do email
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

        //Apresenta o layout de validar conta
        if ($res) {
            Store::layout([
                'layouts/html_header',
                'layouts/header',
                'valid_account',
                'layouts/footer',
                'layouts/html_footer'
            ]);
            return;
        } else {
            //Redireciona para a pagina Inicial
            // vazio. ele vai pro inicio do site
            Store::redirect();
        }
    }

    // ============ Página de login ===============
    public function login()
    {
        //Verifica se existe cliente logado
        if (Store::logged()) {
            Store::redirect();
            return;
        }

        // Caso nao tenha usuário logado, apresenta o form de login
        Store::layout([
            'layouts/html_header',
            'layouts/header',
            'login_form',
            'layouts/footer',
            'layouts/html_footer'
        ]);
    }
    // ===========================================
    public function login_submit()
    {
        //Verifica se existe cliente logado
        if (Store::logged()) {
            Store::redirect();
            return;
        }

        // Verifica se foi efetuado um POST do form de login
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Store::redirect();
            return;
        }

        // Verifica se o login é válido ==============
        /**
         * 1 - verifica se os campos vieram corretamente preenchidos
         * 2 - verifica as informaçoes ao banco de dados (login)
         * 3 - Cria sessão cliente
         */

        // Passo 1
        if (
            !isset($_POST['user_email']) ||
            !isset($_POST['user_password']) ||
            !filter_var(trim($_POST['user_email']), FILTER_VALIDATE_EMAIL)
        ) {
            //Erro de preenchimento de formúlário
            $_SESSION['erro'] = 'Login inválido';
            Store::redirect('login');
            return;
        }

        // prepara os dados para o model
        $user = trim(strtolower($_POST['user_email']));
        $password = trim($_POST['user_password']);


        // Carrega o model e verifica se login é válido
        $cliente = new Clientes();
        $res = $cliente->validarLogin($user, $password);



        // Verifica o resultado
        if (is_bool($res)) {

            //login inválido
            $_SESSION['erro'] = 'Login inválido';
            Store::redirect('login');
            return;
        } else {

            //login válido. Coloca os seguintes dados na sessão
            $_SESSION['cliente'] = $res->id_cliente;
            $_SESSION['user'] = $res->email;
            $_SESSION['full_name'] = $res->full_name;

            // Redireciona pra pag Loja
            Store::redirect();
        }
    }

    // ===========================================
    public function logout()
    {
        // remove as variaveis da sessão
        unset($_SESSION['cliente']);
        unset($_SESSION['user']);
        unset($_SESSION['full_name']);

        // retorna para o inicio da loja
        Store::redirect();
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
