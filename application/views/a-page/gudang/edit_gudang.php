<div class="body-invoice">
  <div class="container py-3">
    <div class="card p-3" style="border-radius: 10px;">
      <h3 class="text-center">Add new warehouse
        <hr class="hr">
      </h3>

      <div class="alert alert-warning text-center" role="alert">
        <strong>Maaf tolong di pilih kembali provinsi dan kota anda apabila mengedit data !</strong>
      </div>

      <?= form_open_multipart('gudang/editGudang/' . $dGudang['id_warehouse']); ?>
      <div class="row">
        <div class="col-md-6 col-sm-12">
          <label>Province :</label>
          <select name="province_id" onclick="get_kota('asal')" onmouseover="get_kota('asal')" id="provinsi_asal" class="form-control provinsi mb-4"></select>
        </div>

        <div class="col-md-6 col-sm-12">
          <label>City :</label>
          <select name="city_id" id="kota_asal" class="form-control mb-4"></select>
        </div>

        <div class="col-md-6 col-sm-12">
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <label for="warehouse_name">Warehouse Name :</label>
              <input type="text" name="warehouse_name" id="warehouse_name" class="form-control" placeholder="Enter warehouse name" value="<?= $dGudang['warehouse_name']; ?>">
              <?= form_error('warehouse_name', '<small class="text-danger pl-2">', '</small>'); ?><br>
            </div>
            <div class="col-md-6 col-sm-12">
              <label for="warehouse">Warehouse type :</label>
              <select name="warehouse_type" id="warehouse" class="form-control mb-4">
                <?php foreach ($warehouse_type as $wt) : ?>
                  <?php
                    if ($wt == 'ps') {
                      $tw = 'Central Warehouse';
                    } else if ($wt == 'cb') {
                      $tw = 'Branch Warehouse';
                    }
                    ?>
                  <option value="<?= $wt; ?>" <?php if ($wt == $dGudang['warehouse_type']) {
                                                  echo "selected";
                                                } ?>><?= $tw; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-sm-12">
          <label for="foto">Warehouse picture :</label>
          <div class="row">
            <div class="col-md-2 col-sm-12 mb-2">
              <img src="<?= base_url('assets/img/gudang/') . $dGudang['image_gudang'] ?>" width="100%">
            </div>
            <div class="col-md-10 col-sm-12 mb-3">
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="image_gudang" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
                  <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-12 col-sm-12">
          <label for="address">Warehouse address :</label>
          <textarea name="address" id="address" rows="4" class="form-control" placeholder="Enter full address warehouse and include the city name as well ..." value="<?= $dGudang['address']; ?>"><?= $dGudang['address']; ?></textarea><br>
          <?= form_error('address', '<small class="text-danger pl-2">', '</small>'); ?>
        </div>

        <div class="col-md-6 col-sm-12">
          <button type="submit" class="btn btn-success">Add warehouse</button>
          <a href="<?= base_url('gudang/lGudang'); ?>" class="btn btn-danger">Cancel</a>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>