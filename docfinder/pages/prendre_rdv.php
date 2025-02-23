<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $medecin_id = $_POST['medecin_id'];
    $nom = $_POST['nom'];
    $date = $_POST['date'];

    $sql = "INSERT INTO rendez_vous (medecin_id, utilisateur_nom, date_rdv) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $medecin_id, $nom, $date);

    if ($stmt->execute()) {
        echo "Rendez-vous confirmé !";
    } else {
        echo "Erreur : " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>