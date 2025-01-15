<?php
class partenaireView {
    public function render($partenaire, $avantages) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Partenaire</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
            <style>
                .card-partenaire {
                    background: linear-gradient(135deg, #007BFF, #6C63FF);
                    border-radius: 15px;
                    color: #fff;
                    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
                    width: 350px;
                    padding: 20px;
                    text-align: center;
                    margin: 20px auto;
                }
                .card-partenaire img {
                    width: 100px;
                    height: 100px;
                    border-radius: 50%;
                    border: 3px solid #fff;
                    margin-bottom: 15px;
                    object-fit: cover;
                }
                .card-partenaire h2 {
                    font-size: 24px;
                    font-weight: bold;
                }
                .advantages-section {
                    margin: 20px auto;
                    padding: 20px;
                    max-width: 90%;
                    border: 1px solid #ddd;
                    border-radius: 8px;
                    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
                    background-color: #f9f9f9;
                }
                .advantages-section h2 {
                    text-align: center;
                    font-size: 24px;
                    margin-bottom: 20px;
                }
                .advantages-section table {
                    width: 100%;
                    border-collapse: collapse;
                    margin: 20px 0;
                }
                .advantages-section th, .advantages-section td {
                    border: 1px solid #ccc;
                    padding: 10px;
                    text-align: left;
                }
                .advantages-section th {
                    background-color: #f4f4f4;
                }
            </style>
        </head>
        <body>
                <div id="alert" >
                <?php include('./views/includes/alerts.php');?>
                </div>
            <div class="container">
                <!-- Carte Partenaire -->
                <div class="card-partenaire">
                    <img src="data:<?= $partenaire['mime_type'] ?>;base64,<?= base64_encode($partenaire['logo']) ?>" alt="Logo Partenaire">
                    <h2><?= htmlspecialchars($partenaire['nom']) ?></h2>
                    <p><?= htmlspecialchars($partenaire['description']) ?></p>
                </div>

                <!-- Section des Avantages -->
                <div class="advantages-section">
                    <h2>Avantages</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Pourcentage</th>
                                <th>Type</th>
                                <th>Date d'expiration</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($avantages as $avantage): ?>
                                <tr>
                                    <td><?= htmlspecialchars($avantage['pourcentage']) ?>%</td>
                                    <td><?= htmlspecialchars($avantage['type']) ?></td>
                                    <td><?= htmlspecialchars($avantage['date_expiration']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Vérification des Membres -->
                <div class="verification-section">
                    <h2 class="text-center">Vérification des Membres</h2>
                    <form method="post" action="" class="d-flex justify-content-center">
                        <div class="input-group mb-3" style="max-width: 400px;">
                            <input type="text" class="form-control" name="member_id" placeholder="ID Membre" required>
                            <button class="btn btn-primary" type="submit">Vérifier</button>
                        </div>
                    </form>
                </div>

            
            </div>
        </body>
        </html>
        <?php
    }
}
?>