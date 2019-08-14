

        <!-- Begin Page Content -->
        <div class="container-fluid">

        
        

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
          
           <!-- Content Row -->
          
            <div class="col">
              
            <?= form_error('menu', '<div class="alert alert-danger" 
                role="alert">', '</div>'); ?>

            <?= $this->session->flashdata('message');  ?>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#NewVendor">Add New Vendor</a>

            <div id="container">
            <table class="table table-hover">
                
                <tbody>

                   
                    <?php foreach ($vendor as $vn) : ?>
                        <tr>
                         

                           <img style="width:300px;height:200px; padding-right: 40px" src="<?= base_url('assets/img/vendor/') . $vn['Logo']; ?>">
                       
                   

    
                        </tr>
                        
                    <?php endforeach; ?>


                </tbody>
            </table>
            </div>

        </div>

    </div>

           
          </div>

          <!-- Modal -->
<div class="modal fade" id="NewVendor" tabindex="-1" role="dialog" aria-labelledby="NewVendorLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="NewVendorLabel">Add New Vendor</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- FORM -->
            <form action="<?= base_url('admin/vendor'); ?>" method="post">
                <div class="modal-body">

                     <!-- Vendor Name -->
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" Name="name" placeholder="Vendor Name">
                    </div>

                    <!-- Alamat -->
                    <div class="form-group">
                        <input type="text" class="form-control" id="alamat" Name="alamat" placeholder="Address">
                    </div>
                    
                    <!-- Kode Pos -->
                    <div class="form-group">
                        <input type="number" class="form-control" id="pos" Name="pos" placeholder="Postal Code">
                    </div>
                      <!-- Kode Area -->
                     <div class="form-group">
                        <input type="number" class="form-control" id="area" Name="area" placeholder="Code Area">
                    </div>
                      <!-- Pemilik -->
                     <div class="form-group">
                        <input type="text" class="form-control" id="pemilik" Name="pemilik" placeholder="Owner">
                    </div>
                    <!-- Nomor HP -->
                    <div class="form-group">
                        <input type="number" class="form-control" id="no_kontak" Name="no_kontak" placeholder="Phone Number">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="logo" Name="logo" placeholder="Logo Vendor">
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




      
