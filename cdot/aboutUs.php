<?php
include "fabicon.html";

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="LiteraryLatte - A haven for book lovers with a variety of services including public computers, café, reading clubs, and disability accommodations.">
  <meta name="keywords" content="books, reading, library, café, disability services, literary community">
  <meta name="author" content="LiteraryLatte Team">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>LiteraryLatte</title>
  <style>
    body {
      background-color: rgb(210, 210, 195);
    }

    h1 {
      text-align: center;
      margin-bottom: 35px;
      padding-top: 35px;
    }

    .services {
      margin: 5px;
      padding: 5px;
    }

    .service-card {
      height: 300px;
      border: 5px solid black;
    }

    .service-image {
      border-top: 5px solid black;
      border-bottom: 5px solid black;
      border-right: 5px solid black;
    }
  </style>
</head>

<body>
<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="assets/images/1.gif" width="30" height="24" class="d-inline-block align-text-top">
      LiteraryLatte
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
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#">Available to Issue</a></li>
            <li><a class="dropdown-item" href="#">Membership Plans</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

  <div class="container">
    <div class="row my-4 mx-4">
      <h1 style="margin-top: 10px;">FOUNDERS OF LiteraryLatte</h1>
      <div class="col-lg-4">
        <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="assets/images/10.jpeg" alt="Aditi Mishra">

        <h2>ADITI MISHRA</h2>
        <p>Welcome to my literary haven! As a devoted book lover, I find joy in the endless worlds hidden within the
          pages of a good book. Whether it's the enchanting realms of fantasy, the intricate plots of mystery, or the
          profound insights of non-fiction, each story is a new adventure waiting to be explored. Here, you'll discover
          my favorite reads and book reviews. So, grab a cup of tea, find a cozy spot, and join me on this journey
          through the boundless landscapes of literature.</p>
      </div>
      <div class="col-lg-4">
        <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="assets/images/11.jpeg" alt="Raashi Jain">

        <h2>RAASHI JAIN</h2>
        <p>Hello, fellow reader! Just like you, I am also a passionate reader who loves to immerse myself in the world
          of books. There is nothing quite like the joy of losing oneself in a captivating story, exploring new ideas,
          and experiencing the vast array of emotions that a well-written book can evoke. Whether it's fiction,
          non-fiction, or anything in between, the thrill of turning each page and discovering what lies ahead is
          something we all cherish deeply.</p>
      </div>
      <div class="col-lg-4">
        <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="assets/images/12.jpeg" alt="Yashika Garg">

        <h2>YASHIKA GARG</h2>
        <p>HELLO READERS!! From a young age, I found magic in the margins of books. I would scribble my thoughts and
          questions, engaging in a silent dialogue with the authors. This habit turned reading into a deeply personal
          and interactive journey. My passion for reading is about more than just consuming words it's about connecting
          with minds across time and space, continually expanding my horizons and finding new perspectives. "IYKYK"</p>
      </div>
    </div>
  </div>

  <div class="services">
    <h1>SERVICES PROVIDED BY YOUR OWN LiteraryLatte</h1>
    <div class="row mb-2">
      <div class="col-md-6">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
          <div class="col p-4 d-flex flex-column position-static service-card">
            <h3 class="mb-0">Public Computer and Wi-Fi Services</h3>
            <p class="card-text mb-auto">At LiteraryLatte, we provide robust public computer and Wi-Fi services. Our
              computers include Microsoft Office and secure browsers, ensuring productivity. Sessions are initially one
              hour, extendable if available. Access our free "LibraryWiFi" with your card or obtain temporary codes. Our
              staff offer assistance, workshops, and tutoring to maximize your digital experience.</p>
          </div>
          <div class="col-auto d-none d-lg-block">
            <img src="assets/images/13.jpeg" alt="Public computer and Wi-Fi services" class="bd-placeholder-img service-image" width="200" height="300">
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
          <div class="col p-4 d-flex flex-column position-static service-card">
            <h3 class="mb-0">Café Services</h3>
            <p class="mb-auto">Experience our café, offering freshly brewed coffee, teas, and specialty beverages, along
              with pastries and sandwiches. Located within the library, it provides cozy seating and complimentary
              Wi-Fi, ideal for relaxing or socializing. Open during library hours, our café serves as a community hub
              where patrons support library initiatives through their purchases. Enjoy a blend of culinary delights and
              literary exploration, enhancing your library visit with warmth and hospitality.</p>
          </div>
          <div class="col-auto d-none d-lg-block">
            <img src="assets/images/14.jpeg" alt="Café services" class="bd-placeholder-img service-image" width="200" height="300">
          </div>
        </div>
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-md-6">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
          <div class="col p-4 d-flex flex-column position-static service-card">
            <h3 class="mb-0">Reading Clubs</h3>
            <p class="card-text mb-auto">Engage in literary discussions and expand your reading horizons with our
              reading clubs at LiteraryLatte. We offer a variety of clubs catering to different interests and age
              groups, from classic literature to contemporary fiction and non-fiction. Joining a reading club provides
              an opportunity to connect with like-minded individuals. Whether you're a lifelong reader or just starting your literary journey, our reading clubs offer a welcoming space to explore, learn, and discuss books together.</p>
          </div>
          <div class="col-auto d-none d-lg-block">
            <img src="assets/images/15.jpeg" alt="Reading clubs" class="bd-placeholder-img service-image" width="200" height="300">
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
          <div class="col p-4 d-flex flex-column position-static service-card">
            <h3 class="mb-0">Disability Accommodation Services</h3>
            <p class="mb-auto">At LiteraryLatte, accessibility is a cornerstone of our commitment to serving all patrons
              inclusively. We provide comprehensive accommodations to ensure ease of access and enjoyment for
              individuals with disabilities. We offer a diverse range of materials including audiobooks, and braille
              materials, complemented by assistive technologies like screen readers and magnifiers on our public
              computers.</p>
          </div>
          <div class="col-auto d-none d-lg-block">
            <img src="assets/images/16.jpeg" alt="Disability accommodation services" class="bd-placeholder-img service-image" width="200" height="300">
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="container">
    <p class="float-end"><a href="#">Back to top</a></p>
    <p>© 2023-2024 LiteraryLatte, Inc.</a></p>
  </footer>

  <!-- Optional JavaScript; choose one of the two! -->
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  -->
</body>

</html>
