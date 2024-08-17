<?php
include "fabicon.html";

?>

<?php

session_start();

// Display errors for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection details
define('DB_USER', 'root');
define('DB_PASSWORD', 'Noida@2020');
define('DB_SERVER', 'localhost');
define('DB_NAME', 'library');

// Database connection
try {
    $dbConn = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD);
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbConn->setAttribute(PDO::ATTR_TIMEOUT, 60);
} catch (PDOException $e) {
    error_log("Exception in DB Connection: " . $e->getMessage());
    exit('Database connection failed.');
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $title = trim($_POST['title']);
    $authors = trim($_POST['author']); 
    $average_rating = trim($_POST['rating']);
    $language_code = trim($_POST['language']);
    $publisher = trim($_POST['publisher']);

    // Check for missing fields
    if (empty($title) || empty($authors) || empty($average_rating) || empty($language_code) || empty($publisher)) {
        $_SESSION['success'] = false;
        header("Location: addbook_page.php");
        exit();
    }

    // Prepare SQL query
    $sql = "INSERT INTO books (title, authors, average_rating, language_code, publisher) VALUES (:title, :authors, :average_rating, :language_code, :publisher)";
    $stmtbooks = $dbConn->prepare($sql);

    // Bind parameters
    $stmtbooks->bindValue(':title', $title, PDO::PARAM_STR);
    $stmtbooks->bindValue(':authors', $authors, PDO::PARAM_STR); 
    $stmtbooks->bindValue(':average_rating', $average_rating, PDO::PARAM_STR);
    $stmtbooks->bindValue(':language_code', $language_code, PDO::PARAM_STR);
    $stmtbooks->bindValue(':publisher', $publisher, PDO::PARAM_STR);

    // Execute the query and provide feedback
    try {
        $stmtbooks->execute();
        $_SESSION['success'] = true; // Set session variable on success
        header("Location: addbook.php"); // Redirect on success
        exit();
    } catch (PDOException $e) {
        echo "Error adding book: " . $e->getMessage();
    }
}
?>
