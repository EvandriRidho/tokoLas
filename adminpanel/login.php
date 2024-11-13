<?php
    session_start();
    require "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image" href="../assets/hammer-solid.svg" />
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<style>
    .main {
        height: 100vh;
    }
    .login-box {
        width: 500px;
        height: 300px;
        box-sizing: border-box;
        border-radius : 10px;
    }
    .alert {
        width: 500px;
    }
</style>
<body>
    <div class="main d-flex flex-column justify-content-center align-items-center">
        <div class="login-box p-5 shadow">
            <form action="" method="POST">
                <div>
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" autocomplete="off">
                </div>
                <div class="my-2">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div>
                    <button class="btn btn-success form-control my-3" type="submit" name="loginbtn">Login</button>
                </div>
                <span>Bukan Admin? <a href="../index.php">Kembali</a></span>
            </form>
        </div>

        <div class="mt-3 alert">
            <?php
                if(isset($_POST['loginbtn'])) {
                    $username = htmlspecialchars($_POST['username']);
                    $password = htmlspecialchars($_POST['password']);

                    // Ambil data user dari database berdasarkan username
                    $query = mysqli_query($con, "SELECT * FROM users WHERE username = '$username'");
                    $countdata = mysqli_num_rows($query);
                    $data = mysqli_fetch_array($query);

                    if($countdata > 0) {
                        // Verifikasi password yang diinput dengan hash yang ada di database
                        if(password_verify($password, $data['password'])) {
                            $_SESSION['login'] = true;
                            header("Location: index.php");
                            exit();
                        } else {
                            ?>
                                <div class="alert alert-warning" role="alert">
                                    Password salah!
                                </div>
                            <?php
                        }
                    } else {
                        ?>
                            <div class="alert alert-warning" role="alert">
                                Akun Tidak Ditemukan!
                            </div>
                        <?php
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>
