<!-- Combined Login Modal -->
<div class="modal fade" id="LogInModal" tabindex="-1" aria-labelledby="LogInModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="LogInModalLabel">LogIn to LiteraryLatte</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="connections.php" method="POST">
          <div class="mb-3">
            <label for="UserEmail" class="form-label">Email (For Users)</label>
            <input type="email" class="form-control" id="UserEmail" name="Email" aria-describedby="UserEmailHelp">
            <div id="UserEmailHelp" class="form-text">We'll never share your email with anyone else.</div>
          </div>
          <div class="mb-3">
            <label for="StaffNo" class="form-label">Staff Number (For Admins)</label>
            <input type="text" class="form-control" id="StaffNo" name="StaffNo">
          </div>
          <div class="mb-3">
            <label for="UserPassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="UserPassword" name="Password" required>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
