<div class="x_panel">
   <div class="x_title">
      <h2>Managemen Order</h2>
     <div class="clearfix"></div>
   </div>

   <div class="x_content">
      <table class="table table-striped table-bordered dt-responsive nowrap" id="datatable">
         <thead>
            <tr>
               <th width="8%">#</th>
               <th width="20%">Id Order</th>
               <th width="30%">Nama Pemesan</th>
               <th width="15%">Tanggal Pesan</th>
               <th width="15%">Batas Bayar</th>
               <th width="10%">Opsi</th>
            </tr>
         </thead>
         <tbody>
            <?php
            $today = (abs(strtotime(date('Y-m-d'))));
            $i = 1;
            foreach($data->result() as $key) :
               $batas = (abs(strtotime($key->bts_bayar)));
            ?>
            <tr>
               <td style="vertical-align:middle"><?= $i++; ?></td>
               <td style="vertical-align:middle"><?= $key->id_order; ?></td>
               <td style="vertical-align:middle"><?= $key->fullname; ?></td>
               <td style="vertical-align:middle"><?= date('d M Y', strtotime($key->tgl_pesan)); ?></td>
               <td style="vertical-align:middle"><?= date('d M Y', strtotime($key->bts_bayar)); ?></td>
               <td style="vertical-align:middle">
                  <?php if ($batas < $today && $key->status == 'belum') { ?>

                     <a href="<?=base_url();?>transaksi/delete/<?=$key->id_order;?>" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus Data ini ?')"><i class="fa fa-trash"></i></a>

                  <?php } else { ?>

                     <a href="<?=base_url();?>transaksi/konfirmasi/<?=$key->id_order;?>" class="btn btn-success" <?php if ($key->status == 'proses') { echo 'disabled'; } ?>><i class="fa fa-check"></i></a>

                  <?php } ?>

                  <a href="<?=base_url();?>transaksi/detail/<?=$key->id_order;?>" class="btn btn-primary"><i class="fa fa-search-plus"></i></a>
               </td>
            </tr>
            <?php endforeach; ?>
         </tbody>
      </table>
   </div>
</div>
