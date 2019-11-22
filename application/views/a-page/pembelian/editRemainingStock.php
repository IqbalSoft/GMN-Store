<div class="body-invoice">
  <div class="container py-3">
    <div class="row">
      <div class="col-md-8">
        <div class="card p-3">
          <h3 class="text-center">Edit Remaining Stock
            <hr class="hr">
          </h3>
          <form action="<?= base_url('pembelian/remainingStock'); ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_user" value="<?= $detail_RS['id_user']; ?>">
            <div class="row">
              <div class="col-md-6 col-sm-12">
                <label for="gudang">Warehouse :</label>
                <select name="id_gudang" id="" class="form-control mb-3">
                  <?php foreach ($gudang as $wn) : ?>
                    <option value="<?= $wn['id_warehouse']; ?>" <?php if ($wn['id_warehouse'] == $detail_RS['id_gudang']) {
                                                                    echo "selected";
                                                                  } ?>><?= strtoupper($wn['warehouse_name']); ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="col-md-6 col-sm-12">
                <label for="produk">Product Name :</label>
                <select name="id_produk" id="" class="form-control mb-3">
                  <?php foreach ($produk as $pm) : ?>
                    <option value="<?= $pm['id_product']; ?>" <?php if ($pm['id_product'] == $detail_RS['id_produk']) {
                                                                  echo "selected";
                                                                } ?>><?= $pm['product_name']; ?></option> <?php endforeach; ?> </select> </div>
              <div class="col-sm-12">
                <label for="remaining">Remaining Product :</label>
                <div class="input-group">
                  <input type="number" name="stok" id="remaining" min="1" value="<?= $detail_RS['stock']; ?>" class="form-control" placeholder="Enter Remaining Stock...">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Pcs</span>
                  </div>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Edit <i class="fa fa-edit"></i></button>
            <a href="<?= base_url('pembelian/stock'); ?>" class="btn btn-warning text-white mt-3">Cancel</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>