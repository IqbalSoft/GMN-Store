<div class="body-invoice" style="height: 100vh;">
  <div class="container py-3">
    <a href="<?= base_url('gudang'); ?>" class="btn btn-primary mb-3">
      <i class="fa fa-arrow-left"></i> Back</a>

    <div class="row">
      <div class="col-md-8 col-sm-12">
        <div class="card p-1">
          <div class="row">
            <div class="col-md-10 col-sm-12">
              <img src="<?= base_url('assets/resi/') . $showResi['resi']; ?>" style="width: 100%;">
            </div>

            <div class="col-md-2 col-sm-12">
              <a href="<?= base_url('gudang/deleteResi/') . $showResi['id_transaksi']; ?>" class="btn btn-danger">
                <i class="fa fa-fw fa-trash"></i>
                Delete
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>