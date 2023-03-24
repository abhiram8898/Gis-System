<?php require 'connection.php';?>
<?php require 'header.php'; ?>
<?php
// Start the session
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    // Get the email address from the form
    $email = $_POST['email'];

    // Check if the email address exists in the database
    $stmt = $connection->prepare("SELECT * FROM main WHERE EMAIL=:email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Generate a random password
        $new_password = bin2hex(random_bytes(8));

        // Hash the password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the user's password in the database
        $stmt = $connection->prepare("UPDATE MAIN SET password=:password WHERE EMAIL=:email");
        $stmt->execute(['password' => $hashed_password, 'email' => $email]);

        // Send the new password to the user's email address
        $to = $email;
        $subject = "Password Reset";
        $message = "Your new password is: " . $new_password;
        $headers = "From: webmaster@example.com" . "\r\n" .
                   "Reply-To: webmaster@example.com" . "\r\n" .
                   "X-Mailer: PHP/" . phpversion();

        mail($to, $subject, $message, $headers);

        // Redirect the user to the login page
        $_SESSION['message'] = "Your password has been reset. Please check your email.";
        header("location: index.php");
        exit();
    } else {
        // If the email address does not exist in the database, display an error message
        $_SESSION['error'] = "Email address not found.";
    }
}
?>

<!-- HTML code for the password reset form -->
<form method="post">
    <div>
        <label for="email">Email address:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <button type="submit">Reset Password</button>
    </div>
</form>
<?php require 'footer.php'; ?>