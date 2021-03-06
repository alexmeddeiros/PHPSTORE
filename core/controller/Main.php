<?php

namespace core\controller;

class Main
{
    public function index()
    {

        $clientes = ['joao', 'ana', 'carlos'];
        /**
         * 
         * 1 - carrega e trata dados (calculos e base de dados)
         * 
         * 2 - apresenta o layout (views)
         */
        echo 'home!!!!';
    }

    public function loja()
    {
        echo 'Loja!!!!';
    }
}
