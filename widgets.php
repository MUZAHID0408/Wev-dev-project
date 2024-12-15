<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="styles/logo.svg" type="image/x-icon">
    <title>Community Forum Widgets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="styles/widgets.css">
</head>

<body>

    <section class="header">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="styles/logo.svg" height="60px"
                        alt="GUB community forum logo"></a>
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
                            <a class="nav-link active hover_blue" aria-current="page" href="http://localhost/GCF/forum.php">Forum</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link hover_blue" href="http://localhost/GCF/index.php#resources">Resource</a>
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

    <!-- widgets card section -->

    <div class="container mt-5">
        <div class="row">
            <!-- Study Group Finder Card -->
            <div class="col-md-4">
                <div class="card">
                    <img src="assets/images/studyGroup.jpg" width="150px" class="card-img-top" alt="Study Group Finder">
                    <div class="card-body">
                        <h5 class="card-title">Study Group Finder</h5>
                        <p class="card-text">Find and join study groups based on your courses or subjects.</p>
                        <a href="#" class="btn btn-primary">Find Study Groups</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="assets/images/tutoringService.jpg" class="card-img-top" alt="Tutoring Services">
                    <div class="card-body">
                        <h5 class="card-title">Tutoring Services</h5>
                        <p class="card-text">Connect with tutors or mentors for additional academic support.</p>
                        <a href="#" class="btn btn-primary">Find a Tutor</a>
                    </div>
                </div>
            </div>
            <!-- Q&A Section Card -->
            <div class="col-md-4">
                <div class="card">
                    <img src="assets/images/questionAnswer.jpg" class="card-img-top" alt="Q&A Section">
                    <div class="card-body">
                        <h5 class="card-title">Q&A Section</h5>
                        <p class="card-text">Ask questions and get answers from peers or experts.</p>
                        <a href="#" class="btn btn-primary">Ask a Question</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <!-- Event Calendar Card -->
            <div class="col-md-4">
                <div class="card">
                    <img src="assets/images/eventCalander.jpg" class="card-img-top" alt="Event Calendar">
                    <div class="card-body">
                        <h5 class="card-title">Event Calendar</h5>
                        <p class="card-text">Stay organized with a calendar of upcoming events, deadlines, and important dates.</p>
                        <a href="#" class="btn btn-primary">View Calendar</a>
                    </div>
                </div>
            </div>
            <!-- Polls and Surveys Card -->
            <div class="col-md-4">
                <div class="card">
                    <img src="assets/images/pollsurvey.jpg" class="card-img-top" alt="Polls and Surveys">
                    <div class="card-body">
                        <h5 class="card-title">Polls and Surveys</h5>
                        <p class="card-text">Participate in polls and surveys to share your opinions and feedback.</p>
                        <a href="#" class="btn btn-primary">Take a Poll</a>
                    </div>
                </div>
            </div>


        </div>
    </div>
    </div>
    </div>

    <!-- Footer section -->
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


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>