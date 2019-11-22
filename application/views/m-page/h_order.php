<div class="body-invoice">
  <div class="container py-3">
    <a href="<?= base_url(); ?>" class="btn btn-outline-success text-white mb-3">
      <i class="fa fa-arrow-left"></i> Back</a>
    <h3 class="mb-3 text-light">Purchase History</h3>

    <div class="row">
      <?php foreach ($h_order as $row) : ?>
      <div class="col-md-4 col-sm-12 mb-3">
        <a href="<?= base_url('shop/detail_hOrder/') . $row['id_transaksi']; ?>" class="card p-2 text-dark bg-light">
          <h5><b>in/<?= $row['id_transaksi']; ?>/<?= $row['date_order'] ?></b></h5>
          <h6 class="ml-auto mr-2"><?= date('d F Y', $row['date_order']); ?></h6>
        </a>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>