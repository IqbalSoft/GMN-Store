<div class="m-3">
  <div class="container">
    <form action="" method="post" class="mt-3" id="form-search">
      <div class="row">
        <div class="col-md-4">
          <div class="input-group mb-3">
            <input type="text" name="keyword" class="form-control tombol" placeholder="Search">
            <div class="input-group-append">
              <button class="btn btn-outline-primary tombol" type="submit"><i class="fa fa-search"></i></button>
            </div>
          </div>
        </div>
      </div>
    </form>
    <!-- akfir search -->

    <div class="row">
      <div class="col-md-10 col-sm-12">
        <div class="alert alert-warning text-center">
          Untuk mencari berdasarkan invoice number silahkan masukkan angka akhir saja !<br> <b>contoh = 'in/30/1547475760 => 1547475760'</b>
        </div>
      </div>
    </div>

    <table class="table-striped table-responsive text-center" cellpadding="10">
      <thead>
        <tr>
          <td></td>
          <th>Invoice Number</th>
          <th>Order Date</th>
          <th>Product Name</th>
          <th>Quantity Of Product</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>
        <?php $i = 1;
        foreach ($d_transaksi as $row) : ?>
          <tr>
            <td><?= ++$start; ?></td>
            <td>in/<?= $row['id_transaksi']; ?>/<?= $row['date_order']; ?></td>
            <td><?= date('d F Y', $row['date_order']); ?></td>
            <td><?= $row['product_name']; ?></td>
            <td><?= $row['qty']; ?> x</td>
            <?php
              if ($row['status_confirm'] == 1) {
                $color = 'danger';
                $text = 'Belum Dikirim';
              } else if ($row['status_confirm'] == 2) {
                $color = 'success';
                $text = 'Sudah Dikirim';
              }
              ?>
            <td>
              <div class="text-<?= $color; ?>"><?= $text; ?></div>
            </td>
            <td>
              <a href="<?= base_url('gudang/detailTransaksi/') . $row['id_transaksi']; ?>" class="badge badge-primary">Detail</a>
              <a href="<?= base_url('pembelian/faktur/') . $row['id_transaksi']; ?>" target="_blank" class="badge badge-success">Faktur</a>
              <a href="<?= base_url('pembelian/suratJalan/') . $row['id_transaksi']; ?>" target="_blank" class="badge badge-info">Surat Jalan</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <!-- alert ketika data tidak ada / kosong di db -->
    <?php if (empty($d_transaksi)) : ?>
      <div class="row">
        <div class="col-md-7 col-sm-12">
          <div class="alert alert-danger text-center">
            <b>Data empty for now.</b>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <!-- pagination btn -->
    <?= $this->pagination->create_links(); ?>
  </div>
</div>