<!-- Begin Page Content -->
<div class="container-fluid">




  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
  <!-- <h5><?= $s1; ?></h5> -->

  <!-- Content Row -->
  <div class="row">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
      <li class="nav-item">
        <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="false">Transaction</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Best Item</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Best Vendor</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" id="pills-contact-tab" data-toggle="pill" href="#pills-user" role="tab" aria-controls="pills-user" aria-selected="true">Best User</a>
      </li>
    </ul>



  </div>
 <!-- <?= $s1; ?> -->
  <div class="row" style="margin-left: 20px">
    <div class="tab-content col-xl-6 " id="pills-tabContent">
      <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="row">
          <div class="col-md-6">

            <?= form_open('admin/nav1'); ?>
            <label>Awal</label>
            <input type="date" class="form-control" name="awal" id="awal">
          </div>
          <div class="col-md-6">
            <label>Akhir</label>
            <input type="date" class="form-control" name="akhir">
          </div>
        </div>
        <br>
        <label for="">Select Category</label>
        <div class="form-grup">
          <select name="kategori" id="kategori" class="form-control">
            <option value="">Select Category</option>
            <?php foreach ($kategori as $ktg) : ?>
              <option value="<?= $ktg['id_kategori']; ?>"><?= $ktg['nama_kategori']; ?></option>
            <?php endforeach; ?>
          </select>

        </div>
        <br>
        <button name="report" class="btn btn-secondary">Select</button>
        </form>
        <br><br>
        <?php
        // echo ($s1);
        if ($s4 == 1) : 
         // echo $s1;
        ?>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Year</th>
              <th scope="col">Month</th>
              <th scope="col">Total</th>
              <th scope="col">Jumlah Transaksi</th>
              <th scope="col">Income</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($hasil1 as $hs) : ?>
              <tr>
                <th><?= $hs['year']; ?></th>
                <th><?= $hs['month']; ?></th>
                <th>Rp. <?= number_format($hs['total']); ?></th>
                <th><?= $hs['transaksi']; ?></th>
                <th>Rp. <?= number_format($hs['toptrofik']); ?></th>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <?php endif; ?>
      </div>
      <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <div class="row">
          <div class="col-md-6">
            <?= form_open('admin/nav2'); ?>
            <label>Awal</label>
            <input type="date" class="form-control" name="awal">
          </div>
          <div class="col-md-6">
            <label>Akhir</label>
            <input type="date" class="form-control" name="akhir">
          </div>
        </div>
        <br>

        <br>
        <button name="report" class="btn btn-secondary">Select</button>
        </form>
        <br><br>
        <?php if ($s3 == 1): ?>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Year</th>
              <th scope="col">Month</th>
              <th scope="col">Item</th>
              <th scope="col">Quantity</th>
              <th scope="col">Vendor</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($hasil2 as $hs): ?>
            <tr>
              <th><?= $hs['year'] ?></th>
              <th><?= $hs['month'] ?></th>
              <th><?= $hs['nama_barang'] ?></th>
              <th><?= $hs['jmh'] ?></th>
              <th><?= $hs['nama_vendor'] ?></th>
            </tr>
             <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>

      </div>
      

      <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">

        <div class="row">
          <div class="col-md-6">
            <?= form_open('admin/nav3'); ?>
            <label>Awal</label>
            <input type="date" class="form-control" name="awal">
          </div>
          <div class="col-md-6">
            <label>Akhir</label>
            <input type="date" class="form-control" name="akhir">
          </div>
        </div>
        <br>

        <br>
        <button name="report" class="btn btn-secondary">Select</button>
        </form>
        <br><br>
        <?php if ($s2 == 1): ?>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Year</th>
              <th scope="col">Vendor</th>
              <th scope="col">Jumlah Transaksi</th>
              <th scope="col">Income</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($hasil3 as $hs): ?>
            <tr>
              <th><?= $hs['year']; ?></th>
              <th><?= $hs['nama_vendor']; ?></th>
              <th><?= $hs['jmh'];?></th>
              <th>Rp. <?= number_format($hs['total']) ;?></th>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>

      </div>
      <div class="tab-pane fade show active" id="pills-user" role="tabpanel" aria-labelledby="pills-user-tab">

        <div class="row">
          <div class="col-md-6">
            <?= form_open('admin/nav4'); ?>
            <label>Awal</label>
            <input type="date" class="form-control" name="awal">
          </div>
          <div class="col-md-6">
            <label>Akhir</label>
            <input type="date" class="form-control" name="akhir">
          </div>
        </div>
        <br>

        <br>
        <button name="report" class="btn btn-secondary">Select</button>
        </form>
        <br><br>
        <?php if($s1 == 1): ?>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Year</th>
              <th scope="col">User</th>
              <th scope="col">Jumlah Transaksi</th>
              <th scope="col">Total Shop</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($hasil4 as $hs): ?>
            <tr>
              <th><?= $hs['year']; ?></th>
              <th><?= $hs['name']; ?></th>
              <th><?= $hs['jmh'];?></th>
              <th>Rp. <?= number_format($hs['total_belanja']) ;?></th>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
      </div>
    </div>



  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->