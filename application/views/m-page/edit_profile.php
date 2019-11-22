<?php
if ($user['role_id'] == 4) {
  $redirect = '';
} else if ($user['role_id'] == 3) {
  $redirect = 'penjualanan';
} else if ($user['role_id'] == 2) {
  $redirect = 'pembelian';
} else if ($user['role_id'] == 1) {
  $redirect = 'gudang';
} else if ($user['role_id'] == 5) {
  $redirect = 'hrd';
} else if ($user['role_id'] == 6) {
  $redirect = 'supervisor';
}
?>
<div class="body-invoice bd-detailP">
  <div class="mr-3 ml-3 mb-3">
    <a href="<?= base_url($redirect); ?>" class="btn btn-outline-primary mb-3 ml-3 mt-3 text-white">
      <i class="fa fa-arrow-left"></i> back</a>
    <div class="row">
      <div class="col-md-4 col-sm-12 mb-3">
        <img src="<?= base_url('assets/img/user/') . $user['picture']; ?>" class="img-profile" style="height: 50%;">
      </div>

      <div class="col-md-8 col-sm-12">
        <div class="card p-3">
          <h3 class="text-center">Edit Profile
            <hr class="hr">
          </h3>

          <div class="alert alert-warning text-center" role="alert">
            <strong>Maaf tolong di pilih kembali provinsi dan kota anda apabila mengedit data !</strong>
          </div>

          <?= form_open_multipart('member/edit'); ?>
          <input type="hidden" name="picture" value="<?= $user['picture']; ?>">
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <label for="nama2">Last name :</label>
              <input type="text" name="fullname" id="nama2" value="<?= $user['fullname']; ?>" placeholder="Enter last name..." class="form-control">
              <?= form_error('last_name', '<small class="text-danger pl-2">', '</small>'); ?>
              <br>
            </div>

            <div class="col-md-6 col-sm-12">
              <label for="no_telp">Phone Number :</label>
              <input type="tel" name="phone_number" id="no_telp" value="<?= $user['phone_number']; ?>" class="form-control" placeholder="enter your phone number...">
              <?= form_error('phone_number', '<small class="text-danger pl-2">', '</small>'); ?>
              <br>
            </div>

            <div class="col-md-6 col-sm-12">
              <label for="email">Email :</label>
              <input type="email" name="email" id="emaail" value="<?= $user['email']; ?>" class="form-control" placeholder="enter your email...">
              <?= form_error('email', '<small class="text-danger pl-2">', '</small>'); ?>
              <br>
            </div>

            <div class="col-md-6 col-sm-12">
              <label for="foto">Profile Picture :</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="picture" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
                  <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                </div>
              </div>
              <br>
            </div>

            <div class="col-md-6 col-sm-12">
              <label>Province</label>
              <select name="province_id" onclick="get_kota('tujuan')" onmouseover="get_kota('tujuan')" id="provinsi_tujuan" class="form-control provinsi">
              </select>
              <?= form_error('province_id', '<small class="text-danger pl-2">', '</small>'); ?>
              <br>
            </div>

            <div class="col-md-6 col-sm-12">
              <label>City</label>
              <select name="city_id" id="kota_tujuan" class="form-control">
              </select>
              <?= form_error('city_id', '<small class="text-danger pl-2">', '</small>'); ?>
              <br>
            </div>

            <div class="col-md-6 col-sm-12">
              <label for="post">Post Code :</label>
              <input type="text" name="post_code" id="post" value="<?= $user['postal_code']; ?>" class="form-control" placeholder="Enter your post code...">
              <?= form_error('post_code', '<small class="text-danger pl-2">', '</small>'); ?>
              <br>
            </div>

            <div class="col-md-6 col-sm-12">
              <label for="alamat">Full Address :</label>
              <input type="text" name="address" id="alamat" value="<?= $user['address']; ?>" class="form-control" placeholder="Enter your address...">
              <?= form_error('address', '<small class="text-danger pl-2">', '</small>'); ?>
              <br>
            </div>

            <div class="col-md-6 col-sm-12">
              <button type="submit" class="btn btn-primary">Edit Profile</button>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>