<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="styles/logo.svg" type="image/x-icon" />
    <title>GUB Community Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
        <link rel="stylesheet" href="styles/style.css">
        <link rel="stylesheet" href="styles/forum.css">


</head>

<body>
    <!-- Header Section -->
    <section>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="styles/logo.svg" height="60px"
                        alt="GUB community forum logo" /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"><span
                        class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active hover_blue" aria-current="page" href="http://localhost/GCF">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link hover_blue" href="#">Resource</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link hover_blue" href="#">Contact</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link hover_blue" href="#">FAQ</a>
                        </li>
                        <li class="nav-item">
                          <?php if(isset($_SESSION['email']) && $_SESSION['email']): ?>
                              <a class="nav-link login_signup" href="http://localhost/GCF/logout.php">Log out</a>
                          <?php else:?>
                               <a class="nav-link login_signup" href="http://localhost/GCF/login.php">Login Or Sign up</a>
                          <?php endif; ?>
                        </li>

                    </ul>

                </div>
            </div>
        </nav>
    </section>

    <!-- Main Content Section -->
    <main class="main-container">
        <!-- Post Form -->
        <section class="post-form">
            <h2>Share Your Thoughts</h2>
            <form id="shareForm">
                <textarea name="thoughts" placeholder="Write your thoughts here..." rows="5" required></textarea>
                <input type="file" name="image" accept="image/*">
                <button type="submit">Post</button>
            </form>
        </section>

        <!-- Posts Section -->
        <section class="posts-section">
            <h2>Community Posts</h2>
            <div class="post">
                <p><strong>User1:</strong> This is a sample post!</p>
                <img src="sample-image.jpg" alt="Sample Post Image">
            </div>
            <!-- Add more posts dynamically here -->
        </section>
    </main>

    <!-- Footer section -->
    <section class="footer" style="background-color: rgba(35, 35, 35, 0.947);">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 border-top">
            <div id="footer_text" class="col-md-4 d-flex align-items-center">
                <a href="#" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1 px-3">
                    <img src="styles/logo.svg" width="40px" alt="GUB community forum logo">
                </a>
                <p class="mb-3 mb-md-0" style="color: rgb(183, 183, 183);">© 2024 GUB Coummunity Forum</p>
            </div>
        </footer>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>