<?php

$myfile = fopen("location.txt", "a"); // "a" for append mode

if ($myfile) {
    $lat = filter_var($_GET["lat"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $long = filter_var($_GET["long"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $useragent = filter_var($_GET["useragent"], FILTER_SANITIZE_STRING); // Sanitize user agent

    if ($lat !== false && $long !== false && $useragent !== false) {
        $txt = "--------------------\n"; // Separator between user entries
        $txt .= "Timestamp: " . date("Y-m-d H:i:s") . "\n"; // Add timestamp
        $txt .= "lat:" . $lat . "\n";
        $txt .= "long:" . $long . "\n";
        $txt .= "IP Address: " . $_SERVER["REMOTE_ADDR"] . "\n";
        $txt .= "User Agent: " . $useragent . "\n";

        if (fwrite($myfile, $txt) === FALSE) {
            error_log("Error writing to file.");
        }
    } else {
        error_log("Invalid latitude, longitude, or user agent input.");
    }

    fclose($myfile);
} else {
    error_log("Unable to open file for writing.");
}

?>