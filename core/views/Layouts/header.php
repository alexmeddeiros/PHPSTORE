<?php

use core\classes\Store;

// $_SESSION['cliente'] = 1;

?>

<!-- Cria duas divs bootstrap
div.container-fluid>div.row>(div.col-6)*2 -->

<div class="container-fluid nav_bar">
    <div class="row">
        <div class="col-6 p-3">
            <a href="?a=home">
                <button type="button" class="btn btn-outline-dark">
                    <h2><?= APP_NAME ?></h2>
                </button>
            </a>
        </div>
        <div class="col-6 text-end p-3">

            <a href="?a=home"><button type="button" class="btn btn-primary">Inicio</button></a>
            <a href="?a=store"><button type="button" class="btn btn-primary">Loja</button></a>


            <!-- Verifica se existe cliente logado -->
            <?php if (Store::logged()) : ?>
                <a href="#"><button type="button" class="btn btn-primary">Minha conta</button></a>
                <a href="#"><button type="button" class="btn btn-danger">Sair</button></a>

            <?php else :  ?>
                <a href="#"><button type="button" class="btn btn-primary">Entrar na conta</button></a>
                <a href="?a=newCostumer"><button type="button" class="btn btn-primary">Criar na conta</button></a>
            <?php endif; ?>

            <a href="#"><i class="fas fa-shopping-cart"></i></a>
            <span class="badge bg-warning">8</span>
        </div>
    </div>
</div>