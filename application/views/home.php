<?php
if ($data->num_rows() > 0) {

   if (isset($url)) {
      echo '<h4>List Item Pada Kategori "' . $url . '"</h4><hr />';
   }
   ?>
   <div class="row text-center">
      <?php
         //Columns must be a factor of 12 (1,2,3,4,6,12)
         $numOfCols = 3;
         $numOfColsMd = 2;
         $rowCount = 0;
         $bootstrapColWidth = 12 / $numOfCols;
         $bootstrapColMd = 12 / $numOfColsMd;
         ?>
      <div class="row text-center">
         <?php
            foreach ($data->result() as $key) {
               ?>
            <div class="col-lg-<?php echo $bootstrapColWidth; ?> col-md-<?= $bootstrapColMd; ?>">
               <div class="card" style="width: auto; float:left;">
                  <img src="<?= base_url(); ?>assets/upload/<?= $key->gambar; ?>" class="card-img-top img-fluid responsive-image" alt="...">
                  <div class="card-body">
                     <h5 class="card-title">
                        <?php
                              $my_string = $key->nama_item;
                              if (strlen($my_string) > 15) {
                                 $my_string = trim(substr($my_string, 0, 15)) . "&hellip;";
                              }
                              echo $my_string;
                              ?>
                     </h5>
                     <p class="card-text">Rp. <?= number_format($key->harga, 0, ',', '.'); ?></p>
                     <div class="card-action">
                        <a href="<?= base_url(); ?>home/detail/<?= $key->id_item; ?>" class="waves-effect waves-light btn-flat blue white-text"><i class="fa fa-search-plus"></i>&nbsp; Detail</a>
                        <a href="<?= base_url(); ?>cart/add/<?= $key->id_item; ?>" class="waves-effect waves-light btn-flat green white-text"><i class="fa fa-cart-plus" aria-hidden="true"></i>&nbsp; Beli</a>
                     </div>
                  </div>
               </div>
            </div>
         <?php
               $rowCount++;
               if ($rowCount % $numOfCols == 0) echo '</div><div class="row">';
            }
            ?>
      </div>


      <!-- <div class="col s12 m3">
            <div class="card">
               <div class="card-image">
                  <img src="<?= base_url(); ?>assets/upload/<?= $key->gambar; ?>">
               </div>
               <div class="card-content">
                  <span class="card-title"><?= $key->nama_item; ?></span>
                  <p>Rp. <?= number_format($key->harga, 0, ',', '.'); ?></p>
               </div>
               <div class="card-action">
                  <a href="<?= base_url(); ?>home/detail/<?= $key->id_item; ?>" class="waves-effect waves-light btn-flat blue white-text"><i class="fa fa-search-plus"></i>&nbsp; Detail</a>
                  <a href="<?= base_url(); ?>cart/add/<?= $key->id_item; ?>" class="waves-effect waves-light btn-flat green white-text"><i class="fa fa-shopping-cart"></i>&nbsp; Tambah Ke Cart</a>
               </div>
            </div>
         </div> -->
   </div>
<?php
} else {
   echo '<h4>Kategori "' . $url . '" Masih Kosong</h4><hr />';
}
?>