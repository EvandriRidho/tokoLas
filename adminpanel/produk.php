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

// Function to handle file upload
function uploadFile($file) {
    $target_dir = "../image/";
    $file_name = basename($file["name"]);
    $target_file = $target_dir . $file_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $image_size = $file["size"];
    $random_name = generateRandomString(20);
    $new_name = $random_name . "." . $imageFileType;

    if ($image_size > 1000000) {
        return ['error' => 'File tidak boleh lebih dari 1MB'];
    }

    if (!in_array($imageFileType, ['jpg', 'png', 'jpeg'])) {
        return ['error' => 'File harus .jpg atau .png atau .jpeg'];
    }

    if (move_uploaded_file($file["tmp_name"], $target_dir . $new_name)) {
        return ['success' => $new_name];
    }

    return ['error' => 'Gagal mengupload file'];
}

// Handle Form Submission
if (isset($_POST['simpan'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $kategori = htmlspecialchars($_POST['kategori']);
    $detail = htmlspecialchars($_POST['detail']);
    $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);

    if (empty($nama) || empty($kategori)) {
        $message = 'Field Tidak Boleh Kosong';
    } else {
        $imageUpload = uploadFile($_FILES['image']);
        if (isset($imageUpload['error'])) {
            $message = $imageUpload['error'];
        } else {
            $new_name = $imageUpload['success'];
            $stmt = $con->prepare("INSERT INTO produk (kategori_id, nama, foto, detail, ketersediaan_stok) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param('issss', $kategori, $nama, $new_name, $detail, $ketersediaan_stok);
            if ($stmt->execute()) {
                $message = 'Produk Berhasil Disimpan';
                echo "<meta http-equiv='refresh' content='1; url=produk.php'>";
            } else {
                $message = 'Gagal menyimpan produk: ' . $con->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link rel="icon" type="image" href="../assets/hammer-solid.svg" />
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>
<style>
    .no-decoration { text-decoration: none; }
    form div { margin-bottom: 10px; }
</style>
<body>
    <?php require "navbar.php"; ?>
    <div class="container mt-5">
        <!-- breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="index.php" class="no-decoration text-muted">
                        <i class="fas fa-home"></i> Beranda</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Produk</li>
            </ol>
        </nav>

        <!-- Tambah Product -->
        <div class="my-5 col-12">
            <h3>Tambah Produk</h3>
            <form action="" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="nama">Nama Produk</label>
                    <input type="text" name="nama" id="nama" placeholder="Masukkan Nama Produk" class="form-control" required autocomplete="off">
                </div>
                <div>
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" required>
                        <?php while ($data = mysqli_fetch_array($queryKategori)) { ?>
                            <option value="<?= $data['id']; ?>"><?= $data['nama']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div>
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <div>
                    <label for="detail">Detail</label>
                    <textarea name="detail" id="detail" class="form-control" cols="30" rows="10" required></textarea>
                </div>
                <div>
                    <label for="ketersediaan_stok">Ketersediaan Stok</label>
                    <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                        <option value="tersedia">Tersedia</option>
                        <option value="habis">Habis</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                </div>
            </form>

            <?php if (isset($message)) { ?>
                <div class="alert alert-warning mt-3" role="alert"><?= $message; ?></div>
            <?php } ?>
        </div>

        <!-- Table List Product -->
        <div class="mt-3 mb-5">
            <h2>List Produk</h2>
            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Ketersediaan Stok</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($jumlahProduk == 0) { ?>
                            <tr>
                                <td colspan="5" class="text-center">Data Produk tidak tersedia</td>
                            </tr>
                        <?php } else { 
                            $jumlah = 1;
                            while ($data = mysqli_fetch_array($queryProduk)) { ?>
                                <tr>
                                    <td><?= $jumlah; ?></td>
                                    <td><?= $data['nama']; ?></td>
                                    <td><?= $data['nama_kategori']; ?></td>
                                    <td><?= $data['ketersediaan_stok']; ?></td>
                                    <td>
                                        <a href="produk-detail.php?p=<?= $data['id']; ?>" class="btn btn-info"><i class="fas fa-search"></i></a>
                                    </td>
                                </tr>
                            <?php $jumlah++; }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>
