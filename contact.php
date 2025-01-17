<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>idiscuss-forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="css/style.css" />
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   
    <style>
        body, html {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        font-family: Arial, sans-serif;
        
       
    }
    .section1 {
        max-width: 100%;
        border: 2px solid black;
        padding: 20px;
        border-radius: 8px;
        display: flex;
        flex-direction: column;
        align-items: center;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .set_form {
        width: 100%;
    }
    
    </style>
</head>

<body>
    <?php
        include 'partials/_dbconn.php';
    ?>
    <?php
        include 'partials/_header.php';
    ?>
        <div class="container my-4" id="mine">
        <form onsubmit="send(event)">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                <div class="section1">
                    <div class="mb-1 set_form">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" placeholder="Enter Your Name" class="form-control" id="name" name="name" required/>
                    </div>
                    <div class="mb-1 set_form">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" placeholder="Enter Your Email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required/>
                    </div>
                    <div class="mb-1 set_form">
                        <label for="number" class="form-label">Number</label>
                        <input type="number" placeholder="Enter Your Number" class="form-control" id="number" name="number" required />
                    </div>
                    <div class="mb-1 set_form">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" placeholder="Enter Your Subject" class="form-control" id="subject" name="subject" required />
                    </div>
                    <div class="mb-3 set_form">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message"  rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </div>
            </div>
        </form>
    </div>
    <?php
        include 'partials/_footer.php';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

<script>
        function send(event) {
            event.preventDefault(); // Prevent form submission
            var name = document.querySelector("#name").value;
            var email = document.querySelector("#email").value;
            var number = document.querySelector("#number").value;
            var subject = document.querySelector("#subject").value;
            var message = document.querySelector("#message").value;

            var body = "Name: " + name + "<br> Email: " + email + " <br> Number: " + number + "<br> Subject: " + subject + "<br> Message: " + message;

            console.log(body);

            Email.send({
                SecureToken : "75045da1-afaa-428c-9c75-bd297319a408",
                To: "vijaydeepu737@gmail.com",
                From: "vijaydeepu737@gmail.com",
                Subject: subject,
                Body: body,
            }).then((message) => {
                console.log(message); // Log the response to check
                if (message === 'OK') {
                    swal("Successful!", "Your data is received!", "success");
                } else {
                    swal("Failed", "There was an error sending your message.", "error");
                }
                // Clear form fields after sending the email
                document.querySelector("#name").value = '';
                document.querySelector("#email").value = '';
                document.querySelector("#number").value = '';
                document.querySelector("#subject").value = '';
                document.querySelector("#message").value = '';
            }).catch((error) => {
                console.error(error);
                swal("Failed", "There was an error sending your message.", "error");
            });
        }
    </script>
</body>

</html>