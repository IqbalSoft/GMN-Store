<div class="body-invoice">
  <div class="container py-3">
    <div class="t-nav">
      <a href="<?= base_url('shop/history_order'); ?>" class="btn btn-success">
        <i class="fa fa-arrow-left"></i> Back</a> </div>
    <div class="row mt-3">
      <div class="col-md-6 col-sm-12">
        <h6 class="text-white"><i class="fas fa-map-marker-alt"></i> Delivery Address</h6>
        <div class="card p-2 mb-3">
          <p><b><?= $user['first_name'] . ' ' . $user['last_name']; ?></b></p>
          <p><?= $user['address'] ?>.<br> <?= $kota; ?>, <?= $provinsi; ?></p>
        </div>
      </div>

      <div class="col-md-6 col-sm-12">
        <a href="<?= base_url('shop/detail_product/') . $h_order['id_product']; ?>" class="text-white">
          <i class="fa fa-warehouse"></i>
          <i class="fa fa-arrow-right float-right"></i>
          <hr>
        </a>
        <div class="row">
          <div class="col-md-4">
            <img src="<?= base_url('assets/img/produk/') . $h_order['image']; ?>" style="width: 80%;">
          </div>

          <div class="col mt-3 text-white">
            <table cellspacing="0" cellpadding="5">
              <tr>
                <td>Brand</td>
                <td>:</td>
                <td><?= $h_order['product_name']; ?></td>
              </tr>

              <tr>
                <?php
                $price = number_format($h_order['price'], 0, ',', '.');
                ?>
                <td>Price</td>
                <td>:</td>
                <td>Rp <?= $price; ?></td>
              </tr>

              <tr>
                <td>Weight</td>
                <td>:</td>
                <td><?= $h_order['weight']; ?> Kg +-</td>
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
            <td>in/<?= $h_order['id_transaksi']; ?>/<?= $h_order['date_order']; ?></td>
          </tr>

          <tr>
            <td>Date Order</td>
            <td>:</td>
            <td><?= date('d F Y', $h_order['date_order']); ?></td>
          </tr>

          <tr>
            <td>Subtotal of product</td>
            <td>:</td>
            <td>
              <?php
              $subtotal = number_format($h_order['price'], 0, ',', '.');
              ?>
              Rp <?= $subtotal; ?>
            </td>
          </tr>

          <tr>
            <td>Quantity of product</td>
            <td>:</td>
            <td><?= $h_order['qty']; ?>x</td>
          </tr>

          <tr>
            <td>Weight Of Product</td>
            <td>:</td>
            <td><?= $h_order['weight']; ?>Kg x <?= $h_order['qty']; ?> Plywood</td>
          </tr>

          <tr>
            <td>Courier</td>
            <td>:</td>
            <td><?= $h_order['courier']; ?></td>
          </tr>

          <tr>
            <td>Service Courier</td>
            <td>:</td>
            <td>
              <?php
              $pay_courier = $h_order['service'] * $h_order['total_weight'];

              $service = number_format($pay_courier, 0, ',', '.');
              ?>
              Rp <?= $service; ?>
            </td>
          </tr>

          <tr>
            <td>Payment Method</td>
            <td>:</td>
            <td>Transfer via <?= $h_order['payment_method']; ?></td>
          </tr>

          <tr>
            <td>Total Payment </td>
            <td>:</td>
            <td>
              <?php
              $total_p = $h_order['price'] * $h_order['qty'] + $pay_courier;
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