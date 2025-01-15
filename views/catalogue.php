<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue des Partenaires</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .partenaire-card {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .partenaire-card img {
            max-width: 100%;
            height: 150px;
            object-fit: cover;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .filters {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center my-4">Catalogue des Partenaires</h1>

        <!-- Filtres -->
        <div class="filters d-flex justify-content-between">
            <form method="GET" class="d-flex gap-3">
                <!-- Filtre par ville -->
                <select name="ville" class="form-select">
                    <option value="">Toutes les villes</option>
                    <?php foreach ($villes as $v): ?>
                        <option value="<?= htmlspecialchars($v) ?>" <?= isset($_GET['ville']) && $_GET['ville'] === $v ? 'selected' : '' ?>>
                            <?= htmlspecialchars($v) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <!-- Filtre par catégorie -->
                <select name="categorie" class="form-select">
                    <option value="">Toutes les catégories</option>
                    <option value="Hotel" <?= isset($_GET['categorie']) && $_GET['categorie'] === 'Hotel' ? 'selected' : '' ?>>Hôtels</option>
                    <option value="Clinique" <?= isset($_GET['categorie']) && $_GET['categorie'] === 'Clinique' ? 'selected' : '' ?>>Cliniques</option>
                    <option value="Ecole" <?= isset($_GET['categorie']) && $_GET['categorie'] === 'Ecole' ? 'selected' : '' ?>>Écoles</option>
                    <option value="Agence" <?= isset($_GET['categorie']) && $_GET['categorie'] === 'Agence' ? 'selected' : '' ?>>Agences de Voyage</option>
                </select>

                <!-- Bouton de filtrage -->
                <button type="submit" class="btn btn-primary">Filtrer</button>
            </form>
        </div>

        <!-- Partenaires -->
        <?php
        $categories = ['Hotel' => 'Hôtels', 'Clinique' => 'Cliniques', 'Ecole' => 'Écoles', 'Agence' => 'Agences de Voyage'];
        foreach ($categories as $key => $label):
            $filteredPartenaires = array_filter($partenaires, fn($p) => $p['categorie'] === $key);
            if (count($filteredPartenaires) > 0): ?>
                <h2 class="my-4"><?= htmlspecialchars($label) ?></h2>
                <div class="row">
                    <?php foreach ($filteredPartenaires as $partenaire): ?>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="partenaire-card">
                                <?php if (!empty($partenaire['logo']) && !empty($partenaire['mime_type'])): ?>
                                    <img src="data:<?= htmlspecialchars($partenaire['mime_type']) ?>;base64,<?= base64_encode($partenaire['logo']) ?>" alt="Logo">
                                <?php endif; ?>
                                <div class="p-3">
                                    <h5><?= htmlspecialchars($partenaire['nom']) ?></h5>
                                    <?php if (!empty($partenaire['description'])): ?>
                                    <p class="partenaire-description"><?= htmlspecialchars($partenaire['description']) ?></p>
                                <?php endif; ?>
                                    <p>Ville : <?= htmlspecialchars($partenaire['ville']) ?></p>
                                    <p><strong>Remises :</strong></p>
                                    <?php if (!empty($partenaire['avantages'])): ?>
                                        <ul>   
                                            <?php 
                                            $avantages = explode('||', $partenaire['avantages']);
                                            foreach ($avantages as $avantage):
                                                $details = explode('|', $avantage);
                                                $pourcentage = $details[0] ?? ''; // Vérifie si l'indice 0 existe
                                                $type = $details[1] ?? '';        // Vérifie si l'indice 1 existe
                                                $date_expiration = $details[2] ?? ''; // Vérifie si l'indice 2 existe
                                            ?>
                                                <li>
                                                    <?= htmlspecialchars($pourcentage) ?>% 
                                                    <?php if (!empty($type)): ?>
                                                        - <?= htmlspecialchars($type) ?>
                                                    <?php endif; ?>
                                                    <?php if (!empty($date_expiration)): ?>
                                                        (Valable jusqu'au : <?= htmlspecialchars($date_expiration) ?>)
                                                    <?php endif; ?>
                                                </li>
                                            <?php endforeach; ?>

                                        </ul>
                                    <?php else: ?>
                                        <p>Aucune remise disponible.</p>
                                    <?php endif; ?>
                                    <a href="/partenaire/details?id=<?= $partenaire['id'] ?>" class="btn btn-primary">Plus de détails</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif;
        endforeach; ?>
    </div>
</body>
</html>

