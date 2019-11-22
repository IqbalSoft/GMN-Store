<?php
if ($user_login['role_id'] == 5) {
  $redirect = '';
} else if ($user_login['role_id'] == 4) {
  $redirect = 'penjualanan';
} else if ($user_login['role_id'] == 3) {
  $redirect = 'pembelian';
} else if ($user_login['role_id'] == 2) {
  $redirect = 'gudang';
} else if ($user_login['role_id'] == 6) {
  $redirect = 'hrd';
}
?>

<div class="body-invoice">
  <div class="container py-3">
    <div class="t-nav">
      <a href="<?= base_url($redirect); ?>" class="btn btn-success">
        <i class="fa fa-arrow-left"></i> Back</a> </div>
    <div class="row mt-3">
      <div class="col-md-6 col-sm-12">
        <h6 class="text-white"><i class="fas fa-map-marker-alt"></i> Delivery Address</h6>
        <div class="card p-2 mb-3">
          <p><b><?= $user['fullname']; ?></b></p>
          <p><?= $user['address'] ?>.<br> <?= $kota; ?>, <?= $provinsi; ?></p>
        </div>
      </div>

      <div class="col-md-6 col-sm-12">
        <a href="<?= base_url('shop/detail_product/') . $detail_order['id_product']; ?>" class="text-white">
          <i class="fa fa-warehouse"></i>
          <?= $detail_order['warehouse_name']; ?>
          <i class="fa fa-arrow-right float-right"></i>
          <hr>
        </a>
        <div class="row">
          <div class="col-md-4">
            <img src="<?= base_url('assets/img/produk/') . $detail_order['image']; ?>" style="width: 80%;">
          </div>

          <div class="col mt-3 text-white">
            <table cellspacing="0" cellpadding="5">
              <tr>
                <td>Brand</td>
                <td>:</td>
                <td><?= $detail_order['product_name']; ?></td>
              </tr>

              <tr>
                <?php
                $price = number_format($detail_order['price'], 0, ',', '.');
                ?>
                <td>Price</td>
                <td>:</td>
                <td>Rp <?= $price; ?></td>
              </tr>

              <tr>
                <td>Weight</td>
                <td>:</td>
                <td><?= $detail_order['weight']; ?> Kg +-</td>
              </tr>
            </table>
          </div>
        </div>
        <hr>
      </div>

      <div class="col-md-12 col-sm-12">
        <h6 class="text-white"><i class="fas fa-money-check-alt"></i> Payment Information</h6>
        <table cellspacing="0" cellpadding="5" class="bg-success text-white" style="border-radius: 5px;">
          <tr>
            <td>Invoice Number</td>
            <td>:</td>
            <td>in/<?= $detail_order['id_transaksi']; ?>/<?= $detail_order['date_order']; ?></td>
          </tr>

          <tr>
            <td>Date Order</td>
            <td>:</td>
            <td><?= date('d F Y', $detail_order['date_order']); ?></td>
          </tr>

          <tr>
            <td>Subtotal of product</td>
            <td>:</td>
            <td>
              <?php
              $subtotal = number_format($detail_order['price'], 0, ',', '.');
              ?>
              Rp <?= $subtotal; ?>
            </td>
          </tr>

          <tr>
            <td>Quantity of product</td>
            <td>:</td>
            <td><?= $detail_order['qty']; ?>x</td>
          </tr>

          <tr>
            <td>Weight Of Product</td>
            <td>:</td>
            <td><?= $detail_order['weight']; ?>Kg x <?= $detail_order['qty']; ?> Plywood</td>
          </tr>

          <tr>
            <td>Courier</td>
            <td>:</td>
            <td><?= $detail_order['courier']; ?></td>
          </tr>

          <tr>
            <td>Service Courier</td>
            <td>:</td>
            <td>
              <?php
              $pay_courier = $detail_order['service'] * $detail_order['total_weight'];

              $service = number_format($pay_courier, 0, ',', '.');
              ?>
              Rp <?= $service; ?>
            </td>
          </tr>

          <tr>
            <td>Payment Method</td>
            <td>:</td>
            <td>Transfer via <?= strtoupper($bank['bank_name']); ?></td>
          </tr>

          <tr>
            <td>Total Payment </td>
            <td>:</td>
            <td>
              <?php
              $total_p = $detail_order['price'] * $detail_order['qty'] + $pay_courier;
              $harga   = number_format($total_p, 2, ',', '.');
              ?>
              <b>Rp <?= $harga; ?></b>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>