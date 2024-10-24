<?php
// Start session
session_start();

// Check if businessId is set in the URL
$businessId = isset($_GET['businessId']) ? intval($_GET['businessId']) : null;
$conversationId = isset($_GET['conversationId']) ? intval($_GET['conversationId']) : null;

// Include the conversation logic (if any)
include('getconversations.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Art Web</title>
    <!-- Include relevant styles -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/global.css" rel="stylesheet">
    <link href="css/artwork.css" rel="stylesheet">
    <linK href="css/addreview.css" rel="stylesheet">
    <linK href="css/message.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz@9..144&display=swap" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php include('includes/header.php'); ?>

    <section id="about_pg" class="p_4">
        <div class="wrapper">
            <div class="container">
                <div class="left">
                    <ul class="people">
                        <?php
                        foreach ($conversations as $conversation) {
                            echo '<li class="person" data-chat="person">
                            <a href="messages.php?conversationId=' . $conversation['id'] . '">
                                <span class="icon-large icon-design"><i class="fa fa-user" style="margin:8px;"></i></span>
                                <span class="name">' . strtoupper($conversation['userName']) . '</span>
                            </a></li>';
                        }
                        ?>
                    </ul>
                </div>

                <?php if ($businessId || $conversationId): ?>
                    <div class="right">
                        <div class="chat-container">
                            <div class="chat-box"></div>
                            <form method="POST" action="storemessage.php">
                                <div class="message-input">
                                    <input type="hidden" name="businessId" value="<?php echo htmlspecialchars($businessId); ?>">
                                    <input type="hidden" name="conversationId" value="<?php echo htmlspecialchars($conversationId); ?>">
                                    <textarea id="message" name="message" placeholder="Type your message..." required></textarea>
                                    <button type="submit" id="sendMessageBtn" style="background-color: #533483;">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="right"> </div>
                <?php endif; ?>

            </div>
        </div>
    </section>

    <?php include('includes/footer.php'); ?>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Echo PHP variables to JavaScript properly using json_encode
        const businessId = <?php echo json_encode($businessId); ?>;
        const conversationId = <?php echo json_encode($conversationId); ?>;

        let fetchUrl = '';

        // Determine which URL to use for fetching messages based on the set values
        if (businessId) {
            fetchUrl = `getmessages.php?businessId=${businessId}`;
        } else if (conversationId) {
            fetchUrl = `getmessages.php?conversationId=${conversationId}`;
        }

        // Only fetch if one of the IDs is present
        if (fetchUrl) {
            fetch(fetchUrl)
                .then(response => response.json())
                .then(data => {
                    const chatBox = document.querySelector('.chat-box');
                    chatBox.innerHTML = ''; // Clear the chat box

                    data.messages.forEach(message => {
                        const messageDiv = document.createElement('div');

                        if (message.sender === 'user') {
                            messageDiv.classList.add('message', 'user');
                            messageDiv.style.backgroundColor = '#e1baf4'; // Styling for user message
                        } else {
                            messageDiv.classList.add('message', 'artist'); // Styling for artist message
                        }

                        messageDiv.innerHTML = `<p>${message.text}</p>`;
                        chatBox.appendChild(messageDiv); // Append each message to chat box
                    });
                })
                .catch(error => {
                    console.error('Error fetching messages:', error);
                });
        } else {
            console.error("Neither businessId nor conversationId is set.");
        }
    });
</script>


</html>