<?php
session_start();
include 'connectToLogInfo.php';

$message = "";

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['study_material']) && $_FILES['study_material']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'study_materials/';
        $fileName = basename($_FILES['study_material']['name']);
        $uploadFilePath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['study_material']['tmp_name'], $uploadFilePath)) {
            $stmt = $conn->prepare("INSERT INTO study_materials (file_name, file_path, uploaded_at) VALUES (?, ?, NOW())");
            $stmt->bind_param("ss", $fileName, $uploadFilePath);

            if ($stmt->execute()) {
                $message = "Study material uploaded successfully!";
                header("Refresh: 2; url=http://localhost/GCF/study_material.php");
            } else {
                $message = "Failed to save material information to the database.";
            }
            $stmt->close();
        } else {
            $message = "Failed to upload material.";
        }
    } else {
        $message = "No file was selected or an error occurred.";
    }
}

// Handle search query
$searchQuery = isset($_GET['query']) ? $_GET['query'] : '';
if ($searchQuery) {
    $searchQuery = $conn->real_escape_string($searchQuery);
    $result = $conn->query("SELECT * FROM study_materials WHERE file_name LIKE '%$searchQuery%' ORDER BY uploaded_at DESC");
} else {
    $result = $conn->query("SELECT * FROM study_materials ORDER BY uploaded_at DESC");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="styles/logo.svg" type="image/x-icon">
    <title>Study Materials Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            height: 100vh;
            background-image: linear-gradient(to right, #ffecd2 0%, #fcb69f 100%);
        }

        main {
            flex: 1;
        }

        #footer_text p {
            color: rgb(183, 183, 183);
        }
    </style>
</head>

<body>
    <section>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="http://localhost/GCF/index.php"><img src="styles/logo.svg" height="60px" alt="GUB community forum logo" /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active hover_blue" aria-current="page" href="http://localhost/GCF">Home</a></li>
                        <li class="nav-item"><a class="nav-link hover_blue" href="http://localhost/GCF/widgets.php">Widgets</a></li>
                       
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

        <div class="container mt-5">
            <h1 class="text-center mb-4">Study Materials</h1>

            <?php if (!empty($message)): ?>
                <div class="alert alert-info"><?= htmlspecialchars($message); ?></div>
            <?php endif; ?>

            <!-- Search Form -->
            <form method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="query" class="form-control" placeholder="Search materials..." value="<?= htmlspecialchars($searchQuery) ?>">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>

            <!-- Upload Section -->
            <?php if (isset($_SESSION['email']) && $_SESSION['email']): ?>
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Upload Study Materials</h5>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="study_material" class="form-label">Choose a file:</label>
                                <input type="file" name="study_material" id="study_material" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>
                    </div>
                </div>
            

            <!-- Display Section -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title">Available Study Materials</h5>
                    <ul class="list-group">
                        <?php if ($result && $result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong><?= htmlspecialchars($row['file_name']) ?></strong>
                                        <br>
                                        <small class="text-muted">Uploaded on <?= $row['uploaded_at'] ?></small>
                                    </div>
                                    <a href="<?= htmlspecialchars($row['file_path']) ?>" class="btn btn-success btn-sm" download>Download</a>
                                </li>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <li class="list-group-item">No materials found.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    
    <?php else: ?>
                <div class="alert alert-warning text-center">
                    Please <a href="login.php" class="alert-link">log in</a> to upload and view study materials.
                </div>
    <?php endif; ?>
    </main>
    <section class="footer" style="background-color: rgba(35, 35, 35, 0.947);">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 border-top">
            <div id="footer_text" class="col-md-4 d-flex align-items-center">
                <a href="#" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1 px-3">
                    <img src="styles/logo.svg" width="40px" alt="GUB community forum logo">
                </a>
                <p class="mb-3 mb-md-0">© 2024 GUB Community Forum</p>
            </div>
        </footer>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>