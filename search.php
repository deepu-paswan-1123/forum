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
<style>
    #mine{
        height: 73vh;
    }
</style>

<body>
    <?php
        include 'partials/_dbconn.php';
        include 'partials/_header.php';
    ?>

    <!-- Search results start here -->
    <div class="container my-4" id="mine">
        <h1 class="text-secondary">Search results for <em class="text-dark">"<?php echo $_GET['search'];  ?>"</em></h1>

        <?php
            $noresult = true;
            $query = $_GET["search"]; // Add a semicolon at the end of this line
            $sql = "SELECT * FROM `thread1` WHERE MATCH (thread_title, thread_desc) against('$query')";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                $title = $row['thread_title'];
                $desc = $row['thread_desc'];
                $thread_id = $row['thread_id'];
                $noresult = false;

                echo '
                <div class="result my-4">
                    <h3><a class="text-dark" href="http://localhost/forum/thread.php?threadid=' . $thread_id . '">' . htmlspecialchars($title) . '</a></h3>
                    <p>' . htmlspecialchars($desc) . '</p>
                </div>
                ';
            }

            if ($noresult) {
                echo '
                <div class="jumbotron jumbotron-fluid bg-light mb-3">
                    <div class="container">
                        <p class="display-6"> did not match any documents.</p>
                        <p class="lead"><b>Suggestions:</b></p>
                        <p class="lead">
                            <ul>
                                <li>Make sure that all words are spelled correctly.</li>
                                <li>Try different keywords.</li>
                                <li>Try more general keywords.</li>
                            </ul>
                        </p>
                    </div>
                </div>';
            }
        ?>

    </div> <!-- Close container div -->

    <?php
        include 'partials/_footer.php';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
