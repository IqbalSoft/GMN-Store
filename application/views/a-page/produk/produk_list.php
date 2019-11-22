<div class="container py-3">
  <form action="" method="post" class="mt-3" id="form-search">
    <div class="row">
      <div class="col-md-4">
        <div class="input-group mb-3">
          <input type="text" name="keyword" class="form-control tombol" placeholder="Search">
          <div class="input-group-append">
            <button class="btn btn-outline-primary tombol" type="submit"><i class="fa fa-search"></i></button>
          </div>
        </div>
      </div>
    </div>
  </form>
  <!-- akfir search -->

  <div class="row mt-3">
    <div class="col-md-2 col-sm-12">
      <h3><?= $title; ?></h3>
    </div>

    <div class="col-md-8 col-sm-12 mb-3 ml-4 mt-3">
      <a href="<?= base_url('product/addProduct'); ?>" class="btn btn-primary btn-sm">Add new product</a> |
      <a href="<?= base_url('product'); ?>" class="btn btn-outline-secondary btn-sm my-warehouse bd active-btn">My Warehouse</a>
      <a href="<?= base_url('product/central'); ?>" class="btn btn-outline-secondary btn-sm bd-central bd">Central</a>
      <a href="<?= base_url('product/branch'); ?>" class="btn btn-outline-secondary btn-sm bd-branch bd">Branch</a>
    </div>
  </div>

  <div class="row">
    <div class="col-md-7 col-sm-12">
      <?= $this->session->flashdata('message'); ?>
    </div>
  </div>

  <div id="c-p">
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
        <?php foreach ($produk as $row) : ?>
          <tr>
            <td><?= ++$start; ?></td>
            <td>
              <?php
                $num_char = 30;
                $text = $row['product_name'];
                echo substr($text, 0, $num_char) . '...';
                ?>
            </td>
            <?php
              $format = number_format($row['price'], 0, ',', '.');
              ?>
            <td><b>Rp.</b> <?= $format; ?> </td>
            <td><?= $row['product_type']; ?> </td>
            <td><?= $row['product_stock']; ?> Pcs </td>
            <td>
              <a href="<?= base_url('product/dP/') . $row['id_product']; ?>" onclick="return confirm('You sure delete this product ?');" class="badge badge-danger">Delete</a>
              <a href="<?= base_url('product/eP/') . $row['id_product']; ?>" class="badge badge-success">Edit</a>
              <a href="<?= base_url('product/dtP/') . $row['id_product']; ?>" class="badge badge-primary">Detail</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- paginatio btn -->
  <?= $this->pagination->create_links(); ?>
</div>