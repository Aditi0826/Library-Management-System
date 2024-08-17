<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Book</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(210, 210, 195);
            margin: 0; /* Remove default margin */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 800px; /* Adjust maximum width as needed */
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            border: 2px solid black;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
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
            background-color: #4cae4c;
        }

        .table-container {
            margin-top: 50px; /* Adjust the space between form and table */
        }

        .message {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="form-container">
        <h1>Return Books</h1>
        <form method="post" action="">
            <div class="form-group">
                <label for="contact">Enter Contact:</label>
                <input type="text" id="contact" name="contact" required>
            </div>
            
            <button type="submit" name="search">Search</button>
        </form>
    </div>

    <?php
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "Noida@2020";
    $dbname = "library";

    // Create a connection to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['search'])) {
        $contact = $_POST['contact'];

        // Fetch records from the issuebook table based on contact
        $selectQuery = $conn->prepare("SELECT * FROM issuebook WHERE issuecontact = ?");
        $selectQuery->bind_param("s", $contact); // Adjust type if necessary
        $selectQuery->execute();
        $result = $selectQuery->get_result();

        if ($result->num_rows > 0) {
            echo '<div class="table-container">';
            echo '<table class="table table-striped table-bordered">';
            echo '<thead class="thead-dark"><tr><th>Book ID</th><th>Contact</th><th>Name</th><th>Book Title</th><th>Issue Days</th><th>Return Date</th><th>Action</th></tr></thead>';
            echo '<tbody>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['bookID']) . '</td>';
                echo '<td>' . htmlspecialchars($row['issuecontact']) . '</td>';
                echo '<td>' . htmlspecialchars($row['name']) . '</td>';
                echo '<td>' . htmlspecialchars($row['issuebook']) . '</td>';
                echo '<td>' . htmlspecialchars($row['issuedays']) . '</td>';
                echo '<td>' . htmlspecialchars($row['issuereturn']) . '</td>';
                echo '<td>';
                echo '<form method="post" class="form-inline">';
                echo '<input type="hidden" name="bookID" value="' . htmlspecialchars($row['bookID']) . '">';
                echo '<input type="hidden" name="issuecontact" value="' . htmlspecialchars($row['issuecontact']) . '">';
                echo '<input type="submit" name="return" value="Return" class="btn btn-danger btn-sm">';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
            echo '</div>';
        } else {
            echo '<div class="alert alert-warning">No records found.</div>';
        }

        // Close the prepared statement
        $selectQuery->close();
    }

    if (isset($_POST['return'])) {
        $bookID = $_POST['bookID'];
        $issuecontact = $_POST['issuecontact'];

        // Move book details to issuereturn table
        $moveQuery = $conn->prepare("INSERT INTO issuereturn (bookID, returncontact, name, returnbook, issuedays, issuereturn) SELECT bookID, issuecontact, name, issuebook, issuedays, NOW() FROM issuebook WHERE bookID = ? AND issuecontact = ?");
        $moveQuery->bind_param("is", $bookID, $issuecontact);
        $moveQuery->execute();

        // Check if the move was successful
        if ($moveQuery->affected_rows > 0) {
            // Delete record from issuebook table
            $deleteQuery = $conn->prepare("DELETE FROM issuebook WHERE bookID = ? AND issuecontact = ?");
            $deleteQuery->bind_param("is", $bookID, $issuecontact);
            $deleteQuery->execute();

            if ($deleteQuery->affected_rows > 0) {
                // Update the status of the book to 'available'
                $updateStatusQuery = $conn->prepare("UPDATE books SET status = 'Available' WHERE bookID = ?");
                $updateStatusQuery->bind_param("i", $bookID);
                $updateStatusQuery->execute();
                $updateStatusQuery->close();

                $_SESSION['success'] = true; // Set session variable on success
                header("Location: returnbook.php"); // Redirect on success
                exit();
            } else {
                echo '<div class="alert alert-danger">Failed to delete the book from the issuebook table.</div>';
            }
        } else {
            echo '<div class="alert alert-danger">Failed to move the book to the issuereturn table.</div>';
        }

        // Close the prepared statements
        $moveQuery->close();
        $deleteQuery->close();
    }

    // Close the database connection
    $conn->close();
    ?>
</div>
</body>
</html>
