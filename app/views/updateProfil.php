<?php $this->view("includes/header", $data); ?>
<div class="container my-3">
    <div class="row">
        <div class="col-12">
            <h2 class="text-center">Modification de mon profil</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-8">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom : </label>
                        <input type="text" value="<?= $userData->nameMember ?>" name='name' class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="firstname" class="form-label">Prénom : </label>
                        <input type="text" value="<?= $userData->firstnameMember ?>" name='firstname' class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="pseudo" class="form-label">Pseudo : </label>
                        <input type="text" value="<?= $userData->pseudoMember ?>" name='pseudo' class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email : </label>
                        <input type="email" value="<?= $userData->emailMember ?>" name='email' class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">Ville : </label>
                        <input type="text" value="<?= $userData->cityMember ?>" name='city' class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="postalCode" class="form-label">Code Postal : </label>
                        <input type="text" value="<?= $userData->postalCodeMember ?>" name='postalCode' class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="adress" class="form-label">Adresse : </label>
                        <input type="text" value="<?= $userData->adressMember ?>" name='adress' class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe : </label>
                        <input type="password" name='password' class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="password2" class="form-label">Confimez le mot de passe : </label>
                        <input type="password" name='password2' class="form-control">
                    </div>
                    <input type="submit" class="btn btn-primary" name="signUp" value="Valider">
                </form>
                <?= checkError() ?>
            </div>
        </div>
    </div>
</div>
<?php $this->view("includes/footer", $data); ?>