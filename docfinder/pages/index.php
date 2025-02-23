<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médecins de Tunisie</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Rechercher un médecin</h1>
    <form action="recherche.php" method="GET">
        <input type="text" name="query" placeholder="Nom, spécialité ou ville">
        <button type="submit">Rechercher</button>
    </form>

    <h2>Médecins populaires</h2>
    <div id="medecins-list">
        <?php
        $sql = "SELECT * FROM medecins LIMIT 5";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='medecin'>
                        <h3>{$row['nom']}</h3>
                        <p>{$row['specialite']} - {$row['ville']}</p>
                        <a href='profil.php?id={$row['id']}'>Voir le profil</a>
                      </div>";
            }
        } else {
            echo "Aucun médecin trouvé.";
        }
        ?>
    </div>
</body>
</html>