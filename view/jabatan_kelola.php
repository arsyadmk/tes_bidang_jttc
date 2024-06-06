<?php

if (@$_GET['h'] == 'y') {
  $eid_temp = enkripsiDekripsi(@$_GET['eid'], 'dekripsi');
  $update = mysqli_query($koneksi, "UPDATE `jabatan` SET `status_jabatan`='N' WHERE idjabatan = '$eid_temp';");
  if ($update) {
    echo '<script type="text/javascript">
    alert("Data berhasil diolah"); 
    window.location.href="?page=jabatan&action=kelola";
    </script>';
  } else {
    $iki_error = str_replace("'", "`", mysqli_error($koneksi));
    echo '<script type="text/javascript">
    alert("Gagal mengolah data\\n' . $iki_error . '"); 
    window.location.href="?page=jabatan&action=kelola";
    </script>';
  }
}

?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Kelola Jabatan</h1>
      </div>
    </div>
  </div>
</div>

<section class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Daftar jabatan</h3>
          </div>
          <div class="card-body">
            <table id="example" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th data-searchable="false">No</th>
                  <th>Nama jabatan</th>
                  <th>Tanggal Pembuatan</th>
                  <th data-searchable="false" data-orderable="false" data-priority="1">Kelola</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $nomor = 1;
                $sql_voucher = mysqli_query($koneksi, "SELECT *
                  FROM `jabatan` p
                  WHERE p.status_jabatan='Y'
                  ORDER BY p.tanggal_input DESC
                  ");
                while ($data_jabatan = mysqli_fetch_array($sql_voucher)) {
                  $eid = enkripsiDekripsi($data_jabatan['idjabatan'], 'enkripsi');
                  ?>
                  <tr>
                    <td><?= $nomor++; ?></td>
                    <td><?= $data_jabatan['nama_jabatan']; ?></td>
                    <td align="center" data-order="<?= tanggal_order($data_jabatan['tanggal_input']) ?>">
                      <?= tanggal_jam_indo($data_jabatan['tanggal_input']); ?>
                    </td>
                    <td align="center">
                      <a onclick="return confirm('Yakin data ingin hapus ?')"
                        href="?page=jabatan&action=kelola&h=y&eid=<?= $eid ?>">
                        <button class="btn btn-danger btn-xm m-1" data-toggle="tooltip" data-container=".content"
                          title="Hapus"><i class="fa fa-fw fa-trash"></i></button>
                      </a>
                      <a href="?page=jabatan&action=edit&eid=<?= $eid ?>">
                        <button class="btn btn-info btn-xm m-1" data-toggle="tooltip" data-container=".content"
                          title="Edit"><i class="fa fa-fw fa-edit"></i></button>
                      </a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>