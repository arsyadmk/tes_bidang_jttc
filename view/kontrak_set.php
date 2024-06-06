<?php
$list_pegawai = $koneksi->query("SELECT * FROM pegawai WHERE status_pegawai = 'Y'")->fetch_all(MYSQLI_ASSOC);
$list_jabatan = $koneksi->query("SELECT * FROM jabatan WHERE status_jabatan = 'Y'")->fetch_all(MYSQLI_ASSOC);

if (!empty($_GET['eid'])) {
  $eid = enkripsiDekripsi($_GET['eid'], 'dekripsi');

  $data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT k.*, p.nama_pegawai, j.nama_jabatan
  FROM `kontrak` k
  INNER JOIN `pegawai` p ON k.idpegawai = p.idpegawai
  INNER JOIN `jabatan` j ON k.idjabatan = j.idjabatan
  WHERE k.status_kontrak='Y'
  AND k.idkontrak = '$eid'"));
}

if (isset($_POST['btnSubmitTambah'])) {
  $idpegawai = mysqli_real_escape_string($koneksi, enkripsiDekripsi(@$_POST['idpegawai'], 'dekripsi'));
  $idjabatan = mysqli_real_escape_string($koneksi, enkripsiDekripsi(@$_POST['idjabatan'], 'dekripsi'));
  $mulai_kontrak = mysqli_real_escape_string($koneksi, @$_POST['tanggal_mulai']);
  $selesai_kontrak = mysqli_real_escape_string($koneksi, @$_POST['tanggal_selesai']);

  $lama_kontrak = round((strtotime($selesai_kontrak) - strtotime($mulai_kontrak)) / (60 * 60 * 24));

  $query_send = mysqli_query($koneksi, "INSERT INTO `kontrak`(
      `idpegawai`
      ,`idjabatan`
      ,`mulai_kontrak`
      ,`selesai_kontrak`
      ,`lama_kontrak`
      ) VALUES (
      '$idpegawai'
      ,'$idjabatan'
      ,'$mulai_kontrak'
      ,'$selesai_kontrak'
      ,'$lama_kontrak')
      ");

  if ($query_send) {
    echo '<script type="text/javascript">
      alert("Data Berhasil diolah"); 
      window.location.href="?page=kontrak&action=kelola";
      </script>';
  } else {
    $iki_error = str_replace("'", "`", trim(preg_replace('/\s\s+/', ' ', mysqli_error($koneksi))));
    echo '<script type="text/javascript">
      alert("Data Gagal diolah, terjadi kesalahan sistem\\n' . $iki_error . '"); 
      window.location.href="?page=kontrak&action=tambah";
      </script>';
  }
} elseif (isset($_POST['btnSubmitEdit'])) {
  $idkontrak = mysqli_real_escape_string($koneksi, @$_POST['idkontrak']);
  $mulai_kontrak = mysqli_real_escape_string($koneksi, @$_POST['tanggal_mulai']);
  $selesai_kontrak = mysqli_real_escape_string($koneksi, @$_POST['tanggal_selesai']);

  $lama_kontrak = round((strtotime($selesai_kontrak) - strtotime($mulai_kontrak)) / (60 * 60 * 24));

  $query_send = mysqli_query($koneksi, "UPDATE `kontrak` SET 
      `mulai_kontrak`='$mulai_kontrak'
      ,`selesai_kontrak`='$selesai_kontrak'
      ,`lama_kontrak`='$lama_kontrak'
      WHERE `idkontrak`='$eid'
      ");

  if ($query_send) {
    echo '<script type="text/javascript">
      alert("Data Berhasil diolah"); 
      window.location.href="?page=kontrak&action=kelola";
      </script>';
  } else {
    $iki_error = str_replace("'", "`", trim(preg_replace('/\s\s+/', ' ', mysqli_error($koneksi))));
    echo '<script type="text/javascript">
      alert("Data Gagal diolah, terjadi kesalahan sistem\\n' . $iki_error . '"); 
      window.location.href="?page=kontrak&action=tambah";
      </script>';
  }

} else {
  if ($action == 'edit' && !empty(@$data['idkontrak'])) {
    $judul_temp = 'Edit ';
    $tombol_temp = '<input type="submit" class="btn btn-primary btn-block" id="btnSubmitEdit" name="btnSubmitEdit" value="Edit">';
  } else {
    $judul_temp = 'Tambah ';
    $tombol_temp = '<input type="submit" class="btn btn-primary btn-block" id="btnSubmitTambah" name="btnSubmitTambah" value="Simpan">';
  }
  ?>

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?= $judul_temp; ?>Kontrak</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <form role="form" method="post" action="" enctype="multipart/form-data">
              <div class="card-body">


                <div class="form-group">
                  <label>Pegawai</label>
                  <?php if (!empty(@$data['idpegawai'])) {
                    ?>
                    <div class="form-group cc">
                      <input type="text" class="form-control" name="nama_pegawai" id="nama_pegawai" placeholder="Nama"
                        value="<?= @$data['nama_pegawai'] ?>" maxlength="500" readonly>
                      <span for="nama_pegawai">*Tidak dapat diedit</span>
                    </div>
                    <?php
                  } else {
                    ?>
                    <select class="form-control form-control-user" name="idpegawai" id="idpegawai" required>
                      <option></option>
                      <?php foreach ($list_pegawai as $list_pegawai_fix => $value_pegawai): ?>
                        <option value="<?= enkripsiDekripsi($value_pegawai['idpegawai'], 'enkripsi') ?>">
                          <?= $value_pegawai['nama_pegawai']; ?>
                        </option>
                      <?php endforeach ?>
                    </select>
                    <span for="pegawai">*Pilih salah satu pegawai</span>
                    <?php
                  } ?>
                </div>

                <div class="form-group">
                  <label>Jabatan</label>
                  <?php if (!empty(@$data['idjabatan'])) {
                    ?>
                    <div class="form-group cc">
                      <input type="text" class="form-control" name="nama_jabatan" id="nama_jabatan" placeholder="Nama"
                        value="<?= @$data['nama_jabatan'] ?>" maxlength="500" readonly>
                      <span for="nama_jabatan">*Tidak dapat diedit</span>
                    </div>
                    <?php
                  } else {
                    ?>
                  <select class="form-control form-control-user" name="idjabatan" id="idjabatan" required>
                    <option></option>
                    <?php foreach ($list_jabatan as $list_jabatan_fix => $value_jabatan): ?>
                      <option value="<?= enkripsiDekripsi($value_jabatan['idjabatan'], 'enkripsi') ?>">
                        <?= $value_jabatan['nama_jabatan']; ?>
                      </option>
                    <?php endforeach ?>
                  </select>
                  <span for="jabatan">*Pilih salah satu jabatan</span>
                    <?php
                  } ?>
                </div>

                <div class="form-group">
                  <label for="tanggal_p">Tanggal Kontrak</label>
                  <button type="button" class="btn btn-default" id="daterange-btn" style="width: 100%">
                    <i class="far fa-calendar-alt"></i> <span
                      id="reportrange"><?= date('j F Y', strtotime(date('Y-m-d'))) . ' - ' . date('j F Y', strtotime(date('Y-m-d'))); ?></span>
                    <i class="fas fa-caret-down"></i>
                  </button>
                  <input type="hidden" name="tanggal_mulai" id="tanggal_mulai" value="<?= date('Y-m-d 00:00:00') ?>"
                    required>
                  <input type="hidden" name="tanggal_selesai" id="tanggal_selesai" value="<?= date('Y-m-d 23:59:59') ?>"
                    required>
                </div>

              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-12">
                    <?= $tombol_temp; ?>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-6">
        </div>
      </div>
    </div>
  </section>

  <script type="text/javascript">
    $(function () {
      $('#daterange-btn').daterangepicker(
        {
          startDate: '<?= date("m/d/Y") ?>',
          endDate: '<?= date("m/d/Y") ?>'
        },
        function (start, end) {
          $('#reportrange').html(start.format('D MMMM YYYY') + ' - ' + end.format('D MMMM YYYY'));
          document.getElementById('tanggal_mulai').value = start.format('YYYY-MM-DD 00:00:00');
          document.getElementById('tanggal_selesai').value = end.format('YYYY-MM-DD 23:59:59');
        }
      )
    });

  </script>
  <?php
}
?>