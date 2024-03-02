<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connection
    require 'conn.php';

    // Sanitize input data
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $password = $_POST["password"], PASSWORD_DEFAULT;

    // Check if the email is already registered
    $checkEmailQuery = "SELECT * FROM users WHERE email = ?";
    $checkStmt = $con->prepare($checkEmailQuery);
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        echo "Email is already registered. Please use a different email.";
    } else {
        // Insert user data into the database
        $insertQuery = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";
        $insertStmt = $con->prepare($insertQuery);
        $insertStmt->bind_param("sss", $full_name, $email, $password);

        if ($insertStmt->execute()) {
            echo "Registration successful! You can now login.";
        } else {
            echo "Error: " . $insertStmt->error;
        }

        $insertStmt->close();
    }

    $checkStmt->close();
    $con->close();
}
?>
