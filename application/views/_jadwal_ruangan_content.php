<thead>
  <tr>
    <th scope="col">Hari</th>
    <th scope="col">Ruang</th>
    <th scope="col">Jam</th>
    <th scope="col">Dosen</th>
    <th scope="col">Kelas</th>
  </tr>
</thead>
<tbody id="myTB">
  <?php 
    $jum_mata_kuliah = count($jadwal);
    $jum_bukan_hari_ini = 0; // inisialisasi, nanti ditambah2 pas looping
  ?>
  <?php if ( !empty( $jadwal ) ): ?>

    <?php 
    // warna hari
    $warna_hari = ['primary', 'danger', 'info', 'success', 'primary', 'dark', 'warning', 'primary' ];
    ?>

    <?php foreach ($jadwal as $key => $value): ?>

      <?php 
        if ( $value['nyala'] == 'bg-abu-abu d-none' ) // kalau isinya diprint tapi gak ditampilkan, berarti ini jadwal yang bukan hari ini
        {
          $jum_bukan_hari_ini++;
        }

        // kalau jadwal udah terlampaui, maka kasih abu=abu aja
        $value['jadwal_udah_lewat'] = ''; // inisialisasi
        if ( $value['selisih_dg_waktu_selesai'] < 0 ) {
          $value['jadwal_udah_lewat'] = 'bg-abu-abu';
        }

      ?>
      
      <tr class="<?php echo $value['nyala'] ?> <?php echo $value['jadwal_udah_lewat'] ?>" id="tr-<?php echo $value['id'] ?>" onclick="show_modal(<?php echo $value['id'] ?>)"  data-toggle="modal" data-target="#exampleModalLong">

        <td class="hari font-weight-bold text-<?php echo $warna_hari[ $value['index_hari'] ] ?>"><?php echo $value['hari'] ?></td>
        <td class="ruang"><?php echo $value['ruang'] ?></td>
        <td class="jam"><?php echo substr($value['jam_mulai'], 0, -3) . ' - ' . substr($value['jam_selesai'], 0, -3) ?></td>
        <td class="dosen"><?php echo $value['dosen'] ?> <?php 
        
        // ketika kkurang 15 menit sblm mulai
        if ( -60*15 < $value['selisih_dg_waktu_mulai'] && $value['selisih_dg_waktu_mulai'] < 0 ) {

          $selisih_dg_waktu_mulai = str_replace('-', '', $value['selisih_dg_waktu_mulai']);
          $jam = sprintf('%02d',  floor($selisih_dg_waktu_mulai / (60*60) )   );
          $sisa_setelah_jam = $selisih_dg_waktu_mulai % (60*60);
          $menit = sprintf('%02d',  floor($sisa_setelah_jam / 60)   );
          $sisa_setelah_menit = $selisih_dg_waktu_mulai % 60;
          $detik = sprintf('%02d',  $selisih_dg_waktu_mulai % 60   );

          echo '<br><span class="badge badge-success '.$value['timer'].'">Mulai dalam ';
          echo $jam . ":" . $menit . ":" . $detik;
          echo '</span>';

        }
        // ketika masuk jam kuliah
        elseif ( $value['selisih_dg_waktu_selesai'] > 0 && 0 < $value['selisih_dg_waktu_mulai'] ) {
          $selisih_dg_waktu_selesai = str_replace('-', '', $value['selisih_dg_waktu_selesai']);
          $jam = sprintf('%02d',  floor($selisih_dg_waktu_selesai / (60*60) )   );
          $sisa_setelah_jam = $selisih_dg_waktu_selesai % (60*60);
          $menit = sprintf('%02d',  floor($sisa_setelah_jam / 60)   );
          $sisa_setelah_menit = $selisih_dg_waktu_selesai % 60;
          $detik = sprintf('%02d',  $selisih_dg_waktu_selesai % 60   );

          echo '<br><span class="badge badge-primary '.$value['timer'].'">';
          echo $jam . ":" . $menit . ":" . $detik;
          echo '</span>';
        }

        ?></td>

        <td class="sks d-none"><?php echo $value['sks'] ?></td>
        <td class="sifat d-none"><?php echo $value['sifat'] ?></td>
        <td class="mata_kuliah d-none"><?php echo $value['mata_kuliah'] ?></td>
        <td class="kelas"><?php echo strtoupper($value['jurusan']) . ' ' . $value['kelas'] ?></td>

      </tr>

    <?php endforeach ?>



  <?php else: ?>

    <tr class="text-center bg-abu-abu">
      <td colspan="5">Tidak ada jadwal</td>
    </tr>

  <?php endif ?>
  
</tbody>