<?php
class BenevolatView {

    public function afficherFormulaire($evenement, $user = null) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Inscription Bénévole</title>
            <!-- Bootstrap CSS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
            <style>
                .event-image {
                    max-width: 50%; /* Reduce the size of the image */
                    height: auto;
                    display: block;
                    margin: 0 auto 20px;
                }
                .text-center {
                    text-align: center;
                }
            </style>
        </head>
        <body>
        <div class="container my-5">
            <h1 class="text-center mb-4">Inscription Bénévole</h1>

            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title text-center"><?= htmlspecialchars($evenement['titre']) ?></h2>
                    <?php if (!empty($evenement['photo']) && !empty($evenement['mime_type'])): ?>
                        <div class="text-center">
                            <img src="data:<?= htmlspecialchars($evenement['mime_type']) ?>;base64,<?= base64_encode($evenement['photo']) ?>" alt="Photo de l'événement" class="event-image">
                        </div>
                    <?php endif; ?>
                    <p class="card-text"><?= htmlspecialchars($evenement['description']) ?></p>
                    <p><strong>Date:</strong> <?= htmlspecialchars($evenement['date_debut']) ?></p>
                    <p><strong>Lieu:</strong> <?= htmlspecialchars($evenement['lieu']) ?></p>
                    <p><strong>Places restantes:</strong> <?= $evenement['places_disponibles'] - $evenement['places_reserves'] ?></p>
                </div>
            </div>                   
            <form action="<?= BASE_URL ?>home?page=benevolat&action=traiter&id_evenement=<?= htmlspecialchars($evenement['id']) ?>" method="post">
                <input type="hidden" name="id_evenement" value="<?= htmlspecialchars($evenement['id']) ?>">

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom complet</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="<?= $user ? htmlspecialchars($user['username']) : '' ?>" required>
                </div>

                <div class="mb-3">
                    <label for="telephone" class="form-label">Téléphone</label>
                    <input type="tel" class="form-control" id="telephone" name="telephone" value="<?= $user ? htmlspecialchars($user['telephone']) : '' ?>" required>
                </div>

                <button type="submit" class="btn btn-primary">S'inscrire</button>
            </form>
        </div>
        </body>
        </html>
        <?php
    }
}
?>