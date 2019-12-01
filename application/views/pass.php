<div class="row">
   <div class="col m10 s12 offset-m1">
      <h4 style="color:#939393"><i class="fa fa-key"></i> Ubah Password</h4>
      <hr />
      <br />
      <?= validation_errors('<p style="color:red">', '</p>'); ?>
      <form action="" method="post">
         <div class="alert alert-warning">
            <h5>Perhatian !</h5>
            <p>Anda akan diminta login ulang ketika password berhasil diubah</p>
         </div>
         <div class="col m10 s12">

            <div class="row">
               <div class="input-field col m8 s12">
                  <input id="password" type="password" class="validate" name="pass1">
                  <label for="password">Password Baru</label>
               </div>
            </div>

            <div class="row">
               <div class="input-field col m8 s12">
                  <input id="password" type="password" class="validate" name="pass2">
                  <label for="password">Ketik Ulang Password Baru</label>
               </div>
            </div>

            <div class="row">
               <div class="input-field col m8 s12">
                  <input id="password" type="password" class="validate" name="pass3">
                  <label for="password">Password Lama</label>
               </div>
            </div>
            <br />
            <div class="row right">
               <button type="button" onclick="window.history.go(-1)" class="btn red waves-effect waves-light">Kembali</button>
               <button type="submit" name="submit" value="Submit" class="btn blue waves-effect waves-light">Submit <i class="fa fa-paper-plane"></i></button>
            </div>
         </div>
      </form>
   </div>
</div>
