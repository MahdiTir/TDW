<?php

class home {
    public function render($data) {
        extract($data);
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Accueil</title>
            <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>css/home.css">
            <script src="<?= BASE_URL ?>js/home.js"></script>
            <?php
            $couleurs = [
                'primary' => Couleurs::getPrimaryColor(),
                'secondary' => Couleurs::getSecondaryColor(),
                'accent' => Couleurs::getAccentColor(),
                'neutral' => Couleurs::getBackgroundColor(),
                'text-dark' => Couleurs::getTextColor()
            ];
            ?>
            <style>
                /*
                :root {
                    --primary: <?= htmlspecialchars($couleurs['primary']) ?> !important;
                    --secondary: <?= htmlspecialchars($couleurs['secondary']) ?> !important;
                    --accent: <?= htmlspecialchars($couleurs['accent']) ?> !important;
                    --neutral: <?= htmlspecialchars($couleurs['neutral']) ?> !important;
                    --text-dark: <?= htmlspecialchars($couleurs['text-dark']) ?> !important;
                }
                    */
            </style>
        </head>
        <body>

            <div id="alert" >
            <?php include('./views/includes/alerts.php');?>
            </div>
            <!-- Slider -->
            <div class="slider-frame">
                <div class="slide-images">
                    <?php foreach ($news as $item): ?>
                        <div class="img-container">
                            <img src="data:<?= $item['mime_type'] ?>;base64,<?= base64_encode($item['image']) ?>" 
                                 alt="<?= htmlspecialchars($item['titre']) ?>">
                            <div>
                                <h3><?= htmlspecialchars($item['titre']) ?></h3>
                                <p><?= htmlspecialchars($item['description']) ?></p>
                                <p class="date">Publié le <?= date('d/m/Y', strtotime($item['created_at'])) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Section événements -->
            <div class="events-section">
                <h2>Nos événements</h2>
                <button class="nav-btn prev">❮</button>
                <div class="event-slider">        
                    <div class="event-cards">
                        <?php foreach ($evenements as $event): ?>
                        <div class="event-card">
                            <img src="data:<?= $event['mime_type'] ?>;base64,<?= base64_encode($event['photo']) ?>" 
                                 alt="<?= htmlspecialchars($event['titre']) ?>" class="event-image">
                            <div class="event-title"><?= htmlspecialchars($event['titre']) ?></div>
                            <div class="event-description"><?= htmlspecialchars($event['description']) ?></div>
                            <div class="event-info"><strong>Date:</strong> <?= htmlspecialchars($event['date_debut']) ?></div>
                            <div class="event-info"><strong>Lieu:</strong> <?= htmlspecialchars($event['lieu']) ?></div>
                            <div class="event-info"><strong>Places restantes:</strong> <?= $event['places_disponibles'] - $event['places_reserves'] ?></div>
                            <button onclick="window.location.href='index.php?page=benevolat&id_evenement=<?= $event['id'] ?>'">
                                Inscrire comme bénévole
                            </button>
                        </div>
                        <?php endforeach; ?>
                    </div> 
                </div>
                <button class="nav-btn next">❯</button>
            </div>

            
            <!--  ---------------------------------------------------------------------- -->

            <!--  Section des avantages -->
            <div class="advantages-section">
                <h2>Nos Avantages</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Partenaire</th>
                            <th>Pourcentage</th>
                            <th>Type</th>
                            <th>Date d'expiration</th>
                        </tr>
                    </thead>
                    <tbody id="advantage-table-body">
                    </tbody>
                </table>
                <div class="pagination-controls">
                    <button id="prev-page" class="pagination-btn" disabled>❮ Précédent</button>
                    <button id="next-page" class="pagination-btn">Suivant ❯</button>
                </div>
            </div>

            <script>
            //--------------------------------------------------------
                document.addEventListener('DOMContentLoaded', function () {
                    const avantages = <?= json_encode($avantages); ?>; 
                    const rowsPerPage = 10;
                    let currentPage = 1;

                    const tableBody = document.getElementById('advantage-table-body');
                    const prevButton = document.getElementById('prev-page');
                    const nextButton = document.getElementById('next-page');

                    // Fonction pour afficher les avantages d'une page
                    function renderTable(page) {
                        tableBody.innerHTML = ''; // Vider le tableau
                        const start = (page - 1) * rowsPerPage;
                        const end = page * rowsPerPage;
                        const pageAvantages = avantages.slice(start, end);

                        // Ajouter les lignes au tableau
                        pageAvantages.forEach(avantage => {
                            const row = `
                                <tr>
                                    <td>${avantage.nom}</td>
                                    <td>${avantage.pourcentage}%</td>
                                    <td>${avantage.type}</td>
                                    <td>${avantage.date_expiration || 'N/A'}</td>
                                </tr>
                            `;
                            tableBody.insertAdjacentHTML('beforeend', row);
                        });
                       
                        // Gestion des boutons
                        prevButton.disabled = page === 1;
                        nextButton.disabled = end >= avantages.length;
                    }

                    prevButton.addEventListener('click', () => {
                        if (currentPage > 1) {
                            currentPage--;
                            renderTable(currentPage);
                        }
                    });

                    nextButton.addEventListener('click', () => {
                        if (currentPage * rowsPerPage < avantages.length) {
                            currentPage++;
                            renderTable(currentPage);
                        }
                    });

                    renderTable(currentPage);
                });
            </script>
            <!--  ---------------------------------------------------------------------- -->

            <!--  section des partenaires -->

            <div class="partners-section">
            <h2>Nos partenaires</h2>
            <button class="p-nav-btn prev">❮</button>
            <div class="partners-slider">         
                <div class="partners-list">
                    <?php foreach ($partenaires as $partenaire): ?>
                        <div class="partner-card">
                            <img src="data:<?= $partenaire['mime_type'] ?>;base64,<?= base64_encode($partenaire['logo']) ?>" 
                                 alt="<?= htmlspecialchars($partenaire['nom']) ?>" 
                                 class="partner-logo">
                            <p class="partner-name"><?= htmlspecialchars($partenaire['nom']) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <button class="p-nav-btn next">❯</button>
        </div>



            <!--  ---------------------------------------------------------------------- -->



        </body>
        </html>
        <?php
    }
}
?>