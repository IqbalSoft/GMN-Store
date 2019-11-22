<div class="m-3">
  <div class="container">

    <div class="row mb-3">
      <div class="col-md-4 col-12">
        <form action="" method="post" id="form-search">
          <div class="input-group mb-3">
            <input type="text" name="keyword" class="form-control tombol" placeholder="Search">
            <div class="input-group-append">
              <button class="btn btn-primary tombol d-flex" type="submit"><i class="fa fa-search"></i></button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <table class="table table-striped table-responsive text-center">
      <thead>
        <tr>
          <th>No</th>
          <th>Date Order</th>
          <th>Name</th>
          <th>Product Name</th>
          <th>Quantity Of Order</th>
          <th>Courier</th>
          <th>Total Payment</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($d_penjualanan as $row) : ?>
          <tr>
            <td><?= ++$start; ?></td>
            <td><?= date('d F Y ', $row['date_order']); ?></td>
            <td><?= $row['fullname']; ?></td>
            <td><?= $row['product_name']; ?></td>
            <td><?= $row['qty']; ?>x</td>
            <?php
              $pay_courier = $row['service'] * $row['total_weight'];
              $service = number_format($pay_courier, 0, ',', '.');
              ?>
            <td>
              <b><?= strtoupper($row['courier']); ?></b>, Rp. <?= $service; ?>
            </td>
            <?php
              $total_p = $row['price'] * $row['qty'] + $pay_courier;
              $harga   = number_format($total_p, 2, ',', '.');
              ?>
            <td>Rp. <?= $harga; ?> </td>
            <td>
              <a href="<?= base_url('penjualanan/detailTransaksi/') . $row['id_transaksi']; ?>" class="badge badge-primary">Detail</a>
              <a href="<?= base_url('penjualanan/confirm/') . $row['id_transaksi']; ?>" onclick="return confirm('You sure confirm this ?');" class="badge badge-success">Cofirm buying</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <?php if (empty($d_penjualanan)) : ?>
      <div class="row">
        <div class="col-md-9 col-sm-12">
          <div class="alert alert-danger">
            <p class="text-center mt-2">Data penjualanan kosong...</p>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <?php if (!empty($d_penjualanan)) : ?>
      <?= $this->pagination->create_links(); ?>
    <?php endif; ?>
  </div>
</div>