<?php
require "session.php";
require "../koneksi.php";

$id = mysqli_real_escape_string($con, $_GET['p']);

$query = mysqli_query($con, "SELECT * FROM kategori WHERE id = '$id'");
$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kategori</title>
    <link rel="icon" type="image" href="../assets/hammer-solid.svg" />
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<body>
    <?php require "navbar.php"; ?>
    
    <div class="container mt-5">
        <h2>Detail Kategori</h2>
        <div class="col-12 col-md-6">
            <form action="" method="POST">  
                <div>
                    <label for="kategori">Kategori</label>
                    <input type="text" name="kategori" id="kategori" class="form-control" value="<?php echo htmlspecialchars($data['nama']); ?>" >
                </div>
                <div class="mt-3">
                    <button type="submit" name="editBtn" class="btn btn-primary">Edit</button>
                    <button type="submit" name="deleteBtn" class="btn btn-danger">Delete</button>
                </div>
            </form>
            <?php
            // Untuk Mengedit Kategori
            if (isset($_POST['editBtn'])) {
                $kategori = mysqli_real_escape_string($con, htmlspecialchars($_POST['kategori']));

                if ($data['nama'] == $kategori) {
                    // Jika tidak ada perubahan kategori, kembali ke halaman kategori
                    echo '<meta http-equiv="refresh" content="0; url=kategori.php">';
                } else {
                    $query = mysqli_query($con, "SELECT * FROM kategori WHERE nama = '$kategori'");
                    $jumlahData = mysqli_num_rows($query);

                    if ($jumlahData > 0) {
                        // Kategori sudah ada
                        echo '<div class="alert alert-warning mt-3" role="alert">Kategori Sudah Ada</div>';
                    } else {
                        // Simpan perubahan
                        $querySimpan = mysqli_query($con, "UPDATE kategori SET nama='$kategori' WHERE id='$id'");
                        if ($querySimpan) {
                            echo '<div class="alert alert-primary mt-3" role="alert">Kategori Berhasil Diupdate</div>';
                            echo '<meta http-equiv="refresh" content="1; url=kategori.php">';
                        } else {
                            echo '<div class="alert alert-danger mt-3" role="alert">' . mysqli_error($con) . '</div>';
                        }
                    }
                }
            }

            // Untuk Menghapus Kategori
            if (isset($_POST['deleteBtn'])) {
                $queryCheck = mysqli_query($con, "SELECT * FROM produk WHERE kategori_id = '$id'");
                $isExists = mysqli_num_rows($queryCheck);
                
                if ($isExists > 0) {
                    // Kategori tidak dapat dihapus jika digunakan pada produk
                    echo '<div class="alert alert-warning mt-3" role="alert">Kategori tidak dapat dihapus karena sudah digunakan di produk</div>';
                    die();
                }

                // Hapus kategori jika tidak ada produk terkait
                $queryDelete = mysqli_query($con, "DELETE FROM kategori WHERE id = '$id'");
                if ($queryDelete) {
                    echo '<div class="alert alert-primary mt-3" role="alert">Kategori Berhasil Dihapus</div>';
                    echo '<meta http-equiv="refresh" content="1; url=kategori.php">';
                } else {
                    echo '<div class="alert alert-danger mt-3" role="alert">' . mysqli_error($con) . '</div>';
                }
            }
            ?>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
