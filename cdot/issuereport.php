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
        .pagination {
            font-size: 80%;
            margin-bottom: 20px;
        }
        .pagination .page-item {
            margin: 0 5px;
        }
        .pagination .prev-next {
            margin: 0 20px;
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
            color: #18bc9c;
        }
        .search-box {
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "Noida@2020";
    $dbname = "Library";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $limit = 10;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    $search_param = "%" . $search . "%";

    // Count total results
    $stmt = $conn->prepare("SELECT COUNT(*) as total FROM issuebook WHERE issuecontact LIKE ?");
    $stmt->bind_param("s", $search_param);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $total_results = $row['total'];
    $total_pages = ceil($total_results / $limit);

    // Fetch current page results
    $stmt = $conn->prepare("SELECT * FROM issuebook WHERE issuecontact LIKE ? LIMIT ? OFFSET ?");
    $stmt->bind_param("sii", $search_param, $limit, $offset);
    $stmt->execute();
    $result = $stmt->get_result();

    echo '<div class="container mt-5">';
    echo '<form action="" method="GET" class="mb-4 search-box">';
    echo '<div class="input-group">';
    echo '<input class="form-control" id="search" name="search" type="search" placeholder="Search by Contact" aria-label="Search" value="' . htmlspecialchars($search) . '">';
    echo '<div class="input-group-append">';
    echo '<button type="submit" class="btn btn-success" style="margin-left: 10px;">Search</button>';
    echo '</div>';
    echo '</div>';
    echo '</form>';

    if ($result->num_rows > 0) {
        echo '<table id="example" class="table table-striped table-bordered table-hover">';
        echo '<thead class="thead-dark">';
        echo '<tr>';
        echo '<th>bookID</th>';
        echo '<th>UserId</th>';
        echo '<th>Issuer Name</th>';
        echo '<th>Issuer Contact</th>';
        echo '<th>Book Name</th>';
        echo '<th>Issue Days</th>';
        echo '<th>Return Date</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['bookID'] . '</td>';
            echo '<td>' . $row['userId'] . '</td>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['issuecontact'] . '</td>';
            echo '<td>' . $row['issuebook'] . '</td>';
            echo '<td>' . $row['issuedays'] . '</td>';
            echo '<td>' . $row['issuereturn'] . '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';

        // Pagination controls
        echo '<nav aria-label="Page navigation example">';
        echo '<ul class="pagination justify-content-center">';

        // Previous button
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

        // Next button
        if ($page < $total_pages) {
            echo '<li class="page-item prev-next"><a class="page-link" href="?search=' . urlencode($search) . '&page=' . ($page + 1) . '">Next</a></li>';
        } else {
            echo '<li class="page-item prev-next disabled"><span class="page-link">Next</span></li>';
        }

        echo '</ul>';
        echo '</nav>';
    } else {
        echo '<h2>No records found for the following contact</h2>';
    }

    echo '</div>';

    $stmt->close();
    $conn->close();
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
