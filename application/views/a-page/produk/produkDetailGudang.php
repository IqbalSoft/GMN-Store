<?php
if ($user['role_id'] == 5) {
  $redirect = '';
} else if ($user['role_id'] == 4) {
  $redirect = 'penjualanan';
} else if ($user['role_id'] == 3) {
  $redirect = 'pembelian/product';
} else if ($user['role_id'] == 2) {
  $redirect = 'product';
}
?>

<div class="body-invoice py-3">
  <div class="container">
    <a href="<?= base_url($redirect); ?>" class="btn btn-outline-success text-white mb-3">
      <i class="fa fa-arrow-left"></i> Back </a>
    <!-- isi content -->
    <div class="row">
      <div class="col-md-auto">
        <div class="card">
          <table class="table table-striped table-responsive text-center">
            <thead>
              <tr>
                <th>No</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Stock</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>
              <?php
              $i = 1;
              foreach ($LProduk as $row) :
                ?>
              <tr>
                <td><?= $i++; ?></td>
                <td>
                  <?php
                    $num_char = 30;
                    $text = $row['product_name'];
                    echo substr($text, 0, $num_char) . '...';
                    ?>
                </td>
                <td>Rp. <?= $row['price']; ?> </td>
                <td><?= $row['product_type']; ?> </td>
                <td><?= $row['product_stock']; ?> Pcs </td>
                <td>
                  <a href="<?= base_url('product/dtP/') . $row['id_product']; ?>" class="badge badge-primary">Detail</a>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- akhir isi content -->
  </div>
</div>