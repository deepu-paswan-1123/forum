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


    <!-- here slider code is starting -->
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active ">
                <img src="img/slider1.jpg" class="d-block w-100 slider" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/slider2.jpg" class="d-block w-100 slider" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/slider3.jpg" class="d-block w-100 slider" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/slider4.jpg" class="d-block w-100 slider" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- here slider code is end -->


    <!-- here categries card start -->
    <div class="container">
        <h1 class="text-center">
            iDiscuss-categories
        </h1>
        <div class="row">
            <!-- here php run for fetch categories -->
            <?php
                $sql="SELECT * FROM `categories`";
                $result=mysqli_query($conn,$sql);

                // for iterate all category use while loop from here
                while($row=mysqli_fetch_assoc($result)){
                  $id=$row['catergory_id'];
                  $cat=$row['category_name'];
                  $desc=$row['category_description'];
                 
                  
                  echo '
                  
                  <div class="col-md-4 ">
                  <div class="card my-3 " style="width: 18rem;">
                  
                    <img src="img/card-'.$id.'.jpg" class="card-img-top" alt="..." height="200px">
                      <div class="card-body">
                          <h5 class="card-title"><a href="http://localhost/forum/threadlist.php?catid='.$id.'">'.$cat.'</a></h5>
                          <p class="card-text">'.substr($desc,0,150).'...</p>
                          <a href="http://localhost/forum/threadlist.php?catid='.$id.'" class="btn btn-primary">view threads</a>
                      </div>
                    </div>
                  </div>
                 
                  
                  ';
                  
                }
            ?>


        </div>
    </div>
    <!-- here categories code is end -->
    <?php
        include 'partials/_footer.php';
     ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>