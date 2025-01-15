<?php
class favoris {
    public function render($partenaires) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Favoris</title>
            <link rel="stylesheet" href="<?= BASE_URL ?>css/profile.css">
        </head>
        <body>
    <?php 
        
    ?>

    <div class="container my-5">
        <h2 class="mb-4">Mes Partenaires Favoris</h2>
        
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php if (!empty($partenaires)) : ?>
                <?php foreach ($partenaires as $partenaire) : ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <?php if ($partenaire['logo']) : ?>
                                <img src="data:<?= $partenaire['mime_type'] ?>;base64,<?= base64_encode($partenaire['logo']) ?>" 
                                     class="card-img-top p-3" alt="Logo <?= htmlspecialchars($partenaire['nom']) ?>"
                                     style="height: 200px; object-fit: contain;">
                            <?php endif; ?>
                            
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($partenaire['nom']) ?></h5>
                                <p class="card-text"><?= htmlspecialchars($partenaire['description']) ?></p>
                                <p class="card-text">
                                    <small class="text-muted">
                                        <i class="fas fa-map-marker-alt"></i> 
                                        <?= htmlspecialchars($partenaire['adresse']) ?>, 
                                        <?= htmlspecialchars($partenaire['ville']) ?>
                                    </small>
                                </p>
                                <p class="card-text">
                                    <span class="badge bg-primary"><?= htmlspecialchars($partenaire['categorie']) ?></span>
                                </p>
                            </div>
                            
                            <div class="card-footer bg-transparent">
                                <form action="<?= BASE_URL ?>favoris/defavoriser" method="POST" class="d-grid">
                                    <input type="hidden" name="id_partenaire" value="<?= $partenaire['id_partenaire'] ?>">
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="fas fa-heart-broken"></i> Retirer des favoris
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="col-12">
                    <div class="alert alert-info" role="alert">
                        <i class="fas fa-info-circle"></i> Vous n'avez pas encore de partenaires favoris.
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Ajoutez ces styles dans votre head ou fichier CSS -->
    <style>
        .card {
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .badge {
            font-size: 0.9em;
        }
    </style>
    </body>
    </html>
        <?php
    }
}
?>