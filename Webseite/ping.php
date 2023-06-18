<?php
    // IP-Adresse des Computers
    $ip = "192.168.0.3";
    
    // Anzahl der Ping-Versuche
    $ping_count = 4;
    
    // Shell-Kommando für den Ping-Befehl
    $ping_command = "ping -c $ping_count $ip";
    
    // Ping-Befehl ausführen
    $ping_output = shell_exec($ping_command);
    
    // Überprüfen, ob der Computer erreichbar ist
    $reachable = strpos($ping_output, "0% packet loss") !== false;
    
    // Zusätzliche Überprüfung, ob der Computer tatsächlich erreichbar ist
    if ($reachable) {
        $socket = @fsockopen($ip, 80, $errno, $errstr, 5);
        if ($socket) {
            // Computer ist erreichbar
            echo '<p style="color:green;">Der Computer wurde erfolgreich angeschaltet.</p>';
            fclose($socket);
        } else {
            // Computer ist nicht erreichbar
            echo '<p style="color:red;">Der Computer wurde nicht angeschaltet.</p>';
        }
    } else {
        // Computer ist nicht erreichbar
        echo '<p style="color:red;">Der Computer wurde nicht angeschaltet.</p>';
    }
?>
