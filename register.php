<?php
    require 'admin/function.php';
    if (isset($_POST['register'])){
        if(registrasi($_POST) > 0){
            echo "<script>
                    alert('Berhasil Register')
                </script>";
            header('location:login.php');
            exit;
        } else {
            echo "<script>
                    alert('Gagal Register')
                </script>";
            echo mysqli_error($conn);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI';
            text-decoration: none;
        }
        body {
            width: 100vw;
            height: 100vh;
            display: grid;
            place-items: center;
            background-image: url('assets/bglogin2.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }
        .form-container {
            color: white;
            width: 380px;
            background-color: rgba(255, 255, 255, 0.237);
            display: flex;
            margin: 5px;
            flex-direction: column;
            gap: 20px;
            padding: 30px 20px 150px 20px;
            text-align: center;
            border-radius: 10px;
            position: absolute;
            top: 50%;
            left: 50%;
            z-index: 997;
            transform: translate(-50%, -50%);
            border: 1px solid #fff;
            box-shadow: 0 0 6px 0 rgba(29, 29, 29, 0.21);
        }
        .kembali {
            position: absolute;
            z-index: 999;
            top: 75%;
            margin-left: 10px;
        }
        input {
            padding: 8px 10px;
            border-radius: 10px;
            border: none;
            outline: none;
        }
        input[type='textarea'] {
            padding: 8px 10px;
            border-radius: 10px;
            height: 60px;
            border: none;
            outline: none;
        }
        input[type='submit'] {
            padding: 8px;
            border-radius: 8px;
            border: none;
            font-weight: 500;
            background-color: rgb(5, 211, 183);
            color: rgba(0, 0, 0, 0.699);
            cursor: pointer;
            font-size: 15px;
        }
        input[type='submit']:hover {
            background-color: rgb(8, 204, 178);
        }
        input[type='submit']:active {
            background-color: rgb(45, 241, 215);
        }
        .kembali button {
            padding: 8px;
            border-radius: 8px;
            width: 338px;
            border: none;
            font-weight: 500;
            background-color: rgb(5, 211, 183);
            color: rgba(0, 0, 0, 0.699);
            cursor: pointer;
            font-size: 15px;
        }
        .kembali button:hover {
            background-color: rgb(8, 204, 178);
        }
        .kembali button:active {
            background-color: rgb(45, 241, 215);
        }
        .login {
            position: absolute;
            display: flex;
            justify-content: center;
            gap: 6px;
            align-items: center;
            z-index: 998;
            color: white;
            top: 81%;
        }
        .login a {
            color: white;
        }
        .login a:hover {
            text-decoration: underline;
        }
    </style>
    <title>Registrasi | Adeabbasy.project</title>
</head>
<body>
    <form action="" method="post" class="form-container">
        <h2>Register</h2>
        <input type="text" id="namacust" name="namacust" placeholder="Nama" required>
        <input type="textarea" id="alamat" name="alamat" placeholder="Alamat" required>
        <input type="text" id="nohp" name="nohp" placeholder="No. HP" required>
        <input type="email" id="email" name="email" placeholder="Email" required>
        <input type="password" id="pass" name="pass" placeholder="Password" required>
        <input name="register" type="submit" value="Register">
    </form>
    <a href="index.php" class="kembali"><div>
        <button>Kembali</button>
    </div></a>
    <div class="login">Sudah punya akun? <a href="login.php">Login</a></div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const nohpInput = document.getElementById("nohp");
            
            nohpInput.addEventListener("input", function() {
                const value = nohpInput.value;
                
                if (!/^\d{6,15}$/.test(value)) {
                    nohpInput.setCustomValidity("No. HP harus berupa angka, minimal 6 digit, dan maksimal 15 digit.");
                } else {
                    nohpInput.setCustomValidity("");
                }
            });
        });
    </script>
</body>
</html>