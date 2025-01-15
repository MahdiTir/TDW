<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carte de Membre</title>
    <style>
        /* Styles globaux */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

       

        .container {
            padding: 20px;
        }

        /* Styles spécifiques à la carte membre */
        .card-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        .card-member {
            background: linear-gradient(135deg, #007BFF, #6C63FF);
            border-radius: 15px;
            color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 350px;
            padding: 20px;
            text-align: center;
            position: relative;
        }

        .card-header {
            margin-bottom: 20px;
        }

        .card-header .logo-association {
            max-width: 80px;
            margin-bottom: 10px;
        }

        .card-header h2 {
            font-size: 20px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .member-photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 3px solid #fff;
            margin: 0 auto 15px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            object-fit: cover;
        }

        .card-body {
            background: #fff;
            color: #333;
            border-radius: 10px;
            padding: 15px;
            text-align: left;
        }

        .card-body p {
            font-size: 14px;
            margin: 5px 0;
        }

        .card-body p strong {
            font-weight: 600;
            color: #007BFF;
        }

        .qr-code {
            text-align: center;
            margin-top: 15px;
        }

        .qr-code img {
            width: 120px;
            height: 120px;
            border: 2px solid #007BFF;
            border-radius: 10px;
        }

        .download-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .download-btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    

    <!-- Contenu principal -->
    <div class="container">
        <div class="card-container">
            <div class="card-member" id="card-member">
                <div class="card-header">
                    <img src="data:image/png;base64,<?= base64_encode($logo['logo_image']) ?>" 
                         alt="<?= htmlspecialchars($logo['logo_alt']) ?>" 
                         class="logo-association">
                    <h2>Carte de Membre</h2>
                </div>
                <!-- Photo du membre -->
                <img src="data:image/jpg;base64,<?= base64_encode($membre['photo']) ?>" 
                     alt="Photo de <?= htmlspecialchars($membre['prenom']) ?>" 
                     class="member-photo">
                <div class="card-body">
                    <p><strong>Nom :</strong> <?= htmlspecialchars($membre['nom']) ?></p>
                    <p><strong>Prénom :</strong> <?= htmlspecialchars($membre['prenom']) ?></p>
                    <p><strong>ID Membre :</strong> <?= htmlspecialchars($membre['id']) ?></p>
                    <p><strong>Date d'expiration :</strong> <?= $date_expiration ?></p>
                    <div class="qr-code">
                        <img src="<?= $qrCodePath ?>" alt="Code QR">
                    </div>
                </div>
            </div>
            <!-- Bouton de téléchargement -->
            <button class="download-btn" onclick="downloadCard()">Télécharger la carte</button>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        function downloadCard() {
            const element = document.getElementById('card-member');
            html2canvas(element).then(canvas => {
                const link = document.createElement('a');
                link.download = 'carte_membre.png';
                link.href = canvas.toDataURL('image/png');
                link.click();
            });
        }
    </script>
</body>
</html>
