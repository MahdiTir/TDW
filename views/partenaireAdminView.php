<?php

class partenaireAdminView {

    public function render($partenaire, $avantages, $types) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['savePartenaire'])) {
                $this->savePartenaire($partenaire['id']);
            } elseif (isset($_POST['deletePartenaire'])) {
                $this->deletePartenaire($partenaire['id']);
            } elseif (isset($_POST['saveAvantage'])) {
                $this->saveAvantage($_POST['avantageId']);
            } elseif (isset($_POST['deleteAvantage'])) {
                $this->deleteAvantage($_POST['avantageId']);
            }
        }
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Détails du partenaire</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        </head>
        <body>
            <div class="container mt-5" >
                <div class="card p-4">
                    <h1 class="text-center mb-4">Détails du partenaire</h1>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nom">Nom:</label>
                            <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($partenaire['nom']) ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="password">Mot de passe:</label>
                            <input type="password" id="password" name="password" value="<?= htmlspecialchars($partenaire['password']) ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="description">Description:</label>
                            <input type="text" id="description" name="description" value="<?= htmlspecialchars($partenaire['description']) ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="adresse">Adresse:</label>
                            <input type="text" id="adresse" name="adresse" value="<?= htmlspecialchars($partenaire['adresse']) ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="ville">Ville:</label>
                            <input type="text" id="ville" name="ville" value="<?= htmlspecialchars($partenaire['ville']) ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="categorie">Catégorie:</label>
                            <select id="categorie" name="categorie" class="form-control">
                                <option value="Hotel" <?= $partenaire['categorie'] == 'Hotel' ? 'selected' : '' ?>>Hotel</option>
                                <option value="Clinique" <?= $partenaire['categorie'] == 'Clinique' ? 'selected' : '' ?>>Clinique</option>
                                <option value="Ecole" <?= $partenaire['categorie'] == 'Ecole' ? 'selected' : '' ?>>Ecole</option>
                                <option value="Agence" <?= $partenaire['categorie'] == 'Agence' ? 'selected' : '' ?>>Agence</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="logo">Logo:</label>
                            <?php if (!empty($partenaire['logo']) && !empty($partenaire['mime_type'])): ?>
                                <img src="data:<?= htmlspecialchars($partenaire['mime_type']) ?>;base64,<?= base64_encode($partenaire['logo']) ?>" alt="Logo" style="width: 100px; height: 100px; object-fit: cover;">
                            <?php endif; ?>
                            <input type="file" id="logo" name="logo" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="mime_type">Type MIME:</label>
                            <input type="text" id="mime_type" name="mime_type" value="<?= htmlspecialchars($partenaire['mime_type']) ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="created_at">Date de création:</label>
                            <input type="text" id="created_at" name="created_at" value="<?= htmlspecialchars($partenaire['created_at']) ?>" class="form-control" readonly>
                        </div>
                        <button type="submit" name="savePartenaire" class="btn btn-primary">Enregistrer les modifications</button>
                        <button type="submit" name="deletePartenaire" class="btn btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer ce partenaire ?')">Supprimer le partenaire</button>
                    </form>
                    <h2 class="text-center mb-4">Avantages</h2>
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Pourcentage</th>
                                <th>Type</th>
                                <th>Date d'expiration</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($avantages as $avantage): ?>
                            <tr>
                                <form method="POST">
                                    <td><input type="text" name="pourcentage" value="<?= htmlspecialchars($avantage['pourcentage']) ?>" class="form-control"></td>
                                    <td>
                                        <select name="type" class="form-control">
                                            <?php foreach ($types as $type): ?>
                                                <option value="<?= htmlspecialchars($type['nom']) ?>" <?= $type['nom'] == $avantage['type'] ? 'selected' : '' ?>><?= htmlspecialchars($type['nom']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td><td><input type="text" name="date_expiration" value="<?= htmlspecialchars($avantage['date_expiration']) ?>" class="form-control"></td>
                                    <td>
                                        <input type="hidden" name="avantageId" value="<?= $avantage['id'] ?>">
                                        <button type="submit" name="saveAvantage" class="btn btn-warning btn-sm">Enregistrer</button>
                                        <button type="submit" name="deleteAvantage" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer cet avantage ?')">Supprimer</button>
                                    </td>
                                </form>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </body>
        </html>
        <?php
    }

    private function savePartenaire($id) {
        $nom = $_POST['nom'];
        $password = $_POST['password'];
        $description = $_POST['description'];
        $adresse = $_POST['adresse'];
        $ville = $_POST['ville'];
        $categorie = $_POST['categorie'];
        $mime_type = $_POST['mime_type'];

        // Handle file upload
        if (isset($_FILES['logo']) && $_FILES['logo']['error'] == UPLOAD_ERR_OK) {
            $logo = file_get_contents($_FILES['logo']['tmp_name']);
        } else {
            $logo = null;
        }

        $partenaire = new PartenaireAdminController();
        $partenaire->updatePartenaire($id, $nom, $password, $description, $adresse, $ville, $categorie, $mime_type, $logo);
        exit();
    }

    private function deletePartenaire($id) {
        $partenaire = new PartenaireAdminController();
        $partenaire->deletePartenaire($id);
        exit();
    }

    private function saveAvantage($id) {
        $pourcentage = $_POST['pourcentage'];
        $type = $_POST['type'];
        $date_expiration = !empty($_POST['date_expiration']) ? $_POST['date_expiration'] : null;;

        $avantage = new PartenaireAdminController();
        $avantage->updateAvantage($id, $pourcentage, $type, $date_expiration);
        exit();
    }

    private function deleteAvantage($id) {
        $avantage = new PartenaireAdminController();
        $avantage->deleteAvantage($id);
        exit();
    }
}
?>
