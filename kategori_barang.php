

        <!-- Begin Page Content -->
        <div class="container-fluid">

        
        

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
            <h2><?= $inf['nama_vendor']; ?></h2>
         
           <!-- Content Row -->
          
            <div class="col">


            <?= form_error('menu', '<div class="alert alert-danger" 
                role="alert">', '</div>'); ?>

            <?= $this->session->flashdata('message');  ?>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newmakanan">Add New Item</a>


            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                                     
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Harga barang</th>
                        <th scope="col">Image</th>
                        <th scope="col">Deskripsi</th>                      
                        <th scope="col">Stok</th>
                        
                        
                    </tr>
                </thead>
                <tbody>

                    <?php $i = 1;
                    foreach ($makanan as $kt) : ?>
                        <tr>
                            <th><?= $i; ?></th>
                            <td><?= $kt['nama_barang']; ?></td>
                         
                             <td><?= $kt['harga_barang']; ?></td>

                            <td><img style="width:100;height:100px;border:0;" src="<?= base_url('assets/img/barang/all/').$kt['image']; ?>"></td>

                            <td><?= $kt['deskripsi']; ?></td>
                            <td><?= $kt['stok']; ?></td>

                            <td>
                                
                                <a href="<?= base_url(); ?>admin/edit_barang/<?= $kt['id_barang']; ?>" class="badge badge-warning">Edit</a>
                                <a href="<?= base_url(); ?>admin/hapus_barang/<?= $kt['id_barang']; ?>" class="badge badge-danger" onclick="return confirm('Are you sure?');">Delete</a>

                            </td>
                        </tr>
                        <?php $i = $i + 1;
                    endforeach; ?>


                </tbody>
            </table>

        </div>

    </div>

           
          </div>
<?= form_open_multipart('admin/kategori_barang');?>
          <!-- Modal -->
<div class="modal fade" id="newmakanan" tabindex="-1" role="dialog" aria-labelledby="newmakananLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newmakananLabel">Add New Item</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- FORM -->
            <form action="<?= base_url('admin/kategori_barang'); ?>" method="post">
                <div class="modal-body">

                     <!-- Item Name -->
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" Name="name" placeholder="Nama Barang">
                    </div>

                    <!-- harga -->
                    <div class="form-group">
                        <input type="number" class="form-control" id="harga" Name="harga" placeholder="Harga Barang">
                    </div>
                    
                    <!-- Deskripsi -->
                    <div class="form-group">
                        <input type="text" class="form-control" id="deskripsi" Name="deskripsi" placeholder="Deskripsi">
                    </div>
                       <!-- Stok -->
                    <div class="form-group">
                        <input type="number" class="form-control" id="stok" Name="stok" placeholder="Stok">
                    </div>
                    <!-- image -->
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




        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->




      
