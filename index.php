<?php
    require ("admin/function.php");
    session_start();
    if(isset($_SESSION['loginc'])){
        header("Location:indexlog.php");
        exit;
    }
    // $wedding = query ('SELECT * FROM paket_layanan WHERE nama_paket LIKE "Wedding%";');
    $paket = query ('SELECT * FROM paket_layanan;');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Update Bootstrap Version -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
        <!-- Add Google Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap">
        <!-- Add Font Awesome Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <style>
            body {
                font-family: 'Montserrat', sans-serif;
                background: #f8f8f8;
            }
            .carousel-caption {
                background: rgba(0, 0, 0, 0.7);
                border-radius: 10px;
                color: white;
                font-weight: 600;
                backdrop-filter: blur(5px);
            }
            h2 {
                font-size: 35px;
            }
            .mid {
                text-align: center;
                padding: 25px;
                border-collapse: collapse;
            }
            .atas {
                padding: 13px;
            }
            footer {
                text-align: center;
                padding: 3px 0;
                background-color: #212529;
                color: white;
            }
            .nolink a {
                text-decoration: none;
                color: black;
            }
            .pesan:hover {
                background-color: #D8D8D8;
                transition: background-color 0.3s;
            }
            .foot1 {
                padding-top: 5px;
            }
            .karoselimg {
                height: 490px;
                border-bottom-left-radius: 10px;
                border-bottom-right-radius: 10px;
            }
            .kacarosel {
                background: rgba(255, 255, 255, 0.14);
                border-radius: 10px; border: 1px solid #fff;
                box-shadow: 0 0 6px 0 rgba(29, 29, 29, 0.21);
                color: black;
                font-weight: 600;
                backdrop-filter: blur(5px)
            }
            .kartu:has(:hover, :focus) {
                --img-scale: 1.1;
                --title-color: #28666e;
                --link-icon-translate: 0;
                --link-icon-opacity: 1;
                box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;
            }
            .btn-outline-success {
                border-color: #4CAF50;
                color: #4CAF50;
            }
            .btn-outline-success:hover {
                background-color: #4CAF50;
                color: white;
            }
            .card {
                border-radius: 10px;
                box-shadow: 0 0 6px 0 rgba(0, 0, 0, 0.16), 0 0 0 1px rgba(0, 0, 0, 0.06);
                color: black;
                font-weight: 600;
                backdrop-filter: blur(5px);
                transition: all 0.3s;
            }
            .card:hover {
                transform: scale(1.05);
                box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2), 0 0 0 2px rgba(0, 0, 0, 0.1);
            }
            @media (max-width: 768px) {
                .karoselimg {
                    height: 250px;
                }
                .carousel-caption {
                    font-size: 14px;
                }
                .kacarosel {
                    font-size: 12px;
                }
                .kartu {
                    width: 100%;
                    margin: 10px;
                }
            }

            @media (max-width: 576px) {
                h2 {
                    font-size: 24px;
                }
                .carousel-caption {
                    font-size: 12px;
                }
                .kacarosel {
                    font-size: 10px;
                }
            }
            @media (max-width: 1000px) {
                .peta {
                    height: 250px;
                    width: 300px;
                }
            }
        </style>
        <title>Adeabbasy.project</title>
    </head>
    <body style="background: white;">
        <!-- navbar starts -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-light sticky-top atas">
            <div class="container-fluid" style="font-size: 20px;">
                <a class="navbar-brand" href="index.php" style="font-size: 22px;">Adeabbasy.project</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#layanan">Layanan</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Lainnya
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#lokasi">Lokasi</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class='d-flex' role='search'>
                        <a href="login.php"><button class="btn btn-outline-success me-2">Login</button></a>
                        <a href="register.php"><button class="btn btn-outline-success">Register</button></a>
                    </div>
                </div>
            </div>
        </nav>
        <!-- navbar ends -->

        <div id="home" class="text-center text-light justify-content-between" style="height: 100%; background: #526D82; box-shadow: 0 0 6px 0 rgba(29, 29, 29, 0.21);">
            <!-- carousel starts -->
            <div id="carouselExampleCaptions" class="carousel slide container-fluid justify-content-between" style="width: 75%;">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="assets/karosel3.jpg" class="d-block w-100 karoselimg" alt="..." >
                        <div class="carousel-caption kacarosel">
                            <h5>Elegance</h5>
                            <p>Adeabbasy.project menyediakan layanan dekorasi yang elegan.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="assets/karosel2.jpg" class="d-block w-100 karoselimg" alt="...">
                        <div class="carousel-caption kacarosel">
                            <h5>Classy</h5>
                            <p>Adeabbasy.project menyediakan layanan dekorasi yang berkelas.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="assets/karosel1.jpg" class="d-block w-100 karoselimg" alt="...">
                        <div class="carousel-caption kacarosel">
                            <h5>Simplicity</h5>
                            <p>Adeabbasy.project menyediakan layanan dekorasi yang sederhana dan berkualitas.</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <!-- carousel ends -->
            <div id="about" class="row align-items-center mt-4 mb-5 nolink">
                <!-- About Us Start -->
                <div class="col-md-12 mt-2 pt-2">
                    <h2>Adeabbasy.project</h2>
                    <img src="assets/Logo1.png" alt="..." style="height: 200px; width: 300px;">
                    
                </div>
                <div class="col-md-6">
                    <h5>Mengapa harus Adeabbasy.project?</h5>
                    <p style="font-size: 20px;">Setiap dekor yang kami berikan selalu lebih baik dari ekspektasi customer.<br>
                    Karena kami bekerja dengan memberikan usaha yang maksimal.</p>
                </div>
                <div class="col-md-6" style="border-left: 5px solid;">
                    <h5>Kontak</h5>
                    <p style="font-size: 20px;">
                        Jl. Sudirman SH, RT. 004, Kel. Baru, Kec. Arut Selatan, <br>
                        Kab. Kotawaringin Barat, Kalimantan Tengah
                    </p>
                    <a href="https://wa.me/6282227774402" target=”_blank” style="text-decoration: none; color: white;"><p style="font-size: 20px;"><span class="fa-brands fa-whatsapp fa-lg"></span> 085646857429</p></a>
                    <a href="https://www.instagram.com/adeabbasy.project/" target=”_blank” style="text-decoration: none; color: white;"><p style="font-size: 20px;"><span class="fa-brands fa-instagram fa-lg"></span> adeabbasy.project</p></a>
                </div>
            </div>
                <!-- About Us Ends -->
                <!-- Layanan Starts -->
            <div id="layanan" class="row align-items-center mt-4 mb-5 nolink" style="background: #A8A4CE;">
                <div class="col-md-12 pt-3" style="border-top: 10px solid;">
                    <h2>Layanan</h2>
                </div>
                <div class="col-md-12">
                    <h5>Layanan Paket Dekorasi</h5>
                    <h6>Untuk event selain wedding ditetapkan harga awal<br> Rp. 1.500.000,- dengan tambahan sesuai kebutuhan.</h6>
                </div>
                <?php
                $i = 1;
                foreach($paket as $row) :
                ?>
                <div class="col-xl-4 pt-5 pb-5">
                    <div class="col-6 card text-dark mx-auto kartu" style="width: 370px;">
                        <img src="assets/<?= $row['gambar_paket']; ?>" class="card-img-top" alt="..." style="height: 360px;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['nama_paket']; ?></h5>
                            <p class="card-text"><?= $row['deskripsi_paket']; ?></p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                Rp. <?= number_format($row["harga_paket"],0,',','.'); ?>,-
                            </li>
                        </ul>
                        <a href="pesan.php">
                            <div class="card-body pesan">
                                <div class="card-link">Pesan</div>
                            </div>
                        </a>
                    </div>
                </div>
                <?php $i++; ?>
                <?php endforeach; ?>
            </div>
            <div class="mid">
                <h2 id="lokasi">Lokasi</h2><br>
                <iframe src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=-2.692041, 111.629014&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed" class="peta" width="1000" height="500" frameborder="0" style="border: 10px solid #333" allowfullscreen="" aria-hidden="false" tabindex="0" ></iframe>
            </div>
        </div>
        <footer>
            <div class="foot1">
                <p>Author: Romi Ramadhan</p>
                <p>ramadhanromi77@gmail.com</p>
            </div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
</html>