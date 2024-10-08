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
    
    <div class="container">
        <?php
            $id=$_GET['threadid'];
            $sql="SELECT * FROM `thread1` WHERE thread_id=$id";
            $result=mysqli_query($conn,$sql);
            
            
            // // for iterate all category use while loop from here
            while($row=mysqli_fetch_assoc($result)){
               
                $title=$row['thread_title'];
                $desc=$row['thread_desc'];
                $thread_user_id=$row['thread_user_id'];
                $sql2="SELECT username FROM `forum_user` WHERE sno=$thread_user_id";
                $result2=mysqli_query($conn,$sql2);
                $num=mysqli_num_rows($result2);
                // echo $num;
                $row2=mysqli_fetch_assoc($result2);
                $show=$row2['username'];
                 
        
            }
           
            //end of while loop
        
        ?>

        <?php
           
            $showalert=false;
            $id=$_GET['threadid'];
            $method=$_SERVER['REQUEST_METHOD'];
            // if request is post then insert threads into database
            if($method=='POST'){
                $comment=$_POST['comment'];
                $sno=$_POST['sno'];
                $comment=str_replace("<","&lt;",$comment);
                $comment=str_replace(">","&gt;",$comment);
                // $sno=$_POST['sno'];
               
                
                
                
                
                $sql="INSERT INTO `comments` ( `comment_content`, `thread_id`, `comment_by`, `comment_time`)
                                 VALUES       ( '$comment', '$id', '$sno', current_timestamp())";
                $result=mysqli_query($conn,$sql);
                $showalert=true;
                
                if($showalert){
                    echo '
                    
                    <div class="alert alert-success alert-dismissible fade show  my-2" role="alert" width=100>
                        <strong>added successfully!</strong> your comment has been added.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    
                    ';
                }
                
            }

        ?>

        




        <!-- here  jumbotron code is start -->

        <div class="jumbotron bg-light text-dark my-4 d-flex flex-column align-items-center jumbo">
            <h2 class="display-4"> <?php echo $title; ?></h2>
            <p class="lead"> <?php echo $desc; ?> </p>
            <hr class="my-4">
            <p>This is a peer to peer forum is sharing knowledge with each other.Be civil. Don't post anything that
                a
                reasonable person would consider offensive, abusive, or hate speech.
                Keep it clean. Don't post anything obscene or sexually explicit.
                Respect each other. Don't harass or grief anyone, impersonate people, or expose their private
                information.Respect our forum.</p>
            <p>
                posted by: <b><i><?php echo $show; ?></i></b>
            </p>
        </div>
        <!-- here jumbotron code is end -->



    </div>

    <div class="container">
        
    <?php
        
       
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
            $r= $_SESSION['sno'];
            // echo $r;
           
        echo'
        <div class="container bg-light mb-3">
            <h2 class="py-2">Post a Comment</h2>
            <form action="'. $_SERVER["REQUEST_URI"] .'" method="POST">
                <div class="mb-3">
                    <label for="comment" class="form-label">Type Your Comment</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                    <input type="hidden" name="sno" value="'.$r.'">
                </div>
                <button type="submit" class="btn btn-success mb-3">Post Comment</button>
            </form>
        </div>';
            
        }
        else{
            echo '
            <div class="container bg-light">
                <h2 class="py-1">Post a Comment</h2>
                <p class="lead">you are not logged in.please logged in to be able to start a comment. </p>
            </div>';

        }

        ?>

        <h2 class="py-2">Discussion</h2>

        <?php
            
           
            $id=$_GET['threadid'];
            $sql="SELECT * FROM `comments` WHERE thread_id=$id";
            $result=mysqli_query($conn,$sql);
            $noresult=true;
            

            // for iterate all category use while loop from here
            while($row=mysqli_fetch_assoc($result)){
                $noresult=false;
                $id=$row['comment_id'];
                $content=$row['comment_content'];
                $comment_time=$row['comment_time'];
                $comment=$row['comment_by'];
                
                $sql2="SELECT username FROM `forum_user` WHERE sno=$comment";
                $result2=mysqli_query($conn,$sql2);
                $num=mysqli_num_rows($result2);
                // echo $num;
                $row2=mysqli_fetch_assoc($result2);
                $show=$row2['username'];

                

                
                
                
                echo '
                <div class="media my-3 d-flex ">
                    <img class="mr-3" src="img/userimg.jpg" alt="Generic placeholder image" width="50px" height="50px">
                    <div class="media-body mx-3">
                         <p class="fw-bold my-0"> '.$show.' '.$comment_time.'</p>
                        '.$content.'
                    </div>
                </div>';
               
            
            
                
            }
            
            
            if($noresult){
                echo '
                <div class="jumbotron jumbotron-fluid bg-light mb-3">
                    <div class="container">
                    <p class="display-6">No Comments Found</p>
                    <p class="lead"><b>be the first person to do comment.</b></p>
                    </div>
                </div>';
            }
            ?>
    </div>






    </div>
    <!-- this above div is the end of containder div -->
    <?php
        include 'partials/_footer.php';
     ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>