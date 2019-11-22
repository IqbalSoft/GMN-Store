<div class="body-auth auth-register">
  <div class="row m-0">
    <div class="col col-md-5 col-sm-12">
      <div class="card mt-3 p-3" id="form-login">
        <div class="container">
          <h3 class="title-login text-center">Sign up here...
            <hr class="hr">
          </h3>

          <form action="<?= base_url('auth/register'); ?>" method="post">
            <div class="row">
              <div class="col-md-6">
                <label for="name1">First name : </label>
                <input type="text" name="first_name" id="name" placeholder="Enter your first name..." class="form-control" value="<?= set_value('first_name'); ?>">
                <?= form_error('first_name', '<small class="text-danger pl-2">', '</small>'); ?>
                <br>
              </div>
              <div class="col-md-6">
                <label for="name2">Last name : </label>
                <input type="text" name="last_name" id="name" placeholder="Enter your last name..." class="form-control" value="<?= set_value('last_name'); ?>">
                <?= form_error('last_name', '<small class="text-danger pl-2">', '</small>'); ?>
                <br>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <label>Province</label>
                <select name="province_id" onclick="get_kota('tujuan')" onmouseover="get_kota('tujuan')" id="provinsi_tujuan" class="form-control provinsi">
                </select>
                <?= form_error('province_id', '<small class="text-danger pl-2">', '</small>'); ?>
                <br>
              </div>

              <div class="col-md-6">
                <label>City</label>
                <select name="city_id" id="kota_tujuan" class="form-control">
                </select>
                <?= form_error('city_id', '<small class="text-danger pl-2">', '</small>'); ?>
                <br>
              </div>
            </div>

            <label for="email">Email : </label>
            <input type="text" name="email" id="email" placeholder="Enter your email..." class="form-control" value="<?= set_value('email'); ?>">
            <?= form_error('email', '<small class="text-danger pl-2">', '</small>'); ?>
            <br>
            <label for="password">Password : </label>
            <input type="password" name="password1" id="password" placeholder="Enter your password..." class="form-control">
            <?= form_error('password1', '<small class="text-danger pl-2">', '</small>'); ?>
            <br>
            <label for="password">Confirm Password : </label>
            <input type="password" name="password2" id="password" placeholder="Enter your password again..." class="form-control">
            <br>
            <button type="submit" class="btn btn-success tombol">Sign up</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>