<!-- view/sideBar.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar - Administration</title>
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
             display: grid;
             grid-template-columns: 250px 1fr;
        }

        .sidebar {
    
    height: 100%;
    background-color: #343a40;
    color: #fff;
    transition: transform 0.3s ease;
    display: flex;
    flex-direction: column;
}

.logo-container {
    width: 100%;
    padding: 15px;
    text-align: center;
    background-color: rgba(255, 255, 255, 0.1);
}

.logo-container img {
    max-width: 120px;
    height: auto;
    display: block;
    margin: 0 auto;
    border-radius: 5px;
}

.sidebar-nav {
    flex: 1;
    padding: 20px 0;
    overflow-y: auto;
}

.sidebar-nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar-nav li {
    margin: 5px 0;
}

.sidebar-nav a {
    display: block;
    padding: 12px 20px;
    color: #fff;
    text-decoration: none;
    transition: background-color 0.2s ease;
}

.sidebar-nav a:hover {
    background-color: rgba(255, 255, 255, 0.1);
}

.toggle-btn {
    display: none;
    position: fixed;
    top: 10px;
    left: 10px;
    z-index: 1000;
    padding: 10px;
    background-color: #343a40;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

@media (max-width: 768px) {
    .sidebar {
        transform: translateX(-100%);
    }
    
    .sidebar.collapsed {
        transform: translateX(0);
    }
    
    .toggle-btn {
        display: block;
    }
    
    .logo-container img {
        max-width: 100px;
    }
}
    </style>
</head>
<body>
    <?php 
        $headerController = new HeaderController(); 
        $logoData = $headerController->getLogo();
    ?>
    <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
    <div class="sidebar" id="sidebar">
        <!-- Logo -->
        <div class="logo-container">
            <?php if (!empty($logoData['logo_image']) && !empty($logoData['logo_mime_type'])): ?>
                <?php if ($logoData['logo_mime_type'] === 'txt'): ?>
                    <?= $logoData['logo_image'] ?>
                <?php else: ?>
                    <img 
                        src="data:<?= htmlspecialchars($logoData['logo_mime_type']) ?>;base64,<?= htmlspecialchars($logoData['logo_image']) ?>" 
                        alt="El_Mountada">
                <?php endif; ?>
            <?php else: ?>
                <p class="error-message"><?= htmlspecialchars($logoData['error'] ?? 'Erreur lors du chargement du logo.') ?></p>
            <?php endif; ?>
        </div>
        
    
        <nav class="sidebar-nav">
            <ul>
                <li><a href="partenaires.php">Gestion des Partenaires</a></li>
                <li><a href="membres.php">Gestion des Membres</a></li>
                <li><a href="dons-benevolat.php">Gestion des Dons et Bénévolat</a></li>
                <li><a href="notifications.php">Notifications et Annonces</a></li>
                <li><a href="paiements.php">Paiements et Abonnements</a></li>
                <li><a href="parametres.php">Paramètres</a></li>
            </ul>
        </nav>
        <div class="sidebar-footer">
            <a href="logout.php">Déconnexion</a>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('collapsed');
        }
    </script>
</body>
</html>