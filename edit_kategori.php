

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
          <h2><?= $kategori['nama_kategori']; ?></h2>
          <h2><?= $vendor['nama_vendor']; ?></h2>
       
           
          <div class="row">
          	<div class="col-lg-4">
          		
          		
          		<form action="" method="post">
          			<input type="hidden" name="id" value="<?= $kategori['id_kategori']; ?>">
          		


          			  <div class="form-group">
					    <label for="nama">Kategori Name</label>
					  	  <input type="text" class="form-control" id="nama" name="nama" value="<?= $kategori['nama_kategori']; ?>">
					   </div>
					   

					   <div class="form-group row">
					    <div class="col-sm-2">Image</div>				  	 
					  	 <div class="col-sm-10">
					  	 	<div class="row">
					  	 		<div class="col-sm-3">
					  	 			<img src="<?= base_url('assets/img/kategori/') . $kategori['image']; ?>" class="img-thumbnail">
					  	 		</div>
					  	 		<div class="col-sm-9">
					  	 			<!-- form ubah foto  -->
					  	 			
									<input type="file" class="btn btn-outline-secondary" name="image">
									 <small>Max Size 1 Mb</small>

					  	 		</div>
					  	 	</div>
					  	 </div>
					   </div>

					   <div class="form-group" row justify-content-end>
					   	<div class="col-sm-10">
					   		<button type="submit" class="btn btn-primary">Edit</button>
					   	</div>
					   </div>

          		</form>

          	</div>


          </div>



        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->




      
