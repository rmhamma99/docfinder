<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $medecin_id = $_POST['medecin_id'];
    $nom = $_POST['nom'];
    $note = $_POST['note'];
    $commentaire = $_POST['commentaire'];

    $sql = "INSERT INTO avis (medecin_id, utilisateur_nom, note, commentaire) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isis", $medecin_id, $nom, $note, $commentaire);

    if ($stmt->execute()) {
        echo "Avis envoyé !";
    } else {
        echo "Erreur : " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>