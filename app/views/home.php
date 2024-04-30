<?php $this->view("includes/header", $data); ?>
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-md-6 text-center">
            <h1 style="font-family: Arial, sans-serif; color: #333;">BooksBazar.ca</h1>
            <h2 style="font-family: Arial, sans-serif; color: #666;">Site de vente de livres en ligne</h2>
        </div>
    </div>
    <div class="row my-5 justify-content-center">
        <div class="col-md-8">
            <h3 class="text-center" style="font-family: Arial, sans-serif; color: #333;">Nouveaux Livres</h3>
            <div class="row">
                <?php echo $htmlProducts; ?>
            </div>
        </div>
    </div>
</div>
<?php $this->view("includes/footer", $data); ?>
