<div class="x_panel">
   <div class="x_title">
      <h2>Detail Item</h2>
     <div class="clearfix"></div>
   </div>

   <div class="x_content">
      <div class="row">
         <div class="col-md-5 col-sm-6">
            <img src="<?= base_url(); ?>assets/upload/<?= $gambar; ?>" style="width:100%">
         </div>
         <div class="col-md-6 col-sm-6">
            <table class="table table-striped">
               <tr>
                  <td width="100px;">Nama Item</td>
                  <td>: <?= $nama_item; ?></td>
               </tr>
               <tr>
                  <td width="100px;">Harga Item</td>
                  <td>: <?= 'Rp. '.number_format($harga, 0, ',','.'); ?></td>
               </tr>
               <tr>
                  <td width="100px;">Berat</td>
                  <td>: <?= $berat; ?> gr</td>
               </tr>
               <tr>
                  <td width="100px;">Status</td>
                  <td>: <?php if($status == 1) { echo 'Aktif'; } else { echo 'Tidak Aktif'; } ?></td>
               </tr>
               <tr>
                  <td width="100px;">Deskripsi</td>
                  <td>: <?= nl2br($deskripsi); ?></td>
               </tr>
               <tr>
                  <td width="100px;">Kategori</td>
                  <?php
                  $value = '';
                  foreach ($kategori->result() as $k) {
                     $value .= ', '.$k->kategori;
                  }
                  ?>
                  <td>: <?= trim($value, ', '); ?></td>
               </tr>
            </table>
            <a href="<?=base_url();?>item/update_item/<?=$id_item;?>" class="btn btn-warning">Edit</a>
            <a href="#" class="btn btn-default" onclick="window.history.go(-1)">Kembali</a>
         </div>
      </div>
   </div>
</div>
