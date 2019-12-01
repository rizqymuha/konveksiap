<div class="x_panel">
   <div class="x_title">
      <h2>Managemen Item</h2>
      <div style="float:right">
         <a href="<?= base_url(); ?>item/add_item" class="btn btn-primary">Tambah Item</a>
      </div>
     <div class="clearfix"></div>
   </div>

   <div class="x_content">
      <div class="row">
         <div class="col-md-12">
            <table class="table table-striped table-bordered dt-responsive nowrap" id="datatable">
               <thead>
                  <tr>
                     <th width="5%">#</th>
                     <th width="45%">Nama Item</th>
                     <th>Harga</th>
                     <th>Status</th>
                     <th width="12%">Opsi</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  $i = 1;
                  foreach($data->result() as $items) :
                  ?>
                  <tr>
                     <td style="vertical-align:middle"><?= $i++; ?></td>
                     <td style="vertical-align:middle"><?= $items->nama_item; ?></td>
                     <td style="vertical-align:middle">
                        <?= 'Rp. '.number_format($items->harga,0,',','.'); ?>
                     </td>
                     <td style="vertical-align:middle;text-align:center">
                        <?php
                        if ($items->status == 1) {
                           echo '<label class="label-success" style="color:white; padding:3px 10px;">Aktif</label>';
                        } else {
                           echo '<label class="label-danger" style="color:white; padding:3px 10px;">Tidak Aktif</label>';
                        }
                        ?>
                     </td>
                     <td>
                        <a href="<?= base_url(); ?>item/detail/<?= $items->id_item; ?>" class="btn btn-success"><i class="fa fa-search-plus"></i></a>
                        <a href="<?= base_url(); ?>item/update_item/<?= $items->id_item; ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                     </td>
                  </tr>
                  <?php endforeach; ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
