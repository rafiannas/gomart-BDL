

        <!-- Begin Page Content -->
        <div class="container-fluid">

        
        

          <!-- Page Heading -->
          <h1 class="h3 text-gray-800"><?= $title; ?></h1>
          <h2 class="mb-5"><?= $info['nama_vendor']; ?></h2>
           <!-- Content Row -->
          
            <div class="col">
                

            <?= form_error('menu', '<div class="alert alert-danger" 
                role="alert">', '</div>'); ?>

            <?= $this->session->flashdata('message');  ?>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#NewCategory">Add New Category</a>


            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Kategori</th>                      
                        
                        <th scope="col">Image</th>
                        
                    </tr>
                </thead>
                <tbody>

                    <?php $i = 1;
                    foreach ($kategori as $kt) : ?>
                        <tr>
                            <th><?= $i; ?></th>
                            <td><?= $kt['nama_kategori']; ?></td>
                            
                            <td><img style="width:100;height:100px;border:0;" src="<?= base_url('assets/img/kategori/') . $kt['image']; ?>"></td>

                            <td>

                                <!-- <a href="<?= base_url(); ?>admin/<?=$kt['url2'] ?>/<?= $info['id_vendor']; ?>" class="badge badge-success">View</a> -->

                                <a href="<?= base_url(); ?>admin/before_barang/<?= $kt['id_kategori']; ?>" class="badge badge-success">View</a>
                                <a href="<?= base_url(); ?>admin/edit_kategori/<?= $kt['id_kategori']; ?>" class="badge badge-warning">Edit</a>
                                <a href="<?= base_url(); ?>admin/hapus_kategori/<?= $kt['id_kategori']; ?>" class="badge badge-danger" onclick="return confirm('Are you sure?');">Delete</a>

                            </td>
                        </tr>
                        <?php $i = $i + 1;
                    endforeach; ?>


                </tbody>
            </table>

        </div>

    </div>

           
          </div>

          <!-- Modal -->
<div class="modal fade" id="NewCategory" tabindex="-1" role="dialog" aria-labelledby="NewCategoryLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="NewCategoryLabel">Add New Category</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- FORM -->
            <form action="<?= base_url('admin/kategori'); ?>" method="post">
                <div class="modal-body">

                     <!--  Name -->
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" Name="name" placeholder="Category Name">
                    </div>
                    
                    <!-- image -->
                    <div class="form-group">
                        <input type="text" class="form-control" id="image" Name="image" placeholder="Image">
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




      
