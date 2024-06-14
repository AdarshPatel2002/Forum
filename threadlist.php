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
      $id = $_GET['catid'];
      $sql = "SELECT * FROM `categories` WHERE category_id=$id";
      $result = mysqli_query($connect, $sql);

      while ($row = mysqli_fetch_assoc($result))
      {
         $catname = $row['category_name'];
         $catdesc = $row['category_description'];
      }
   ?>

   <?php
      $showAlert = false;
      $method = $_SERVER['REQUEST_METHOD'];

      if ($method == 'POST')
      {
         $th_title = $_POST['title'];
         $th_desc = $_POST['desc'];

         $th_title = str_replace('<', '&lt;', $th_title);
         $th_title = str_replace('>', '&gt;', $th_title);

         $th_desc = str_replace('<', '&lt;', $th_desc);
         $th_desc = str_replace('>', '&gt;', $th_desc);
         
         $sr = $_POST['sr'];
         $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$sr', current_timestamp())";
         $result = mysqli_query($connect, $sql);
         $showAlert = true;

         if($showAlert)
         {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                     <strong>Success!</strong> Your thread has been successfully added. Please wait for community to respond.
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>';
         }
      }
   ?>

   <div class="container my-5">
      <div class="jumbotron">
         <h1 class="display-4">Welcome to <?php echo $catname; ?> Forum</h1>
         <p class="lead"><?php echo $catdesc; ?></p>
         <hr class="my-5">
         <p>This is a peer to peer forum. No spam / advertising / self-promot is allowed. Do not post
            copyright-infringing. Do not post 'offensive' post, links or images. Do not cross post questions. Remain
            respectful of all the members all the time.</p>
         <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
      </div>
   </div>

   <?php
      if ( isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true )
      {
         echo '<div class="container">
                  <h1 class="py-2">Start a Discussion</h1>

                  <form action="' . $_SERVER["REQUEST_URI"] . '" method="post">
                     <div class="form-group">
                        <label for="title">Problem Title</label>
                        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted">Keep your title as short & crisp as possible</small>
                     </div>
                     <div class="form-group">
                        <label for="desc">Ellaborate Your Concern</label>
                        <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                        <input type="hidden" name="sr" value="' . $_SESSION["sr"] . '">
                     </div>
                     <button type="submit" class="btn btn-primary">Submit</button>
                  </form>

               </div>';
      }

      else
      {
         echo '<div class="container">
                  <h1 class="py-2">Start a Discussion</h1>
                  <p class="lead">You are not logged in. Please login to start a Discussion.</p>
               </div>';
      }
   ?>

   <div class="container">

      <h1 class="py-2">Browse Questions</h1>

      <?php
         $id = $_GET['catid'];
         $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
         $result = mysqli_query($connect, $sql);
         $noResult = true;

         while ($row = mysqli_fetch_assoc($result))
         {
            $noResult = false;
            $id = $row['thread_id'];
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_time = $row['timestamp'];
            $thread_user_id = $row['thread_user_id'];
            $sql2 = "SELECT user_email FROM `users` WHERE sr='$thread_user_id'";
            $result2 = mysqli_query($connect, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
         
            echo '<div class="media my-5">
                     <img src="https://lippianfamilydentistry.net/wp-content/uploads/2015/11/user-default.png" width="60px" class="mr-3" alt="...">
                     <div class="media-body">
                        <div class="font-weight-bold my-0">' . $row2["user_email"] . '<span class="float-right">' . $thread_time . '</span></div>
                        <h5 class="mt-0"><a href="thread.php?threadid=' . $id . '" class="text-dark">' . $title . '</a></h5>
                        ' . $desc . '
                     </div>
                  </div>';
         }

         if($noResult)
         {
            echo '<div class="jumbotron jumbotron-fluid">
                     <div class="container">
                        <p class="display-4">No Threads Found</p>
                        <p class="lead">Be the first person to ask a question</p>
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