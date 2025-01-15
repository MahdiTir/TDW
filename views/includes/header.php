<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/header.css?v=<?php echo time(); ?>" >
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
    
        :root {
            --primary: <?= htmlspecialchars($couleurs['primary']) ?> !important;
            --secondary: <?= htmlspecialchars($couleurs['secondary']) ?> !important;
            --accent: <?= htmlspecialchars($couleurs['accent']) ?> !important;
            --neutral: <?= htmlspecialchars($couleurs['neutral']) ?> !important;
            --text-dark: <?= htmlspecialchars($couleurs['text-dark']) ?> !important;
        }
        
    </style>
</head>
<body>
    <?php 
        $headerController = new HeaderController(); 
        $logoData = $headerController->getLogo();
        $socialLinks = $headerController->getReseauxSociaux();
    ?>

    <header class="top-header">
        <div class="container">
            <div class="row align-items-center">
                <!-- Logo -->
                <div class="col-lg-3 col-md-3 col-sm-4">
                    <div class="logo-container">
                        <?php if (!empty($logoData['logo_image']) && !empty($logoData['logo_mime_type'])): ?>
                            <?php if ($logoData['logo_mime_type'] === 'txt'): ?>
                              <?php  $logoData['logo_image'] ?>
                            <?php else: ?>
                                <img 
                                    src="data:<?= htmlspecialchars($logoData['logo_mime_type']) ?>;base64,<?= htmlspecialchars($logoData['logo_image']) ?>" 
                                    alt="El_Mountada" 
                                    class="img-fluid">
                            <?php endif; ?>
                        <?php else: ?>
                            <p class="error-message"><?= htmlspecialchars($logoData['error'] ?? 'Erreur lors du chargement du logo.') ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Menu de navigation -->
                <div class="col-lg-6 col-md-6 col-sm-8">
                    <nav class="main-nav">
                        <ul>
                            <li><a href="<?= BASE_URL ?>">Accueil</a></li>
                            <li><a href="<?= BASE_URL ?>catalogue">Catalogue</a></li>
                            <li><a href="<?= BASE_URL ?>remises">Remises</a></li>
                            <li><a href="<?= BASE_URL ?>dons">Dons</a></li>
                            <li><a href="<?= BASE_URL ?>partenaire">Partenaire</a></li>
                            
                        </ul>
                    </nav>
                </div>
                
                <!-- Réseaux sociaux et bouton utilisateur -->
                <div class="col-lg-3 col-md-3 col-sm-12 d-flex justify-content-end align-items-center gap-3">
                    <!-- Réseaux sociaux -->
                    <div class="social-links">
                        <?php if (isset($socialLinks) && is_array($socialLinks)): ?>
                            <?php foreach ($socialLinks as $social): ?>
                                <?php if ($social['active']): ?>
                                    <a href="<?= htmlspecialchars($social['url']) ?>" 
                                       target="_blank" 
                                       title="<?= htmlspecialchars($social['name']) ?>">
                                        <i class="<?= htmlspecialchars($social['icon_class']) ?>"></i>
                                    </a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <!-- Bouton utilisateur -->
                    <div class="user-menu d-flex align-items-center gap-2">
                        <?php if (isset($_SESSION['logged']) && $_SESSION['logged'] === true): ?>
                            <div class="dropdown d-flex align-items-center">
                                <a href="<?= BASE_URL ?>profil" class="profile-link me-2">
                                    <?php 
                                    $user = User::getUserById($_SESSION['user_id']);
                                    if (!empty($user['photo'])): ?>
                                        <img src="data:image/jpeg;base64,<?= base64_encode($user['photo']) ?>" 
                                            alt="Photo de profil" 
                                            class="profile-photo"
                                            style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                                    <?php else: ?>
                                        <i class="fas fa-user-circle" style="font-size: 40px;"></i>
                                    <?php endif; ?>
                                </a>
                
           
                                <button class="btn dropdown-toggle" id="userMenuButton" style="background-color: var(--primary); color: white;">
                                </button>
                                <ul class="dropdown-menu" id="dropdownMenu">
                                    <?php if ($_SESSION['type_user'] === 'simple'): ?>
                                        <li><a class="dropdown-item" href="<?= BASE_URL ?>devenirMembre">Devenir un membre</a></li>
                                    <?php elseif (isset($_SESSION['status']) && ( $_SESSION['status'] === 'valide' || $_SESSION['status'] === 'enAttente')): ?>
                                        <li><a class="dropdown-item" href="<?= BASE_URL ?>carteMembre">ma Carte Membre</a></li>
                                    <?php elseif (isset($_SESSION['status']) && $_SESSION['status'] === 'expire'): ?>
                                        <li><a class="dropdown-item" href="<?= BASE_URL ?>renouvlerCarte">Renouvler votre Carte</a></li>
                                    <?php endif; ?>
                                    <li><a class="dropdown-item" href="<?= BASE_URL ?>favoris">Favoris</a></li>
                                    <li><a class="dropdown-item" href="<?= BASE_URL ?>profil">mon Profil</a></li>
                                    <li><a class="dropdown-item" href="<?= BASE_URL ?>historique">historique</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="<?= BASE_URL ?>logout">Déconnexion</a></li>
                                </ul>
                            </div>
                        <?php else: // Si l'utilisateur est déconnecté ?>
                            <a href="<?= BASE_URL ?>login" class="btn btn-primary">Connexion</a>
                            <a href="<?= BASE_URL ?>register" class="btn btn-outline-primary">Inscription</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <script>
        // JavaScript pour afficher/masquer le dropdown 
        document.addEventListener('DOMContentLoaded', () => {
            const userMenuButton = document.getElementById('userMenuButton');
            const dropdownMenu = document.getElementById('dropdownMenu');

            userMenuButton.addEventListener('click', () => {
                dropdownMenu.classList.toggle('show');
            });

            // Fermer le menu si on clique à l'extérieur
            document.addEventListener('click', (e) => {
                if (!userMenuButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.remove('show');
                }
            });
        });
    </script>

</body>
</html>