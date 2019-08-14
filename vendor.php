

        <!-- Begin Page Content -->
        <div class="container-fluid">

        
        

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

          
            <div class="col">
                

            <?= form_error('menu', '<div class="alert alert-danger" 
                role="alert">', '</div>'); ?>

       

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#NewVendor">Add New Vendor</a>

            <table class="table table-hover">
              <thead>
                <tr>
                  <th></th>
                  <th><form method="post">
              
                        <input type="text" class="form-control" id="cari" Name="cari" placeholder="Search vendor or postal code" autofocus="">
                  
                  </th>
                    <th><button type="submit" name="tombol_cari" class="btn btn-primary">Search</button></th>
                </tr></form>
                    <?= $this->session->flashdata('message');  ?>
              </thead>

            </table>

            <div id="container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Vendor</th>                      
                        <th scope="col">Alamat</th>
                        <th scope="col">Kode Pos</th>
                        <th scope="col">Kode Area</th>                      
                        <th scope="col">Pemilik Vendor</th>
                        <th scope="col">No Kontak</th>                      
                        <th scope="col">Logo Vendor</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $i = 1;
                    foreach ($vendor as $vn) : ?>
                        <tr>
                            <th><?= $i; ?></th>
                            <td><?= $vn['nama_vendor']; ?></td>
                            <td><?= $vn['alamat']; ?></td>
                            <td><?= $vn['kode_pos']; ?></td>
                            <td><?= $vn['kode_area']; ?></td>
                            <td><?= $vn['nama_kontak']; ?></td>
                            <td><?= $vn['nomor_kontak']; ?></td>
                            <td><img style="width:100;height:100px;border:0;" src="<?= base_url('assets/img/img/') . $vn['logo']; ?>"></td>
                   

                            <td>
                                <a href="<?= base_url(); ?>admin/before/<?= $vn['id_vendor']; ?>" class="badge badge-success">View</a>

                                <a href="<?= base_url(); ?>admin/edit_vendor/<?= $vn['id_vendor']; ?>" class="badge badge-warning">Edit</a>
                                <!--  data-toggle="modal" data-target="#EditVendor" -->
                                <a href="<?= base_url(); ?>admin/hapus_vendor/<?= $vn['id_vendor']; ?>" class="badge badge-danger" onclick="return confirm('Are you sure?');">Delete</a>

                            </td>
                        </tr>
                        <?php $i = $i + 1;
                    endforeach; ?>


                </tbody>
            </table>
            </div>

        </div>

    </div>

           
          </div>
<?= form_open_multipart('admin/vendor');?>
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

                     <!-- PILIH VENDOR -->
                    <div class="form-group">
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">Select Vendor</option>
                            <?php foreach($pilih as $m) : ?>
                                <option value="<?= $m['Id_Vendor_List'];  ?> "><?= $m['Vendor']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                     <!-- Vendor Name -->
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" Name="name" placeholder="Branch">
                          <?= form_error('name', '<small class="text-danger pl-3">', '</small>');  ?>
                    </div>

                    <!-- Alamat -->
                    <div class="form-group">
                        <input type="text" class="form-control" id="alamat" Name="alamat" placeholder="Address">
                    </div>
   
                    <!-- Kode Pos -->
                    <div class="form-group">
                        <select name="pos" id="pos" class="form-control">
                            <option value="">Select Pos Code</option>
                            <?php foreach($kode_pos as $m) : ?>
                                <option value="<?= $m['kode_pos'];  ?> "><?= $m['kode_pos']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                   
                      <!-- Pemilik -->
                     <div class="form-group">
                        <input type="text" class="form-control" id="pemilik" Name="pemilik" placeholder="Owner">
                    </div>
                    <!-- Nomor HP -->
                    <div class="form-group">
                        <input type="number" class="form-control" id="no_kontak" Name="no_kontak" placeholder="Phone Number">
                    </div>
                    <!-- logo -->
                    <div class="form-group">
                        <small style="margin-left: 15px">Logo</small>
                        <input type="file" class="form-control" id="image" Name="image" placeholder="Logo Vendor">
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




      
