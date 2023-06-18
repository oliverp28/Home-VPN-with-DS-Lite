# Home-VPN-with-DS-Lite

In diesem Projekt beschreibe ich den Aufbau und Ablauf einer VPN Verbindung in das Heimnetzwerk über einen s.g. DS-Lite anschluss.

    -------- Mein Ziel -------------------------
    --> einen leistungsstarken PC über ein Wake-On-Lan Signal zu starten
    --> Remote Verbindung zu dem PC
    ==> Zugang zu hoher Rechenleistung von überall auf der Welt aus

  
    -------- Mein Setup ------------------------
    --> Vodafone Standard-Router mit DS-Lite Vertrag
    --> Raspberry Pi
    --> PC
    --> Laptop
    # Alles über LAN-Kabel angeschlossen
    --> Wireguard VPN
        -> effizienter als andere Alternativen
        -> einfache und unkomplizierte Handhabung
        -> wird vom MacBook über das iPhone bis hin zum iPad nativ im Appstore angeboten
        -> hohe Sicherheit gegenüber Wireshark etc. (hoher Verschlüsselungsgrad)


    ------- DS-Lite Problematik ----------------
    --> Aufgrund der wachsenden Anzahl an Geräten sinkt die Anzahl der öffentlich verfügbaren IPv4-Adressen (max 2^32)
    --> IPv6 löst diese Problematik mit insgesamt 2^128 Adressen
    --> Internet-Anbieter vergeben daher an die Kunden nur noch IPv6 Adressen
    --> Damit wir unseren Router über das Internet ansprechen können muss das IPv6 Protokoll auch über die VPN-Dienste funktionieren
        -> Wireguard unterstützt bisher IPv6 nicht nativ
    --> IPv6 ist mit IPv4 nicht direkt kompatibel

    -- Lösung: ---------

    --> im Internet gibt es weiterhin Server mit IPv4 womit die Kommunikation funktioniert
        -> Es findet eine Übersetzung der Protokolle auf einem Server des Internet-Providers statt
    --> als Übersetzung verwenden wir einen eigenen Server mit einer öffentlichen IPv4 Adresse der mit dem Heimnetzwerk kommuniziert
    --> Somit verbinde ich mich vom meinem Laptop aus mit dem Server und bin so über diesen in meinem Heimnetzwerk
        -> Verschlüsselt und abhörsicher
        -> hohe Geschwindigkeit und geringe Latenz
        -> Standortunabhängig



    ------------------ Einrichtung --------------------


