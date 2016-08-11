<!-- Modals -->
<!-- Login modal -->
<div id="login-modal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center">Login</h4>
      </div>
      <div class="modal-body">
        <form method="POST">
          <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          </div>
          <div class="form-group">
            <input type="submit" name="login" value="Login" class="btn btn-primary">
          </div>
        </form>
        <!-- Display php errors and status messages here -->
        <?php
          if (isset($message)) {
            echo '<label class="text-danger">'.$message.'</label>';
          }
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Create account modal -->
<div id="create-account-modal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center">Create an account</h4>
      </div>
      <div class="modal-body">
        <form method="POST">
          <div class="form-group">
            <label for="create_account_name">Display name</label>
            <input type="text" class="form-control" id="create_account_name" name="create_account_name" placeholder="Name" required>
          </div>
          <div class="form-group">
            <label for="create_account_email">Email address</label>
            <input type="email" class="form-control" id="create_account_email" name="create_account_email" placeholder="Email" required>
          </div>
          <div class="form-group">
            <label for="create_account_password">Password</label>
            <input type="password" class="form-control" id="create_account_password" name="create_account_password" placeholder="Password" required>
          </div>
          <div class="form-group">
            <label for="create_account_confirm_password">Confirm password</label>
            <input type="password" class="form-control" id="create_account_confirm_password" name="create_account_confirm_password" placeholder="Password again" required>
          </div>
          <div class="checkbox">
            <label>
              <input type="checkbox" required> I agree with the TOS.
            </label>
          </div>
          <input type="submit" value="Create" name="create_account_button" class="btn btn-primary">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
