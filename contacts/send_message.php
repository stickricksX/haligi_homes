<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include '../db.php';  // Include database connection

    // Sanitize inputs
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Prepare SQL insert
    $sql = "INSERT INTO messages (name, email, subject, message) 
            VALUES (?, ?, ?, ?)";

    // Use prepared statement
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssss", $name, $email, $subject, $message);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Thank you, $name. Your message has been sent and stored.";
        } else {
            echo "Something went wrong. Please try again.";
        }

        $stmt->close();
    } else {
        echo "Database error: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
?>
