<?php

namespace core\controller;

use core\classes\Functions;

class Main
{
    public function index()
    {



        // 1 - carrega e trata dados (calculos e base de dados)
        $dados = [
            'titulo' => 'Este é o título',
            'clientes' => ['joao', 'ana', 'carlos']
        ];

        // 2 - apresenta o layout (views)
        Functions::layout([
            'layouts/header',
            'home',
            'layouts/footer'
        ], $dados);
    }

    public function loja()
    {
        echo 'Loja!!!!';
    }
}
