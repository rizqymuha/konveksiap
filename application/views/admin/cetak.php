<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Cetak Laporan</title>
      <link href="<?php echo base_url(); ?>admin_assets/css/bootstrap.min.css" rel="stylesheet">
   </head>
   <body>
      <div class="container">
         <div class="row">
            <?php
            switch ($bln) {
               case '01':
                  $Bulan = 'Januari';
                  break;
               case '02':
                  $Bulan = 'Februari';
                  break;
               case '03':
                  $Bulan = 'Maret';
                  break;
               case '04':
                  $Bulan = 'April';
                  break;
               case '05':
                  $Bulan = 'Mei';
                  break;
               case '06':
                  $Bulan = 'Juni';
                  break;
                  case '07':
                     $Bulan = 'Juli';
                     break;
                  case '08':
                     $Bulan = 'Agustus';
                     break;
                  case '09':
                     $Bulan = 'September';
                     break;
                  case '10':
                     $Bulan = 'Oktober';
                     break;
                  case '11':
                     $Bulan = 'November';
                     break;
                  case '12':
                     $Bulan = 'Desember';
                     break;
            }

            ?>
            <div class="col-md-10 col-sm-12 col-md-offset-1">
               <center><h3>Laporan Bulan <?= $Bulan;?> Tahun <?=$thn;?></h3></center>
            </div>

            <div class="col-md-12 col-sm-12">
               <table class="table table-bordered">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Id Order</th>
                        <th>Nama Pemesan</th>
                        <th>Kota Tujuan</th>
                        <th>Total Bayar</th>
                        <th>Ongkir</th>
                        <th>Pendapatan</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $no = 1;
                     $pendapatan = 0;
                     foreach($data->result() as $key) :
                        $pendapatan += $key->biaya;
                     ?>
                     <tr>
                        <td><?= $no++;?></td>
                        <td><?=$key->id_order;?></td>
                        <td><?=$key->fullname;?></td>
                        <td><?=$key->kota;?></td>
                        <td>
                           <span style="float:left">Rp.</span>
                           <span style="float:right"><?= number_format($key->total,0,',','.');?>,-</span>
                        </td>
                        <td>
                           <span style="float:left">Rp.</span>
                           <span style="float:right"><?= number_format(($key->total - $key->biaya),0,',','.');?>,-</span>
                        </td>
                        <td>
                           <span style="float:left">Rp.</span>
                           <span style="float:right"><?= number_format($key->biaya,0,',','.');?>,-</span>
                        </td>
                     </tr>
                     <?php endforeach; ?>
                     <tr>
                        <td colspan="6" style="text-align:center"><b>Pendapatan</b></td>
                        <td>
                           <b>
                              <span style="float:left">Rp.</span>
                              <span style="float:right"><?= number_format($pendapatan,0,',','.');?>,-</span>
                           </b>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <script type="text/javascript">
         window.print();
      </script>
   </body>
</html>
