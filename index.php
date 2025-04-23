<?php
session_start();

$op = $_GET["prompt"];

$headers = [
    'Content-Type: application/json',
];

$data = [
    'contents' => [
        [
            'parts' => [
                ['text' => $op]
            ]
        ]
    ]
];

$ch = curl_init('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=GEMINI_API_KEY');
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);

$pj = json_decode($response, true);

// Save the response in session memory
$_SESSION['response'] = $pj['choices'][0]['text'];

echo $_SESSION['response']; // Output the stored response

?>
