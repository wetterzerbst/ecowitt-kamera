<?php
// URL der API - Code sponsored by: https://wetterstation.lima.zone
$api_url = "https://deinewebseite/api.php"; // Bitte entsprechend korrigieren

// Daten von der API abrufen
$response = file_get_contents($api_url);

// Prüfen, ob die Anfrage erfolgreich war
if ($response === false) {
    http_response_code(500); // Serverfehler
    die("Fehler: Die API konnte nicht erreicht werden.");
}

// Regulärer Ausdruck, um die URL des Bildes aus der API-Antwort zu extrahieren
if (preg_match('/\[url\] => (https?:\/\/[^\s]+)/', $response, $matches)) {
    $webcam_url = $matches[1];

    // Webcam-Bild abrufen
    $image = file_get_contents($webcam_url);
    if ($image === false) {
        http_response_code(500); // Serverfehler
        die("Fehler: Das Webcam-Bild konnte nicht abgerufen werden.");
    }

    // Content-Type-Header setzen, damit der Browser das als Bild erkennt
    header("Content-Type: image/jpeg");

    // Bilddaten ausgeben
    echo $image;
} else {
    http_response_code(404); // Nicht gefunden
    die("Fehler: Keine gültige Webcam-URL gefunden.");
}
?>
