

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
          <h2><?= $barang['nama_barang']; ?></h2>
           <h2><?= $vendor['nama_vendor']; ?></h2>
           
          <div class="row">
          	<div class="col-lg-4">
          		
          		
          		<form action="" method="post">
          			<input type="hidden" name="id" value="<?= $barang['id_barang']; ?>">
          		
          			 <div class="form-group">
          			 	<label for="nama">Nama Barang</label>
                        <input type="text" class="form-control" id="name" Name="nama" placeholder="Nama Barang" value="<?= $barang['nama_barang']; ?>">
                    </div>

                    <!-- harga -->
                    <div class="form-group">
                    	<label for="nama">Harga</label>
                        <input type="number" class="form-control" id="harga" Name="harga" placeholder="Harga Barang" value="<?= $barang['harga_barang']; ?>">
                    </div>
                    
                    <!-- Deskripsi -->
                    <div class="form-group">
                    	<label for="deskripsi">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" Name="deskripsi" placeholder="Deskripsi" value="<?= $barang['deskripsi']; ?>">
                    </div>
                       <!-- Stok -->
                    <div class="form-group">
                    	<label for="stok">Stok</label>
                        <input type="number" class="form-control" id="stok" Name="stok" placeholder="Stok" value="<?= $barang['stok']; ?>">
                    </div>
                    <!-- image -->
    

					   <div class="form-group row">
					    <div class="col-sm-2">Logo</div>				  	 
					  	 <div class="col-sm-10">
					  	 	<div class="row">
					  	 		<div class="col-sm-3">
					  	 			<img src="<?= base_url('assets/img/barang/all/') . $barang['image']; ?>" class="img-thumbnail">
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




      
