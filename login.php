<?php
include 'connectToLogInfo.php';

$message = "";
$messageType = "";

if (isset($_POST['logIn'])) {
    $email = $_POST['emailAddress'];
    $password = md5($_POST['password']);

    if ($email === "" || $password === "") {
        $message = "Please provide required information.";
        $messageType = "warning";
    } else {
        $query = "SELECT password FROM users WHERE email ='" . mysqli_real_escape_string($conn, $email) . "'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) <= 0) {
            $message = "Login information could not be found.";
            $messageType = "danger";
        } else {
            $query = "SELECT * FROM users WHERE email ='" . mysqli_real_escape_string($conn, $email) . "'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_array($result);
            if ($row['password'] === $password) {
                session_start();
                $_SESSION['email'] = $row['email'];
                $message = "Login successful! Redirecting...";
                $messageType = "success";
                header("Refresh: 2; url=http://localhost/GCF/index.php");
            } else {
                $message = "Wrong Password.";
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
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="styles/login.css?v=1.0">
</head>

<body>
    <div class="container set_middle">
        <div class="card p-4" style="max-width: 400px; width: 100%;">
            <div class="text-center mb-4">
                <a href="http://localhost/GCF/index.php">
                    <img src="styles/logo.svg" width="80px" alt="GUB Community Forum Logo">
                </a>
                <h3 class="mt-2">Welcome Back</h3>
            </div>

            <!-- Display message -->
            <?php if (!empty($message)) : ?>
                <div class="alert alert-<?php echo $messageType; ?> text-center" role="alert">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <form method="post" action="login.php">
                <div class="mb-3">
                    <label for="emailAddress" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="emailAddress" name="emailAddress" required>
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary mb-3" name="logIn">Log In</button>
                <p class="text-center">OR</p>
                <a href="http://localhost/GCF/signup.php" class="btn btn-secondary">Sign Up</a>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
