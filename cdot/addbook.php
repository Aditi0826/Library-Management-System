<?php
include "fabicon.html";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: rgb(210, 210, 195); /* Background color */
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Full viewport height */
        }

        .form-container {
            max-width: 600px;
            width: 100%; /* Responsive width */
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            border: 2px solid black; /* Black border */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"], 
        input[type="number"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="number"] {
            -moz-appearance: textfield; /* Remove the number input spinners */
        }

        input[type="number"]::-webkit-inner-spin-button, 
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #5cb85c;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #4cae4c;
        }

        .alert {
            display: none;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            color: white;
            text-align: center;
            opacity: 0.85; /* Slightly transparent */
        }

        .alert-success {
            background-color: #5cb85c;
        }
        .button-container {
            margin-top: 20px; /* Space above the button container */
        }

        .button-container button {
            display: block;
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            margin-bottom: 10px; /* Space between buttons */
        }

        .button-container button:first-child {
            background-color: #5cb85c; /* Green for Add Book */
            color: white;
        }

        .button-container button:first-child:hover {
            background-color: #4cae4c;
        }

        .button-container button:last-child {
            background-color: #0275d8; /* Blue for Back To Dashboard */
            color: white;
        }

        .button-container button:last-child:hover {
            background-color: #025aa5;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Add a New Book</h1>
        <?php
        session_start();
        if (isset($_SESSION['success']) && $_SESSION['success'] == true) {
            echo '<div id="success-alert" class="alert alert-success">New book added successfully!</div>';
            unset($_SESSION['success']); // Clear session variable after showing the alert
        }
        ?>
        <form action="addbookserver_page.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required/>
            </div>
            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" id="author" name="author" required/>
            </div>
            <div class="form-group">
                <label for="rating">Average Rating:</label>
                <input type="number" id="rating" name="rating" step="0.1" min="0" max="5" required/>
            </div>
            <div class="form-group">
                <label for="language">Language:</label>
                <input type="text" id="language" name="language" required/>
            </div>
            <div class="form-group">
                <label for="publisher">Publisher:</label>
                <input type="text" id="publisher" name="publisher" required/>
            </div>
            <div class="button-container">
                <button type="submit" name="action" value="add">Add Book</button>
                <button type="button" onclick="window.location.href='admin_dashboard.php'">Back To Dashboard</button>
            </div>
        </form>
    </div>

    <script>
        window.onload = function() {
            const successAlert = document.getElementById('success-alert');
            if (successAlert) {
                successAlert.style.display = 'block';
                setTimeout(function() {
                    successAlert.style.display = 'none';
                }, 3000); // Hide after 3 seconds
            }
        }
    </script>
</body>
</html>
