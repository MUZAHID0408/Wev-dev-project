<?php
    include 'connectToLogInfo.php';

    if(isset($_POST['logIn'])){
        $email = $_POST['emailAddress'];
        $password = md5($_POST['password']);

        if($email === "" || $password === ""){
            echo "<script>alert('Please provide required information');</script>";
        }else{
            $query = "SELECT password FROM users WHERE email ='".mysqli_real_escape_string($conn, $email)."'";
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result) <=0){
               echo "<script>alert('Login information could not be found.');</script>";
            }else{
                $query = "SELECT * FROM users WHERE email ='".mysqli_real_escape_string($conn, $email)."'";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_array($result);
                if($row['password'] === $password){
                    session_start();
                    $_SESSION['email'] = $row['email'];
                    echo "<script>alert('Login successfull');</script>";
                    header("Location: http://localhost/GCF/index.php");
                }else{
                    echo "<script>alert('Wrong Password');</script>";
                }


                
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="styles/logo.svg" type="image/x-icon">
    <title>Login or Sign up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="styles/login.css">
</head>

<body>
    

    <div class="container-sm set_middle">

        <div class="login_content_holder ">
            <div class="logo_area">

                <a href="http://localhost/GCF/index.php">
                    <img src="styles/logo.svg" width="100px" alt="GUB community forum logo">
                </a>

            </div>
            <div class="login_area">
                <form method="post" action="login.php">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="emailAddress" aria-describedby="emailHelp" required>
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-4">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
                    </div>
                    <div class="mb-3 set_middle">
                        <button type="submit" class="btn btn-primary" name="logIn">Log In</button>
                        <p>OR</p>
                        <a href="http://localhost/GCF/signup.php" class="btn btn-secondary">Sign up</a>
                    </div>

                </form>

            </div>
        </div>


    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>