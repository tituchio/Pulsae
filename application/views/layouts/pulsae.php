<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pulsae.com | Cepat-Mudah-Murah</title>

    <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/css/freelancer.css'); ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <script src="<?php echo base_url('assets/js/libs/angular.min.js'); ?>" type="text/javascript"></script>

</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#page-top"><img src="<?php echo base_url('assets/img/p-logo-transparent.gif'); ?>">
 Pulsae.Com</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="#pricelist">Tabel Harga</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#howto">Cara Pembelian</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#about">Tentang Kami</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#contact">Hubungi Kami</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img class="img-responsive" src="<?php echo base_url('assets/img/pulsae-logo-green.png'); ?>" alt="">
                    <div class="intro-text">
                        <span class="name">Butuh Pulsa Korea?</span>
                        <hr class="star-light">
                        <a href="#pricelist" class="btn btn-lg btn-outline">
	                        <i class="fa fa-shopping-cart"></i> Beli Sekarang
	                    </a>
						<span class="skills"> - </span>
                        <a href="<?php echo base_url('files/cara-pembelian-pulsae-20150103.jpg'); ?>" target="_blank" class="btn btn-lg btn-outline">
	                        <i class="fa fa-download"></i> Beli Nanti
	                    </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Portfolio Grid Section -->
    <section id="pricelist">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Tabel Harga</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <?php echo $template['body']; ?>  
        </div>
    </section>

    <!-- About Section -->
    <section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Tentang Pulsae.com</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2">
                    <p>Pulsae.com adalah sebuah layanan penjualan pulsa Korea untuk warga Indonesia di Korea Selatan. Kami menyediakan kebutuhan pulsa lokal Korea dan pulsa telepon ke Indonesia.</p>
                </div>
                <div class="col-lg-4">
                    <p>Pulsae.com is a Korean phone voucher sales service for Indonesian in South Korea. We provide local korean phone voucher and Indonesian international call voucher. </p>
                </div>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <a href="<?php echo base_url('files/cara-pembelian-pulsae-20150103.jpg'); ?>" target="_blank" class="btn btn-lg btn-outline">
                        <i class="fa fa-download"></i> Download Harga & Cara Beli
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div id="contact" class="footer-col col-md-4">
                        <h3>Kontak</h3>
                        <p>Kakao : titusid2504 <br/>(Senin-Jumat)</p>
                        <p>Email : pulsaeshop@gmail.com <br/>(Senin-Jumat)</p>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>Mengapa Harus Pulsae.com?</h3>
                        <p>Kami memberikan layanan yang cepat, tanpa proses registrasi di website yang rumit. <br/>
                        	<b><i>"Kepuasan Anda adalah tanggung jawab Kami"</i></b>
                        </p>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>Nomor Rekening</h3>
                        <p>Kookmin Bank (KB) <br/>
						Account No : 733702-00-124921 <br/>
						</p>
						<p>NongHyup Bank (NH) <br/>
						Account No : 302-0752-3333-11 <br/>
						</p>
						<p>Hana Bank<br/>
						Account No : 880-910461-66007 <br/>
						</p>
						<p>a.n DAMAIYANTI TITUS IRMA
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; Pulsae <?php echo date("Y"); ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll visible-xs visble-sm">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>


    <!-- jQuery -->
    <script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/pbs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="<?php echo base_url('assets/js/classie.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/cbpAnimatedHeader.js'); ?>"></script>

    <!-- Contact Form JavaScript -->
    <script src="<?php echo base_url('assets/js/jqBootstrapValidation.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/contact_me.js'); ?>"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url('assets/js/freelancer.js'); ?>"></script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-58341540-1', 'auto');
  ga('send', 'pageview');

</script>

</body>

</html>
