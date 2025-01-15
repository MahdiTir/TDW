<?php

class partenairesAdminView {

    public function render($partenaires) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Liste des établissements partenaires</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
            <style>
                th { cursor: pointer; }
                td { vertical-align: middle; }
                .sort-button {
                    border: none;
                    background: none;
                    color: var(--primary);
                    font-size: 1.2rem;
                    padding: 0;
                    margin-left: 5px;
                    cursor: pointer;
                }
                .sort-button:hover {
                    color: var(--secondary);
                }
            </style>
       </head>
<body>

    <div class="container mt-5">
        <div class="card p-4">
            <h1 class="text-center mb-4">Liste des établissements partenaires</h1>
            <div class="mb-3">
                <label for="villeFilter">Filtrer par ville:</label>
                <input type="text" id="villeFilter">
                <label for="categorieFilter">Filtrer par catégorie:</label>
                <input type="text" id="categorieFilter">
                <button onclick="applyFilters()" class="btn btn-primary">Filtrer</button>
            </div>
            <table class="table table-bordered table-striped" id="partenairesTable">
                <thead class="thead-dark">
                    <tr>
                        <th>Logo</th>
                        <th>Nom <button class="sort-button" onclick="sortTable(1)">⬆⬇</button></th>
                        <th>Adresse <button class="sort-button" onclick="sortTable(2)">⬆⬇</button></th>
                        <th>Ville <button class="sort-button" onclick="sortTable(3)">⬆⬇</button></th>
                        <th>Catégorie <button class="sort-button" onclick="sortTable(4)">⬆⬇</button></th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach ($partenaires as $partenaire) {
                    ?>
                    <tr>
                        <td>
                            <?php if (!empty($partenaire['logo']) && !empty($partenaire['mime_type'])): ?>
                                <img src="data:<?= htmlspecialchars($partenaire['mime_type']) ?>;base64,<?= base64_encode($partenaire['logo']) ?>" alt="Logo" style="width: 50px; height: 50px; object-fit: cover;">
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($partenaire['nom']); ?></td>
                        <td><?php echo htmlspecialchars($partenaire['adresse']); ?></td>
                        <td><?php echo htmlspecialchars($partenaire['ville']); ?></td>
                        <td><?php echo htmlspecialchars($partenaire['categorie']); ?></td>
                        <td> <a href="partenaire?id=<?php echo $partenaire['id']; ?>" class="btn btn-info btn-sm">Plus de détails</a></td>
                   </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function applyFilters() {
            const villeFilter = document.getElementById('villeFilter').value.toLowerCase();
            const categorieFilter = document.getElementById('categorieFilter').value.toLowerCase();
            const rows = document.querySelectorAll('#partenairesTable tbody tr');

            rows.forEach(row => {
                const ville = row.cells[4].textContent.toLowerCase();
                const categorie = row.cells[5].textContent.toLowerCase();

                row.style.display = 
                    (ville.includes(villeFilter) || villeFilter === '') &&
                    (categorie.includes(categorieFilter) || categorieFilter === '')
                    ? '' : 'none';
            });
        }

        function sortTable(columnIndex) {
            const table = document.getElementById("partenairesTable");
            const rows = Array.from(table.querySelectorAll("tbody tr"));
            const ascending = table.getAttribute("data-sort") === columnIndex.toString();

            rows.sort((a, b) => {
                const aText = a.cells[columnIndex].textContent.trim().toLowerCase();
                const bText = b.cells[columnIndex].textContent.trim().toLowerCase();
                return ascending ? bText.localeCompare(aText) : aText.localeCompare(bText);
            });

            rows.forEach(row => table.querySelector("tbody").appendChild(row));
            table.setAttribute("data-sort", ascending ? "" : columnIndex.toString());
        }
    </script>
</body>
</html>
        <?php
    }
}
?>