

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
          <h2><?= $usr['name']; ?></h2>
         
          <div class="row">
          	<div class="col-lg-4">
          		
          		
          		<form action="" method="post">
          			<input type="hidden" name="id" id="id" value="<?= $usr['id']; ?>">
          		
          			  <div class="form-group">
					    <label for="nama">Name</label>
					  	  <input type="text" class="form-control" id="nama" name="nama" value="<?= $usr['name']; ?>">
					   </div>
					   <div class="form-group">
					    <label for="email">Email</label>
					  	  <input type="text" class="form-control" id="email" name="email" value="<?= $usr['email']; ?>" readonly> 
					   </div>
					
					   <div class="form-group">
					    <label for="password1">Password</label>
					  	  <input type="password" class="form-control" id="password1" name="password1" value="<?= $usr['password']; ?>">
					   </div>
					   <div class="form-group">
					    <label for="phone">Phone Number</label>
					  	  <input type="number" class="form-control" id="phone" name="phone" value="<?= $usr['phone_number']; ?>">
					   </div>


					   <div class="form-group" row justify-content-end>
					   	<div class="col-sm-10">
					   		<button type="submit" name="edit_user" class="btn btn-primary">Edit</button>
					   	</div>
					   </div>

          		</form>

          	</div>


          </div>



        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->




      
