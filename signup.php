<?php
    include 'connectToLogInfo.php';

    if(isset($_POST['SignIn'])){
        $email = $_POST['emailAddress'];
        $userName = $_POST['userName'];
        $password = md5($_POST['password']);
        $passwordLength = strlen($_POST['password']);
        $confirmPassword = $_POST['confirmPassword'];

        if($email === "" || $userName === ""){
            echo "<script>alert('There is empty field');</script>";
        }else if($passwordLength <=5){
            echo "<script>alert('Password must contain more than 6 character.');</script>";
        }
        else{
            $query = "SELECT id FROM users WHERE email ='".mysqli_real_escape_string($conn, $email)."'";
            $query2 = "SELECT id FROM users WHERE username ='".mysqli_real_escape_string($conn, $userName)."'";
            $result = mysqli_query($conn, $query);
            $result2 = mysqli_query($conn, $query2);
            if(mysqli_num_rows($result)>0){
               echo "<script>alert('Email address has already been taken');</script>";
            }else if(mysqli_num_rows($result2)){
                echo "<script>alert('username has already been taken');</script>";
            }else{
                $query = "INSERT INTO users (username, email, password) VALUES ('$userName', '$email', '$password')";

                if(mysqli_query($conn, $query)){
                    echo "<script>alert('Signup successful!'); window.location.href = 'http://localhost/GCF/login.php';</script>";
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
    <title>Sign up</title>
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
                <form method="post" action="signup.php">
                    <div class="mb-2">
                        <label for="userMail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="userMail" name="emailAddress" aria-describedby="emailHelp" placeholder="youremail@gmail.com" required>
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-2">
                        <label for="userName" class="form-label">User Name</label>
                        <input type="text" class="form-control" id="userName" name="userName" aria-describedby="userNameHelp" placeholder="e.g. Karim123" required>
                        <div id="userNameHelp" class="form-text">Provide User Name</div>
                    </div>
                    <div class="mb-2">
                        <label for="inputPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="inputPassword" aria-describedby="passwordCheck" required>
                        <div id="passwordCheck" class="form-text">Enter minimum 6 character</div>
                    </div>

                    <div class="mb-4">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" aria-describedby="confirmPasswordCheck" required>
                        <div id="confirmPasswordCheck" class="form-text">Passwords do not match.</div>
                    </div>
                    <div class="mb-3 set_middle">
                        <button type="submit" class="btn btn-primary" name="SignIn">Sign In</button>
                    </div>

                </form>

            </div>
        </div>


    </div>
    <script src="js/signup.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>