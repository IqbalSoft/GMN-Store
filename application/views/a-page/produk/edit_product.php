<div class="body-invoice">
  <div class="container-fluid py-3">
    <div class="row">
      <div class="col-md-4 col-sm-12">
        <img src="<?= base_url('assets/img/produk/') . $produk['image']; ?>" width="100%" class="mb-3">
      </div>

      <div class="col-md-8 col-sm-12">
        <div class="card p-3" style="border-radius: 10px;">
          <h3 class="text-center">Edit product
            <hr class="hr">
          </h3>

          <?= form_open_multipart(); ?>
          <input type="hidden" name="image" value="<?= $produk['image']; ?>">
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <label for="foto">Product picture :</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="image" id="inputGroupFile04">
                  <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                </div>
              </div><br>
            </div>

            <div class="col-md-6 col-sm-12">
              <label for="nama">Product name :</label>
              <input type="text" name="product_name" id="nama" class="form-control" placeholder="Enter product name..." value="<?= $produk['product_name']; ?>">
              <?= form_error('product_name', '<small class="text-danger pl-2">', '</small>'); ?>
              <br>
            </div>

            <div class="col-md-6 col-sm-12">
              <label for="stok">Price :</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Rp</span>
                </div>
                <input type="text" name="price" class="form-control" placeholder="example like this 120000" value="<?= $produk['price']; ?>">
              </div>
              <?= form_error('price', '<small class="text-danger pl-2">', '</small>'); ?>
              <br>
            </div>

            <div class="col-md-6 col-sm-12">
              <label for="stok">Product stock :</label>
              <div class="input-group">
                <input type="number" name="product_stock" class="form-control" placeholder="How many product ?" min="1" value="<?= $produk['product_stock']; ?>">
                <div class="input-group-prepend">
                  <span class="input-group-text">Pcs</span>
                </div>
              </div>
              <?= form_error('product_stock', '<small class="text-danger pl-2">', '</small>'); ?>
              <br>
            </div>

            <div class="col-md-6 col-sm-12">
              <label for="weight">Weight :</label>
              <div class="input-group">
                <input type="number" name="weight" class="form-control" min="1" placeholder="Weight product on kilogram" title="if product below kilogram enter 1" value="<?= $produk['weight']; ?>">
                <div class="input-group-prepend">
                  <span class="input-group-text">Kg</span>
                </div>
              </div>
              <?= form_error('weight', '<small class="text-danger pl-2">', '</small>'); ?>
              <br>
            </div>

            <div class="col-md-6 col-sm-12">
              <label for="vendor">Vendor product :</label>
              <select name="id_vendor" id="vendor" class="form-control mb-3">
                <option hidden selected>Select Vendor Product</option>
                <?php foreach ($vendor as $row) : ?>
                <option value="<?= $row['id_vendor']; ?>" <?php if ($row['id_vendor'] == $produk['id_vendor']) {
                                                              echo "selected";
                                                            } ?>>vd/<?= $row['id_vendor']; ?>/<?= $row['created_at']; ?> | <?= $row['vendor_name']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="col-md-12 col-sm-12">
              <button type="submit" class="btn btn-success">Edit product</button>
              <a href="<?= base_url('product'); ?>" class="btn btn-danger">Cancel</a>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>