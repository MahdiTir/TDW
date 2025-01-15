<?php
class historique {
    public function afficherHistorique($dons, $benevolats, $remises) {
        ?> <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Historique Complet</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
            <script>
                function toggleSection(sectionId, button) {
                    var section = document.getElementById(sectionId);
                    if (section.style.display === "none") {
                        section.style.display = "block";
                        button.innerHTML = '▼';
                    } else {
                        section.style.display = "none";
                        button.innerHTML = '►';
                    }
                }
            </script>
        </head>
        <body>
            <div class="container my-5">
                <h1 class="text-center mb-4">Historique Complet</h1>
        
                <div class="mb-4">
                    <h2 class="text-primary">
                        Dons
                        <button class="btn btn-link p-0" onclick="toggleSection('donsSection', this)">►</button>
                    </h2>
                    <div id="donsSection" style="display: none;">
                        <?php
                        if (empty($dons)) {
                            ?><p class="text-muted">Aucun don trouvé.</p><?php
                        } else {
                            ?><ul class="list-group"><?php
                            foreach ($dons as $don) {
                                ?><li class="list-group-item">
                                    <strong>ID :</strong> <?php echo htmlspecialchars($don['id']); ?><br>
                                    <strong>Montant:</strong> <?php echo htmlspecialchars($don['montant']); ?> DZD<br>
                                    <strong>Statut:</strong> <?php echo htmlspecialchars($don['status']); ?><br>
                                    <strong>Date:</strong> <?php echo htmlspecialchars($don['date']); ?>
                                </li><?php
                            }
                            ?></ul><?php
                        }
                        ?>
                    </div>
                </div>
        
                <div class="mb-4">
                    <h2 class="text-primary">
                        Bénévolats
                        <button class="btn btn-link p-0" onclick="toggleSection('benevolatsSection', this)">►</button>
                    </h2>
                    <div id="benevolatsSection" style="display: none;">
                        <?php
                        if (empty($benevolats)) {
                            ?><p class="text-muted">Aucun bénévolat trouvé.</p><?php
                        } else {
                            ?><ul class="list-group"><?php
                            foreach ($benevolats as $benevolat) {
                                if ($benevolat['status'] === 'fait') {
                                ?><li class="list-group-item">
                                    <strong>ID :</strong> <?php echo htmlspecialchars($benevolat['id']); ?><br>
                                    <strong>Événement:</strong> <?php echo htmlspecialchars($benevolat['evenement']); ?><br>
                                    <strong>Date De:</strong> <?php echo htmlspecialchars($benevolat['date_debut']); ?>
                                    <strong>A:</strong> <?php echo htmlspecialchars($benevolat['date_fin']); ?>
                                </li><?php
                                }
                            }
                            ?></ul><?php
                        }
                        ?>
                    </div>
                </div>
        
                <div class="mb-4">
                    <h2 class="text-primary">
                        Remises
                        <button class="btn btn-link p-0" onclick="toggleSection('remisesSection', this)">►</button>
                    </h2>
                    <div id="remisesSection" style="display: none;">
                        <?php
                        if (empty($remises)) {
                            ?><p class="text-muted">Aucune remise trouvée.</p><?php
                        } else {
                            ?><ul class="list-group"><?php
                            foreach ($remises as $remise) {
                                ?><li class="list-group-item">
                                    <strong>ID :</strong> <?php echo htmlspecialchars($remise['id']); ?><br>
                                    <strong>Partenaire:</strong> <?php echo htmlspecialchars($remise['partenaire']); ?> <br>
                                    <strong>Pourcentage:</strong> <?php echo htmlspecialchars($remise['pourcentage']); ?> %<br>
                                    <strong>Date:</strong> <?php echo htmlspecialchars($remise['date_obtenu']); ?>
                                </li><?php
                            }
                            ?></ul><?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </body>
        </html>
        <?php
    }
}
?>
