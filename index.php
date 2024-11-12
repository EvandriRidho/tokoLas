<?php
    require 'koneksi.php';
    $queryProduk = mysqli_query($con, "SELECT id, nama, foto, detail FROM produk LIMIT 6");
    $queryKategori = mysqli_query($con, "SELECT * FROM kategori")
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karyaputracollection</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php  require 'navbar.php';?>
    
    <!-- Banner -->
    <div class="container-fluid banner d-flex align-items-center">
        <div class="container text-center">
            <h1>Karya Putra Collection</h1>
            <h3>Mau Cari Apa?</h3>
            <div class="col-md-8 offset-md-2">
                <form method="GET" action="produk.php">
                    <div class="input-group input-group-lg my-4">
                        <input type="text" class="form-control" placeholder="Cari Produk" aria-label="Cari Produk" aria-describedby="basic-addon2" name="keyword" autocomplete="off">
                        <button type="submit" class="btn thirth-color">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--  Kategori -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Kategori</h3>
            <div class="row mt-5">
                <?php while($data = mysqli_fetch_array($queryKategori)) { ?>
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-tangga d-flex align-items-center justify-content-center">
                        <h4><a href="produk.php?kategori=<?php echo $data['nama']; ?>" class="no-decoration"><?php echo $data['nama']; ?></a></h4>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>


    <!-- Tentang Kami -->
    <div class="container-fluid thirth-color py-5">
        <div class="container">
            <div class="row text-center text-lg-start">
                <div class="col-lg-6 mb-4 mb-lg-0">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3333.2839941058173!2d106.732392841346!3d-6.526099207704554!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c3fabd9b8b85%3A0x4c8ae064f23319c8!2sBengkel%20las%20listrik%20K.P.C!5e0!3m2!1sen!2sus!4v1731403502471!5m2!1sen!2sus" 
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                </div>
                <div class="col-lg-6">
                    <h3>Tentang Kami</h3>
                    <p class="fs-5 mt-3 ">
                        Layanan jasa bengkel las listrik untuk kebutuhan aksesoris rumah, kantor, apartemen, dan fasilitas umum yang membutuhkan produk-produk besi dengan model tertentu.
                    </p>
                    <h3>Temui Kami di </h3>
                    <div class="social-media mt-4 d-flex justify-content-md-start justify-content-center gap-4">
                        <a href="https://wa.me/6285959133189" target="_blank">
                            <i class="fab fa-whatsapp fs-2" style="color: black;"></i>
                        </a>
                        <a href="#" target="_blank">
                            <i class="fab fa-instagram fs-2" style="color: black;"></i>
                        </a>
                        <a href="#" target="_blank">
                            <i class="fa-solid fa-cart-shopping fs-2" style="color: black;"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Produk -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Gallery Produk</h3>
            <div class="row mt-5"> 
                <?php while($data = mysqli_fetch_array($queryProduk)) { ?>
                <div class="col-sm-6 col-md-4 mb-3">
                    <div class="card">
                        <img src="image/<?php echo $data['foto']; ?>" class="card-img-top" alt="<?php echo $data['nama']; ?>" style="height: 250px; object-fit: cover; object-position: center">
                        <div class="card-body"> 
                            <h5><?php echo $data['nama']; ?></h5>
                            <p class="card-text text-truncate"><?php echo $data['detail']; ?></p>
                            <a href="produk-detail.php?nama=<?php echo $data['nama']; ?>" class="btn secondary-color">Detail Product</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <a class="btn btn-outline-warning mt-3" href="produk.php">See More</a>
        </div>
    </div>

    <?php  require 'footer.php';?>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>