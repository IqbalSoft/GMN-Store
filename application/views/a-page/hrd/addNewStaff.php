<div class="body-invoice py-3">
  <div class="container">
    <h3 class="text-center text-white">Add New Staff
      <hr class="hr">
    </h3>

    <?= form_open_multipart('hrd/addNewStaff'); ?>
    <div class="card p-3">
      <div class="row">
        <div class="col-md-6 col-sm-12 mb-4">
          <label for="first_name">First Name :</label>
          <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter First name" value="<?= set_value('first_name'); ?>">
          <?= form_error('first_name', '<small class="text-danger pl-2">', '</small>'); ?>
        </div>
        <!-- akhir first name -->

        <div class="col-md-6 col-sm-12 mb-4">
          <label for="last_name">Last Name :</label>
          <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter Last name" value="<?= set_value('last_name'); ?>">
          <?= form_error('last_name', '<small class="text-danger pl-2">', '</small>'); ?>
        </div>
        <!-- akhir last name -->

        <div class="col-md-6 col-sm-12 mb-4">
          <label>Province :</label>
          <select name="province_id" onclick="get_kota('tujuan')" onmouseover="get_kota('tujuan')" id="provinsi_tujuan" class="form-control provinsi">
          </select>
          <?= form_error('province_id', '<small class="text-danger pl-2">', '</small>'); ?>
        </div>
        <!-- akhir province -->

        <div class="col-md-6 col-sm-12 mb-4">
          <label>City :</label>
          <select name="city_id" id="kota_tujuan" class="form-control">
          </select>
        </div>
        <!-- akhir city -->

        <div class="col-md-6 col-sm-12 mb-4">
          <label for="foto">Profile Picture :</label>
          <div class="input-group">
            <div class="custom-file">
              <input type="file" name="foto" class="custom-file-input" id="inputGroupFile04">
              <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
            </div>
          </div>
        </div>
        <!-- akhir profile picture -->

        <div class="col-md-6 col-sm-12 mb-4">
          <label for="post">Postal Code :</label>
          <input type="text" name="postal_code" id="post" placeholder="Enter Postal code" class="form-control" value="<?= set_value('postal_code'); ?>">
          <?= form_error('postal_code', '<small class="text-danger pl-2">', '</small>'); ?>
        </div>
        <!-- akhir postal code -->

        <div class="col-md-6 col-sm-12 mb-4">
          <label for="address">Full Address :</label>
          <textarea name="address" id="address" class="form-control" rows="1" placeholder="Enter full address" value="<?= set_value('address'); ?>"><?= set_value('address'); ?></textarea>
          <?= form_error('address', '<small class="text-danger pl-2">', '</small>'); ?>
        </div>
        <!-- akhir full address -->

        <div class="col-md-6 col-sm-12 mb-4">
          <label for="phone_number">Phone Number :</label>
          <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Enter Phone Number" value="<?= set_value('phone_number'); ?>">
          <?= form_error('phone_number', '<small class="text-danger pl-2">', '</small>'); ?>
        </div>
        <!-- akhir phone number -->

        <div class="col-md-6 col-sm-12 mb-4">
          <label for="email">Email :</label>
          <input type="text" name="email" id="email" placeholder="Enter email" value="<?= set_value('email'); ?>" class="form-control">
          <?= form_error('email', '<small class="text-danger pl-2">', '</small>'); ?>
        </div>
        <!-- akhir email -->

        <div class="col-md-6 col-12 mb-4">
          <div class="row">
            <div class="col-md-6 col-12">
              <label for="password">Password :</label>
              <input type="password" name="password1" id="password" placeholder="Enter password" class="form-control">
            </div>

            <div class="col-md-6 col-12">
              <label for="password2">Confirm Password :</label>
              <input type="password" name="password2" id="password2" placeholder="Enter password again" class="form-control">
            </div>
          </div>
          <?= form_error('password1', '<small class="text-danger pl-2">', '</small>'); ?>
        </div>

        <div class="col-md-6 col-sm-12 mb-4">
          <label for="role">Position :</label>
          <select name="role_id" id="" class="form-control">
            <?php foreach ($position as $row) : ?>
              <option value="<?= $row['role_id']; ?>"><?= $row['role_name']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <!-- akhir hak akses -->

        <div class="col-md-6 col-sm-12 mb-4">
          <label for="role">Warehouse :</label>
          <select name="warehouse" id="" class="form-control">
            <option value="">No Warehouse</option>
            <?php foreach ($warehouse as $row) : ?>
              <option value="<?= $row['id_warehouse']; ?>"><?= $row['warehouse_type']; ?>/<?= $row['id_warehouse']; ?>/<?= $row['created_at']; ?> | <?= $row['province_name']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <!-- akhir gudang -->

        <div class="col-md-6 col-sm-12">
          <button type="submit" class="btn btn-success">Add Staff</button>
        </div>
      </div>
    </div>
    </form>
  </div>
</div>