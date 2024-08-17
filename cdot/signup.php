<!-- SignUp Modal -->
<div class="modal fade" id="SignUpModal" tabindex="-1" aria-labelledby="SignUpModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="SignUpModalLabel">Get A LiteraryLatte Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="mx-2" style="padding-bottom: 10px; padding-top: 10px;">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#UserxModal" data-bs-dismiss="modal">User</button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AdminxModal" data-bs-dismiss="modal">Admin</button>
      </div>
    </div>
  </div>
</div>

<!-- Userx Modal -->
<div class="modal fade" id="UserxModal" tabindex="-1" aria-labelledby="UserxModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="UserxModalLabel">Get A LiteraryLatte Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="connections.php" method="POST">
          <input type="hidden" name="action" value="signup">
          <div class="mb-3">
            <label for="UserName" class="form-label">Name</label>
            <input type="text" class="form-control" id="UserName" name="Name" required>
          </div>
          <div class="mb-3">
            <label for="UserContact" class="form-label">Contact</label>
            <input type="tel" class="form-control" id="UserContact" name="Contact" required>
          </div>
          <div class="mb-3">
            <label for="UserEmail1" class="form-label">Email</label>
            <input type="email" class="form-control" id="UserEmail1" name="Email" aria-describedby="UserEmailHelp1" required>
            <div id="UserEmailHelp1" class="form-text">We'll never share your email with anyone else.</div>
          </div>
          <div class="mb-3">
            <label for="UserPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="UserPassword1" name="Password" required>
          </div>
          <div class="mb-3">
            <label for="UserConfirmPassword1" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="UserConfirmPassword1" name="ConfirmPassword" required>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Adminx Modal -->
<div class="modal fade" id="AdminxModal" tabindex="-1" aria-labelledby="AdminxModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="AdminxModalLabel">Get A LiteraryLatte Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="connections.php" method="POST">
          <input type="hidden" name="action" value="signup">
          <div class="mb-3">
            <label for="AdminName" class="form-label">Name</label>
            <input type="text" class="form-control" id="AdminName" name="Name" required>
          </div>
          <div class="mb-3">
            <label for="AdminContact" class="form-label">Contact</label>
            <input type="tel" class="form-control" id="AdminContact" name="Contact" required>
          </div>
          <div class="mb-3">
            <label for="AdminStaffNo" class="form-label">Staff Number</label>
            <input type="text" class="form-control" id="AdminStaffNo" name="StaffNo" required>
          </div>
          <div class="mb-3">
            <label for="AdminEmail1" class="form-label">Email</label>
            <input type="email" class="form-control" id="AdminEmail1" name="Email" aria-describedby="AdminEmailHelp1" required>
            <div id="AdminEmailHelp1" class="form-text">We'll never share your email with anyone else.</div>
          </div>
          <div class="mb-3">
            <label for="AdminPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="AdminPassword1" name="Password" required>
          </div>
          <div class="mb-3">
            <label for="AdminConfirmPassword1" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="AdminConfirmPassword1" name="ConfirmPassword" required>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
