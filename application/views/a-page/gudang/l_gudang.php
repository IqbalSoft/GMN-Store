<div class="m-3">
  <div class="container">
    <form action="" method="post" class="mt-3" id="form-search">
      <div class="row">
        <div class="col-md-4">
          <div class="input-group mb-3">
            <input type="text" class="form-control tombol" name="keyword_gudang" placeholder="Search">
            <div class="input-group-append">
              <input class="btn btn-outline-primary tombol" name="submit" type="submit" value="search">
            </div>
          </div>
        </div>
      </div>
    </form>
    <!-- akfir search -->

    <a href="<?= base_url('gudang/addGudang'); ?>" class="btn btn-primary mb-3">Add new warehouse</a>

    <div class="row">
      <div class="col-md-10 col-sm-12">
        <?= $this->session->flashdata('message'); ?>
      </div>
    </div>

    <table class="table table-striped table-responsive text-center">
      <thead>
        <tr>
          <th>No</th>
          <th>Warehouse code</th>
          <th>Warehouse Name</th>
          <th>Province</th>
          <th>address</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>
        <?php $i = 1; ?>
        <?php foreach ($l_Gudang as $row) : ?>
          <tr>
            <td><?= $i++; ?></td>
            <td><?= $row['warehouse_type']; ?>/<?= $row['id_warehouse']; ?>/<?= $row['created_at']; ?></td>
            <td><?= strtoupper($row['warehouse_name']); ?></td>
            <td><?= $row['province_name']; ?></td>
            <td>
              <?php
                $num_char = 25;
                $text = $row['address'];
                echo substr($text, 0, $num_char) . '...';
                ?>
            </td>
            <td>
              <a href="<?= base_url('gudang/deleteGudang/') . $row['id_warehouse']; ?>" onclick="return confirm('You sure delete this ?');" class="badge badge-danger">Delete</a>
              <a href="<?= base_url('gudang/editGudang/') . $row['id_warehouse']; ?>" class="badge badge-success">Edit</a>
              <a href="<?= base_url('gudang/detailGudang/') . $row['id_warehouse']; ?>" class="badge badge-primary">Detail</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <!-- pagination btn -->
    <?= $this->pagination->create_links(); ?>
  </div>
</div>