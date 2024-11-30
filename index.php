<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="styles/logo.svg" type="image/x-icon" />
    <title>GUB Community Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="styles/style.css" />
</head>

<body>
    <!-- header -->
    <section class="header">
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
                            <a class="nav-link active hover_blue" aria-current="page" href="http://localhost/GCF/forum.php">Forum</a>
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


    <!-- hero section -->
     <section class="hero">
        <div class="container">
            <div class="px-4 pt-5 my-5 text-center border-bottom">
                <h1 class="display-4 fw-bold text-body-emphasis">Welcome to <span class="color_green">Green Univeristy</span> Community Forum</h1>
                <div class="col-lg-6 mx-auto">
                  <p class="lead mb-4">This platform is designed to help students, especially new ones, connect with resources, ask questions, and share experiences about university life. Browse through our categories or post a new topic to start a discussion!</p>
                  <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
                    <a href="http://localhost/GCF/forum.php" class="text-decoration-none btn btn-primary btn-lg px-4 me-sm-3">Open Forum</a>
                    <a href="https://green.edu.bd/" class="text-decoration-none btn btn-outline-secondary btn-lg px-4">GUB Webpage</a>
                  </div>
                </div>
                <div class="overflow-hidden">
                  <div class="container-sm px-5">
                    <div id="carouselExampleIndicators" class="carousel slide">
                        <div class="carousel-indicators">
                          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                            <img src="styles/green1.png" class="d-block w-100"  alt="Green Univeristy main building">
                          </div>
                          <div class="carousel-item">
                            <img src="styles/green2.png" class="d-block w-100"  alt="Green Univeristy Main building">
                          </div>
                          <div class="carousel-item">
                            <img src="styles/green3.png" class="d-block w-100"  alt="Green University Annex Building">
                          </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Next</span>
                        </button>
                      </div>
                  </div>
                </div>
              </div>
        </div>
        
     </section>
     
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

      

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
