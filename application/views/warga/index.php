<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hi-Care &mdash; System Pembayaran Iuran </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Hi-care Payment System Powered By: Kanzu Group" />
    <meta name="keywords" content="hi-care, hicare, pembayaran iuran bukit permai" />
    <meta name="author" content="kanpa.co.id" />
    <meta property="og:image" content="<?= base_url('assets'); ?>/images/logo_e/hi.png" />

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content="" />
    <meta property="og:image" content="" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="" />
    <meta property="og:description" content="" />
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />

    <link href="https://fonts.googleapis.com/css?family=Space+Mono" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
    <link rel="shortcut icon" href="<?= base_url('assets'); ?>/images/logo_e/hi.png" />

    <!-- Animate.css -->
    <link rel="stylesheet" href="<?= base_url('assets/profile'); ?>/css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="<?= base_url('assets/profile'); ?>/css/icomoon.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="<?= base_url('assets/profile'); ?>/css/bootstrap.css">

    <!-- Theme style  -->
    <link rel="stylesheet" href="<?= base_url('assets/profile'); ?>/css/style.css">
    <script src="<?= base_url('assets/profile'); ?>/js/modernizr-2.6.2.min.js"></script>

</head>

<body>

    <div class="fh5co-loader"></div>

    <div id="page">
        <header id="fh5co-header" class="fh5co-cover js-fullheight" role="banner"
            style="background-image:url(assets/profile/images/bp122.jpg);" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 text-center">
                        <div class="display-t js-fullheight">
                            <div class="display-tc js-fullheight animate-box" data-animate-effect="fadeIn">
                                <div class="profile-thumb"
                                    style="background: url(assets/images/logo_e/HI-CARE-lan.png);">
                                </div>
                                <h1><span>Hi-Care System Payment</span></h1>
                                <h3><span>System Pembayaran Iuran Online / By: Kanzu Group</span></h3>
                                <p>
                                <div class="wrap">
                                    <button class="button" id="signin-button">Sign in</button>
                                </div>
                                </p>
                                <p>
                                    <br><br>
                                <ul class="fh5co-social-icons">
                                    <div class="flip-cover-twiter "></div>
                                    <div class="flip-cover-linkedin "></div>
                                    <div class="flip-cover-email"></div>
                                </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>

    <script>
    document.getElementById("signin-button").addEventListener("click", function() {
        window.location.href = "<?php echo site_url('Auth'); ?>";
    });
    </script>

    <!-- jQuery -->
    <script src="<?= base_url('assets/profile'); ?>/js/jquery.min.js"></script>
    <!-- jQuery Easing -->
    <script src="<?= base_url('assets/profile'); ?>/js/jquery.easing.1.3.js"></script>
    <!-- Bootstrap -->
    <script src="<?= base_url('assets/profile'); ?>/js/bootstrap.min.js"></script>
    <!-- Waypoints -->
    <script src="<?= base_url('assets/profile'); ?>/js/jquery.waypoints.min.js"></script>
    <!-- Stellar Parallax -->
    <script src="<?= base_url('assets/profile'); ?>/js/jquery.stellar.min.js"></script>
    <!-- Main -->
    <script src="<?= base_url('assets/profile'); ?>/js/main.js"></script>
    <script src="<?= base_url('assets/profile'); ?>/js/style.js"></script>
</body>

</html>