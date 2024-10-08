<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>idiscuss-forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <?php
        include 'partials/_dbconn.php';
    ?>
    <?php
        include 'partials/_header.php';
    ?>

    <?php
        $showalert=false;
        $id=$_GET['catid'];
        $method=$_SERVER['REQUEST_METHOD'];
        // if request is post then insert threads into database
        if($method=='POST'){
            $th_title=$_POST['title'];
            $th_desc=$_POST['desc'];
            $sno=$_POST['sno'];
            $th_title=str_replace("<","&lt;",$th_title);
            $th_title=str_replace(">","&gt;",$th_title);
            $th_desc=str_replace("<","&lt;",$th_desc);
            $th_desc=str_replace(">","&gt;",$th_desc);
            $sql="INSERT INTO `thread1` ( `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `date`)
                         VALUES ('$th_title', '$th_desc','$id','$sno',current_timestamp())";
            $result=mysqli_query($conn,$sql);
            $showalert=true;
            if($showalert){
                echo '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>added successfully!</strong> your threa has been added! please wait for community to respond.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
                ';
            }
        }

    ?>

    <?php
        $id=$_GET['catid'];
        // echo $id;
        $sql="SELECT * FROM `categories` WHERE catergory_id=$id";
        $result=mysqli_query($conn,$sql);
        

        // for iterate all category use while loop from here
        while($row=mysqli_fetch_assoc($result)){
       
          $cat_name=$row['category_name'];
       
          $cat_desc=$row['category_description'];
       
        }
        
    ?>

    <!-- here  jumbotron code is start -->
    <div class="container">
        <div class="jumbotron bg-light text-dark my-4 d-flex flex-column align-items-center jumbo">
            <h2 class="display-4">welcome to <?php echo $cat_name; ?> forums</h2>
            <p class="lead"> <?php echo $cat_desc; ?> </p>
            
            <hr class="my-4">
            <p>This is a peer to peer forum is sharing knowledge with each other.Be civil. Don't post anything that a
                reasonable person would consider offensive, abusive, or hate speech.
                Keep it clean. Don't post anything obscene or sexually explicit.
                Respect each other. Don't harass or grief anyone, impersonate people, or expose their private
                information.Respect our forum.</p>
            <p class="lead">
                <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>
    </div>
    
    <!-- here jumbotron code is end -->

    <!-- here form for asking querstion code is start -->
    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        $r= $_SESSION['sno'];
        // echo $r;
    echo'
    <div class="container bg-light mb-3">
         <h2 class="py-2">Start a Discussion</h2>
        <form action="'. $_SERVER["REQUEST_URI"] .'" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">problem title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">keep your title as short and crisp as possible</div>
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Elaborate your concern</label>
                <textarea class="form-control" id="desc"  name="desc" rows="3"></textarea>
                <input type="hidden" name="sno" value="'.$r.'">
                
            </div>

            <button type="submit" class="btn btn-success mb-3">Submit</button>
        </form>
    </div>';
    }
    else{
        echo '<div class="container bg-light">
                <h2 class="py-1">Start a Discussion</h2>
                <p class="lead">your are not logged in.please login to be able to start a discussion. </p>
              </div>';
    }
    ?>

    
    <!-- here form for asking querstion code is end -->

    <div class="container">
        <!-- <h2 class="py-2">Browse Question</h2> -->
        <h2 class="py-2">Browse Question</h2>

        
        <?php
           
            $id=$_GET['catid'];
            $sql="SELECT * FROM `thread1` WHERE thread_cat_id=$id";
            $result=mysqli_query($conn,$sql);
            $noresult=true;
            

            // for iterate all category use while loop from here
            while($row=mysqli_fetch_assoc($result)){
                $noresult=false;
                $id=$row['thread_id'];
                $title=$row['thread_title'];
                $desc=$row['thread_desc'];
                $date=$row['date'];
                $thread_user_id=$row['thread_user_id'];
                $sql2="SELECT username FROM `forum_user` WHERE sno=$thread_user_id";
                $result2=mysqli_query($conn,$sql2);
                // echo mysqli_num_rows($result2);
                $row2=mysqli_fetch_assoc($result2);
                $show= $row2['username'];

                
                
            
                echo '
                <div class="media my-3 d-flex ">
                    <img class="mr-3" src="img/userimg.jpg" alt="Generic placeholder image" width="50px" height="50px">
                    <div class="media-body mx-3">
                    <p class="fw-bold my-0"> '.$show.' '.$date.'</p>
                        <h5 class="mt-0"><a href="http://localhost/forum/thread.php?threadid='.$id.'" class="text-dark"> '.$title.'</a></h5>
                        '.$desc.'
                    </div>
                </div>';
                

            }
            if($noresult){
                echo '
                <div class="jumbotron jumbotron-fluid bg-light mb-3">
                    <div class="container">
                    <p class="display-5">No Result Found</p>
                    <p class="lead"><b>be the first person to ask question.</b></p>
                    </div>
                </div>';
            }
            
        
            ?>
    </div>

    <?php
        include 'partials/_footer.php';
     ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>