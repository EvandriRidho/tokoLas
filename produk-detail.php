<?php
    require 'koneksi.php';

    $nama = htmlspecialchars($_GET['nama']);
    $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE nama = '$nama'");
    $produk = mysqli_fetch_array($queryProduk);

    $queryProdukTerkait = mysqli_query($con, "SELECT * FROM produk WHERE kategori_id = '$produk[kategori_id]' AND id!= '$produk[id]' LIMIT 4");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail-Produk</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require 'navbar.php' ?>
    
    <!-- Detail Produk -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mb-5">
                    <img src="image/<?php echo $produk['foto']; ?>" alt="<?php echo $produk['nama']; ?>" height="300px">
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <h1><?php echo $produk['nama']; ?></h1>
                    <p  class="fs-5"><?php echo $produk['detail']; ?></p>
                    <p>Status Ketersediaan : <strong><?php echo $produk['ketersediaan_stok']; ?></strong></p>
                    <button class="btn secondary-color">
                        <a href="https://wa.me/6285959133189" target="_blank" style="color: black ; text-decoration: none">
                            For Detail Price Click Me!
                        </a>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Produk Terkait -->
    <div class="container-fluid py-5 secondary-color">
        <div class="container">
            <h2 class="text-center mb-5">Produk Terkait</h2>
            <div class="row">
                <?php while($data = mysqli_fetch_array($queryProdukTerkait)) {  ?>
                    <div class="col-md-6 col-lg-3 mb-3">
                            <img src="image/<?php echo $data['foto']; ?>" alt="<?php echo $data['nama']; ?>" class="img-fluid img-thumbnail produk-terkait-image">
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php require 'footer.php';?>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>