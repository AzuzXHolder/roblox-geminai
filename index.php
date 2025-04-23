<?php
// Replace with your real API key
$apiKey = 'GEMINI_API_KEY';

$prompt = isset($_GET['prompt']) ? $_GET['prompt'] : 'Hello, what can you do?';

$data = [
    "contents" => [[
        "parts" => [[ "text" => $prompt ]]
    ]]
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=AIzaSyAFRqJdn1TEIvKT3Dj4StbDCgAiJUpC28I" . $apiKey);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

$response = curl_exec($ch);
curl_close($ch);

// Output only the first response text
$json = json_decode($response, true);
$text = $json['candidates'][0]['content']['parts'][0]['text'] ?? 'No response.';

echo $text;
?>
