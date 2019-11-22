<div class="body-invoice">
  <div class="container py-3">
    <a href="<?= base_url('gudang/lGudang'); ?>" class="btn btn-outline-success text-white mb-2">
      <i class="fa fa-arrow-left"></i> Back</a>
    <div class="row">
      <div class="col-md-3">
        <img src="<?= base_url('assets/img/gudang/') . $detail['image_gudang']; ?>" width="100%" class="bg-light mb-3">
      </div>

      <div class="col-md-8">
        <div class="card p-3">
          <h3 class="text-center">Detail warehouse
            <hr class="hr">
          </h3>

          <table cellspacing="0" cellpadding="5">
            <tr>
              <td>Warehouse code</td>
              <td>:</td>
              <td><?= $detail['warehouse_type']; ?>/<?= $detail['id_warehouse']; ?>/<?= $detail['created_at']; ?></td>
            </tr>

            <tr>
              <td>Warehouse type</td>
              <td>:</td>
              <td>
                <?php
                $type = $detail['warehouse_type'];

                if ($type == 'ps') {
                  echo "Central warehouse";
                } else {
                  echo "Branch warehouse";
                }
                ?>
              </td>
            </tr>

            <tr>
              <td>Province</td>
              <td>:</td>
              <td><?= $detail['province_name']; ?></td>
            </tr>

            <tr>
              <td>City</td>
              <td>:</td>
              <td><?= $kota; ?></td>
            </tr>

            <tr>
              <td>Address</td>
              <td>:</td>
              <td><?= $detail['address']; ?></td>
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
</div>