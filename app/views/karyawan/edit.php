  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Halaman Karyawan</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?= $data['title']; ?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="<?= base_url; ?>/karyawan/updateKaryawan" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $data['karyawan']['id']; ?>">
                <div class="card-body">
                  <div class="form-group">
                    <label >Nama Karyawan</label>
                    <input type="text" class="form-control" placeholder="masukkan nama karyawan..." name="nama" value="<?= $data['karyawan']['nama'];?>">
                  </div>
                  <div class="form-group">
                    <label >NIP</label>
                    <input type="text" class="form-control" placeholder="masukkan NIP karyawan..." name="nip" value="<?= $data['karyawan']['nip'];?>">
                  </div>
                  <div class="form-group">
                    <label >Email</label>
                    <input type="text" class="form-control" placeholder="masukkan email karyawan..." name="email" value="<?= $data['karyawan']['email'];?>">
                  </div>
                  <div class="form-group">
                    <label >Tahun Masuk</label>
                    <input type="text" class="form-control" placeholder="masukkan tahun masuk karyawan..." name="th_masuk" value="<?= $data['karyawan']['th_masuk'];?>">
                  </div>
                  <div class="form-group">
                    <label >Jabatan</label>
                    <select class="form-control" name="jabatan_id">
                        <option value="">Pilih</option>
                         <?php foreach ($data['jabatan'] as $row) :?>
                        <option value="<?= $row['id']; ?>" <?php if($data['karyawan']['jabatan_id'] == $row['id']) { echo "selected"; } ?>><?= $row['nama_jabatan']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-Footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->