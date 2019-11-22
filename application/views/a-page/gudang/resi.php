<div class="body-invoice" style="height: 100vh;">
  <div class="container py-3">
    <a href="<?= base_url('gudang') ?>" class="btn btn-primary mb-3">
      <-- Back</a> <div class="row">
        <div class="col-md-7 col-sm-12">
          <div class="card p-3 ">
            <h3 class="text-center">Upload Resi
              <hr class="hr">
            </h3>

            <form action="<?= base_url('gudang/addResi/') . $id_transaksi; ?>" method="POST" enctype="multipart/form-data">
              <div class="input-group mb-3">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="resiFile" id="inputGroupFile04">
                  <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                </div>
              </div>
              <button type="submit" class="btn btn-success float-right">Upload <i class="fa fa-upload"></i></button>
            </form>
          </div>
        </div>
  </div>
</div>
</div>