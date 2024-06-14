<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
      integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
   <title>iDiscuss - Coding Forums</title>
</head>

<body>
   <?php include 'Partials/_dbconnect.php'; ?>
   <?php include 'Partials/_header.php'; ?>

   <?php
      $id = $_GET['threadid'];
      $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
      $result = mysqli_query($connect, $sql);

      while ($row = mysqli_fetch_assoc($result))
      {
         $title = $row['thread_title'];
         $desc = $row['thread_desc'];

         $thread_user_id = $row['thread_user_id'];
         $sql2 = "SELECT user_email FROM `users` WHERE sr='$thread_user_id'";
         $result2 = mysqli_query($connect, $sql2);
         $row2 = mysqli_fetch_assoc($result2);
         $posted_by = $row2['user_email'];
      }
   ?>

   <?php
      $showAlert = false;
      $method = $_SERVER['REQUEST_METHOD'];

      if ($method == 'POST')
      {
         $comment = $_POST['comment'];
         $comment = str_replace('<', '&lt;', $comment);
         $comment = str_replace('>', '&gt;', $comment);

         $sr = $_POST['sr'];
         $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$sr', current_timestamp())";
         $result = mysqli_query($connect, $sql);
         $showAlert = true;

         if($showAlert)
         {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                     <strong>Success!</strong> Your comment has been successfully added.
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>';
         }
      }
   ?>

   <div class="container my-5">
      <div class="jumbotron pb-5">
         <h1 class="display-4"> <?php echo $title; ?> </h1>
         <p class="lead"><?php echo $desc; ?></p>
         <hr>
         <p>This is a peer to peer forum. No spam / advertising / self-promot is allowed. Do not post copyright-infringing. Do not post 'offensive' post, links or images. Do not cross post questions. Remain respectful of all the members all the time.</p>
         <p class="pt-1"><b>Posted by: <?php echo $posted_by; ?></b></p>
      </div>
   </div>

   <?php
      if ( isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true )
      {
         echo '<div class="container">
                  <h1 class="py-2">Post a Comment</h1>

                  <form action="' . $_SERVER["REQUEST_URI"] . '" method="post">
                     <div class="form-group">
                        <label for="comment">Type your comment</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                        <input type="hidden" name="sr" value="' . $_SESSION["sr"] . '">
                     </div>
                     <button type="submit" class="btn btn-primary">Post Comment</button>
                  </form>
               </div>';
      }

      else
      {
         echo '<div class="container">
                  <h1 class="py-2">Post a Comment</h1>
                  <p class="lead">You are not logged in. Please login to post a comment.</p>
               </div>';
      }
   ?>

   <div class="container">

      <h1 class="py-2">Discussions</h1>

      <?php
         $id = $_GET['threadid'];
         $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
         $result = mysqli_query($connect, $sql);
         $noResult = true;

         while ($row = mysqli_fetch_assoc($result))
         {
            $noResult = false;
            $id = $row['comment_id'];
            $content = $row['comment_content'];
            $comment_time = $row['comment_time'];
            $thread_user_id = $row['comment_by'];
            $sql2 = "SELECT user_email FROM `users` WHERE sr='$thread_user_id'";
            $result2 = mysqli_query($connect, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
         
            echo '<div class="media my-5">
                     <img src="https://lippianfamilydentistry.net/wp-content/uploads/2015/11/user-default.png" width="60px" class="mr-3" alt="...">
                     <div class="media-body">
                        <div class="font-weight-bold my-0">' . $row2["user_email"] . '<span class="float-right">' . $comment_time . '</span></div>
                        ' . $content . '
                     </div>
                  </div>';
         }

         if($noResult)
         {
            echo '<div class="jumbotron jumbotron-fluid">
                     <div class="container">
                        <p class="display-4">No Comments Found</p>
                        <p class="lead">Please wait for someone to respond or Be the first person to comment</p>
                     </div>
                  </div>';
         }
      ?>

   </div>

   <?php include 'Partials/_footer.php'; ?>

   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
   </script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
   </script>

</body>

</html>