<?php $this->view("includes/header", $data); ?>
<div class="row justify-content-center">
    <div class="col-6 text-center">
        <h1>Vite mon Book !</h1>
        <h2>Details Produit</h2>
    </div>
</div>
<div class="container">
    <div class="row justify-content-evenly">
        <div class="col-12 col-lg-4">
            <p><span class="bold">Nom Produit</span> : <?= $product->nameProduct ?></p>
            <p><span class="bold">Catégorie Produit</span> : <?= $product->nameCategory ?></p>
            <p><span class="bold">Prix Produit : </span><?= $product->priceProduct ?> $</p>
            <p><span class="bold">Description Produit : </span><?= $product->descriptionProduct ?></p>
        </div>
        <div class="col-12 col-lg-4">
            <img style="height:200px" src="<?= ASSETS ?>img/products/<?= $product->imageProduct ?>">
        </div>
    </div>
    <div class="row my-5">
        <div class="offset-5">
            <button class="btn btn-primary"><a href="<?= ROOT ?>cart/addcart/<?= $product->idProduct ?>">Ajouter au panier</a></button>
        </div>
    </div>
</div>
<?php $this->view("includes/footer", $data); ?>