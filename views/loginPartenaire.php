<?php
class LoginPartenaire {
    public function showLoginForm() {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Connexion Partenaire</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body>
            <div class="container">
                <div class="row my-4">
                    <div class="col-md-6 mx-auto">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="text-center">Connexion Partenaire</h3>
                            </div>
                            <div class="card-body bg-light">
                                <form method="post" action="">
                                    <div class="form-group mb-3">
                                        <label for="nom">Nom du Partenaire</label>
                                        <input type="text" name="nom" class="form-control" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="password">Mot de Passe</label>
                                        <input type="password" name="password" class="form-control" >
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary">Connexion</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
        </html>
        <?php
    }

}
?>