<?php
include 'db.php';

if (!isset($_GET['id'])) {
    die("ID du médecin non spécifié.");
}

$medecin_id = $_GET['id'];
$sql = "SELECT * FROM medecins WHERE id = $medecin_id";
$result = $conn->query($sql);
$medecin = $result->fetch_assoc();

if (!$medecin) {
    die("Médecin non trouvé.");
}

$sql_avis = "SELECT * FROM avis WHERE medecin_id = $medecin_id";
$result_avis = $conn->query($sql_avis);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $medecin['nom']; ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1><?php echo $medecin['nom']; ?></h1>
    <p>Spécialité : <?php echo $medecin['specialite']; ?></p>
    <p>Ville : <?php echo $medecin['ville']; ?></p>

    <h2>Avis des patients</h2>
    <?php
    if ($result_avis->num_rows > 0) {
        while($avis = $result_avis->fetch_assoc()) {
            echo "<div class='avis'>
                    <p><strong>{$avis['utilisateur_nom']}</strong> - Note : {$avis['note']}/5</p>
                    <p>{$avis['commentaire']}</p>
                  </div>";
        }
    } else {
        echo "Aucun avis pour ce médecin.";
    }
    ?>

    <h2>Laisser un avis</h2>
    <form action="avis.php" method="POST">
        <input type="hidden" name="medecin_id" value="<?php echo $medecin_id; ?>">
        <label for="nom">Votre nom :</label>
        <input type="text" name="nom" required>
        <label for="note">Note (1-5) :</label>
        <input type="number" name="note" min="1" max="5" required>
        <label for="commentaire">Commentaire :</label>
        <textarea name="commentaire" required></textarea>
        <button type="submit">Envoyer</button>
    </form>

    <h2>Prendre un rendez-vous</h2>
    <form action="prendre_rdv.php" method="POST">
        <input type="hidden" name="medecin_id" value="<?php echo $medecin_id; ?>">
        <label for="nom">Votre nom :</label>
        <input type="text" name="nom" required>
        <label for="date">Date :</label>
        <input type="datetime-local" name="date" required>
        <button type="submit">Confirmer</button>
    </form>
</body>
</html>