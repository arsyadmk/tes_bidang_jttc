<?php
if (!empty($_GET['eid'])) {
  $eid = enkripsiDekripsi($_GET['eid'], 'dekripsi');

  $data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT *
    FROM `pegawai` p
    WHERE p.idpegawai = '$eid'
    "));
}

if (isset($_POST['btnSubmitTambah'])) {
  $nama_pegawai = mysqli_real_escape_string($koneksi, @$_POST['nama_pegawai']);
  $alamat_pegawai = mysqli_real_escape_string($koneksi, @$_POST['alamat_pegawai']);
  $email_pegawai = mysqli_real_escape_string($koneksi, @$_POST['email_pegawai']);

  $query_send = mysqli_query($koneksi, "INSERT INTO `pegawai`(
      `nama_pegawai`
      ,`alamat_pegawai`
      ,`email_pegawai`
      ) VALUES (
      '$nama_pegawai'
      ,'$alamat_pegawai'
      ,'$email_pegawai')
      ");

  if ($query_send) {
    echo '<script type="text/javascript">
      alert("Data Berhasil diolah"); 
      window.location.href="?page=pegawai&action=kelola";
      </script>';
  } else {
    $iki_error = str_replace("'", "`", trim(preg_replace('/\s\s+/', ' ', mysqli_error($koneksi))));
    echo '<script type="text/javascript">
      alert("Data Gagal diolah, terjadi kesalahan sistem\\n' . $iki_error . '"); 
      window.location.href="?page=pegawai&action=tambah";
      </script>';
  }
} elseif (isset($_POST['btnSubmitEdit'])) {
  $nama_pegawai = mysqli_real_escape_string($koneksi, @$_POST['nama_pegawai']);
  $alamat_pegawai = mysqli_real_escape_string($koneksi, @$_POST['alamat_pegawai']);
  $email_pegawai = mysqli_real_escape_string($koneksi, @$_POST['email_pegawai']);

  $query_send = mysqli_query($koneksi, "UPDATE `pegawai` SET 
      `nama_pegawai`='$nama_pegawai'
      ,`alamat_pegawai`='$alamat_pegawai'
      ,`email_pegawai`='$email_pegawai'
      WHERE `idpegawai`='$eid'
      ");

  if ($query_send) {
    echo '<script type="text/javascript">
      alert("Data Berhasil diolah"); 
      window.location.href="?page=pegawai&action=kelola";
      </script>';
  } else {
    $iki_error = str_replace("'", "`", trim(preg_replace('/\s\s+/', ' ', mysqli_error($koneksi))));
    echo '<script type="text/javascript">
      alert("Data Gagal diolah, terjadi kesalahan sistem\\n' . $iki_error . '"); 
      window.location.href="?page=pegawai&action=tambah";
      </script>';
  }

} else {
  if ($action == 'edit' && !empty(@$data['idpegawai'])) {
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
          <h1><?= $judul_temp; ?>Pegawai</h1>
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
                  <label for="nama_pegawai">Nama</label>
                  <input type="text" class="form-control" name="nama_pegawai" id="nama_pegawai" placeholder="Nama"
                    value="<?= @$data['nama_pegawai'] ?>" maxlength="500" required>
                  <span for="nama_pegawai">*Dapat menggunakan karakter A-Z, a-z, 0-9, dan (spasi`?!@#$%^&*,./=_+)</span>
                </div>

                <div class="form-group cc">
                  <label for="alamat_pegawai">Alamat</label>
                  <textarea class="form-control textarea" name="alamat_pegawai" id="alamat_pegawai" placeholder="Alamat"
                    rows="5" maxlength="1000" required><?= @$data['alamat_pegawai'] ?></textarea>
                  <span for="alamat_pegawai">*Dapat menggunakan karakter A-Z, a-z, 0-9, dan (spasi`?!@#$%^&*,./=_+)</span>
                </div>

                <div class="form-group cc">
                  <label for="email_pegawai">Email</label>
                  <input type="email" name="email_pegawai" class="form-control" id="email_pegawai" placeholder="Email"
                    maxlength="500" required value="<?= @$data['email_pegawai'] ?>">
                  <span for="email_pegawai">*Berisi Format Email</span>
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
    setInputFilter(document.getElementById("nama_pegawai"), function (value) {
      return /^[a-zA-Z0-9 `?!@#$%^&*,./=_+]*$/.test(value);
    });
    setInputFilter(document.getElementById("alamat_pegawai"), function (value) {
      return /^[a-zA-Z0-9 `?!@#$%^&*,./=_+]*$/.test(value);
    });

  </script>
  <?php
}
?>