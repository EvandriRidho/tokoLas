<?php
    require "session.php";
    require "../koneksi.php";

    // MENGAMBIL Product DARI DB   
    $queryProduk = mysqli_query($con, "SELECT a.*, b.nama as nama_kategori FROM produk a JOIN kategori b ON a.kategori_id = b.id");
    $jumlahProduk = mysqli_num_rows($queryProduk);

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>
<style>
    .no-decoration {
        text-decoration: none;
    }
    form div {
        margin-bottom: 10px;
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
                        Produk
                </li>
            </ol>
        </nav>

        <!-- Tambah Product -->
        <div class="my-5 col-12 col-md-6">
            <h3>Tambah Produk</h3>
            <form action="" method="POST" enctype="multipart/form-data">
                <!-- Masukkan Nama Product -->
                <div>
                    <label for="nama">Nama Produk</label>
                    <input type="text" name="nama" id="nama" placeholder="Masukkan Nama Produk" class="form-control" required autocomplete="off">
                </div>
                <!-- Input Category -->
                <div>
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" required>
                        <?php 
                            while($data  = mysqli_fetch_array($queryKategori)) {
                                ?>
                                    <option value="
                                        <?php echo $data['id'];?>"><?php echo $data['nama']; ?>
                                    </option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
                <!-- Input image -->
                <div>
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <!-- Detail Product -->
                <div>
                    <label for="detail">Detail</label>
                    <textarea name="detail" id="detail" class="form-control" cols="30" rows="10" required>
                        
                    </textarea>
                </div>
                <!-- Ketersedian Stock -->
                <div>
                    <label for="ketersediaan_stok">Ketersedian Stok</label>
                    <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                        <option value="tersedia">Tersedia</option>
                        <option value="habis">Habis</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                </div>
            </form>

            <!-- Validasi BE -->
            <?php
                if(isset($_POST['simpan'])) {
                    $nama = htmlspecialchars($_POST['nama']);
                    $kategori = htmlspecialchars($_POST['kategori']);
                    $detail = htmlspecialchars($_POST['detail']);
                    $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);

                    // Upload Gambar
                    $target_dir = "../image/";
                    $nama_file = basename($_FILES["image"]["name"]);
                    $target_file = $target_dir . $nama_file;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $image_size = $_FILES["image"]["size"];
                    $random_name = generateRandomString(20);
                    $new_name = $random_name . "." . $imageFileType;

                    if(empty($nama) || empty($kategori) ) {
                        ?>
                            <div class="alert alert-warning mt-3" role="alert">
                                Field Tidak Boleh Kosong
                            </div>
                        <?php
                    } else {
                        if($nama_file!= '') {
                            if($image_size > 1000000) {
                        ?>
                            <div class="alert alert-warning mt-3" role="alert"> 
                                File tidak boleh lebih dari 1mb
                            </div>
                        <?php
                        } else {
                            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                        ?>
                                <div class="alert alert-warning mt-3" role="alert">
                                    File harus .jpg atau .png atau .jpeg
                                </div>
                        <?php
                            } else {
                                // Jika semua kondisi sudah terpenuhi
                                move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $new_name);
                            }
                        }
                    }
                    // Memasukan data ke product tabel
                    $queryTambahProduk = mysqli_query($con, "INSERT INTO produk (kategori_id, nama, foto, detail, ketersediaan_stok) VALUES('$kategori', '$nama', '$new_name', '$detail', '$ketersediaan_stok')");
                        
                    if($queryTambahProduk) {
                    ?>
                        <div class="alert alert-primary mt-3" role="alert">
                            Produk Berhasil Disimpan
                        </div>
                        <meta http-equiv="refresh" content="1; url=produk.php">
                    <?php
                    } else {
                        echo mysqli_error($con);
                    }
                }
            }
            ?>

        <div>

        <!-- Table List Product -->
        </div class="mt-3 mb-5">
            <h2>List Produk</h2>
            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>ketersediaan Stok</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if($jumlahProduk == 0) {
                                ?>
                                    <tr>
                                        <td colspan="6" class="text-center">Data Produk tidak tersedia</td>
                                    </tr>
                                <?php
                            } else {
                                $jumlah = 1;
                                while($data = mysqli_fetch_array($queryProduk)) {
                                ?>
                                    <tr>
                                        <td><?php echo $jumlah; ?></td>
                                        <td><?php echo $data['nama']; ?></td>
                                        <td><?php echo $data['nama_kategori']; ?></td>
                                        <td><?php echo $data['ketersediaan_stok']; ?></td>
                                        <td>
                                            <a href="produk-detail.php?p=<?php echo $data['id']; ?>" 
                                            class="btn btn-info"><i class="fas fa-search"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                $jumlah++;
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