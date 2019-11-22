<div class="body-invoice">
  <div class="container py-3">
    <div class="card p-3">
      <h3 class="text-center">Edit Vendor
        <hr class="hr">
      </h3>
      <form action="<?= base_url('vendor/editVendor/') . $edit['id_vendor']; ?>" method="post">
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <label for="vendor_name">Vendor Name :</label>
            <input type="text" name="vendor_name" id="vendor_name" class="form-control" value="<?= $edit['vendor_name']; ?>" placeholder="Enter vendor name...">
            <?= form_error('vendor_name', '<small class="text-danger pl-2">', '</small>'); ?>
            <br>
          </div>

          <div class="col-md-6 col-sm-12">
            <label for="product_type">Product Type :</label>
            <select name="product_type" id="product_type" class="form-control">
              <option value="Wood">Wood</option>
              <option value="Iron">Iron</option>
              <option value="Plastic">Plastic</option>
              <option value="Go Grenn">Go-Green</option>
            </select><br>
          </div>

          <div class="col-md-6 col-sm-12">
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" class="form-control" value="<?= $edit['email']; ?>" placeholder="Enter email vendor office...">
            <?= form_error('email', '<small class="text-danger pl-2">', '</small>'); ?>
            <br>
          </div>

          <div class="col-md-6 col-sm-12">
            <label for="telp">Telephone number :</label>
            <input type="tel" name="phone_number" id="telp" class="form-control" value="<?= $edit['phone_number']; ?>" placeholder="Enter vendor phone number office...">
            <?= form_error('phone_number', '<small class="text-danger pl-2">', '</small>'); ?>
            <br>
          </div>

          <div class="col-md-12 col-sm-12">
            <label for="address">Address :</label>
            <textarea name="address" id="address" rows="5" class="form-control" value="<?= $edit['address']; ?>" placeholder="Enter address vendor office..."><?= $edit['address']; ?></textarea>
            <?= form_error('address', '<small class="text-danger pl-2">', '</small>'); ?>
          </div>

          <div class="col-md-12">
            <button type="submit" class="btn btn-success mt-3">Edit</button>
            <a href="<?= base_url('vendor'); ?>" class="btn btn-danger mt-3">Cancel</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>