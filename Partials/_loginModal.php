<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Login to iDiscuss</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="/prog/Forum/Partials/_handleLogin.php" method="post">

        <div class="modal-body">
          <div class="form-group">
            <label for="loginEmail">Username</label>
            <input type="text" class="form-control" id="loginEmail" name="loginEmail" aria-describedby="emailHelp">
          </div>
          
          <div class="form-group">
            <label for="loginPassword">Password</label>
            <input type="password" class="form-control" id="loginPassword" name="loginPassword">
          </div>

          <button type="submit" class="btn btn-primary">Login</button>
        </div>
        
      </form>
        
    </div>
  </div>
</div>