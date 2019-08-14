

        <!-- Begin Page Content -->
        <div class="container-fluid">

        
        

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
          
           <!-- Content Row -->
          <div class="row">
            <div class="col-lg-6">


            <?= form_error('menu', '<div class="alert alert-danger" 
                role="alert">', '</div>'); ?>

            <?= $this->session->flashdata('message');  ?>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#NewKurir">Add Kurir</a>


            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Plat Nomor</th>
                        <th scope="col">Nama Kurir</th>
                        <th scope="col">Kode Area Tugas</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>

                    <?php $i = 1;
                    foreach ($kurir as $sm) : ?>
                        <tr>
                            <th><?= $i; ?></th>
                            <td><?= $sm['plat_nomor']; ?></td>
                            <td><?= $sm['nama_kurir']; ?></td>
                            <td><?= $sm['kode_tugas']; ?></td>
                            <td><?= $sm['foto']; ?></td>                    
                            <td>
                                <a href="" class="badge badge-warning">Edit</a>
                                <a href="" class="badge badge-danger">Delete</a>

                            </td>
                        </tr>
                        <?php $i = $i + 1;
                    endforeach; ?>


                </tbody>
            </table>

        </div>
  

          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->


<!-- Modal -->
<div class="modal fade" id="NewKurir" tabindex="-1" role="dialog" aria-labelledby="NewKurirLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="NewKurirLabel">Add New Kurir</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- FORM -->
            <form action="<?= base_url('admin/list_kurir'); ?>" method="post">
                <div class="modal-body">

                     <!-- Nama -->
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama" Name="nama" placeholder="Nama">
                    </div>
                     <!-- Plat -->
                    <div class="form-group">
                        <input type="text" class="form-control" id="plat" Name="plat" placeholder="Plat Nomor">
                    </div>

                    <!-- KodeTugas -->
                    <div class="form-group">
                        <select name="kode_t" id="kode_t" class="form-control">
                            <option value="">Kode Tugas</option>
                            <?php foreach($kode as $m) : ?>
                                <option value="<?= $m['kode_area'];  ?> "><?= $m['kode_area']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <input type="file" class="btn btn-outline-secondary" name="image">
                        <small>Max Size 1 Mb</small>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>




      
