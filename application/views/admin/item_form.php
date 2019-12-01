<div class="x_panel">
   <div class="x_title">
      <h2><?= $header; ?></h2>
     <div class="clearfix"></div>
     <?= validation_errors('<p style="color:red">','</p>'); ?>
     <?php
     if ($this->session->flashdata('alert'))
     {
        echo '<div class="alert alert-danger alert-message">';
        echo $this->session->flashdata('alert');
        echo '</div>';
     }
     ?>
   </div>

   <div class="x_content">
      <br />

      <form class="form-horizontal form-label-left" action="" enctype="multipart/form-data" method="post">

         <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" >Nama Item
            </label>
            <div class="col-md-7 col-sm-6 col-xs-12">
               <input type="text" class="form-control col-md-7 col-xs-12" name="nama" value="<?= $nama; ?>">
            </div>
         </div>

         <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" >Gambar Utama
            </label>
            <div class="col-md-5 col-sm-6 col-xs-12">
               <?php
               if (isset($gambar)) {
                  echo '<input type="hidden" name="old_pict" value="'.$gambar.'">';
                  echo '<img src="'.base_url().'assets/upload/'.$gambar.'" width="30%">';
                  echo '<div class="clear-fix"></div><br />';
               }
               ?>
               <input type="file" class="form-control col-md-7 col-xs-12" name="foto">
            </div>
         </div>

         <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Harga Item
            </label>
            <div class="col-md-4 col-sm-6">
               <input class="form-control col-md-7 col-xs-12" type="number" name="harga" value="<?= $harga; ?>">
            </div>
         </div>

         <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Berat Item</label>
            <div class="col-md-4 col-sm-6">
               <input class="form-control col-md-7" type="number" name="berat" value="<?= $berat; ?>">
               <p class="help-text">* Berat dalam satuan Gram</p>
            </div>
         </div>

         <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Kategori</label>
            <div class="col-md-7 col-sm-6">
               <textarea class="form-control" rows="2" name="kategori" id="txt1"><?= $kategori; ?></textarea>
               <p class="help-text">* Gunakan tanda koma untuk memisahkan kategori</p>

               <?php foreach($kat->result() as $k) :?>
                  <input type="checkbox" name="kat[]" value="<?=$k->kategori;?>" onclick="addlist(this, 'txt1')" <?php if($rk) { foreach ($rk->result() as $l) { if ($k->kategori == $l->kategori) { echo 'checked'; } } } ?> > <?=$k->kategori;?>&nbsp;
               <?php endforeach; ?>

            </div>
         </div>

         <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Status</label>
            <div class="col-md-4 col-sm-6">
               <select name="status" class="form-control">
                  <option value="">--Pilih Status--</option>
                  <option value="1" <?php if($status == 1) { echo "selected"; }?>>Aktif</option>
                  <option value="2" <?php if($status == 2) { echo "selected"; }?>>Tidak Aktif</option>
               </select>
            </div>
         </div>

         <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Deskripsi</label>
            <div class="col-md-9 col-sm-6">
               <textarea class="form-control" rows="4" name="desk"><?= $desk; ?></textarea>
            </div>
         </div>

         <div class="ln_solid"></div>

         <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
               <button type="submit" class="btn btn-success" name="submit" value="Submit">Submit</button>
              <button type="button" onclick="window.history.go(-1)" class="btn btn-primary" >Kembali</button>
            </div>
         </div>

     </form>
   </div>
</div>
