<?php
include "fabicon.html";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LiteraryLatte</title>
     <!-- Add Bootstrap CSS links -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom styles for pagination */
        .pagination {
            font-size: 80%; /* Adjust the font size as needed */
            margin-bottom: 20px;
        }
        .pagination .page-item {
            margin: 0 5px; /* Add margin between pagination items */
        }
        .pagination .prev-next {
            margin: 0 20px; /* Add larger margin for Previous/Next buttons */
        }
        body {
            background-color: rgb(210, 210, 195);
        }
        .search-heading {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.5em;
            color: #2c3e50;
            font-weight: bold;
        }
        .search-heading span {
            color: #18bc9c; /* Accent color */
        }
        .search-box {
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <?php
    // Include your navigation or header here (e.g., include("nav-search.php");)

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "Noida@2020";
    $dbname = "Library";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Default search term (if none provided)
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    // Pagination setup
    $limit = 10; // Number of results per page
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    // Query the database for total number of results
    $stmt = $conn->prepare("SELECT COUNT(*) as total FROM books WHERE title LIKE ? OR authors LIKE ? OR language_code LIKE ?");
    $search_param = "%" . $search . "%";
    $stmt->bind_param("sss", $search_param, $search_param, $search_param);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $total_results = $row['total'];
    $total_pages = ceil($total_results / $limit);

    // Query the database for the current page of results
    $stmt = $conn->prepare("SELECT * FROM books WHERE title LIKE ? OR authors LIKE ? OR language_code LIKE ? LIMIT ?, ?");
    $stmt->bind_param("sssii", $search_param, $search_param, $search_param, $offset, $limit);
    $stmt->execute();
    $result = $stmt->get_result();

    echo '<div class="container mt-5">';
    // echo '<h1 class="search-heading">Welcome to <span>LiteraryLatte</span></h1>';
    echo '<form action="" method="GET" class="mb-4 search-box">';
    echo '<div class="input-group">';
    echo '<input class="form-control" id="search" name="search" type="search" placeholder="Search by Title, Author, or Language" aria-label="Search" value="' . htmlspecialchars($search) . '">';
    echo '<div class="input-group-append">';
    echo '<button type="submit" class="btn btn-success" style="margin-left: 10px;">Search</button>';
    echo '</div>';
    echo '</div>';
    echo '</form>';

    if ($result->num_rows > 0) {
        echo '<table id="example" class="table table-striped table-bordered table-hover">';
        echo '<thead class="thead-dark">';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Book Title</th>';
        echo '<th>Authors</th>';
        echo '<th>Ratings</th>';
        echo '<th>Language</th>';
        echo '<th>Publisher</th>';
        echo '<th>Status</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['bookID'] . '</td>';
            echo '<td>' . $row['title'] . '</td>';
            echo '<td>' . $row['authors'] . '</td>';
            echo '<td>' . $row['average_rating'] . '</td>';
            echo '<td>' . $row['language_code'] . '</td>';
            echo '<td>' . $row['publisher'] . '</td>';
            echo '<td>' . $row['status'] . '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';

        // Pagination controls
        echo '<nav aria-label="Page navigation example">';
        echo '<ul class="pagination justify-content-center">';
        
        // Previous button with margin
        if ($page > 1) {
            echo '<li class="page-item prev-next"><a class="page-link" href="?search=' . urlencode($search) . '&page=' . ($page - 1) . '">Previous</a></li>';
        } else {
            echo '<li class="page-item prev-next disabled"><span class="page-link">Previous</span></li>';
        }
        
        // Page numbers
        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $page) {
                echo '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
            } else {
                echo '<li class="page-item"><a class="page-link" href="?search=' . urlencode($search) . '&page=' . $i . '">' . $i . '</a></li>';
            }
        }

        // Next button with margin
        if ($page < $total_pages) {
            echo '<li class="page-item prev-next"><a class="page-link" href="?search=' . urlencode($search) . '&page=' . ($page + 1) . '">Next</a></li>';
        } else {
            echo '<li class="page-item prev-next disabled"><span class="page-link">Next</span></li>';
        }

        echo '</ul>';
        echo '</nav>';

    } else {
        echo '<h2>Oops!! Looks like we do not have this book</h2>';
    }

    echo '</div>';

    $stmt->close();
    $conn->close();
    ?>

    <!-- Add your other HTML content here -->
    <!-- Add Bootstrap JS scripts if needed -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('search').addEventListener('input', function() {
            const searchValue = this.value;
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('search', searchValue);
            urlParams.set('page', 1); // Reset to first page on new search
            window.history.replaceState(null, null, "?" + urlParams.toString());
            fetchResults(searchValue);
        });

        function fetchResults(search) {
            const urlParams = new URLSearchParams(window.location.search);
            const page = urlParams.get('page') || 1;
            fetch('?search=' + encodeURIComponent(search) + '&page=' + page)
                .then(response => response.text())
                .then(data => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(data, 'text/html');
                    const newTable = doc.querySelector('table');
                    const newPagination = doc.querySelector('.pagination');

                    document.querySelector('table').innerHTML = newTable.innerHTML;
                    document.querySelector('.pagination').innerHTML = newPagination.innerHTML;
                });
        }
    </script>
</body>
</html> 
