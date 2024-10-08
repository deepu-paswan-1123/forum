<?php
    
     echo '
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">idiscuss</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/forum">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Top categories
                    </a>
                    <ul class="dropdown-menu">
                   ';

                   $sql="SELECT * FROM `categories` LIMIT 5";
                    $result=mysqli_query($conn,$sql);
                    $num=mysqli_num_rows($result);
                    
                    
                    while($row=mysqli_fetch_assoc($result)){
                        $x=$row['catergory_id'];    
                        $y=$row['category_name'];
                        echo'
                        
                        
                        <li><a class="dropdown-item" href="http://localhost/forum/threadlist.php?catid='.$x.'">'.$y.'</a></li> 
                        
                        ';
                        
                    }
                    
                    
                
                    
                        
                   echo '
                   </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="http://localhost/forum/contact.php">contact</a>
                </li>
            </ul>';

            session_start();
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
                
                echo '
                <form class="d-flex" role="search" action="search.php" method="GET">
                    <input class="form-control me-2" type="search" placeholder="Search" name="search"aria-label="Search">
                    <button class="btn btn-success" type="submit">Search</button>
                    

                    </form>
                    <p class="text-light my-0 mx-2"> welcome '.$_SESSION['username'].' </p>
                    <a type="button" href="http://localhost/forum/partials/_logout.php" class="btn btn-outline-success"  data-bs-target="#signupModal">
                        logout
                    </a>';
            }
            else{
                echo '            
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-success" type="submit">Search</button>
                </form>
                <div class="mx-2">
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#loginModal">
                        login
                    </button>
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#signupModal">
                        signup
                    </button>

                </div>
                ';

            }

                 echo'
           
        </div>
    </div>
</nav>';

   
include 'partials/_loginModal.php';
include 'partials/_signupModal.php';



$signupsuccess=false;

if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true"){
    $signupsuccess = true;
    
} 
if($signupsuccess) {
    echo '
    <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
        <strong>success!</strong> You have signup successfull now you can logged in .
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    
    ';

    
}
    

 
?>