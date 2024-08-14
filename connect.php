<?php
// Start the session
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'test'); // Update with your database credentials

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Assume password is an integer
    $subject = $_POST['subject'];
    $gender = $_POST['gender'];
    $phno = $_POST['phno'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO registration (firstName, email, password, subject, gender, phno) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssissi", $firstName, $email, $password, $subject, $gender, $phno);

    // Execute the query
    if ($stmt->execute()) {
        // Registration successful, redirect to signuppage.html
        header("Location: signuppage.html?success=registered");
        exit(); // Ensure no further code is executed
    } else {
        // Handle any errors (optional)
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>