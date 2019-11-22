<div class="body-invoice">
  <div class="py-3">
    <div class="container">
      <a href="<?= base_url('hrd'); ?>" class="btn btn-primary mb-3">
        <i class="fa fa-arrow-left"></i> Back</a>
      <div class="card p-3">
        <h3 class="text-center">Detail Staff
          <hr>
        </h3>

        <div class="row">
          <div class="col-md-4 col-sm-12">
            <img src="<?= base_url('assets/img/user/') . $user['picture']; ?>" class="img-profile">
          </div>

          <div class="col-md-8 col-sm-12">
            <table cellspacing="0" cellpadding="5">
              <tr>
                <td>Name</td>
                <td>:</td>
                <td><?= $user['fullname']; ?></td>
              </tr>

              <tr>
                <td>Province</td>
                <td>:</td>
                <td><?= $provinsi; ?></td>
              </tr>

              <tr>
                <td>City</td>
                <td>:</td>
                <td><?= $kota; ?></td>
              </tr>

              <tr>
                <td>Full Address</td>
                <td>:</td>
                <td>
                  <?php
                  if ($user['address'] == '') {
                    echo '<div class="text-danger pl-2">', 'Not yet setting address', '</div>';
                  } else {
                    echo  $user['address'];
                  }
                  ?>
                </td>
              </tr>

              <tr>
                <td>Post Code</td>
                <td>:</td>
                <td>
                  <?php
                  if ($user['postal_code'] == '') {
                    echo '<div class="text-danger pl-2">', 'Not yet setting post code', '</div>';
                  } else {
                    echo  $user['postal_code'];
                  }
                  ?>
                </td>
              </tr>

              <tr>
                <td>Phone Number</td>
                <td>:</td>
                <td>
                  <?php
                  if ($user['phone_number'] == '') {
                    echo '<div class="text-danger pl-2">', 'Not yet setting phone number', '</div>';
                  } else {
                    echo  $user['phone_number'];
                  }
                  ?>
                </td>
              </tr>

              <tr>
                <td>Email</td>
                <td>:</td>
                <td><?= $user['email']; ?></td>
              </tr>

              <tr>
                <td>Position</td>
                <td>:</td>
                <td><?= $user['role_name']; ?></td>
              </tr>

              <tr>
                <td>Join since</td>
                <td>:</td>
                <td><?= date('d F Y', $user['date_created']); ?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>