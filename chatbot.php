<?php
// Function to send a POST request to the ChatGPT API
function chatGPT($message) {
    $url = 'https://api.openai.com/v1/chat/completions';
    $headers = array(
        'Content-Type: application/json',
        'Authorization: Bearer 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' // Replace with your OpenAI API key
    );

    $data = [
        "model" => "gpt-3.5-turbo",
        "messages" => [
            ["role" => "system", "content" => "You are a helpful assistant."],
            ["role" => "user", "content" => $message]
        ],
        "max_tokens" => 100,
        "temperature" => 0.9
    ];

    
    $payload = json_encode($data);

    // Send a POST request to the ChatGPT API
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    curl_close($ch);

    // Parse the API response and extract the generated answer
    $response = json_decode($result, true);
    $answer = $response['choices'][0]['message']['content'];

    return $answer;
}

// Handle incoming messages and generate responses
if (isset($_POST['message'])) {
    $message = $_POST['message'];
    $response = chatGPT($message);
    echo json_encode($response);
}
?>