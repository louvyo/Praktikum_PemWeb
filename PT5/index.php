<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Louvy Store</title>
    <link rel="stylesheet" href="style.css" />

    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="dark.css"> -->
</head>

<body>
    <!-- header -->
    <header>
        <a href="" class="logo">Louvy</a>

        <ul class="navlist">
            <li><a href="#home">Home</a></li>
            <li><a href="#featured">Featured</a></li>
            <li><a href="#aboutme">About Me</a></li>
        </ul>

        <div class="header-icons">
            <a href="#"><i class="bx bx-shopping-bag"></i></a>
            <div class="bx bx-menu" id="menu-icon"></div>
            <button id="loginButton" onclick="showLoginPopup()">Login</button>
        </div>

        <div class="darkmode">
            <input type="checkbox" id="dark-mode-toggle" onchange="darkmode()" />
            <label for="dark-mode-toggle"></label>
        </div>
    </header>

    <!-- Pop-up Coupon -->
    <div class="popup-container" id="couponPopup">
        <div class="popup">
            <span class="close-button" onclick="hideCouponPopup()">X</span>
            <h2>Congratulations</h2>
            <p>You can get</p>
            <div class="discount">75% off</div>
            <p>Here is your code</p>
            <div class="code">AEZAKMI</div>
            <button class="btn" id="redeemCouponBtn" onclick="hideCouponPopup()">Redeem</button>
        </div>
    </div>

    <!-- Pop-up Login Form -->
    <div class="popup-container" id="loginPopup">
        <div class="popup">
            <span class="close-button" onclick="hideLoginPopup()">X</span>
            <h2>Login</h2>
            <form action="admin_login.php" method="post">
                <div class="form-group">
                    <label for="popup-username"><i class="bx bxs-user"></i></label>
                    <input type="text" id="popup-username" name="popup-username" required autocomplete="off" />
                </div>
                <div class="form-group">
                    <label for="popup-password"><i class="bx bxs-lock-alt"></i></label>
                    <input type="password" id="popup-password" name="popup-password" required />
                </div>
                <button type="submit" class="login-button">Login</button>
            </form>
            
            <?php
            if (isset($error_message)) {
                echo '<p>' . $error_message . '</p>';
            }
            ?>
        </div>
    </div>

    <!-- Home -->
    <section class="home" id="home">
        <div class="home-text">
            <h1>Men's New <br /><span>Arrivals</span></h1>
            <p>New colors, now also available in men's sizing</p>
            <a href="#featured" class="btn">View Collection</a>
        </div>
    </section>

    <!-- featured -->
    <section class="featured" id="featured">
        <div class="center-text">
            <h2>Featured Categories</h2>
        </div>

        <div class="featured-content">
            <div class="row">
                <div class="image-container">
                    <img src="img/have_faith-removebg-preview.png" />
                </div>
                <div class="fea-text">
                    <h5>Jacket</h5>
                    <p>10 items</p>
                </div>
                <div class="arrow">
                    <a href="#"><i class="bx bx-right-arrow-alt"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="image-container">
                    <img src="img/O-removebg-preview.png" />
                </div>
                <div class="fea-text">
                    <h5>Pants</h5>
                    <p>10 items</p>
                </div>
                <div class="arrow">
                    <a href="#"><i class="bx bx-right-arrow-alt"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="image-container">
                    <img src="img/image-removebg-preview (3).png" />
                </div>
                <div class="fea-text">
                    <h5>Shirt</h5>
                    <p>10 items</p>
                </div>
                <div class="arrow">
                    <a href="#"><i class="bx bx-right-arrow-alt"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="image-container">
                    <img src="img/image-removebg-preview (4).png" />
                </div>
                <div class="fea-text">
                    <h5>Bags</h5>
                    <p>10 items</p>
                </div>
                <div class="arrow">
                    <a href="#"><i class="bx bx-right-arrow-alt"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- aboutme -->
    <section class="aboutme" id="aboutme">
        <div class="photocard">
            <img src="img/Huda.png" alt="Foto Profil" id="profile-image" />
        </div>
        <div class="info">
            <h1>Saya <span>Huda</span><br />biasa dipanggil nengok</h1>
            <br />
            <h2>Miftahul Huda</h2>
            <p>Tanggal Lahir: 31 Mei 2004</p>
            <p>Alamat: Jl. Soekarno Hatta, Loa Janan Ilir</p>
            <p>Email: miftahulh654@gmail.com</p>
            <p>Telepon: +62 851 6363 1059</p>
        </div>
    </section>

    <!-- contact -->
    <section class="contact" id="contact">
        <div class="main-contact">
            <h3>Louvy</h3>
            <h5>Rock the World</h5>
            <div class="icons">
                <a href=""><i class="bx bxl-facebook"></i></a>
                <a href="https://www.instagram.com/hulooo._/"><i class="bx bxl-instagram"></i></a>
                <a href=""><i class="bx bxl-twitter"></i></a>
            </div>
        </div>

        <div class="main-contact">
            <h3>Explore</h3>
            <li><a href="#home">Home</a></li>
            <li><a href="#featured">Featured</a></li>
            <li><a href="#aboutme">About Me</a></li>
        </div>

        <div class="main-contact">
            <h3>Shopping</h3>
            <li><a href="">Clothing Store</a></li>
            <li><a href="">Trend</a></li>
            <li><a href="">Accessories</a></li>
        </div>
    </section>

    <footer class="last-text">
        <p>Copyright &copy; 2023 All rights reserved | Louvy.</p>
    </footer>
    <a href="#" class="top"><i class="bx bx-up-arrow-alt"></i></a>

    <!-- custom js link -->
    <script src="script.js"></script>
    </body>

</html>