<?php

namespace core\classes;

use Exception;

class Store
{
    // ==================================================
    public static function Layout($layout, $dados = null)
    {
        // Verifica se a estrutura($layout) é um array
        if (!is_array($layout)) {
            throw new Exception("Erro de estrutura HTML");
        }


        // Trata variáveis que estão nas paginas
        if (!empty($dados) && is_array($dados)) {
            extract($dados);
        }


        /** Apresenta as views para aplicação
         * fazendo um foreach no array($layout)
         * e ao final da declaração do caminho
         * adiciono o (.php) ja que todas as paginas
         * contem a extensão .php
         */
        foreach ($layout as $layout) {
            include("../core/views/$layout.php");
        };
    }

    // ==================================================
    public static function logged()
    {
        // verifica se existe um cliente com sessão
        return isset($_SESSION['cliente']);
    }

    // ==================================================
    public static function createHash($num_char = 20)
    {
        //criar hashes
        $chars = '01234567891234568abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle($chars), 0, $num_char);
    }
}

/**
 * header.php 
 * inicio.php 
 * footer.php 
 */
