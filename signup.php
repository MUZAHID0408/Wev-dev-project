<?php
include 'connectToLogInfo.php';

$message = "";
$messageType = "";

if (isset($_POST['SignIn'])) {
    $email = $_POST['emailAddress'];
    $userName = $_POST['userName'];
    $password = md5($_POST['password']);
    $passwordLength = strlen($_POST['password']);
    $confirmPassword = $_POST['confirmPassword'];

    if ($email === "" || $userName === "") {
        $message = "All fields are required!";
        $messageType = "danger";
    } else if ($passwordLength <= 5) {
        $message = "Password must contain more than 6 characters.";
        $messageType = "warning";
    } else {
        $query = "SELECT id FROM users WHERE email ='" . mysqli_real_escape_string($conn, $email) . "'";
        $query2 = "SELECT id FROM users WHERE username ='" . mysqli_real_escape_string($conn, $userName) . "'";
        $result = mysqli_query($conn, $query);
        $result2 = mysqli_query($conn, $query2);

        if (mysqli_num_rows($result) > 0) {
            $message = "The email address is already registered.";
            $messageType = "warning";
        } else if (mysqli_num_rows($result2) > 0) {
            $message = "The username is already taken.";
            $messageType = "warning";
        } else {
            $query = "INSERT INTO users (username, email, password) VALUES ('$userName', '$email', '$password')";
            if (mysqli_query($conn, $query)) {
                $message = "Signup successful! Redirecting to login...";
                $messageType = "success";
                header("Refresh: 2; url=http://localhost/GCF/login.php");
            } else {
                $message = "Something went wrong. Please try again later.";
                $messageType = "danger";
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
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="styles/signup.css">
</head>

<body>
    <div class="container set_middle">
        <div class="card p-4" style="max-width: 400px; width: 100%;">
            <div class="text-center mb-4">
                <a href="http://localhost/GCF/index.php">
                    <img src="styles/logo.svg" width="80px" alt="GUB Community Forum Logo">
                </a>
                <h3 class="mt-2">Create Your Account</h3>
            </div>

            <!-- Display message -->
            <?php if (!empty($message)) : ?>
                <div class="alert alert-<?php echo $messageType; ?> text-center" role="alert">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <form method="post" action="signup.php">
                <div class="mb-3">
                    <label for="emailAddress" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="emailAddress" name="emailAddress" placeholder="mail@green.bd" required>
                    <small class="form-text text-muted">Use your university-provided email address.</small>
                </div>
                <div class="mb-3">
                    <label for="userName" class="form-label">Username</label>
                    <input type="text" class="form-control" id="userName" name="userName" placeholder="e.g., Md. Karim" aria-describedby="emailHelp" required>
                    <div id="emailHelp" class="form-text">Give university provided mail address</div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordCheck" required>
                    <div id="passwordCheck" class="form-text">Enter minimum 6 character</div>
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" aria-describedby="confirmPasswordCheck" required>
                    <div id="confirmPasswordCheck" class="form-text">Passwords do not match.</div>
                </div>
                <button type="submit" class="btn btn-primary" name="SignIn">Sign Up</button>
            </form>
        </div>
    </div>
    <script src="js/signup.js?v=1.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>