<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
      integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
   <title>iDiscuss - Coding Forums</title>
   <style>
      #mainContainer
      { min-height: 92vh; }
   </style>
</head>

<body>
   <?php include 'Partials/_dbconnect.php'; ?>
   <?php include 'Partials/_header.php'; ?>

   <div id="mainContainer" class="container my-3">
      <h1>Search result for "<?php echo $_GET['search'] ?>"</h1>

      <?php
         $query = $_GET['search'];
         $sql = "SELECT * FROM `threads` WHERE MATCH (thread_title, thread_desc) AGAINST ('$query')";
         $result = mysqli_query($connect, $sql);
         $noResult = true;

         while ($row = mysqli_fetch_assoc($result))
         {
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_id = $row['thread_id'];
            $url = "thread.php?threadid=" . $thread_id;
            $noResult = false;
            
            echo '<div class="result">
                     <h3><a href="' . $url . '" class="text-dark">' . $title . '</a></h3>
                     <p>' . $desc . '</p>
                  </div>';
         }

         if($noResult)
         {
            echo '<div class="jumbotron jumbotron-fluid">
                     <div class="container">
                        <p class="display-4">No Results Found</p>
                        <p class="lead">Suggestions:<ul>
                              <li>Make sure that all words are spelled correctly.</li>
                              <li>Try different keywords.</li>
                              <li>Try more general keywords.</li>
                              <li>Try fewer keywords.</li></ul>
                        </p>
                     </div>
                  </div>';
         }
      ?>

   </div>

   <?php include 'Partials/_footer.php'; ?>

   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
      crossorigin="anonymous"></script>
      
</body>

</html>