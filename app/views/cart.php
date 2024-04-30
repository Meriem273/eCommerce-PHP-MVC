<?php $this->view("includes/header", $data); ?>
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-8 text-center">
            <h1 class="">Votre Panier</h1>
        </div>
    </div>
    <?php
    if (isset($_SESSION['idCommand'])) {
        echo "Votre numéro de commande : " . $_SESSION['idCommand'];
        unset($_SESSION['idCommand']);
    }
    ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Numero de commande</th>
                <th scope="col">Nom du produit</th>
                <th scope="col">Quantité</th>
                <th scope="col">Prix($)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            echo $cart;
            ?>
        <script src="https://www.paypal.com/sdk/js?client-id=AeNR5aCDiC3uGG8jDi6KBG_RgBSxh1GcIQ80ANEo_cE-adwN62-Zfaym-lsaJkk0ssHuc1XLgkl2uEU-&currency=CAD"></script>
<script src="<?= ASSETS ?>paypal.js"></script>
        </tbody>
    </table>

    <?php
    if (isset($buttonValidate)) {
        echo $buttonValidate;
    }
    if (isset($button)) {
        echo $button;
    }
    ?>
</div>
<form method="post">
        <center>
            <br><br>
            <div id="paypal-payment-button" name="payer" style="width: 300px;"></div>
        </center>

        </form>

<?php $this->view("includes/footer", $data); ?>

