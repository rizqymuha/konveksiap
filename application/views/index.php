<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Konveksiap</title>
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <!-- Materialize Css -->
   <link rel="stylesheet" href="<?= base_url(); ?>assets/css/materialize.min.css">
   <!-- Font-Awesome -->
   <link rel="stylesheet" href="<?= base_url(); ?>admin_assets/font-awesome/css/font-awesome.min.css">
   <!-- customCss -->
   <link rel="stylesheet" href="<?= base_url(); ?>assets/css/custom.css">
</head>

<body>
   <header>
      <header>
         <nav class="light-blue darken-2">
            <div class="nav-wrapper container">
               <ul id="nav-mobile" class="right hide-on-med-and-down">
                  <li><a href="<?= base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
                  <li><a href="#" class="dropdown-button" data-activates="kat1"><i class="fa fa-tags"></i> Kategori<i class="fa fa-caret-down right"></i></a></li>
                  <ul class="dropdown-content" id="kat1">
                     <?php foreach ($kategori->result() as $kat) : ?>
                        <li>
                           <a href="<?= base_url(); ?>home/kategori/<?= $kat->url; ?>"> <?= $kat->kategori; ?></a>
                        </li>
                     <?php endforeach; ?>
                  </ul>

                  <?php if ($this->session->userdata('user_login')) { ?>

                     <li><a href="#" class="dropdown-button" data-activates="drop1"><i class="fa fa-user"></i> <?= ucwords($this->session->userdata('name')); ?><i class="fa fa-caret-down right"></i></a></li>

                     <ul class="dropdown-content" id="drop1">
                        <li><a href="<?= base_url(); ?>home/profil"><i class="fa fa-user"></i> Profil</a></li>
                        <li><a href="<?= base_url(); ?>home/password"><i class="fa fa-key"></i> Ubah Password</a></li>
                        <li><a href="<?= base_url(); ?>home/transaksi"><i class="fa fa-exchange"></i> Transaksi</a></li>
                        <li><a href="<?= base_url(); ?>home/logout"><i class="fa fa-sign-out"></i> logout</a></li>
                     </ul>
                  <?php } else { ?>

                     <li><a href="<?= base_url(); ?>home/login"><i class="fa fa-sign-in"></i> login</a></li>
                     <li><a href="<?= base_url(); ?>home/registrasi"><i class="fa fa-edit"></i> Daftar</a></li>

                  <?php } ?>
                  <li>
                     <a href="<?= base_url(); ?>cart">
                        <i class="fa fa-shopping-cart"></i>
                        <?php
                        if ($this->cart->total() > 0) {
                           echo 'Rp. ' . number_format($this->cart->total(), 0, ',', '.');
                        } else {
                           echo 'cart';
                        }
                        ?>
                     </a>
                  </li>
               </ul>
               <a href="#" data-activates="slide-out" class="button-collapse"><i class="fa fa-bars"></i></a>
            </div>
            <!-- Side Nav -->
            <ul id="slide-out" class="side-nav">
               <li><a href="<?= base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>

               <li><a href="#" class="dropdown-button" data-activates="kat2"><i class="fa fa-tags"></i> Kategori<i class="fa fa-caret-down right"></i></a></li>

               <ul class="dropdown-content" id="kat2">
                  <?php foreach ($kategori->result() as $kat) : ?>
                     <li>
                        <a href="<?= base_url(); ?>home/kategori/<?= $kat->url; ?>"> <?= $kat->kategori; ?></a>
                     </li>
                  <?php endforeach; ?>
               </ul>

               <?php if ($this->session->userdata('user_login')) { ?>

                  <li><a href="#" class="dropdown-button" data-activates="drop2"><i class="fa fa-user"></i> <?= ucwords($this->session->userdata('name')); ?><i class="fa fa-caret-down right"></i></a></li>

                  <ul class="dropdown-content" id="drop2">
                     <li><a href="<?= base_url(); ?>home/profil"><i class="fa fa-user"></i> Profil</a></li>
                     <li><a href="<?= base_url(); ?>home/password"><i class="fa fa-key"></i> Ubah Password</a></li>
                     <li><a href="<?= base_url(); ?>home/transaksi"><i class="fa fa-exchange"></i> Transaksi</a></li>
                     <li><a href="<?= base_url(); ?>home/logout"><i class="fa fa-sign-out"></i> logout</a></li>
                  </ul>
               <?php } else { ?>

                  <li><a href="<?= base_url(); ?>home/login"><i class="fa fa-sign-in"></i> login</a></li>
                  <li><a href="<?= base_url(); ?>home/registrasi"><i class="fa fa-edit"></i> Daftar</a></li>

               <?php } ?>
               <li><a href="#"><i class="fa fa-shopping-cart"></i> cart</a></li>
            </ul>
         </nav>
      </header>

      <main>
         <div class="jumbotron jumbotron-fluid">
            <div class="container text-center text-white">
               <img src="https://i.ibb.co/rdSHY0M/konveksiap.png" height="230" width="260">
               <p class="lead" style="color:black; font-weight:bold; color:#2c3657;">Kami Selalu Siap Melayani Anda</p>
            </div>
         </div>
         <!-- <div class="toko">
         <img src="assets/img/konveksiap.png" alt="logo" style="width: 230px; height: 200px">
         <p>Kami Selalu Siap Melayani Anda</p>
      </div> -->

         <section class="product py-5">
            <div class="container py-3 py-md-4 text-center">
               <div class="row">
                  <div class="col-lg-12 mb-5">
                     <h3>Produk Kami</h3>
                  </div>
                  <div class="col-lg-12">
                     <?= $content; ?>
                  </div>
               </div>
            </div>
         </section>

         <section class="product_service py-5">
            <div class="container py-3 py-md-4 text-center">
               <div class="row">
                  <div class="col-lg-12 mb-5">
                     <h3>Kami Melayani Pembuatan</h3>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-12 img-fluid mb-4">
                     <h4>Kaos</h4>
                     <img class="rounded" src="https://i.ibb.co/2cmy8t2/konveksi-kaos.jpg">
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-12 img-fluid mb-4">
                     <h4>Kemeja</h4>
                     <img class="rounded" src="https://i.ibb.co/RN6sx4W/konveksi-kemeja.jpg">
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-12 img-fluid mb-4">
                     <h4>Jersey</h4>
                     <img class="rounded" src="https://i.ibb.co/cgbnyX1/konveksi-jersey.jpg">
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-12 img-fluid mb-4">
                     <h4>Sweater</h4>
                     <img class="rounded" src="https://i.ibb.co/zJtT8Gz/konveksi-sweater.jpg">
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-12 img-fluid mb-4">
                     <h4>Jaket</h4>
                     <img class="rounded" src="https://i.ibb.co/5Md5SzT/konveksi-jaket.jpg">
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-12 img-fluid mb-4">
                     <h4>Seragam</h4>
                     <img class="rounded" src="https://i.ibb.co/GQZRg5B/konveksi-seragam.jpg">
                  </div>
               </div>
         </section>

         <section class="about py-5">
            <div class="container py-3 py-md-4 text-center">
               <div class="row">
                  <div class="col-lg-12 mb-5">
                     <h3>Tentang Kami</h3>
                     <img src="https://i.ibb.co/rdSHY0M/konveksiap.png" alt="" style="width: 250px; height:220px; margin-top:10px;">
                  </div>
                  <div class="col-lg-12 mb-4">
                     <p class="text-justify" style="font-size: 20px">Kami adalah jasa konveksi dari bandung yang sudah berpengalaman, kami melayani pembuatan antara lain baju, kaos, kemeja, sepatu, tas, topi, dan lainnya yang mampu menghasilkan produk dalam jumlah besar dengan kualitas tinggi yang dihadirkan pada detail setiap produk sebagai kelebihan kami untuk memuaskan pelanggan dan komitmen kami atas kepercayaan yang diberikan. Kami memenuhi pesanan konveksi dalam jumlah kecil maupun besar dengan waktu pengerjaan yang sesuai dengan ketepatan tanpa mengesampingkan kualitas dengan harga yang bersaing. Produk yang dihasilkanpun tidak semata untuk memenuhi pesanan pelanggan saja, tetapi dirancang khusus untuk menghasilkan kepuasan sebagai bukti komitmen kami.</p>
                  </div>
                  <div class="col-lg-6 mb-5">
                     <a href="tel:+6282210173887"><img src="https://i.ibb.co/5rRcmqv/telepon.png" alt="" style="width:340px; height:120px"></a>
                  </div>
                  <div class="col-lg-6 mb-5">
                     <a href="https://api.whatsapp.com/send?phone=6282210173887"><img src="https://i.ibb.co/k8Ps0vs/whatsapp.png" alt="" style="width:340px; height:120px"></a>
                  </div>
               </div>
            </div>
         </section>

         <section class="qna" id="qna">
            <div class="container py-md-5 py-3">
               <div class="row text-center">
                  <div class="col-sm-12">
                     <h4 class="heading mb-5">Seputar Pertanyaan & Jawaban</h4>
                  </div>
                  <div class="col-lg-5 col-md-12 col-sm-12 offset-lg-1">
                     <p class="mb-3"><a class="btn btn-outline-primary btn-block" data-toggle="collapse" href="#terpercaya" role="button" aria-expanded="false" aria-controls="beliproduk" style="white-space: normal;">Apa saja yang dapat dipesan disini?</a></p>
                     <div class="collapse" id="terpercaya">
                        <div class="card card-body mb-3">Anda dapat memesan berbagai jenis pakaian seragam dan produk jahitan. Seperti <span>kaos, kemeja, jaket dan lain-lain.</span></div>
                     </div>
                  </div>
                  <div class="col-lg-5 col-md-12 col-sm-12">
                     <p class="mb-3"><a class="btn btn-outline-primary btn-block" data-toggle="collapse" href="#beli" role="button" aria-expanded="false" aria-controls="beliproduk" style="white-space: normal;">Apakah desain dapat di custom?</a></p>
                     <div class="collapse" id="beli">
                        <div class="card card-body mb-3">Anda dapat memesan produk sesuai dengan keinginan Anda. Anda dapat menentukan jenis bahan sendiri, memilih warna bahan, mengganti bentuk kerah, memilih bentuk dan warna kancing, menambahkan Scotchlite, dll.</div>
                     </div>
                  </div>
                  <div class="col-lg-5 col-md-12 col-sm-12 offset-lg-1">
                     <p class="mb-3"><a class="btn btn-outline-primary btn-block" data-toggle="collapse" href="#pengajuan" role="button" aria-expanded="false" aria-controls="beliproduk" style="white-space: normal;">Berapa lama waktu produksi?</a></p>
                     <div class="collapse" id="pengajuan">
                        <div class="card card-body mb-3">Waktu produksi ditentukan oleh banyaknya jumlah produk yang ingin Anda pesan, tingkat kerumitan desain, dan ketersediaan bahan. Waktu yang dibutuhkan juga berbeda-beda untuk memproduksi masing-masing jenis produk karena masing-masing produk memiliki tingkat kesulitan tersendiri.</div>
                     </div>
                  </div>
                  <div class="col-lg-5 col-md-12 col-sm-12">
                     <p class="mb-3"><a class="btn btn-outline-primary btn-block" data-toggle="collapse" href="#lokasi" role="button" aria-expanded="false" aria-controls="beliproduk" style="white-space: normal;">Apakah ada minimal pemesanan?</a></p>
                     <div class="collapse" id="lokasi">
                        <div class="card card-body mb-3">Demi menjaga kualitas produk dan layanan, kami menerapkan kebijakan minimal pemesanan atau Minimum Order Quantity (MOQ) : 12 pcs. Namun dalam kondisi tertentu, kami dapat melayani pesanan dibawah jumlah minimum.</div>
                     </div>
                  </div>
                  <div class="col-lg-5 col-md-12 col-sm-12 offset-lg-1">
                     <p class="mb-3"><a class="btn btn-outline-primary btn-block" data-toggle="collapse" href="#janji" role="button" aria-expanded="false" aria-controls="beliproduk" style="white-space: normal;">Berapa harga produk?</a></p>
                     <div class="collapse" id="janji">
                        <div class="card card-body mb-3">Harga untuk setiap produk berbeda-beda. Faktor penentunya adalah 4 hal berikut : banyaknya rencana jumlah pemesanan, jenis bahan yang hendak digunakan, desain yang dipilih, dan deadline/batas waktu.</div>
                     </div>
                  </div>
                  <div class="col-lg-5 col-md-12 col-sm-12">
                     <p class="mb-3"><a class="btn btn-outline-primary btn-block" data-toggle="collapse" href="#claim" role="button" aria-expanded="false" aria-controls="beliproduk" style="white-space: normal;">Bagaimana cara pemesanannya?</a></p>
                     <div class="collapse" id="claim">
                        <div class="card card-body mb-3">Anda cukup menghubungi kami lewat Whatsapp atau Telepon dan memberitahukan 4 hal ini : jumlah order, bahan, desain, dan batas waktu pengerjaan. Selanjutnya, kami akan memberikan informasi order secara langsung ke kontak Anda. <br> Untuk pemesan produk yang kami jual anda bisa langsung memesan dengan cara daftar dan login, kemudian lakukan pemesanan diweb.</div>
                     </div>
                  </div>
                  <div class="col-lg-5 col-md-12 col-sm-12 offset-lg-1">
                     <p class="mb-3"><a class="btn btn-outline-primary btn-block" data-toggle="collapse" href="#cair" role="button" aria-expanded="false" aria-controls="beliproduk" style="white-space: normal;">Bagaimana cara pembayaran?</a></p>
                     <div class="collapse" id="cair">
                        <div class="card card-body mb-3">Pembayaran uang muka (pembayaran pertama) diperlukan sebelum memulai produksi sebagai bentuk komitmen kerja. Besarannya antara 30% - 60% tergantung kesepakatan. Pelunasan dapat dilakukan sebelum pesanan dikirimkan ke daerah Anda atau dapat juga dengan tempo paling lama 30 hari setelah invoice diterima.</div>
                     </div>
                  </div>
                  <div class="col-lg-5 col-md-12 col-sm-12">
                     <p class="mb-3"><a class="btn btn-outline-primary btn-block" data-toggle="collapse" href="#rs" role="button" aria-expanded="false" aria-controls="beliproduk" style="white-space: normal;">Bagaimana apabila ada produk yang cacat/rusak?</a></p>
                     <div class="collapse" id="rs">
                        <div class="card card-body mb-3">Meskipun sebelum dikirimkan pesanan Anda telah diperiksa, ada kemungkinan produk yang cacat/rusak lolos dari pengecekan. Kami memberikan garansi selama 14 hari untuk menjamin kepentingan Anda sebagai pelanggan.</div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- start item -->
         <div class="item">

            <!-- end item -->
         </div>

         <footer class="page-footer light-blue darken-3">
            <div class="container">
               <div class="row">
                  <div class="col l6 s12">
                     <h5 class="white-text">Alamat Toko</h5>
                     <p class="grey-text text-lighten-4">Antapani, Jl. Terusan Sekolah No.1-2, Cicaheum, Kec. Kiaracondong, Kota Bandung, Jawa Barat 40282<br /></p>
                  </div>
                  <div class="col l4 offset-l2 s12">
                     <h5 class="white-text">Hubungi Kami di</h5>
                     <div class="link">
                        <a class="grey-text text-lighten-3" href="https://api.whatsapp.com/send?phone=6282210173887"><i class="fa fa-whatsapp fa-lg"></i> Whatsapp</a>
                        <br>
                        <a class="grey-text text-lighten-3" href="tel:+6282210173887"><i class="fa fa-phone fa-lg"></i> 0822-1017-3887</a>
                        <!-- <a class="grey-text text-lighten-3" href="#!"><i class="fa fa-facebook"></i> Facebook</a>&nbsp;&nbsp;
                        <a class="grey-text text-lighten-3" href="#!"><i class="fa fa-twitter"></i> Twitter</a>&nbsp;&nbsp;
                        <a class="grey-text text-lighten-3" href="#!"><i class="fa fa-google-plus"></i> Google+</a> -->
                     </div>
                  </div>
               </div>
            </div>
            <div class="footer-copyright">
               <div class="container text-center">
                  Copyright &copy; 2019 KonvekSiap.
                  <!-- <span class="grey-text text-lighten-4 right">Develope By <a class="blue-text text-lighten-4" href="https://kangjaz.blogspot.co.id/">Achmad Jazuli</a></span> -->
               </div>
            </div>
         </footer>
      </main>

      <a href="" class="btn-floating btn-large waves-effect waves-light red back-top"><i class="fa fa-angle-double-up"></i></a>

      <!-- Jquery -->
      <script type="text/javascript" src="<?= base_url(); ?>admin_assets/js/jquery.min.js"></script>
      <!-- bootstrap -->
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <!-- materialize -->
      <script type="text/javascript" src="<?= base_url(); ?>assets/js/materialize.min.js"></script>
      <!-- custom -->
      <script type="text/javascript">
         $(".button-collapse").sideNav();
         $(".modal").modal();

         $(document).ready(function() {
            <?php if ($this->uri->segment(1) == 'checkout' || $this->uri->segment(1) == 'Checkout') { ?>

               $('#prov').change(function() {
                  var prov = $('#prov').val();
                  var province = prov.split(',');

                  $.ajax({
                     url: "<?= base_url(); ?>checkout/city",
                     method: "POST",
                     data: {
                        prov: province[0]
                     },
                     success: function(obj) {
                        $('#kota').html(obj);
                     }
                  });
               });

               $('#kota').change(function() {
                  var kota = $('#kota').val();
                  var dest = kota.split(',');
                  var kurir = $('#kurir').val()

                  $.ajax({
                     url: "<?= base_url(); ?>checkout/getcost",
                     method: "POST",
                     data: {
                        dest: dest[0],
                        kurir: kurir
                     },
                     success: function(obj) {
                        $('#layanan').html(obj);
                     }
                  });
               });

               $('#kurir').change(function() {
                  var kota = $('#kota').val();
                  var dest = kota.split(',');
                  var kurir = $('#kurir').val()

                  $.ajax({
                     url: "<?= base_url(); ?>checkout/getcost",
                     method: "POST",
                     data: {
                        dest: dest[0],
                        kurir: kurir
                     },
                     success: function(obj) {
                        $('#layanan').html(obj);
                     }
                  });
               });

               $('#layanan').change(function() {
                  var layanan = $('#layanan').val();

                  $.ajax({
                     url: "<?= base_url(); ?>checkout/cost",
                     method: "POST",
                     data: {
                        layanan: layanan
                     },
                     success: function(obj) {
                        var hasil = obj.split(",");

                        $('#ongkir').val(hasil[0]);
                        $('#total').val(hasil[1]);
                     }
                  });
               });

            <?php } ?>
            $(window).scroll(function() {
               if ($(this).scrollTop() > 100) {
                  $('.back-top').fadeIn();
               } else {
                  $('.back-top').fadeOut();
               }
            });
            $('.back-top').click(function() {
               $("html, body").animate({
                  scrollTop: 0
               }, 600);
               return false;
            });
         });
      </script>
</body>

</html>