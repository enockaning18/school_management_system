<?php
header("Content-Type: application/json");
$paystackCallbackResponse = file_get_contents('php://input');
$logFile = "Paystackresponse.json";
$log - fopen($logFile, 'a');
fwrite($log, $paystackCallbackResponse);
fclose($log);
?>