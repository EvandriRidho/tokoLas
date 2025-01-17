<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami</title>
    <link rel="icon" type="image" href="./assets/hammer-solid.svg" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .about-container {
            margin-top: 30px;
        }
        .social-media a {
            margin: 0 10px;
            font-size: 24px;
            color: #000;
        }
    </style>
</head>
<body>
    <?php require 'navbar.php'; ?>

    <!-- Banner -->
    <div class="container-fluid banner-tentang-kami d-flex align-items-center">
        <div class="container">
            <h1 class="text-center text-white">Tentang Kami</h1>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-5">
        <div class="row about-container">
            <!-- Google Map Section -->
            <div class="col-lg-6 mb-4">
                <div class="about-map ratio ratio-4x3">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.056971150441!2d144.95373631531626!3d-37.81720977975197!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d470f1f8f4f%3A0x5045675218ce6e0!2sFederation%20Square!5e0!3m2!1sen!2sus!4v1614564347852!5m2!1sen!2sus" 
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        aria-label="Lokasi di Peta Google">
                    </iframe>
                </div>
            </div>

            <!-- About Us Text Section -->
            <div class="col-lg-6">
                <h3>Tentang Kami</h3>
                <p class="fs-5 mt-3">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vehicula ante sed sem dictum, eget eleifend ipsum elementum. Maecenas eget eros eu ligula tempor consequat. Aenean hendrerit sapien ut orci fermentum, in dapibus ipsum facilisis. Vivamus ut felis at justo dictum sollicitudin. In hac habitasse platea dictumst. Aliquam vehicula sem ut risus venenatis, non varius odio ultricies. Donec interdum est quis mauris auctor, id volutpat metus convallis. Phasellus venenatis, justo vitae pharetra tincidunt, ipsum magna ultricies nulla, id lobortis nunc sem eget libero. Sed tempus, mauris in interdum fermentum, ipsum leo tincidunt ligula, sit amet dictum orci leo sit amet augue.

                </p>

                <!-- Social Media Links -->
                <div class="social-media mt-4 d-flex justify-content-md-start justify-content-center gap-4">
                    <a href="#" target="_blank" aria-label="WhatsApp">
                        <i class="fab fa-whatsapp fs-2" style="color: black;"></i>
                    </a>
                    <a href="#" target="_blank" aria-label="Instagram">
                        <i class="fab fa-instagram fs-2" style="color: black;"></i>
                    </a>
                    <a href="#" target="_blank" aria-label="Blibli Merchant">
                        <i class="fa-solid fa-cart-shopping fs-2" style="color: black;"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php require 'footer.php'; ?>
    
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>
