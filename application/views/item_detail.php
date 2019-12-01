<h4><i class="fa fa-search-plus"></i> Detail Item</h4>
<hr />
<br />
<?php
$key = $data->row();
?>

<div class="row">
   <div class="col m3 s12 offset-m1">
      <!-- Gambar Item -->
      <img src="<?= base_url(); ?>/assets/upload/<?= $key->gambar; ?>" class="responsive-img" alt="">
   </div>
   <div class="col m7 s12 offset-m1">
      <!-- Detail Item -->
      <table class="responsive-table bordered striped">
         <tr>
            <td style="width:30%; text-align: right; vertical-align: top">Nama Barang :</td>
            <td><?= ucfirst($key->nama_item); ?></td>
         </tr>
         <tr>
            <td style="width:30%; text-align: right; vertical-align: top">Harga Barang :</td>
            <td><?= 'Rp. '.number_format($key->harga, 0, ',', '.'); ?></td>
         </tr>
         <tr>
            <td style="width:30%; text-align: right; vertical-align: top">Berat Barang :</td>
            <td><?= number_format($key->berat, 0, ',', '.').' gr'; ?></td>
         </tr>
         <tr>
            <td style="width:30%; text-align: right; vertical-align: top">Kategori :</td>
            <td>
               <?php
               $val = '';
               foreach ($kat->result() as $value) {
                  $val .= ', '.$value->kategori;
               }

               echo trim($val, ', ');
               ?>
            </td>
         </tr>
         <tr>
            <td style="width:30%; text-align: right; vertical-align: top">Deskripsi :</td>
            <td><?= ucfirst(nl2br($key->deskripsi)); ?></td>
         </tr>
      </table>
      <br />
      <button type="button" class="btn red waves-effect waves-light" onclick="window.history.go(-1)">Kembali</button>
      <a href="<?= base_url(); ?>cart/add/<?= $key->id_item; ?>" class="btn blue waves-effect waves-light"><i class="fa fa-shopping-cart"></i> Add to Cart</a>
   </div>
</div>
