<?php
class donsView {

    public function afficherFormulaire() {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Faire un Don</title>
            <!-- Bootstrap CSS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body>
        <div class="container my-5">
            <h1 class="text-center mb-4">Faire un Don</h1>

            <form action="dons/traiter" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="montant" class="form-label">Montant (DZD)</label>
                    <input type="number" class="form-control" id="montant" name="montant" required>
                </div>

                <div class="mb-3">
                    <label for="recu_virement" class="form-label">Reçu de Virement</label>
                    <input type="file" class="form-control" id="recu_virement" name="recu_virement" accept="image/*,application/pdf" required>
                </div>

                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
        </div>
        </body>
        </html>
        <?php
    }

}
?>