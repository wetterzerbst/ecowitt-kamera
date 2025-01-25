<?php
// API-Parameter - Code sponsored by: https://wetterstation.lima.zone
$api_url = "https://api.ecowitt.net/api/v3/device/real_time";
$application_key = "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX"; // Ersetze durch deinen Application Key
$api_key = "XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX"; // Ersetze durch deinen API-Schlüssel
$mac_address = "XX:XX:XX:XX:XX:2XX"; // Ersetze durch die MAC-Adresse deiner Wetterstationskamera

// Anfrage-URL erstellen
$request_url = sprintf(
    "%s?application_key=%s&api_key=%s&mac=%s&call_back=all",
    $api_url,
    $application_key,
    $api_key,
    $mac_address
);

// Daten abrufen
$response = file_get_contents($request_url);

// Prüfen, ob die Anfrage erfolgreich war
if ($response === false) {
    die("Fehler: Daten konnten nicht von der API abgerufen werden.");
}

// JSON-Daten dekodieren
$data = json_decode($response, true);

// Prüfen, ob die API erfolgreich Daten geliefert hat
if (isset($data['error_code']) && $data['error_code'] !== 0) {
    die("API-Fehler: " . $data['error_message']);
}

// Wetterdaten anzeigen (JSON-Daten ausgeben oder formatieren)
echo "<pre>";
print_r($data);
echo "</pre>";
?>
