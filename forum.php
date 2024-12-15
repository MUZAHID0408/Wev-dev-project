<?php
ob_start();
include 'connectToLogInfo.php';
session_start();
$message = '';
$posts_per_page = 5; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $posts_per_page;

if (isset($_POST['post_to']) && isset($_POST['content'])) {
    $text = $_POST['content'];
    $category_id = $_POST['category_id'];
    $image_name = $_FILES['image']['name'];
    $temp_name = $_FILES['image']['tmp_name'];
    $email = $_SESSION['email'];

    $query = "SELECT id FROM users WHERE email = '" . mysqli_real_escape_string($conn, $email) . "'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['id'];
    $unique_name = $user_id . '_' . $image_name;
    $folder = 'file/' . $unique_name;
    move_uploaded_file($temp_name, $folder);

    $insert_query = "INSERT INTO posts (user_id, category_id, content, image) VALUES 
                     ($user_id, $category_id, '" . mysqli_real_escape_string($conn, $text) . "', '" . mysqli_real_escape_string($conn, $unique_name) . "')";

    if (mysqli_query($conn, $insert_query)) {
        $message = "Post successful";
        $messageType = "success";
        header("Location: http://localhost/GCF/forum.php");
        exit();
    } else {
        $message = "Something went wrong. Please try again later.";
        $messageType = "danger";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="styles/logo.svg" type="image/x-icon">
    <title>GUB Community forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="styles/forum.css">
</head>

<body>
    <?php if (!empty($message)) : ?>
        <div class="alert alert-<?php echo $messageType; ?> text-center" role="alert">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($message)) : ?>
        <div class="alert alert-<?php echo $messageType; ?> text-center" role="alert">
            <?php echo $message;
            ?>
        </div>
    <?php endif; ?>
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
                            <a class="nav-link hover_blue" href="http://localhost/GCF/index.php#resources">Resource</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link hover_blue" href="http://localhost/GCF/widgets.php">Widgets</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link hover_blue" href="#">FAQ</a>
                        </li>

                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <?php if (isset($_SESSION['email']) && $_SESSION['email']): ?>
                            <li class="nav-item"><a class="nav-link" href="logout.php">Log out</a></li>
                        <?php else: ?>
                            <li class="nav-item"><a class="nav-link" href="login.php">Login / Sign up</a></li>
                        <?php endif; ?>
                    </ul>

                </div>

            </div>
        </nav>
    </section>

    <?php if (isset($_SESSION['email']) && $_SESSION['email']): ?>
        <main>
            <div class="container my-4">
                <div class="row">
                    <div class="container my-4">
                        <div class="row">
                            <!-- Left Sidebar -->
                            <div class="col-12 col-md-3 order-md-1 mb-4">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">Categories</h5>
                                        <ul class="list-group">
                                            <li class="list-group-item"><a href="forum.php?category=education">1. Education</a></li>
                                            <li class="list-group-item"><a href="forum.php?category=gaming">2. Gaming</a></li>
                                            <li class="list-group-item"><a href="forum.php?category=career">3. Career & Jobs</a></li>
                                            <li class="list-group-item"><a href="forum.php?category=entertainment">4. Entertainment</a></li>
                                            <li class="list-group-item"><a href="forum.php?category=sports">5. Sports</a></li>

                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Main Post Section -->
                            <div class="col-12 col-md-6 order-md-2 mb-4">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">Share Your Thoughts</h5>
                                        <form method="POST" enctype="multipart/form-data">
                                            <textarea class="form-control mb-3" name="content" placeholder="Write your thoughts here..." rows="4" required></textarea>
                                            <select class="form-control mb-3" name="category_id" required>
                                                <option value="" disabled selected>Select a Category</option>
                                                <?php
                                                include 'connectToLogInfo.php';
                                                $query = "SELECT category_id, name FROM categories";
                                                $result = mysqli_query($conn, $query);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<option value='{$row['category_id']}'>{$row['name']}</option>";
                                                }
                                                ?>
                                            </select>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <label for="file-upload" class="btn btn-secondary btn-sm">Choose File</label>
                                                <input type="file" id="file-upload" name="image" hidden>
                                                <span id="file-name" class="text-muted ms-2">No file chosen</span>


                                                <button type="submit" class="btn btn-success" name="post_to">Post</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- community post section -->

                                    <h5 class="mt-4" style="text-align: center;">Community Posts</h5>
                                    <?php
                                    if (isset($_GET['category'])) {
                                        $category = $_GET['category'];
                                        $query = "
                                                SELECT 
                                                    posts.post_id AS post_id, 
                                                    posts.content, 
                                                    posts.image, 
                                                    users.username 
                                                FROM posts 
                                                JOIN users ON posts.user_id = users.id 
                                                WHERE posts.category_id = (
                                                    SELECT category_id FROM categories WHERE name = '" . mysqli_real_escape_string($conn, $category) . "'
                                                )
                                                ORDER BY posts.post_id DESC 
                                                LIMIT $posts_per_page OFFSET $offset";
                                    } else {
                                        $query = "
                                                SELECT 
                                                    posts.post_id AS post_id, 
                                                    posts.content, 
                                                    posts.image, 
                                                    users.username 
                                                FROM posts 
                                                JOIN users ON posts.user_id = users.id 
                                                ORDER BY posts.post_id DESC 
                                                LIMIT $posts_per_page OFFSET $offset";
                                    }

                                    $result = mysqli_query($conn, $query);

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $post_id = $row['post_id'];
                                            $username = $row['username'];
                                            $content = $row['content'];
                                            $image = $row['image'];
                                            $imagePath = !empty($image) ? 'file/' . $image : 'default-image.jpg'; // Fallback for missing images

                                            echo "
                                                    <div class='card shadow-sm mt-4'>
                                                        <div class='card-body'>
                                                            <h5 class='card-title'>Community Posts</h5>
                                                            <div class='border-bottom mb-3 pb-3'>
                                                                <p><strong>$username:</strong> $content</p>
                                                                <img src='$imagePath' alt='NO IMAGE UPLOADED' style='max-width:100%;max-height:450px;' class='img-fluid rounded'>
                                                            </div>
                                                ";

                                            $comment_query = "
                                                    SELECT 
                                                        comments.comment, 
                                                        users.username AS commenter 
                                                    FROM 
                                                        comments 
                                                    JOIN 
                                                        users 
                                                    ON 
                                                        comments.user_id = users.id 
                                                    WHERE 
                                                        comments.post_id = $post_id 
                                                    ORDER BY 
                                                        comments.created_at ASC;
                                                ";
                                            $comment_result = mysqli_query($conn, $comment_query);

                                            echo "<div class='comments-section' id ='post$post_id'>";
                                            if (mysqli_num_rows($comment_result) > 0) {
                                                while ($comment_row = mysqli_fetch_assoc($comment_result)) {
                                                    $commenter = $comment_row['commenter'];
                                                    $comment_text = $comment_row['comment'];
                                                    echo "<p><strong>$commenter:</strong> $comment_text</p>";
                                                }
                                            } else {
                                                echo "<p>No comments yet. Be the first to comment!</p>";
                                            }
                                            echo "</div>";

                                            echo "
                                                        <form method='POST' class='mt-3'>
                                                            <input type='hidden' name='post_id' value='$post_id'>
                                                            <textarea name='comment' class='form-control mb-2' rows='2' placeholder='Write a comment...' required></textarea>
                                                            <button type='submit' class='btn btn-primary btn-sm'>Submit</button>
                                                        </form>
                                                    </div>
                                                </div>";
                                        }
                                    } else {
                                        echo "<p class='text-center'>NO POST AVAILABLE</p>";
                                    }

                                    // Calculate total pages
                                    $count_query = isset($_GET['category'])
                                        ? "SELECT COUNT(*) AS total FROM posts WHERE category_id = (
                                SELECT category_id FROM categories WHERE name = '" . mysqli_real_escape_string($conn, $category) . "'
                            )"
                                        : "SELECT COUNT(*) AS total FROM posts";

                                    $count_result = mysqli_query($conn, $count_query);
                                    $count_row = mysqli_fetch_assoc($count_result);
                                    $total_posts = $count_row['total'];
                                    $total_pages = ceil($total_posts / $posts_per_page);

                                    // Display pagination links
                                    echo "<nav>";
                                    echo "<ul class='pagination'>";
                                    for ($i = 1; $i <= $total_pages; $i++) {
                                        $active = $i === $page ? "active" : "";
                                        echo "<li class='mt-5 page-item $active'><a class='page-link' href='forum.php?page=$i'>" . $i . "</a></li>";
                                    }
                                    echo "</ul>";
                                    echo "</nav>";


                                    if (isset($_POST['comment']) && isset($_POST['post_id'])) {
                                        $comment = mysqli_real_escape_string($conn, $_POST['comment']);
                                        $post_id = (int) $_POST['post_id'];
                                        $email = $_SESSION['email'];
                                        $user_query = "SELECT id FROM users WHERE email = '" . mysqli_real_escape_string($conn, $email) . "'";
                                        $user_result = mysqli_query($conn, $user_query);
                                        $user_row = mysqli_fetch_assoc($user_result);
                                        $user_id = $user_row['id'];

                                        $insert_comment = "INSERT INTO comments (post_id, user_id, comment) VALUES ($post_id, $user_id, '$comment')";

                                        if (mysqli_query($conn, $insert_comment)) {
                                            header("Location: http://localhost/GCF/forum.php#post$post_id");
                                            exit();
                                        } else {
                                            echo "<script>alert('Error adding comment.');</script>";
                                        }
                                    }
                                    ob_end_flush();
                                    ?>
                                
                            </div>
                        </div>

                    </div>
        </main>
    <?php else: ?>
        <div class="container setMiddle">
            <div class="loginRequest">
                <h1>Login or register:</h1>
                <a href="http://localhost/GCF/login.php">Login or sign up</a>
            </div>
        </div>
    <?php endif; ?>

     <!-- footer section -->
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
    <script src="js/post.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>