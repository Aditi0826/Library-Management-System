<?php
include "fabicon.html";

?>
<?php
session_start();
if (!isset($_SESSION['contact'])) {
    header('Location: userlogin.php'); // Redirect to login if not logged in
    exit();
}

$contact = $_SESSION['contact'];

// Database connection parameters
define('DB_USER', "root");
define('DB_PASSWORD', "Noida@2020");
define('DB_SERVER', "localhost");
define('DB_NAME', 'Library');

$error = '';

// Database connection
try {
    $dbConn = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD);
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log("Exception in DB Connection: " . $e->getMessage());
    exit('Database connection failed.');
}

// Fetch returned books for the logged-in user based on contact
$query = "SELECT * FROM issuereturn WHERE returncontact = :contact";
$stmt = $dbConn->prepare($query);
$stmt->bindValue(':contact', $contact, PDO::PARAM_STR);
$stmt->execute();
$returnedBooks = $stmt->fetchAll(PDO::FETCH_ASSOC);

$dbConn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Returned Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(210, 210, 195);
            margin: 0; /* Remove default margin */
            padding-top: 60px;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border: 1px solid #dee2e6;
        }
        th {
            background-color: #f8f9fa;
        }
        .table-container {
            margin-top: 20px;
        }
        .no-data {
            text-align: center;
            font-size: 1.25rem;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="mb-4">Returned Books</h1>
    
    <?php if (count($returnedBooks) > 0): ?>
        <div class="table-container">
            <table class="table table-striped table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Book ID</th>
                        <th>Contact</th>
                        <th>Name</th>
                        <th>Book Title</th>
                        <th>Issue Days</th>
                        <th>Return Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($returnedBooks as $book): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($book['bookID']); ?></td>
                            <td><?php echo htmlspecialchars($book['returncontact']); ?></td>
                            <td><?php echo htmlspecialchars($book['name']); ?></td>
                            <td><?php echo htmlspecialchars($book['returnbook']); ?></td>
                            <td><?php echo htmlspecialchars($book['issuedays']); ?></td>
                            <td><?php echo htmlspecialchars($book['issuereturn']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="no-data">No returned books found.</p>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
