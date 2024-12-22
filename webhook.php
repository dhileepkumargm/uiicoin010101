<?php

$apiKey = '7934607069:AAHJ5QvElJVVup3bySRk6BD2Gx0mz74KcuI'; // Your Telegram bot API key
$apiUrl = "https://api.telegram.org/bot$apiKey/";

// Get the incoming message
$content = file_get_contents("php://input");
$update = json_decode($content, true);

// Extract necessary information from the update
$chat_id = $update['message']['chat']['id'];
$text = $update['message']['text'];
$message_id = $update['message']['message_id'];

// Check if the received message is the "/start" command
if ($text === '/start') {

    // Send a photo with caption
    $photoPath = 'home.png'; // Local path to the image

    // Debugging: Check if file exists and print path
    if (file_exists($photoPath)) {
        $realPath = realpath($photoPath);
    } else {
        error_log("File does not exist: " . $photoPath);
        $realPath = '';
    }

    $caption = "
    👋 **Welcome to the UII Coin Adventure!** 🐾🎮

    Get ready for a tail-wagging journey where every paw-tap leads to bigger rewards! Here’s what’s waiting for you:

    ✨ **Play UII**: Tap the dog bone and watch your balance fetch amazing rewards!
    🐕 **Mine for UII Coin**: Collect UII Tokens with every action your maining friend takes.
    📋 **Complete UII Tasks**: Help your pup finish fun missions and earn even more treats!
    🏆 **Climb the Leaderboard**: Compete with other pups and rise to the top to show you’re the best in the pack!
    👥 **Invite Your Pack & Earn More!**  
    Got friends, family, or fellow dog lovers? Invite them to join the fun and grow your earnings as the pack gets bigger! The more paws, the better!


    🐾 **Get Started Now** and take your dog on the ultimate UIIcoin adventure!

    👉 [Join Our UII Coin Community](https://t.me/UIICommunity)
    ";

    // Send photo to Telegram
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl . "sendPhoto");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);

    $post_fields = [
        'chat_id' => $chat_id,
        'photo' => ($realPath ? new CURLFILE($realPath) : ''), // Use realpath to ensure correct path
        'caption' => $caption,
        'parse_mode' => 'Markdown', // Use Markdown for basic formatting
        'reply_to_message_id' => $message_id,
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [
                    ['text' => 'Play UIIcoin Now', 'web_app' => ['url' => 'hhttps://uiicoin0001.vercel.app/']],
                    ['text' => 'Join Our Community', 'url' => 'https://t.me/UIIcoinbot']]
            ]
        ])
    ];

    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    $result = curl_exec($ch);

    if ($result === false) {
        error_log("CURL Error: " . curl_error($ch));
    } else {
        // Optionally, log the result for debugging
        error_log("Result: " . $result);
    }

    curl_close($ch);
}

?>
