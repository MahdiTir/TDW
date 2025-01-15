<?php
class profil {
    public function render($user, $membre) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Profil</title>
            <link rel="stylesheet" href="<?= BASE_URL ?>css/profile.css">
        </head>
        <body>
        <?php 
            if(isset($_POST['submit'])){
                $updateUser = new ProfilController();
                $updateUser->update();
            }
        ?>

            <div id="alert" >
            <?php include('./views/includes/alerts.php');?>
            </div>
            <div class="container">
                <h1>Mon profil</h1>

                <!-- Formulaire de mise à jour des informations -->
                <form method="post" action="<?= BASE_URL ?>profil/update" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="username">Nom d'utilisateur</label>
                        <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="telephone">Téléphone</label>
                        <input type="text" name="telephone" class="form-control" value="<?= htmlspecialchars($user['telephone']) ?>" required>
                    </div>
                    <div class="form-group mb-4">
                        <?php if (!empty($user['photo'])): ?>
                            <div class="current-photo mb-2">
                                <label>Photo actuelle</label><br>
                                <img src="data:image/jpeg;base64,<?= base64_encode($user['photo']) ?>" 
                                    alt="Photo de profil" 
                                    style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;">
                            </div>
                        <?php endif; ?>
                        <label for="photo">Photo de profil</label>
                        <input type="file" name="photo" class="form-control" accept="image/*">
                        <small class="text-muted">Formats acceptés: JPG, PNG. Taille max: 2MB</small>
                    </div>
                    <?php if ($membre) : ?>
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($membre['nom']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="prenom">Prénom</label>
                            <input type="text" name="prenom" class="form-control" value="<?= htmlspecialchars($membre['prenom']) ?>" required>
                        </div>
                    <?php endif; ?>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </form>

                
            </div>
        </body>
        </html>
        <?php
    }
}
?>