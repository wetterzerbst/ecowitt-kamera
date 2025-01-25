Diese Codes helfen Dir die API von Ecowitt abzurufen, um das letzte hochgeladene Bild einer Kamera in eine Webseite einbinden zu können.

api.php - Abruf der API von Ecowitt zur Erzeugung der BILD-URL

bild.php - Erzeugung des Bildes aus der api.php

webcam.php - Einbindung des Bildes aus der bild.php

Demo: https://wetterstation.x10.mx/station/e/wettercam.php

Möchte man den ECOWITT-Server entlasten und direkte Aufrufe auf eingebundene Webseiten an Ecowitt vermeiden, kann man das Script: php-cron.php verwenden, um die Datei direkt auf den eigenen Webspace zu laden. Dabei prüft das Script auch, ob sich das Bild verändert hat. Falls nicht, wird die Datei auf dem Webspace auch nicht aktualisiert.

Dieser Code wird Dir zur Verfügung gestellt von: https://wetterstation.lima.zone
