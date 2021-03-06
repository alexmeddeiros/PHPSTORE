<?php

namespace core\classes;

use Exception;

class Functions
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
}

/**
 * header.php 
 * inicio.php 
 * footer.php 
 */
