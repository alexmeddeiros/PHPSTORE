<h1><?= $titulo ?></h1>

<ul>
    <ol>
        <?php foreach ($clientes as $c) : ?>
            <li> <?= $c ?> </li>
        <?php endforeach; ?>
    </ol>
</ul>

<h1> <i class="far fa-trash-alt"></i> </h1>