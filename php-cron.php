<?php
// Konfigurationsvariablen - Script sponsored by: https://wetterstation.lima.zone
$outputDir = "/var/www/html/webcam";  // Zielverzeichnis für das Bild
$imageName = "livecam.jpg";          // Name der lokalen Bilddatei
$apiScript = "/var/www/html/webcam/api.php"; // Pfad zum API-Skript
$stateFile = "$outputDir/last_image_url.txt"; // Datei, um die letzte Bild-URL zu speichern

// Vollständiger Pfad zur Bilddatei
$imagePath = "$outputDir/$imageName";

// API-Skript aufrufen und die Bild-URL extrahieren
echo "Rufe API-Skript auf, um Bild-URL zu erhalten...\n";
ob_start();
include($apiScript); // API-Skript ausführen und Ausgabe erfassen
$rawOutput = ob_get_clean();

// URL aus der verschachtelten API-Ausgabe extrahieren
if (preg_match('/\[url\] => (https?:\/\/[^\s]+)/', $rawOutput, $matches)) {
    $imageUrl = $matches[1];
    echo "Gefundene Bild-URL: $imageUrl\n";
} else {
    echo "Fehler: Keine gültige Bild-URL von der API erhalten.\n";
    exit(1);
}

// Prüfen, ob die URL der letzten gespeicherten URL entspricht
if (file_exists($stateFile)) {
    $lastImageUrl = file_get_contents($stateFile);
    if ($imageUrl === $lastImageUrl) {
        echo "Die Bild-URL hat sich nicht geändert. Kein Download erforderlich.\n";
        exit(0);
    }
}

// URL hat sich geändert oder Datei existiert nicht - Download starten
echo "Die Bild-URL hat sich geändert. Lade neues Bild herunter...\n";

// Alte Bilddatei löschen, falls vorhanden
if (file_exists($imagePath)) {
    echo "Lösche vorhandene Datei: $imagePath\n";
    unlink($imagePath);
}

// Bild von der URL herunterladen
$imageData = file_get_contents($imageUrl);
if ($imageData === false) {
    echo "Fehler: Das Bild konnte nicht heruntergeladen werden.\n";
    exit(1);
}

// Bild speichern
file_put_contents($imagePath, $imageData);
echo "Bild erfolgreich gespeichert unter: $imagePath\n";

// Speichern der neuen Bild-URL in der Zustandsdatei
file_put_contents($stateFile, $imageUrl);
echo "Neue Bild-URL wurde in der Zustandsdatei gespeichert.\n";
?>
