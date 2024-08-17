<?php
session_start();
if (!isset($_SESSION['StaffNo'])) {
    header('Location: adminlogin.php'); // Redirect to login if not logged in
    exit();
}

$staffNo = $_SESSION['StaffNo'];
$name = $_SESSION['name'];
$contact = $_SESSION['contact'];
$email = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>LiteraryLatte Admin Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: rgb(210, 210, 195);
            padding-top: 60px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: #f8f9fa;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .main {
            flex: 1;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }
        .card {
            align-items: center;
            background-color: white;
            text-align: center;
            justify-content: center;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px 0;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        .card h3 {
            margin: 0 0 10px;
        }
        .card p {
            font-size: 1.5rem;
            font-weight: bold;
            margin: 0;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .col {
            flex: 1;
            min-width: 250px;
        }
        .user-info {
            display: flex;
            align-items: center;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .user-info img {
            border-radius: 50%;
            width: 80px;
            height: 80px;
            margin-right: 20px;
        }
        .user-info div {
            flex: 1;
        }
        .user-info h2 {
            margin: 0 0 10px;
        }
        .user-info p {
            margin: 5px 0;
        }
        footer {
            background-color: #f8f9fa;
            padding: 10px 0;
            text-align: center;
        }
        footer p {
            margin: 0;
        }
        footer a {
            color: #007bff;
            text-decoration: none;
        }
        footer a:hover {
            text-decoration: underline;
        }
        .greenbtn {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 5px;
            transition: transform 0.3s, box-shadow 0.3s;
            background-color: indigo;
            color: white;
            width: 260px;
            height: 130px;
        }
        .greenbtn:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        .buttons {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="assets/images/1.gif" width="30" height="24" class="d-inline-block align-text-top" alt="Logo">LiteraryLatte
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="library.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="aboutUs.php">About Us</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Services
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Issue</a></li>
                        <li><a class="dropdown-item" href="#">Return</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Available to Issue</a></li>
                        <li><a class="dropdown-item" href="#">Membership Plans</a></li>
                    </ul>
                </li>
            </ul>
            <div class="mx-2">
                <a href="logout.php" class="btn btn-primary">Log Out</a>
            </div>
        </div>
    </div>
</nav>

<div class="main">
    <div class="user-info">
        <img src="assets/images/17.png" alt="User Avatar">
        <div>
            <h2>Name: <?php echo htmlspecialchars($name); ?></h2>
            <h3>Staff No.: <?php echo htmlspecialchars($staffNo); ?></h3>
            <p>Email: <?php echo htmlspecialchars($email); ?></p>
            <p>Contact: <?php echo htmlspecialchars($contact); ?></p>
        </div>
    </div>

    <div class="buttons">
        <button class="greenbtn single-btn" onclick="window.location.href='totalbooks.php'"><h3>TOTAL BOOKS</h3></button>
        <button class="greenbtn single-btn" onclick=" window.location.href = 'issuebook.php'"><h3>ISSUE BOOK</h3></button>
        <button class="greenbtn single-btn" onclick=" window.location.href = 'returnbook.php'"><h3>RETURN BOOK</h3></button>
        <button class="greenbtn single-btn" onclick=" window.location.href = 'issuereport.php'"><h3>ISSUE REPORT</h3></button>
    </div>

    <div class="buttons">
        <button class="greenbtn single-btn" onclick=" window.location.href = 'studentreport.php'"><h3>STUDENT REPORT</h3></button>
        <button class="greenbtn" onclick=" window.location.href = 'addbook.php'"><h3>ADD NEW BOOK</h3></button>
    </div>
</div>

<footer>
    <p>© 2023-2024 LiteraryLatte, Inc.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
