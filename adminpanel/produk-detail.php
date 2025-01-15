<?php
require "session.php";
require "../koneksi.php";

$id = $_GET['p'];

// Mengambil data produk berdasarkan ID
$query = mysqli_query($con, "SELECT a.*, b.nama as nama_kategori FROM produk a JOIN kategori b ON a.kategori_id = b.id WHERE a.id = '$id'");
$data = mysqli_fetch_array($query);

// Mengambil daftar kategori selain kategori yang dipilih produk
$queryKategori = mysqli_query($con, "SELECT * FROM kategori WHERE id!='$data[kategori_id]'");

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
    <title>Detail Produk</title>
    <link rel="icon" type="image" href="../assets/hammer-solid.svg" />
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<style>
    form div {
        margin-bottom: 10px;
    }
</style>
<body>
    <?php require "navbar.php" ?>

    <div class="container mt-5">
        <h2>Detail Produk</h2>

        <div class="col-12 col-md-6 mb-5">
            <form action="" method="POST" enctype="multipart/form-data">
                <div>
                    <label>Nama Produk</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="<?php echo htmlspecialchars($data['nama']); ?>" required autocomplete="off">
                </div>
                <div>
                    <label for="kategori">Kategori</label>
                    <Select name="kategori" id="kategori" class="form-control" required>
                        <option value="<?php echo $data['kategori_id']; ?>"><?php echo $data['nama_kategori']; ?></option>
                        <?php
                            while($dataKategori = mysqli_fetch_array($queryKategori)) {
                        ?>
                            <option value="<?php echo $dataKategori['id']; ?>"><?php echo $dataKategori['nama']; ?></option>
                        <?php
                            }
                        ?>
                    </Select>   
                </div>
                <div>
                    <label for="currentFoto">Image Produk</label>
                    <img src="../image/<?php echo htmlspecialchars($data['foto']); ?>" alt="img-product" width="100px">
                </div>
                <div>
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <div>
                    <label for="detail">Detail</label>
                    <textarea name="detail" id="detail" class="form-control" cols="30" rows="10"><?php echo htmlspecialchars($data['detail']); ?></textarea>
                </div>
                <div>
                    <label for="ketersediaan_stok">Ketersediaan Stok</label>
                    <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                        <option value="<?php echo htmlspecialchars($data['ketersediaan_stok']); ?>"><?php echo htmlspecialchars($data['ketersediaan_stok']); ?></option>
                        <option value="<?php echo ($data['ketersediaan_stok'] == 'tersedia') ? 'habis' : 'tersedia'; ?>">
                            <?php echo ($data['ketersediaan_stok'] == 'tersedia') ? 'Habis' : 'Tersedia'; ?>
                        </option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
                </div>
            </form>

            <?php
            // Untuk Mengupdate Produk
            if (isset($_POST['simpan'])) {
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

                // Mengecek Required sisi BE
                if (empty($nama) || empty($kategori)) {
                    echo '<div class="alert alert-warning mt-3" role="alert">Field Tidak Boleh Kosong</div>';
                } else {
                    $queryUpdate = mysqli_query($con, "UPDATE produk SET kategori_id = '$kategori', nama = '$nama', detail = '$detail', ketersediaan_stok = '$ketersediaan_stok' WHERE id = '$id'");

                    // Jika file gambar diupload
                    if ($nama_file != "") {
                        if ($image_size > 1000000) {
                            echo '<div class="alert alert-warning mt-3" role="alert">File tidak boleh lebih dari 1mb</div>';
                        } else {
                            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                                echo '<div class="alert alert-warning mt-3" role="alert">File harus .jpg atau .png atau .jpeg</div>';
                            } else {
                                // Jika semua kondisi sudah terpenuhi
                                move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $new_name);
                                $queryUpdate = mysqli_query($con, "UPDATE produk SET foto = '$new_name' WHERE id = '$id'");

                                if ($queryUpdate) {
                                    echo '<div class="alert alert-primary mt-3" role="alert">Produk Berhasil DiUpdate</div>';
                                    echo '<meta http-equiv="refresh" content="1; url=produk.php">';
                                } else {
                                    echo mysqli_error($con);
                                }
                            }
                        }
                    }
                }
            }

            // Untuk Menghapus Produk
            if (isset($_POST['hapus'])) {
                $queryHapus = mysqli_query($con, "DELETE FROM produk WHERE id = '$id'");

                if ($queryHapus) {
                    echo '<div class="alert alert-primary mt-3" role="alert">Product Berhasil Dihapus</div>';
                    echo '<meta http-equiv="refresh" content="1; url=produk.php">';
                } else {
                    echo mysqli_error($con);
                }
            }
            ?>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
