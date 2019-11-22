<div class="container py-3">
  <form action="<?= base_url('product/central') ?>" method="post" class="mt-3" id="form-search">
    <div class="row">
      <div class="col-md-4">
        <div class="input-group mb-3">
          <input type="text" name="keyword_PC" class="form-control tombol" placeholder="Search">
          <div class="input-group-append">
            <input class="btn btn-outline-primary tombol" type="submit" name="submit" value="search">
          </div>
        </div>
      </div>
    </div>
  </form>
  <!-- akfir search -->

  <div class="row mt-3">
    <div class="col-md-3 col-sm-12">
      <h3><?= $title; ?></h3>
    </div>

    <div class="col-md-7 col-sm-12 mb-3 mt-3">
      <a href="<?= base_url('product'); ?>" class="btn btn-outline-secondary btn-sm my-warehouse">My Warehouse</a>
      <a href="<?= base_url('product/central'); ?>" class="btn btn-outline-secondary btn-sm active-btn">Central</a>
      <a href="<?= base_url('product/branch'); ?>" class="btn btn-outline-secondary btn-sm">Branch</a>
    </div>
  </div>

  <div class="row mt-3">
    <?php foreach ($LGudang as $row) : ?>
      <div class="col-md-4">
        <a href="<?= base_url('product/pDW/') . $row['id_warehouse']; ?>">
          <div class="alert alert-info text-center p-1">
            <h5><?= strtoupper($row['warehouse_name']); ?></h5>
            <small><strong><?= $row['province_name']; ?></strong></small>
          </div>
        </a>
      </div>
    <?php endforeach; ?>
  </div>

  <?php if (empty($LGudang)) : ?>
    <div class="row">
      <div class="col-md-6 text-center">
        <div class="alert alert-danger">
          Sorry warehouse not found!
        </div>
      </div>
    </div>
  <?php endif; ?>

  <!-- pagination btn -->
  <?= $this->pagination->create_links(); ?>
</div>