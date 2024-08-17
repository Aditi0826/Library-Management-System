<?php
include "fabicon.html";
?>
<?php
session_start(); // Start the session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issue Book</title>
    <style>
        /* Reset default margins and paddings */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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
            position: relative; 
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            position: relative; 
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"], 
        input[type="number"],
        input[type="date"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .dropdown-container {
            position: relative; 
        }

        .dropdown-content {
            display: none;
            position: absolute;
            top: 100%; 
            right: 0; 
            width: calc(100% - 2px); 
            background-color: #f9f9f9;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            max-height: 200px;
            overflow-y: auto;
            opacity: 0.9; 
            border-radius: 4px;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .show {
            display: block;
        }

        .arrow {
            position: absolute;
            right: 10px;
            top: 70%; /* Align arrow with top 70% of the input field */
            transform: translateY(-50%); /* Center the arrow vertically */
            pointer-events: all; /* Ensure pointer events are enabled */
            font-size: 12px;
            color: #aaa;
            cursor: pointer; /* Set cursor to pointer */
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
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Issue Book</h1>
        <?php
        // session_start();
        if (isset($_SESSION['success']) && $_SESSION['success'] == true) {
            echo '<div id="success-alert" class="alert alert-success">Book Issued successfully!</div>';
            unset($_SESSION['success']); // Clear session variable after showing the alert
        }
        ?>
        
        <form id="issueBookForm" method="post" action="issue_book.php">
            <div class="form-group">
                <label for="issuename">Name:</label>
                <input type="text" id="issuename" name="issuename" required>
            </div>
            <div class="form-group">
                <label for="issuecontact">Contact:</label>
                <input type="text" id="issuecontact" name="issuecontact" required>
            </div>

            <div class="form-group">
                <label for="issuedate">Issue Date:</label>
                <input type="date" id="issuedate" name="issuedate" required>
            </div>

            <div class="form-group">
                <label for="issuedays">Issue Days:</label>
                <input type="number" id="issuedays" name="issuedays" required>
            </div>

            <div class="form-group dropdown-container">
                <label for="issuebook">Book:</label>
                <input type="text" id="issuebook" name="issuebook" oninput="filterBooks()" autocomplete="off" required>
                <span class="arrow" onclick="toggleDropdown()">▼</span>
                <div id="books-list" class="dropdown-content">
                    <!-- Dropdown items will be injected by JavaScript -->
                </div>
            </div>

            <div class="button-container">
                <button type="submit" name="action" value="add">Issue Book</button>
                <button type="button" onclick="window.location.href='admin_dashboard.php'">Back To Dashboard</button>
            </div>
        </form>
    </div>
   <script>
const booksList = [
    <?php
    // Enable error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

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

    // Query to fetch available books
    $booksQuery = "SELECT title FROM books WHERE status = 'Available'";
    $result = $conn->query($booksQuery);

    if ($result === FALSE) {
        echo "Error: " . $conn->error; // Output SQL error if query fails
    } else if ($result->num_rows > 0) {
        $books = [];
        while ($row = $result->fetch_assoc()) {
            $books[] = '"' . $conn->real_escape_string($row['title']) . '"';
        }
        echo implode(',', $books);
    } else {
        echo "[]";
    }

    $conn->close();
    ?>
];

function filterBooks() {
    const input = document.getElementById('issuebook');
    const filter = input.value.toLowerCase();
    const dropdown = document.getElementById('books-list');
    
    // Clear existing options
    dropdown.innerHTML = '';

    if (filter.length > 0) {
        let filteredBooks = booksList.filter(book => book.toLowerCase().includes(filter));
        filteredBooks = filteredBooks.slice(0, 10); // Show only the first 10 results

        filteredBooks.forEach(book => {
            const a = document.createElement('a');
            a.href = '#';
            a.textContent = book;
            a.onclick = () => selectBook(book);
            dropdown.appendChild(a);
        });
        dropdown.classList.add('show');
    } else {
        dropdown.classList.remove('show');
    }
}

function selectBook(title) {
    document.getElementById('issuebook').value = title;
    document.getElementById('books-list').classList.remove('show');
}

function toggleDropdown() {
    const dropdown = document.getElementById('books-list');
    const isVisible = dropdown.classList.contains('show');
    
    // Toggle dropdown visibility
    if (isVisible) {
        dropdown.classList.remove('show');
    } else {
        populateDropdown();
        dropdown.classList.add('show');
    }
}

function populateDropdown() {
    const dropdown = document.getElementById('books-list');
    dropdown.innerHTML = ''; // Clear existing options

    // Display all books
    booksList.forEach(book => {
        const a = document.createElement('a');
        a.href = '#';
        a.textContent = book;
        a.onclick = () => selectBook(book);
        dropdown.appendChild(a);
    });
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('#issuebook') && !event.target.matches('.arrow')) {
        const dropdowns = document.getElementsByClassName("dropdown-content");
        for (let i = 0; i < dropdowns.length; i++) {
            const openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}
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

