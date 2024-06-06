<?php
if (!empty($_GET['eid'])) {
  $eid = enkripsiDekripsi($_GET['eid'], 'dekripsi');

  $data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT *
    FROM `jabatan` j
    WHERE j.idjabatan = '$eid'
    "));
}

if (isset($_POST['btnSubmitTambah'])) {
  $nama_jabatan = mysqli_real_escape_string($koneksi, @$_POST['nama_jabatan']);

  $query_send = mysqli_query($koneksi, "INSERT INTO `jabatan`(
      `nama_jabatan`
      ) VALUES (
      '$nama_jabatan')
      ");

  if ($query_send) {
    echo '<script type="text/javascript">
      alert("Data Berhasil diolah"); 
      window.location.href="?page=jabatan&action=kelola";
      </script>';
  } else {
    $iki_error = str_replace("'", "`", trim(preg_replace('/\s\s+/', ' ', mysqli_error($koneksi))));
    echo '<script type="text/javascript">
      alert("Data Gagal diolah, terjadi kesalahan sistem\\n' . $iki_error . '"); 
      window.location.href="?page=jabatan&action=tambah";
      </script>';
  }
} elseif (isset($_POST['btnSubmitEdit'])) {
  $nama_jabatan = mysqli_real_escape_string($koneksi, @$_POST['nama_jabatan']);

  $query_send = mysqli_query($koneksi, "UPDATE `jabatan` SET 
      `nama_jabatan`='$nama_jabatan'
      WHERE `idjabatan`='$eid'
      ");

  if ($query_send) {
    echo '<script type="text/javascript">
      alert("Data Berhasil diolah"); 
      window.location.href="?page=jabatan&action=kelola";
      </script>';
  } else {
    $iki_error = str_replace("'", "`", trim(preg_replace('/\s\s+/', ' ', mysqli_error($koneksi))));
    echo '<script type="text/javascript">
      alert("Data Gagal diolah, terjadi kesalahan sistem\\n' . $iki_error . '"); 
      window.location.href="?page=jabatan&action=tambah";
      </script>';
  }

} else {
  if ($action == 'edit' && !empty(@$data['idjabatan'])) {
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
          <h1><?= $judul_temp; ?>Jabatan</h1>
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

                <div class="form-group cc">
                  <label for="nama_jabatan">Nama</label>
                  <input type="text" class="form-control" name="nama_jabatan" id="nama_jabatan" placeholder="Nama"
                    value="<?= @$data['nama_jabatan'] ?>" maxlength="500" required>
                  <span for="nama_jabatan">*Dapat menggunakan karakter A-Z, a-z, 0-9, dan (spasi`?!@#$%^&*,./=_+)</span>
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
    setInputFilter(document.getElementById("nama_jabatan"), function (value) {
      return /^[a-zA-Z0-9 `?!@#$%^&*,./=_+]*$/.test(value);
    });

  </script>
  <?php
}
?>