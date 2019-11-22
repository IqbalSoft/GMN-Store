<div class="body-invoice">
  <div class="container py-3">
    <div class="t-nav">
      <a href="<?= base_url(); ?>" class="btn btn-success">
        <i class="fa fa-arrow-left"></i> Back</a> </div>

    <div class="alert alert-warning mt-2">
      <b>Note : </b>harap segera melakukan <b>TRANSFER VIA <?= strtoupper($bank['bank_name']) . ' ' . $bank['no_rekening']; ?>, atas nama GLOBAL MEDIA NUSANTARA</b>
      <div class="confrim">
        <i>Silahkan konfirmasi pembayaran anda ke nomor berikut : <b>082355667756</b>.</i>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-md-6 col-sm-12">
        <h6 class="text-white"><i class="fas fa-map-marker-alt"></i> Delivery Address</h6>
        <div class="card p-2 mb-3">
          <p><b><?= $user['fullname']; ?></b></p>
          <p><?= $user['address'] ?>.<br> <?= $kota; ?>, <?= $provinsi; ?></p>
        </div>
      </div>

      <div class="col-md-6 col-sm-12">
        <a class="text-white" href="<?= base_url('shop/detail_product/') . $invoice['id_product']; ?>">
          <i class="fa fa-warehouse"></i> <?= $gudang['warehouse_name']; ?>
          <i class="fa fa-arrow-right float-right"></i>
          <hr>
        </a>
        <div class="row">
          <div class="col-md-4">
            <img src="<?= base_url('assets/img/produk/') . $invoice['image']; ?>" style="width: 80%;">
          </div>

          <div class="col mt-3 text-white">
            <table cellspacing="0" cellpadding="5">
              <tr>
                <td>Brand</td>
                <td>:</td>
                <td><?= $invoice['product_name']; ?></td>
              </tr>

              <tr>
                <?php
                $price = number_format($invoice['price'], 0, ',', '.');
                ?>
                <td>Price</td>
                <td>:</td>
                <td>Rp <?= $price; ?></td>
              </tr>

              <tr>
                <td>Weight</td>
                <td>:</td>
                <td><?= $invoice['weight']; ?> Kg +-</td>
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
            <td>in/<?= $invoice['id_transaksi']; ?>/<?= $invoice['date_order']; ?></td>
          </tr>

          <tr>
            <td>Date Order</td>
            <td>:</td>
            <td><?= date('d F Y', $invoice['date_order']); ?></td>
          </tr>

          <tr>
            <td>Subtotal of product</td>
            <td>:</td>
            <td>
              <?php
              $subtotal = number_format($invoice['price'], 0, ',', '.');
              ?>
              Rp <?= $subtotal; ?>
            </td>
          </tr>

          <tr>
            <td>Quantity of product</td>
            <td>:</td>
            <td><?= $invoice['qty']; ?>x</td>
          </tr>

          <tr>
            <td>Weight Of Product</td>
            <td>:</td>
            <td><?= $invoice['weight']; ?>Kg x <?= $invoice['qty']; ?> Plywood</td>
          </tr>

          <tr>
            <td>Courier</td>
            <td>:</td>
            <td><?= $invoice['courier']; ?></td>
          </tr>

          <tr>
            <td>Service Courier</td>
            <td>:</td>
            <td>
              <?php
              $pay_courier = $invoice['service'] * $invoice['total_weight'];

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
              $total_p = $invoice['price'] * $invoice['qty'] + $pay_courier;
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