<?php
   session_start();
   
   echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

            <a class="navbar-brand" href="#">iDiscuss</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
            </button>
         
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav mr-auto">

                  <li class="nav-item active">
                     <a class="nav-link" href="../forum">Home<span class="sr-only">(current)</span></a>
                  </li>

                  <li class="nav-item">
                     <a class="nav-link" href="about.php">About</a>
                  </li>

                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Top Categories
                     </a>

                     <div class="dropdown-menu" aria-labelledby="navbarDropdown">';

               $sql = "SELECT category_name, category_id FROM `categories` LIMIT 4";
               $result = mysqli_query($connect, $sql);

               while ($row = mysqli_fetch_assoc($result))
               {
                  echo '<a class="dropdown-item" href="threadlist.php?catid=' . $row['category_id'] . '">' . $row['category_name'] . '</a>';
               }
                        
               echo '</div>
                  </li>

                  <li class="nav-item">
                     <a class="nav-link" href="contact.php">Contact</a>
                  </li>

               </ul>

               <div class="row">';

               if ( isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true )
               {
                  echo '<form class="form-inline my-2 my-lg-0" action="search.php" method="get">
                           <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
                           <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
                           <p class="text-light my-0 ml-3">Welcome ' . $_SESSION['useremail'] . '</p>
                           <a href="Partials/_logout.php" class="btn btn-outline-primary ml-3 mr-3">Logout</a>
                        </form>';
               }
               else
               {
                  echo '<form class="form-inline my-2 my-lg-0" action="search.php" method="get">
                           <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
                           <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
                        </form>

                        <div class="btn btn-outline-primary ml-2" data-toggle="modal" data-target="#loginModal">Login</div>
                        <div class="btn btn-outline-primary ml-2 mr-2" data-toggle="modal" data-target="#signupModal">Signup</div>';
               }

         echo '</div>

            </div>
         </nav>';

   include 'Partials/_loginModal.php';
   include 'Partials/_signupModal.php';

   if ( isset($_GET['signupsuccess'])  &&  $_GET['signupsuccess']=='true' )
   {
      echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
               <strong>Success!</strong> You have successfully signed up.
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>';
   }
   elseif ( isset($_GET['signupsuccess'])  &&  $_GET['signupsuccess']=='false' )
   {
      echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
               <strong>Fail!</strong> You have not successfully signed up.
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>';
   }

?>