<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('DB_USER', "root");
define('DB_PASSWORD', "Noida@2020");
define('DB_SERVER', "localhost");
define('DB_NAME', 'Library');

$error = '';

try {
    $dbConn = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD);
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log("Exception in DB Connection: " . $e->getMessage());
    exit('Database connection failed.');
}


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



$error = '';

try {
    $dbConn = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD);
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log("Exception in DB Connection: " . $e->getMessage());
    exit('Database connection failed.');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Email = isset($_POST['Email']) ? trim($_POST['Email']) : null;
    $StaffNo = isset($_POST['StaffNo']) ? trim($_POST['StaffNo']) : null;
    $Password = trim($_POST['Password']);

    if (!$Email && !$StaffNo) {
        $error = 'Please enter either Email or Staff Number.';
        echo "<script>alert('$error'); window.location.href='library.php';</script>";
        exit();
    }

    // Choose the query based on whether Email or Staff Number is provided
    $query = "SELECT userId, StaffNo, Name, Contact, Email, Password, Type FROM users WHERE ";
    if ($Email) {
        $query .= "Email = :identifier";
        $identifier = $Email;
    } else {
        $query .= "StaffNo = :identifier";
        $identifier = $StaffNo;
    }

    $stmt = $dbConn->prepare($query);
    $stmt->bindValue(':identifier', $identifier, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($Password, $user['Password'])) {
        // Storing session variables
        $_SESSION['userId'] = $user['userId'];
        $_SESSION['StaffNo'] = $user['StaffNo'];
        $_SESSION['name'] = $user['Name'];
        $_SESSION['contact'] = $user['Contact'];
        $_SESSION['email'] = $user['Email'];
        $_SESSION['type'] = $user['Type'];

        // Redirect based on user type
        if ($user['Type'] === "User") {
            header('Location: user_dashboard.php');
        } elseif ($user['Type'] === "Admin") {
            header('Location: admin_dashboard.php');
        }
        exit();
    } else {
        $error = 'Invalid email/staff number or password.';
        echo "<script>alert('$error'); window.location.href='library.php';</script>";
        exit();
    }
}

// Handle Signup
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$error = '';

try {
    $dbConn = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD);
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log("Exception in DB Connection: " . $e->getMessage());
    exit('Database connection failed.');
}

// Handle Signup
if (isset($_POST['action']) && $_POST['action'] === 'signup') {
    $Name = trim($_POST['Name']);
    $Contact = trim($_POST['Contact']);
    $Email = trim($_POST['Email']);
    $Password = trim($_POST['Password']);
    $ConfirmPassword = trim($_POST['ConfirmPassword']);
    $StaffNo = isset($_POST['StaffNo']) ? trim($_POST['StaffNo']) : null;

    // Validate input data
    if ($Password !== $ConfirmPassword) {
        $error = 'Passwords do not match.';
        echo "<script>alert('$error'); window.location.href='library.php';</script>";
        exit();
    }

    // Check if the email or staff number already exists
    $query = "SELECT * FROM users WHERE Email = :Email OR StaffNo = :StaffNo";
    $stmt = $dbConn->prepare($query);
    $stmt->bindValue(':Email', $Email, PDO::PARAM_STR);
    $stmt->bindValue(':StaffNo', $StaffNo, PDO::PARAM_STR);
    $stmt->execute();
    $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingUser) {
        $error = 'An account with this email or staff number already exists.';
        echo "<script>alert('$error'); window.location.href='library.php';</script>";
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

    // Determine user type
    $Type = $StaffNo ? 'Admin' : 'User';

    // Insert the new user/admin into the database
    $query = "INSERT INTO users (Name, Contact, Email, Password, StaffNo, Type) 
              VALUES (:Name, :Contact, :Email, :Password, :StaffNo, :Type)";
    $stmt = $dbConn->prepare($query);
    $stmt->bindValue(':Name', $Name, PDO::PARAM_STR);
    $stmt->bindValue(':Contact', $Contact, PDO::PARAM_STR);
    $stmt->bindValue(':Email', $Email, PDO::PARAM_STR);
    $stmt->bindValue(':Password', $hashedPassword, PDO::PARAM_STR);
    $stmt->bindValue(':StaffNo', $StaffNo, PDO::PARAM_STR);
    $stmt->bindValue(':Type', $Type, PDO::PARAM_STR);
    $stmt->execute();

    // Retrieve the inserted user's ID
    $userId = $dbConn->lastInsertId();

    // Store session variables
    $_SESSION['userId'] = $userId;
    $_SESSION['StaffNo'] = $StaffNo;
    $_SESSION['name'] = $Name;
    $_SESSION['contact'] = $Contact;
    $_SESSION['email'] = $Email;
    $_SESSION['type'] = $Type;

    // Redirect based on user type
    if ($Type === "User") {
        header('Location: user_dashboard.php');
    } elseif ($Type === "Admin") {
        header('Location: admin_dashboard.php');
    }
    exit();
}

// Close the database connection
$dbConn = null;
?>
