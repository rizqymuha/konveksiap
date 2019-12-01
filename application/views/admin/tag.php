<div class="x_panel">
   <div class="x_title">
      <h2>Managemen Kategori</h2>
     <div class="clearfix"></div>
   </div>

   <div class="x_content">
      <div class="row">
         <div class="col-md-7">
            <table class="table table-striped table-bordered dt-responsive nowrap" id="datatable">
               <thead>
                  <tr>
                     <th width="8%">#</th>
                     <th width="50%">Kategori</th>
                     <th>Url</th>
                     <th width="10%">Opsi</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  $i = 1;
                  foreach($data->result() as $key) :
                  ?>
                  <tr>
                     <td style="vertical-align:middle"><?= $i++; ?></td>
                     <td style="vertical-align:middle"><?= $key->kategori; ?></td>
                     <td style="vertical-align:middle">
                        <?= $key->url; ?>
                     </td>
                     <td>
                        <a href="<?= base_url(); ?>item/del_tag/<?= $key->id_kategori; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus kategori ini?')"><i class="fa fa-trash"></i></a>
                     </td>
                  </tr>
                  <?php endforeach; ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
