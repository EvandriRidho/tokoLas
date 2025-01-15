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
                        <button type="submit" class="btn third-color text-white">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Kategori -->
    <div class="container-fluid py-5">
    <div class="container text-center">
        <h3 class="fw-bold mb-4">Kategori</h3>
        <div class="row mt-5">
            <?php if ($queryKategori->num_rows > 0): ?>
                <?php while($data = $queryKategori->fetch_array()) { ?>
                    <div class="col-md-4 mb-4">
                        <div class="highlighted-kategori kategori-box d-flex align-items-center justify-content-center p-4 rounded shadow-sm bg-light">
                            <h4 class="fs-5 fw-semibold mb-0">
                                <a href="produk.php?kategori=<?php echo htmlspecialchars($data['nama'], ENT_QUOTES); ?>" class="no-decoration text-dark hover-text-primary">
                                    <?php echo htmlspecialchars($data['nama'], ENT_QUOTES); ?>
                                </a>
                            </h4>
                        </div>
                    </div>
                <?php } ?>
            <?php else: ?>
                <p class="text-muted">Tidak ada kategori yang tersedia.</p>
            <?php endif; ?>
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
                                <button href="#" target="_blank"class="btn secondary-color" >
                                    Detail Price Click Me!
                                </button>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php else: ?>
                <p class="text-muted">Tidak ada produk yang tersedia.</p>
            <?php endif; ?>
        </div>
        <a class="btn secondary-color mt-4 px-4" href="produk.php">See More</a>
    </div>
</div>

<!-- Testimoni Pelanggan -->
<div class="container-fluid third-color pt-3 pb-5">
    <div class="container text-center text-white">
        <h3 class="fw-bold mb-4">Apa Kata Pelanggan Kami?</h3>
        <div class="row mt-4 justify-content-center">
            <!-- Testimoni 1 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card bg-light text-dark shadow-lg rounded-3">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center" style="width: 50px; height: 50px;">
                                <i class="fas fa-user fs-4"></i>
                            </div>
                            <h5 class="ms-3 mb-0">Bapak Agus</h5>
                        </div>
                        <p class="card-text fst-italic text-muted">
                            "Pelayanan sangat memuaskan, hasil pengerjaan rapi dan sesuai dengan permintaan."
                        </p>
                        <span class="text-secondary fw-bold">Bogor</span>
                    </div>
                </div>
            </div>
            <!-- Testimoni 2 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card bg-light text-dark shadow-lg rounded-3">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center" style="width: 50px; height: 50px;">
                                <i class="fas fa-user fs-4"></i>
                            </div>
                            <h5 class="ms-3 mb-0">Ibu Santi</h5>
                        </div>
                        <p class="card-text fst-italic text-muted">
                            "Harga terjangkau dengan kualitas yang luar biasa. Terima kasih, Toko Las!"
                        </p>
                        <span class="text-secondary fw-bold">Depok</span>
                    </div>
                </div>
            </div>
            <!-- Testimoni 3 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card bg-light text-dark shadow-lg rounded-3">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center" style="width: 50px; height: 50px;">
                                <i class="fas fa-user fs-4"></i>
                            </div>
                            <h5 class="ms-3 mb-0">Pak Joko</h5>
                        </div>
                        <p class="card-text fst-italic text-muted">
                            "Sangat cepat dan hasilnya sesuai ekspektasi. Pasti akan kembali lagi!"
                        </p>
                        <span class="text-secondary fw-bold">Jakarta</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




    <?php require 'footer.php'; ?>

    <script src="bootstrap/js/bootstrap.bundle.min.js" defer></script>
    <script src="fontawesome/js/all.min.js" defer></script>
</body>
</html>
