<?php
require 'conn.php';
require 'form.html';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $fullName = $_POST["fullName"];
    $Number = $_POST["Number"];
    $dob = $_POST["date"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $doctor = $_POST["doctor"];
    $comments = $_POST["comments"];

    if (isset($_FILES["fil"]) && $_FILES["fil"]["error"] == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["fil"]["tmp_name"];
        $fileName = $_FILES["fil"]["name"];

        // Ensure the "uploads" directory exists
        if (!is_dir('uploads/')) {
            mkdir('uploads/');
        }

        // Process the uploaded file
        $targetPath = "uploads/" . $fileName;
        move_uploaded_file($tmp_name, $targetPath);

        // Use prepared statements to prevent SQL injection
        $sql = "INSERT INTO users(`Full_Name`, `Contact_No`, `DOB`, `Age`, `Gender`, `Doc`, `Report`, `Comment`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $fullName, $Number, $dob, $age, $gender, $doctor, $targetPath, $comments);
        $result = $stmt->execute();
    
        if ($result) {
            echo "Form submitted successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        echo "Error uploading the file.";
        echo "File Upload Error: " . $_FILES["fil"]["error"] . "<br>";
        echo "Temp File: " . $_FILES["fil"]["tmp_name"] . "<br>";
    }

    $conn->close();
}
?>
