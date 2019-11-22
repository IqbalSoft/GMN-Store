<div class="container py-3">
  <!-- awal search -->
  <form action="" method="post" class="mt-3" id="form-search">
    <div class="row">
      <div class="col-md-4">
        <div class="input-group mb-3">
          <input type="text" name="keyword" class="form-control tombol" placeholder="Search">
          <div class="input-group-append">
            <input class="btn btn-outline-primary tombol" type="submit" value="search">
          </div>
        </div>
      </div>
    </div>
  </form>
  <!-- akfir search -->

  <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modelId">Add new vendor</a>

  <div class="row">
    <div class="col-md-7 col-sm-12 text-center">
      <div class="alert alert-warning">
        Untuk mencari berdasarkan vendor code silahkan masukkan angka akhir saja<br> <b>contoh = 'vd/9/1565854013 => 1565854013'</b>
      </div>
    </div>
  </div>

  <table class="table table-striped table-responsive text-center">
    <thead>
      <tr>
        <th>No</th>
        <th>Vendor code</th>
        <th>Vendor name</th>
        <th>Product type</th>
        <th>Action</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($vendor_list as $row) : ?>
        <tr>
          <td><?= ++$start; ?></td>
          <td>vd/<?= $row['id_vendor']; ?>/<?= $row['created_at']; ?></td>
          <td>
            <?php
              $num_char = 20;
              $text = $row['vendor_name'];
              echo substr($text, 0, $num_char) . '...';
              ?>
          </td>
          <td><?= $row['product_type']; ?></td>
          <td>
            <a href="<?= base_url('vendor/deleteVendor/') . $row['id_vendor']; ?>" onclick="return confirm('You sure delete this ?');" class="badge badge-danger">Delete</a>
            <a href="<?= base_url('vendor/editVendor/') . $row['id_vendor']; ?>" class="badge badge-success">Edit</a>
            <a href="<?= base_url('vendor/detailVendor/') . $row['id_vendor']; ?>" class="badge badge-primary">Detail</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <?php if (empty($vendor_list)) : ?>
    <div class="row">
      <div class="col-md-7 col-sm-12">
        <div class="alert alert-danger text-center">Vendor not found!</div>
      </div>
    </div>
  <?php endif; ?>

  <!-- pagination btn -->
  <?= $this->pagination->create_links(); ?>
</div>

<!-- form add new vendor -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Add new vendor</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('vendor/addVendor'); ?>" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <label for="vendor_name">Vendor Name :</label>
              <input type="text" name="vendor_name" id="vendor_name" class="form-control" placeholder="Enter vendor name..." required><br>
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
              <input type="email" name="email" id="email" class="form-control" placeholder="Enter email vendor office..." required><br>
            </div>

            <div class="col-md-6 col-sm-12">
              <label for="telp">Telephone number :</label>
              <input type="tel" name="phone_number" id="telp" class="form-control" placeholder="Enter vendor phone number office..." required><br>
            </div>

            <div class="col-md-12 col-sm-12">
              <label for="address">Address :</label>
              <textarea name="address" id="address" rows="5" class="form-control" placeholder="Enter address vendor office..." required></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>