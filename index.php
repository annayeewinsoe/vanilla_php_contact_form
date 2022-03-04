<?php

$msg = '';

if (filter_has_var(INPUT_POST, 'submit')) {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Check required fields
    if (!empty($name) && !empty($email) && !empty($message)) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $msg = 'Invalid email address';
        } else {
            // pass
            $to_email = 'sunayaka2@gmail.com';
            $subject = "$name - Contact Request Form";
            $body = "<h2>Contact Request</h2>
                <h4>Name: $name</h4>
                <h4>Email: $email</h4>
                <p>Message: $message</p>
            ";
            $headers = "MIME-Version:1.0\r\n";
            $headers .= "Content-Type:text/html;charset=UTF-8\r\n";
            $headers .= "From:<$email>\r\n";
            // mail
            if (mail($to_email, $subject, $body, $headers)) {
                $msg = 'Your email has been sent';
            } else {
                $msg = 'There was an error sending your message and the message was not sent';
            }
        }
    } else {
        $msg = 'Please fill in all fields';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <div class="alert">
        <?php if ($msg) : ?>
            <p><?php echo $msg ?></p>
        <?php endif ?>
    </div>

    <div class="container">
        <h1>Contact Us!</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <input type="text" name="name" placeholder="Name" value="<?php echo isset($_POST['name']) ? $name : ''; ?>">
            <input type="text" name="email" placeholder="Email" value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
            <textarea name="message" placeholder="Message" value="<?php echo isset($_POST['message']) ? $message : ''; ?>"></textarea>
            <button type=" submit" name="submit">Submit</button>
        </form>
    </div>
</body>

</html>