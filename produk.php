<?php
    require 'koneksi.php';

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");
    // Get Product by keyword
    if(isset($_GET['keyword'])) {
        $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE nama LIKE '%$_GET[keyword]%'");
    }
    // Get Product by kategori
    else if (isset($_GET['kategori'])) {
        $queryGetKategoriId = mysqli_query($con, "SELECT id FROM kategori WHERE nama = '$_GET[kategori]'");
        $kategoriId = mysqli_fetch_array($queryGetKategoriId);
        $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE kategori_id = $kategoriId[id]");
    }
    // Get product default
    else {
        $queryProduk = mysqli_query($con, "SELECT * FROM produk");
    }

    $countData = mysqli_num_rows($queryProduk);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link rel="icon" type="image" href="./assets/hammer-solid.svg" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require 'navbar.php' ?>

    <!-- Banner -->
    <div class="container-fluid banner-produk d-flex align-items-center">
        <div class="container">
            <h1 class="text-center text-white">Aneka Produk Las</h1>
        </div>
    </div>

    <!-- Main -->
    <!-- Kategori -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3 mb-5">
                <h3>Kategori</h3>
                <ul class="list-group">
                    <?php while($kategori = mysqli_fetch_array($queryKategori)) { ?>
                    <a class="no-decoration" href="produk.php?kategori=<?php echo $kategori['nama']; ?>">
                        <li class="list-group-item"><?php echo $kategori['nama']; ?></li>
                    </a>
                    <?php } ?>
                </ul>
            </div>
            
            <!-- Produk -->
            <div class="col-lg-9">
                <h3 class="text-center mb-3">Aneka Produk Las</h3>
                <div class="row">
                    <?php
                        if($countData < 1) {
                    ?>
                        <h4 class="text-center my-5">Produk Tidak Ditemukan</h4>
                    <?php
                        }
                    ?>

                    <?php while($produk = mysqli_fetch_array($queryProduk)) { ?>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="image/<?php echo $produk['foto']; ?>" class="card-img-top" alt="<?php echo $produk['nama']; ?>" style="height: 250px; object-fit: cover; object-position: center">
                                <div class="card-body"> 
                                    <h5><?php echo $produk['nama']; ?></h5>
                                    <p class="card-text text-truncate"><?php echo $produk['detail']; ?></p>
                                    <a href="https://wa.me/6285959133189" target="_blank" class="btn secondary-color">
                                        Detail Price Click Me!
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <?php require 'footer.php';?>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>