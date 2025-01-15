<?php 
class remises {
    private $avantages;

    public function __construct($avantages) {
        $this->avantages = $avantages;
    }

    public function render() {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Remises et Avantages</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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
                <h1 class="text-center mb-4">Remises et Avantages</h1>
                <div class="mb-3">
                    <label for="wilayaFilter">Filtrer par Wilaya:</label>
                    <input type="text" id="wilayaFilter">
                    <label for="categorieFilter">Filtrer par Categorie:</label>
                    <input type="text" id="categorieFilter">
                    <label for="typeFilter">Filtrer par Type:</label>
                    <input type="text" id="typeFilter">
                    <button onclick="applyFilters()" class="btn btn-primary">Filtrer</button>
                </div>
                <table class="table table-bordered table-striped" id="remisesTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Partenaire <button class="sort-button" onclick="sortTable(0)">⬆⬇</button></th>
                            <th>Wilaya <button class="sort-button" onclick="sortTable(1)">⬆⬇</button></th>
                            <th>Categorie <button class="sort-button" onclick="sortTable(2)">⬆⬇</button></th>
                            <th>Pourcentage <button class="sort-button" onclick="sortTable(3)">⬆⬇</button></th>
                            <th>Type</th>
                            <th>Date Expiration <button class="sort-button" onclick="sortTable(5)">⬆⬇</button></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($this->avantages as $avantage) {
                        ?>
                        <tr>
                            <td>
                                <?php
                                if (isset($avantage['mime_type']) && isset($avantage['logo'])) {
                                    echo '<img src="data:' . htmlspecialchars($avantage['mime_type']) . ';base64,' . base64_encode($avantage['logo']) . '" alt="logo" style="width: 50px; border-radius: 50%;">';
                                }
                                echo htmlspecialchars($avantage['nom'] ?? 'N/A');
                                ?>
                            </td>
                            <td><?php echo htmlspecialchars($avantage['ville']); ?></td>
                            <td><?php echo htmlspecialchars($avantage['categorie']); ?></td>
                            <td><?php echo htmlspecialchars($avantage['pourcentage']); ?>%</td>
                            <td><?php echo htmlspecialchars($avantage['type'] ?? 'N/A'); ?></td>
                            <td><?php echo htmlspecialchars($avantage['date_expiration'] ?? 'Indefini'); ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <script>
                function applyFilters() {
                    const wilayaFilter = document.getElementById('wilayaFilter').value.toLowerCase();
                    const categorieFilter = document.getElementById('categorieFilter').value.toLowerCase();
                    const typeFilter = document.getElementById('typeFilter').value.toLowerCase();
                    const rows = document.querySelectorAll('#remisesTable tbody tr');

                    rows.forEach(row => {
                        const wilaya = row.cells[1].textContent.toLowerCase();
                        const categorie = row.cells[2].textContent.toLowerCase();
                        const type = row.cells[4].textContent.toLowerCase();

                        row.style.display = 
                            (wilaya.includes(wilayaFilter) || wilayaFilter === '') &&
                            (categorie.includes(categorieFilter) || categorieFilter === '') &&
                            (type.includes(typeFilter) || typeFilter === '')
                            ? '' : 'none';
                    });
                }

                function sortTable(columnIndex) {
                    const table = document.getElementById("remisesTable");
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
