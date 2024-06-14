<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="signupModalLabel">Signup to iDiscuss</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="/prog/Forum/Partials/_handleSignup.php" method="post">
        <div class="modal-body">

          <div class="form-group">
            <label for="signupEmail">Username</label>
            <input type="text" class="form-control" id="signupEmail" name="signupEmail" aria-describedby="emailHelp">
          </div>
          
          <div class="form-group">
            <label for="signupPassword">Password</label>
            <input type="password" class="form-control" id="signupPassword" name="signupPassword">
          </div>
          
          <div class="form-group">
            <label for="signupcPassword">Confirm Password</label>
            <input type="password" class="form-control" id="signupcPassword" name="signupcPassword">
          </div>

          <button type="submit" class="btn btn-primary">Signup</button>
        </div>
        
      </form>

    </div>
  </div>
</div>