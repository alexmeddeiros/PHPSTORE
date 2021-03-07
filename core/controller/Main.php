<?php

namespace core\controller;

use core\classes\Store;

class Main
{
    public function index()
    {



        // 1 - carrega e trata dados (calculos e base de dados)
        $dados = [
            'titulo' => APP_NAME . ' ' . APP_VERSION,
        ];

        // 2 - apresenta o layout (views) e envia os dados para as view
        Store::layout([
            'layouts/html_header',
            'layouts/header',
            'home',
            'layouts/footer',
            'layouts/html_footer'
        ], $dados);
    }

    public function loja()
    {
        echo 'Loja!!!!';
    }
}
