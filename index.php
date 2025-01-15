<?php
    require 'koneksi.php';

    $stmtProduk = $con->prepare("SELECT id, nama, foto, detail FROM produk LIMIT 6");
    $stmtProduk->execute();
    $queryProduk = $stmtProduk->get_result();

    $stmtKategori = $con->prepare("SELECT * FROM kategori");
    $stmtKategori->execute();
    $queryKategori = $stmtKategori->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Las</title>
    <link rel="icon" type="image" href="./assets/hammer-solid.svg" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" rel="preload" as="style">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css" rel="preload" as="style">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require 'navbar.php'; ?>
    
    <!-- Banner -->
    <div class="container-fluid banner d-flex align-items-center">
        <div class="container text-center text-white">
            <h1>Toko Las</h1>
            <h3>Mau Cari Apa?</h3>
            <div class="col-md-8 offset-md-2">
                <form method="GET" action="produk.php">
                    <div class="input-group input-group-lg my-4">
                        <input type="text" class="form-control" placeholder="Cari Produk" aria-label="Cari Produk" aria-describedby="basic-addon2" name="keyword" autocomplete="off">
                        <button type="submit" class="btn third-color">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Kategori -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Kategori</h3>
            <div class="row mt-5">
                <?php if ($queryKategori->num_rows > 0): ?>
                    <?php while($data = $queryKategori->fetch_array()) { ?>
                        <div class="col-md-4 mb-3">
                            <div class="highlighted-kategori kategori-box d-flex align-items-center justify-content-center">
                                <h4><a href="produk.php?kategori=<?php echo htmlspecialchars($data['nama'], ENT_QUOTES); ?>" class="no-decoration"><?php echo htmlspecialchars($data['nama'], ENT_QUOTES); ?></a></h4>
                            </div>
                        </div>
                    <?php } ?>
                <?php else: ?>
                    <p class="text-muted">Tidak ada kategori yang tersedia.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Tentang Kami -->
    <div class="container-fluid third-color py-5">
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
                    <p class="fs-5 mt-3">
                        Layanan jasa bengkel las listrik untuk kebutuhan aksesoris rumah, kantor, apartemen, dan fasilitas umum yang membutuhkan produk-produk besi dengan model tertentu.
                    </p>
                    <h3>Temui Kami di </h3>
                    <div class="social-media mt-4 d-flex justify-content-md-start justify-content-center gap-4">
                        <a href="https://wa.me/6285959133189" target="_blank">
                            <i class="fab fa-whatsapp fs-2" style="color: black;"></i>
                        </a>
                        <a href="https://www.instagram.com/rizall_260?igsh=Z2pza21pazU2dDkw" target="_blank">
                            <i class="fab fa-instagram fs-2" style="color: black;"></i>
                        </a>
                        <a href="https://siplah.blibli.com/merchant/dashboard" target="_blank">
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
        <h3 class="mb-4">Gallery Produk</h3>
        <div class="row mt-4">
            <?php if ($queryProduk->num_rows > 0): ?>
                <?php while($data = $queryProduk->fetch_array()) { ?>
                    <div class="col-sm-6 col-md-4 mb-4">
                        <div class="card shadow-sm border-0 rounded-lg overflow-hidden">
                            <img src="image/<?php echo htmlspecialchars($data['foto'], ENT_QUOTES); ?>" class="card-img-top img-fluid" alt="<?php echo htmlspecialchars($data['nama'], ENT_QUOTES); ?>" style="object-fit: cover; object-position: center; height: 250px;">
                            <div class="card-body text-center">
                                <h5 class="card-title mb-2"><?php echo htmlspecialchars($data['nama'], ENT_QUOTES); ?></h5>
                                <p class="card-text text-truncate mb-3"><?php echo htmlspecialchars($data['detail'], ENT_QUOTES); ?></p>
                                <a href="https://wa.me/6285959133189" target="_blank" class="btn btn-warning text-white font-weight-bold">
                                    Detail Price Click Me!
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php else: ?>
                <p class="text-muted">Tidak ada produk yang tersedia.</p>
            <?php endif; ?>
        </div>
        <a class="btn btn-outline-warning mt-4 px-4" href="produk.php">See More</a>
    </div>
</div>


    <?php require 'footer.php'; ?>

    <script src="bootstrap/js/bootstrap.bundle.min.js" defer></script>
    <script src="fontawesome/js/all.min.js" defer></script>
</body>
</html>
