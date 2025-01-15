<?php

class Aide {
    public function afficherPage($typeAides, $user) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Demande d'Aide</title>
        </head>
        <body>
            <h1>Types d'Aides Disponibles</h1>
            <ul>
                <?php foreach ($typeAides as $typeAide): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($typeAide['nom']); ?></strong><br>
                        <?php echo htmlspecialchars($typeAide['description']); ?>
                    </li>
                <?php endforeach; ?>
            </ul>

            <h2>Formulaire de Demande d'Aide</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="nom">Nom:</label>
                <input type="text" id="nom" name="nom" required><br>

                <label for="prenom">Prénom:</label>
                <input type="text" id="prenom" name="prenom" required><br>

                <label for="telephone">Téléphone:</label>
                <input type="text" id="telephone" name="telephone" required><br>

                <label for="id_type_aide">Type d'Aide:</label>
                <select id="id_type_aide" name="id_type_aide" required>
                    <?php foreach ($typeAides as $typeAide): ?>
                        <option value="<?php echo htmlspecialchars($typeAide['id']); ?>">
                            <?php echo htmlspecialchars($typeAide['nom']); ?>
                        </option>
                    <?php endforeach; ?>
                </select><br>

                <label for="description">Description:</label>
                <textarea id="description" name="description" required></textarea><br>

                <label for="dossier">Fichier ZIP:</label>
                <input type="file" id="dossier" name="dossier" accept=".zip" required><br>

                <button type="submit">Soumettre la Demande</button>
            </form>
        </body>
        </html>
        <?php
    }
}
?>