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
      <form class="d-flex" action="search.php" method="get">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
      <div class="mx-2">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#LogInModal">LogIn</button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#SignUpModal">SignUp</button>
      </div>
    </div>
  </div>
</nav>
