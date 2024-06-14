<?php

   $showError = 'false';

   if($_SERVER["REQUEST_METHOD"] == 'POST')
   {
      include '_dbconnect.php';
      $email = $_POST['loginEmail'];
      $pass = $_POST['loginPassword'];

      $sql = "SELECT * FROM `users` WHERE user_email = '$email'";
      $result = mysqli_query($connect, $sql);
      $numRows = mysqli_num_rows($result);

      if($numRows == 1)
      {
         $row = mysqli_fetch_assoc($result);
         
         if( password_verify($pass, $row['user_pass']) )
         {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['sr'] = $row['sr'];
            $_SESSION['useremail'] = $email;
            // header("Location: /prog/Forum/index.php");
            // exit();
         }
         
         header("Location: /prog/Forum/index.php");
      }
      header("Location: /prog/Forum/index.php");
   }

?>