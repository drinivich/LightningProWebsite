<?php
if ($_POST) {
    // Get form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);
    
    // Validate inputs
    $errors = [];
    
    if (empty($name)) {
        $errors[] = "Name is required";
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required";
    }
    
    if (empty($message)) {
        $errors[] = "Message is required";
    }
    
    // If no errors, send email
    if (empty($errors)) {
        $to = "lightningproteam@gmail.com";
        $subject = "Contact Form - Lightning Pro";
        $body = "Name: $name\n";
        $body .= "Email: $email\n";
        $body .= "Message:\n$message";
        
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        
        if (mail($to, $subject, $body, $headers)) {
            $success = "Thank you! Your message has been sent.";
        } else {
            $error = "Sorry, there was an error sending your message. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Form Response</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 50px auto; padding: 20px; }
        .success { color: green; background: #d4edda; padding: 15px; border-radius: 5px; }
        .error { color: red; background: #f8d7da; padding: 15px; border-radius: 5px; }
        .back-link { margin-top: 20px; }
    </style>
</head>
<body>
    <?php if (isset($success)): ?>
        <div class="success"><?php echo $success; ?></div>
    <?php endif; ?>
    
    <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <?php if (!empty($errors)): ?>
        <div class="error">
            <ul>
                <?php foreach ($errors as $err): ?>
                    <li><?php echo $err; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    
    <div class="back-link">
        <a href="contact.html">← Back to Contact Page</a>
    </div>
</body>
</html>