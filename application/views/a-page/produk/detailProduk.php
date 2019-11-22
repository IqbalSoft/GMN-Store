<?php
if ($user['role_id'] == 4) {
  $redirect = '';
} else if ($user['role_id'] == 3) {
  $redirect = 'penjualanan';
} else if ($user['role_id'] == 2) {
  $redirect = 'pembelian';
} else if ($user['role_id'] == 1) {
  $redirect = 'gudang';
} else if ($user['role_id'] == 5) {
  $redirect = 'hrd';
} else if ($user['role_id'] == 6) {
  $redirect = 'supervisor';
}
?>

<div class="body-invoice">
  <div class="container py-3">
    <a href="<?= base_url($redirect); ?>" class="btn btn-outline-success text-white mb-3">
      <i class="fa fa-arrow-left"></i> Back</a>
    <div class="row">
      <div class="col-md-3 col-sm-12">
        <img src="<?= base_url('assets/img/produk/') . $produk['image']; ?>" class="img-produk">
      </div>

      <div class="col-md-9 col-sm-12">
        <div class="card p-3">
          <h3 class="text-center">Detail Product
            <hr class="hr">
          </h3>
          <table cellspacing="0" cellpadding="5">
            <tr>
              <th>Product Name</th>
              <td>:</td>
              <td><?= $produk['product_name']; ?></td>
            </tr>

            <tr>
              <th>Weight</th>
              <td>:</td>
              <td><?= $produk['weight']; ?>Kg +-</td>
            </tr>

            <tr>
              <th>Price</th>
              <td>:</td>
              <td>Rp. <?= $produk['price']; ?></td>
            </tr>

            <tr>
              <th>Stock</th>
              <td>:</td>
              <td><?= $produk['product_stock']; ?>Pcs</td>
            </tr>

            <tr>
              <th>Vendor Product</th>
              <td>:</td>
              <td><?= $produk['vendor_name']; ?></td>
            </tr>

            <tr>
              <th>Product arrive </th>
              <td>:</td>
              <td><?= date('d F Y', $produk['product_arrive']); ?></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>