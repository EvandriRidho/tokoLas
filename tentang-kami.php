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
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .about-text {
            flex: 1;
            padding: 20px;
        }
        .about-map {
            flex: 1;
            height: 400px;
            margin-right: 20px;
        }
        @media (max-width: 768px) {
            .about-container {
                flex-direction: column;
            }
            .about-map {
                margin-right: 0;
                margin-bottom: 20px;
            }
        }
        .social-media {
            margin-top: 20px;
            display: flex;
            justify-content: center;
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

    <div class="container-fluid banner-tentang-kami d-flex align-items-center">
        <div class="container">
            <h1 class="text-center text-white">Tentang Kami</h1>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="container">
            <div class="about-container">
                <div class="about-map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.056971150441!2d144.95373631531626!3d-37.81720977975197!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d470f1f8f4f%3A0x5045675218ce6e0!2sFederation%20Square!5e0!3m2!1sen!2sus!4v1614564347852!5m2!1sen!2sus" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>

                <div class="about-text">
                    <p class="fs-5 mt-3">
                        Karya Putra Collection adalah perusahaan yang menyediakan layanan jasa bengkel las listrik khusus untuk kebutuhan aksesoris rumah, kantor, apartemen, dan fasilitas umum. Kami berkomitmen untuk memberikan produk-produk besi berkualitas tinggi dengan desain yang sesuai dengan model dan kebutuhan klien. Sejak berdiri pada tahun 2017, Karya Putra Collection telah melayani berbagai proyek, baik skala kecil maupun besar, dengan mengutamakan keakuratan dalam pembuatan serta ketahanan produk yang kami hasilkan. Tim kami yang berpengalaman siap membantu mewujudkan berbagai macam desain aksesoris besi, mulai dari pagar, railing, hingga berbagai produk besi lainnya, yang dapat disesuaikan dengan estetika dan fungsionalitas ruang yang Anda inginkan.
                    </p>
                    <div class="col-lg-6">
                        <div class="social-media mt-4 d-flex justify-content-md-start justify-content-center gap-4">
                            <a href="https://wa.me/6285959133189" target="_blank">
                                <i class="fab fa-whatsapp fs-2" style="color: black;"></i>
                            </a>
                            <a href="https://www.instagram.com/rizall_260?igsh=Z2pza21pazU2dDkw" target="_blank">
                                <i class="fab fa-instagram fs-2" style="color: black;"></i>
                            </a>
                            <a href="https://siplah.blibli.com/merchant-detail/SKPC-0009?itemPerPage=40&page=0&merchantId=SKPC-0009" target="_blank">
                                <i class="fa-solid fa-cart-shopping fs-2" style="color: black;"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require 'footer.php'; ?>
    
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>
