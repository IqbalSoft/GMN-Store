<?php
if ($user['role_id'] == 3) {
  $redirect = "pembelian/product";
} elseif ($user['role_id'] == 4) {
  $redirect = "penjualanan/product";
}
?>
<div class="body-invoice">
  <div class="container py-3">
    <a href="<?= base_url($redirect); ?>" class="btn btn-outline-primary text-white">
      <i class="fa fa-arrow-left"></i> Back</a>
    <h3 class="mt-3 text-white">Branch Warehouse</h3>

    <form action="" method="post" class="mt-3" id="form-search">
      <div class="row">
        <div class="col-md-4">
          <div class="input-group">
            <input type="text" name="keyword_PB" class="form-control tombol" placeholder="Search" autofocus>
            <div class="input-group-append">
              <input class="btn btn-primary tombol" type="submit" value="search" name="submit">
            </div>
          </div>
        </div>
      </div>
    </form>

    <div class="row mt-3">
      <?php foreach ($warehouse as $row) : ?>
        <div class="col-md-4">
          <a href="<?= base_url('product/pDW/') . $row['id_warehouse']; ?>">
            <div class="alert alert-info text-center p-1">
              <h5><?= strtoupper($row['warehouse_name']); ?></h5>
              <small><strong><?= $row['province_name']; ?></strong></small>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>