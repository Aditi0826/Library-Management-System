<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "Noida@2020";
$dbname = "library";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['issuename'];
$contact = $_POST['issuecontact'];
$issueDate = $_POST['issuedate'];
$issueDays = $_POST['issuedays'];
$bookTitle = $_POST['issuebook'];

// Validate issue date
if (empty($issueDate)) {
    die("Issue date is required.");
}

// Format the issue date
$issueDateFormatted = $issueDate;
$returnDate = date('Y-m-d', strtotime($issueDate . " + $issueDays days"));

// Get book ID from books table
$bookQuery = "SELECT bookID FROM books WHERE title = ?";
$stmt = $conn->prepare($bookQuery);
$stmt->bind_param("s", $bookTitle);
$stmt->execute();
$stmt->bind_result($bookID);
$stmt->fetch();
$stmt->close();

if (!$bookID) {
    die("Book not found");
}

// Get user ID from user table
$userQuery = "SELECT userID FROM users WHERE contact = ?";
$stmt = $conn->prepare($userQuery);
$stmt->bind_param("i", $contact);
$stmt->execute();
$stmt->bind_result($userID);
$stmt->fetch();
$stmt->close();

if (!$userID) {
    die("User not found");
}

// Insert data into issuebooks table
$insertQuery = "INSERT INTO issuebook (bookID, userId, issuecontact, name, issuebook, issuedays, issuedate, issuereturn, fine) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0)";
$stmt = $conn->prepare($insertQuery);
$stmt->bind_param("iisssiss", $bookID, $userID, $contact, $name, $bookTitle, $issueDays, $issueDateFormatted, $returnDate);
if ($stmt->execute()) {
    // Update the status of the book to 'Not Available'
    $updateStatusQuery = "UPDATE books SET status = 'Not Available' WHERE bookID = ?";
    $stmt = $conn->prepare($updateStatusQuery);
    $stmt->bind_param("i", $bookID);
    $stmt->execute();
    $stmt->close();

    $_SESSION['success'] = true; // Set session variable on success
    header("Location: issuebook.php"); // Redirect on success
    exit();
} else {
    echo "Error: " . $stmt->error;
}
$stmt->close();

// Calculate fine if the book is overdue
$currentDate = date('Y-m-d');
if ($currentDate > $returnDate) {
    $daysOverdue = (strtotime($currentDate) - strtotime($returnDate)) / 86400; // Calculate days overdue
    $fine = $daysOverdue * 5; // Rs. 5 per day

    // Update the fine in the issuebooks table
    $updateFineQuery = "UPDATE issuebook SET fine = ? WHERE bookID = ? AND userId = ?";
    $stmt = $conn->prepare($updateFineQuery);
    $stmt->bind_param("iii", $fine, $bookID, $userID);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
?>
