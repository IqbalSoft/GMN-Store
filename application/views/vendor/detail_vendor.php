<?php
if ($user['role_id'] == 5) {
  $redirect = '';
} else if ($user['role_id'] == 4) {
  $redirect = 'penjualanan';
} else if ($user['role_id'] == 3) {
  $redirect = 'pembelian';
} else if ($user['role_id'] == 2) {
  $redirect = 'gudang';
}
?>
<div class="body-invoice">
  <div class="container py-3">
    <div class="row">
      <div class="col-md-8">
        <a href="<?= base_url($redirect); ?>" class="btn btn-outline-primary mb-2">
          <-- Back</a> <div class="card p-3">
            <h3 class="text-center">Detail Vendor
              <hr class="hr">
            </h3>

            <table cellspacing="0" cellpadding="5">
              <tr>
                <td>Vendor code</td>
                <td>:</td>
                <td>vd/<?= $detail['id_vendor']; ?>/<?= $detail['created_at']; ?></td>
              </tr>

              <tr>
                <td>Vendor name</td>
                <td>:</td>
                <td><?= $detail['vendor_name']; ?></td>
              </tr>

              <tr>
                <td>Product type</td>
                <td>:</td>
                <td><?= $detail['product_type']; ?></td>
              </tr>

              <tr>
                <td>Email</td>
                <td>:</td>
                <td><?= $detail['email']; ?></td>
              </tr>

              <tr>
                <td>Telephone number</td>
                <td>:</td>
                <td><?= $detail['phone_number']; ?></td>
              </tr>

              <tr>
                <td>Office address</td>
                <td>:</td>
                <td><?= $detail['address'] ?></td>
              </tr>

              <tr>
                <td>Join since</td>
                <td>:</td>
                <td><?= date('d F Y', $detail['created_at']); ?></td>
              </tr>
            </table>
      </div>
    </div>
  </div>
</div>