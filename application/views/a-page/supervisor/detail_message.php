<div class="body-invoice">
  <div class="container py-3">
    <a href="<?= base_url('supervisor'); ?>" class="btn btn-success mb-3"><i class="fa fa-arrow-left"></i> Back</a>
    <div class="row">
      <div class="col-md-6">
        <div class="card p-3">
          <table cellspacing="0" cellpadding="10">
            <tr>
              <th>Name</th>
              <th>:</th>
              <td><?= strtoupper($detailMessage['fullname']); ?></td>
            </tr>

            <tr>
              <th>Email from</th>
              <th>:</th>
              <td><?= $detailMessage['email']; ?></td>
            </tr>

            <tr>
              <th>Date</th>
              <th>:</th>
              <td><?= date('d F Y', $detailMessage['created_at']); ?></td>
            </tr>

            <tr>
              <td colspan="3">
                <p><?= $detailMessage['message'] ?></p>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>