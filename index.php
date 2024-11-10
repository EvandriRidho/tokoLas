<?php
    require 'koneksi.php';
    $queryProduk = mysqli_query($con, "SELECT id, nama, foto, detail FROM produk LIMIT 6");
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
                        <input type="text" class="form-control" placeholder="Cari Produk" aria-label="Cari Produk" aria-describedby="basic-addon2" name="keyword">
                        <button type="submit" class="btn thirth-color">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Highligted Kategori -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Highligted Category</h3>

            <div class="row mt-5">
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-tangga d-flex align-items-center justify-content-center ">
                        <h4><a href="produk.php?kategori=Canopy" class="no-decoration">Canopy</a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-tangga d-flex align-items-center justify-content-center ">
                        <h4><a href="produk.php?kategori=Jendela" class="no-decoration">Jendela</a></h4>
                    </div>
                </div> 
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-tangga d-flex align-items-center justify-content-center ">
                        <h4><a href="produk.php?kategori=Pagar" class="no-decoration">Pagar</a></h4>
                    </div>
                </div> 
                </div> 
            </div>
        </div>
    </div>

    <!-- Tentang Kami -->
    <div class="container-fluid thirth-color py-5">
        <div class="container text-center">
            <h3>Tentang Kami</h3>
            <p class="fs-5 mt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin varius ligula ac nulla tempor, non vehicula lacus venenatis. Curabitur fringilla mauris sed lacus vehicula, sed faucibus ligula cursus. Integer ut tortor nisl. Nam bibendum metus sed tortor aliquet, in vestibulum nisi efficitur. Nulla facilisi. Phasellus convallis eros id odio fermentum, at consequat nulla volutpat. Donec pharetra tellus ac lacus varius malesuada. Vivamus auctor nulla quis ligula fringilla, sit amet pellentesque eros viverra</p>
        </div>
    </div>

    <!-- Produk -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Produk</h3>
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