

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
          <h2><?= $vendorC['nama_vendor']; ?></h2>
           <h2><?= $vendorC['id_vendor']; ?></h2>
           
          <div class="row">
          	<div class="col-lg-4">
          		
          		
          		<form action="" method="post">
          			<input type="hidden" name="id" value="<?= $vendorC['id_vendor']; ?>">
          		


          			  <div class="form-group">
					    <label for="nama">Vendor Name</label>
					  	  <input type="text" class="form-control" id="nama" name="nama" value="<?= $vendorC['nama_vendor']; ?>">
					   </div>
					   <div class="form-group">
					    <label for="alamat">Address</label>
					  	  <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $vendorC['alamat']; ?>"> 
					   </div>

					   <div class="form-group">
					    <label for="kp">Postal Code</label>
					  	  <select class="form-control" id="kp" name="kp">
					  	  	<?php foreach($edit as $e): ?>
					  	  		<?php if($vendorC['kode_pos'] == $e['kode_pos']) : ?>
					  	  			<option value="<?= $e['kode_pos']; ?>" selected><?= $e['kode_pos']; ?></option>
					  	  	 	<?php else : ?>
					  	  			<option value="<?= $e['kode_pos']; ?>"><?= $e['kode_pos']; ?></option>
					  	  		<?php endif; ?>
					  	  	<?php endforeach; ?>
					  	  </select>
					  		
					   </div>
					
					   <div class="form-group">
					    <label for="owner">Owner</label>
					  	  <input type="text" class="form-control" id="owner" name="owner" value="<?= $vendorC['nama_kontak']; ?>">
					   </div>
					   <div class="form-group">
					    <label for="phone">Phone Number</label>
					  	  <input type="number" class="form-control" id="phone" name="phone" value="<?= $vendorC['nomor_kontak']; ?>">
					   </div>

					   <div class="form-group row">
					    <div class="col-sm-2">Logo</div>				  	 
					  	 <div class="col-sm-10">
					  	 	<div class="row">
					  	 		<div class="col-sm-3">
					  	 			<img src="<?= base_url('assets/img/img/') . $vendorC['logo']; ?>" class="img-thumbnail">
					  	 		</div>
					  	 		<div class="col-sm-9">
					  	 			<!-- form ubah foto  -->
					  	 			
									<input type="file" class="btn btn-outline-secondary" name="image">

					  	 		</div>
					  	 	</div>
					  	 </div>
					   </div>

					   <div class="form-group" row justify-content-end>
					   	<div class="col-sm-10">
					   		<button type="submit" name="ubedit_vendorah" class="btn btn-primary">Edit</button>
					   	</div>
					   </div>

          		</form>

          	</div>


          </div>



        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->




      
