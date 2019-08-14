<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="col-lg-6">


            <?= form_error('menu', '<div class="alert alert-danger" 
                role="alert">', '</div>'); ?>

            <?= $this->session->flashdata('message');  ?>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#NewUser">Add New User</a>


            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>                      
                        <th scope="col">Phone Number</th>
                        <th scope="col">Date Created</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>

                    <?php $i = 1;
                    foreach ($usr as $ad) : ?>
                        <tr>
                            <th><?= $i; ?></th>
                            <td><?= $ad['name']; ?></td>
                             <td><?= $ad['email']; ?></td>
                             <td><?= $ad['password']; ?></td>
                              <td><?= $ad['phone_number']; ?></td>
                              <td><?= date('d F Y', $ad['date_created']) ?></td>
                            <td>
                               
                                <a href="<?= base_url(); ?>admin/edit_user/<?= $ad['id']; ?>" class="badge badge-warning" >Edit</a>
                                <a href="<?= base_url(); ?>admin/hapus_user/<?= $ad['id']; ?>" class="badge badge-danger" onclick="return confirm('Are you sure?');">Delete</a>

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

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="NewUser" tabindex="-1" role="dialog" aria-labelledby="NewUserLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="NewUserLabel">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- FORM -->
            <form action="<?= base_url('admin/list_user'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" Name="name" placeholder="Name">
                          <?= form_error('name', '<small class="text-danger pl-3">', '</small>');  ?>
                    </div>

                     <!-- Email -->
                    <div class="form-group">
                        <input type="text" class="form-control" id="email" Name="email" placeholder="Email">
                          <?= form_error('email', '<small class="text-danger pl-3">', '</small>');  ?>
                    </div>

                    <!-- Phone Number -->
                    <div class="form-group">
                        <input type="number" class="form-control" id="phone" Name="phone" placeholder="Phone Number">
                    </div>
                   
                      <!-- Password -->
                     <div class="form-group">
                        <input type="password" class="form-control" id="password1" Name="password1" placeholder="Password">
                    </div>
                    <!-- ConformPassword -->
                    <div class="form-group">
                        <input type="password" class="form-control" id="password2" Name="password2" placeholder="Conform Password">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

