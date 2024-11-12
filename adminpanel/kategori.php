<?php
    require "session.php";
    require "../koneksi.php";

    // MENGAMBIL CATEGORI DARI DB   
    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");
    $jumlahKategori = mysqli_num_rows($queryKategori);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>
<style>
    .no-decoration {
        text-decoration: none;
    }
</style>
<body>
    <?php require "navbar.php" ?>
    <div class="container mt-5">
        <!-- breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="index.php" class="no-decoration text-muted">
                        <i class="fas fa-home"></i> Beranda</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                        Kategori
                </li>
            </ol>
        </nav>

        <!-- FORM TAMBAH KATEGORI -->
        <div class="my-5 col-12 col-md-6">
            <h3>Tambah Kategori</h3>
            <form action="" method="POST">
                <div>
                    <label for="kategori">Kategori</label>
                    <input type="text" name="kategori" id="kategori" placeholder="Masukkan Kategori" class="form-control" required autocomplete="off">
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary" type="submit" name="simpan_kategori">Simpan</button>
                </div>
            </form>
            <?php   
                if(isset($_POST['simpan_kategori'])) {
                    $kategori = htmlspecialchars($_POST['kategori']);

                    // untuk mengecek apakah kategori sudah ada di database
                    $queryExist = mysqli_query($con, "SELECT nama FROM kategori WHERE nama = '$kategori'" );
                    $jumlahDataKategoriBaru = mysqli_num_rows($queryExist);
                    
                    // Aksi untuk jika data sudah ada atau belum ada
                    if($jumlahDataKategoriBaru > 0) {
            ?>
                        <div class="alert alert-warning mt-3" role="alert">
                                Kategori Sudah Ada
                        </div>
            <?php
                    } else {
                        $querySimpan = mysqli_query($con, "INSERT INTO kategori (nama) VALUES('$kategori')");
                        if($querySimpan) {
            ?>
                                <div class="alert alert-primary mt-3" role="alert">
                                    Kategori Berhasil Disimpan
                                </div>
                                <!-- Untuk Merefresh page setiap 1 detik -->
                                <meta http-equiv="refresh" content="1; url=kategori.php">
            <?php
                        } else {
                            echo mysqli_error($con);
                        }
                    }
                } 
            ?>
        </div>

        <div class="mt-3">
            <h2>List Kategori</h2>
            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Kategori</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if($jumlahKategori == 0) {
                        ?>
                            <tr>
                                <td colspan="3" class="text-center">Data Kategori tidak tersedia</td>
                            </tr>
                        <?php
                            } else {
                                $number = 1;
                                while($data = mysqli_fetch_array($queryKategori)) {
                        ?>
                                    <tr>
                                        <td><?php echo $number; ?></td>
                                        <td><?php echo $data['nama']; ?></td>
                                        <td>
                                            <a href="kategori-detail.php?p=<?php echo $data['id']; ?>" 
                                            class="btn btn-info"><i class="fas fa-search"></i></a>
                                        </td>
                                    </tr>
                        <?php
                                    $number++;
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>