<?php
require 'conn.php'
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fullName = $_POST["fullName"];
    $Number = $_POST["Number"];
    $dob = $_POST["date"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $doctor = $_POST["doctor"];
    $comments = $_POST["comments"];

    // You may want to handle file upload separately, this is just a basic example
    $uploadedFile = $_FILES["fil"];
    $fileName = $uploadedFile["name"];
    $fileTmpName = $uploadedFile["tmp_name"];
    $fileType = $uploadedFile["type"];
    $fileError = $uploadedFile["error"];
    $fileSize = $uploadedFile["size"];

    // Check if the file name length is within the allowed limit (12 characters)
    if (strlen($fileName) > 12) {
        echo "Error: File name should not be greater than 12 characters.";
        exit();
    }

    // Process the uploaded file, you may want to move it to a specific directory
    // and store the file path in the database
    if ($fileError === UPLOAD_ERR_OK) {
        move_uploaded_file($fileTmpName, "uploads/" . $fileName);
    }

    // You can perform further validation and processing here

    // For example, you might want to save data to a database
    // Replace the following with your database connection and query logic
    

    // Replace the table_name with your actual table name
    $sql = "INSERT INTO info(fullName, Contact_Number, dob, age, gender, doctor, comments, fileName)
            VALUES ('$fullName', '$Number', '$dob', $age, '$gender', '$doctor', '$comments', '$fileName')";

    if ($conn->query($sql) === TRUE) {
        echo "Form submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
