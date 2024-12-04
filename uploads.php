<?php
session_start();
include 'connectToLogInfo.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $fileName = basename($_FILES['file']['name']);
        $uploadFilePath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath)) {
            $stmt = $conn->prepare("INSERT INTO uploads (file_name, file_path, uploaded_at) VALUES (?, ?, NOW())");
            $stmt->bind_param("ss", $fileName, $uploadFilePath);

            if ($stmt->execute()) {
                $message = "File uploaded successfully!";
            } else {
                $message = "Failed to save file information to the database.";
            }
            $stmt->close();
        } else {
            $message = "Failed to upload file.";
        }
    } else {
        $message = "No file was selected or an error occurred.";
    }
}

$result = $conn->query("SELECT * FROM uploads ORDER BY uploaded_at DESC");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="styles/logo.svg" type="image/x-icon">
    <title>Community Uploads</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/upload.css?v=1.0">
</head>

<body>
    <section>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="http://localhost/GCF/index.php"><img src="styles/logo.svg" height="60px"
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
                            <a class="nav-link hover_blue" href="#">Widget</a>
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

    <main>
        <?php if (isset($_SESSION['email']) && $_SESSION['email']): ?>
            <div class="container mt-5">
                <section>

                    <h1 class="text-center mb-4">Community Uploads</h1>

                    <?php if (isset($message)): ?>
                        <div class="alert alert-success">
                            <?= htmlspecialchars($message); ?>
                        </div>
                        <script>
                            setTimeout(() => {
                                window.location.href = "http://localhost/GCF/uploads.php";
                            }, 1000);
                        </script>
                    <?php endif; ?>


                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Upload a file to help others</h5>
                            <form action="uploads.php" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="file" class="form-label">Choose a file to upload:</label>
                                    <input type="file" name="file" id="file" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>
                        </div>
                    </div>



                    <div class=" container card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Uploaded Files</h5>
                            <ul class="list-group">
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong><?= htmlspecialchars($row['file_name']) ?></strong><br>
                                            <small class="text-muted">Uploaded on <?= $row['uploaded_at'] ?></small>
                                        </div>
                                        <a href="<?= htmlspecialchars($row['file_path']) ?>" class="btn btn-sm btn-success" download>Download</a>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                    </div>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center">
                Please <a href="login.php" class="alert-link">log in</a> to upload and view community uploads.
            </div>
        <?php endif; ?>

    </main>
    <section class="footer" style="background-color: rgba(35, 35, 35, 0.947);">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 border-top">
            <div id="footer_text" class="col-md-4 d-flex align-items-center">
                <a href="#" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1 px-3">
                    <img src="styles/logo.svg" width="40px" alt="GUB community forum logo">
                </a>
                <p class="mb-3 mb-md-0">© 2024 GUB Coummunity Forum</p>
            </div>
        </footer>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>