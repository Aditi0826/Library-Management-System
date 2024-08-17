<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Book</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(210, 210, 195);
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form-container {
            max-width: 600px;
            width: 100%;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            border: 2px solid black;
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

        input[type="text"] {
            width: calc(100% - 16px); /* Adjust width to account for padding and border */
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: calc(100% - 16px); /* Adjust width to match input */
            padding: 10px;
            background-color: #5cb85c;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            display: block;
            margin-top: 10px; /* Add margin to separate from input */
        }

        button:hover {
            background-color: #466D1D;
        }

        .message {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }
        .btn-space{
            color: prima;
        }
    </style>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Issue Records</title>
</head>
<body>
    <div class="form-container">
        <h1>Return Books</h1>
        <?php
        // session_start();
        if (isset($_SESSION['success']) && $_SESSION['success'] == true) {
            echo '<div id="success-alert" class="alert alert-success">Book Returned successfully!</div>';
            unset($_SESSION['success']); // Clear session variable after showing the alert
        }
        ?>
    <form method="post" action="return_book.php">
        <div class="form-group">
            <label for="contact">Enter Contact:</label>
            <input type="text" id="contact" name="contact" required>
        </div>
        
        
        <button type="submit" name="search">Search</button>
        <button type="button" class="btn btn-primary" onclick="window.location.href='admin_dashboard.php'">Back to Dashboard</button>

    
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


