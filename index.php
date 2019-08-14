        

        <!-- Begin Page Content -->
        <div class="container-fluid">

        
        

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Dasboard</h1>
          
          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">

                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <a class="text-xs font-weight-bold text-primary text-uppercase mb-1" href="<?= base_url('admin/vendor'); ?>">Vendor</a>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $vendor['Jumlah']; ?></div>
                    </div>
                    <div class="col-auto">
                      <i href="#" class="fas fa-fw fa-store fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">User</div>
                      <a class="text-xs font-weight-bold text-primary text-uppercase mb-1" href="<?= base_url('admin/list_user'); ?>"><?= $usr['Jumlah']; ?></a>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-fw fa-user-friends fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Items</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $brg['Jumlah']; ?></div>
                        </div>
      
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fa-fw fas fa-boxes fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Transaction</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $krj['Jumlah']; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class=" fas fa-shopping-cart fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>




           <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Transaction</h1>
          

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th >Lokasi Belanja</th>
                      <th>Tanggal</th>
                      <th>Pembeli</th>
                      <th>Lokasi Pembeli</th>
                      <th>Total Harga</th>
                      <th>Metode Pembayaran</th>
                      <th>Ongkir</th>
                      <th>Kurir</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Lokasi Belanja</th>
                      <th>Tanggal</th>
                      <th>Pembeli</th>
                      <th>Lokasi Pembeli</th>
                      <th>Total Harga</th>
                      <th>Metode Pembayaran</th>
                      <th>Ongkir</th>
                      <th>Kurir</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php $i = 1;
                    foreach ($transaksi as $tr) : ?>

                    <tr>
                      <td><?= $i; ?></td>
                      <td><?= $tr['nama_vendor']; echo "_____". $tr['kode_pos'];?></td>
                      <td><?= $tr['tgl']; ?></td>
                      <td><?= $tr['name'];?></td>
                      <td><?= $tr['alamat_kirim']; echo "_____" .$tr['lokasi_kirim'];?></td>
                      <td>Rp. <?= number_format($tr['total_harga']);?></td>
                      <td><?= $tr['met_pemb'];?></td>
                      <td>Rp. <?= number_format($tr['ongkir']);?></td>
                      <td><?= $tr['nama_kurir'];?></td>
                    </tr>
                      <?php $i = $i + 1;
                    endforeach; ?>
                    
                  </tbody>
                  <a class="btn btn-primary" href="<?= base_url().'admin/export' ?>">Export Excel</a>
                </table>
              </div>
            </div>
          </div>

        </div>

        <!-- Content Row -->
          <div class="row">

            <div class="col-xl-8 col-lg-7">

              <!-- Area Chart -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Area Chart</h6>
                </div>
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                  </div>
                  <hr>
                  Styling for the area chart can be found in the <code>/js/demo/chart-area-demo.js</code> file.
                </div>
              </div>

              <!-- Bar Chart -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Bar Chart</h6>
                </div>
                <div class="card-body">
                  <div class="chart-bar">
                    <canvas id="myBarChart"></canvas>
                  </div>
                  <hr>
                  Styling for the bar chart can be found in the <code>/js/demo/chart-bar-demo.js</code> file.
                </div>
              </div>

            </div>

          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
            

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      
 <script src="<?= base_url('assets'); ?>/vendor/chart.js/Chart.min.js"></script>

 <script src="<?= base_url('assets'); ?>/js/demo/chart-bar-demo.js"></script>
  




      
