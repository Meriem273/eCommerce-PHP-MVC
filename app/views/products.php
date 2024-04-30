<?php $this->view("includes/header", $data); ?>
<div class="row justify-content-center">
    <div class="col-6 text-center">
        <h1>BooksBazar.ca </h1>
        <h2>Les livres</h2>
    </div>
</div>
<div class="container">
    <div class="row my-5 justify-content-center">
        <h3 class="text-center">Nouveaux Livres</h3>
        <?php
        echo $htmlProducts;
        ?>
    </div>
</div>
<?php $this->view("includes/footer", $data); ?>