<div class="row">
   <div class="col m10 s12 offset-m1">
      <h4 style="color:#939393"><i class="fa fa-shopping-bag"></i> Checkout</h4>
      <hr />
      <br />
      <?= validation_errors('<p style="color:red">', '</p>'); ?>
      <form action="" method="post">
         <div class="col m10 s12">

            <div class="row">
               <div class="col m8 s12">
                  <label>Provinsi</label>
                  <select class="browser-default" name="prov" id="prov">
                     <option value="" disabled selected>-- Pilih Provinsi --</option>
                     <?php $this->load->view('prov'); ?>
                  </select>
               </div>
            </div>

            <div class="row">
               <div class="col m8 s12">
                  <label>Pilih Kota / Kabupaten</label>
                  <select name="kota" class="browser-default" id="kota">
                     <option value="" disabled selected>-- Kota / Kabupaten --</option>
                  </select>
               </div>
            </div>

            <div class="row">
               <div class="input-field col m8 s12">
                  <input type="text" id="alamat" class="validate" name="alamat" value="">
                  <label for="alamat">Alamat</label>
               </div>
               <div class="input-field col m4 s12">
                  <input type="number" id="kd_pos" class="validate" name="kd_pos" value="">
                  <label for="kd_pos">Kode Pos</label>
               </div>
            </div>

            <div class="row">
               <div class="col m8 s12">
                  <label>Pilih Kurir</label>
                  <select class="browser-default" name="kurir" id="kurir">
                     <option value="pos">POS</option>
                     <option value="jne">JNE</option>
                  </select>
               </div>
            </div>

            <div class="row">
               <div class="col m8 s12">
                  <label>Pilih Layanan</label>
                  <select class="browser-default" name="layanan" id="layanan">
                     <option value="" disabled selected>Pilih Layanan</option>
                  </select>
               </div>
               <div class="col m4 s12">
                  <label>Ongkos Kirim</label>
                  <input type="number" name="ongkir" value="0" id="ongkir">
               </div>
            </div>

            <div class="row">
               <div class="input-field col m4 s12 offset-m8">
                  <input type="number" name="total" value="<?= $this->cart->total(); ?>" id="total">
                  <label>Total Biaya</label>
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
