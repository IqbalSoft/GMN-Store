<div class="body-invoice">
  <div class="container py-3">
    <a href="<?= base_url('shop'); ?>" class="btn btn-outline-success text-white">
      <-- Back</a> <form action="<?= base_url('shop/order/') . $produk['id_product']; ?>" method="post">
        <input type="hidden" name="weight" value="<?= $produk['weight']; ?>">
        <input type="hidden" name="id_gudang" value="<?= $produk['id_gudang']; ?>">
        <div class="row mt-3">
          <div class="col-md-6 col-sm-12 card p-3 mb-3">
            <h6 class="text-white"><i class="fas fa-map-marker-alt"></i> Delivery Address</h6>
            <div class="row">
              <div class="col-md-10 col-sm-12">
                <p class="text-dark"><?= $user['address']; ?>. <?= $kota; ?>, <?= $provinsi; ?></p>
              </div>

              <div class="col-md-2 col-sm-12">
                <a href="<?= base_url('member/editAddress/' . $this->session->id_user); ?>" data-toggle="modal" data-target="#edit_alamat">
                  <h4 class="fas fa-arrow-right"></h4>
                </a>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-sm-12 text-white">
            <h6><i class="fa fa-warehouse"></i> <?= $produk['warehouse_name']; ?>
              <hr>
            </h6>
            <div class="row">
              <div class="col-md-4">
                <img src="<?= base_url('assets/img/produk/') . $produk['image']; ?>" style="width: 80%;">
              </div>

              <div class="col mt-3">
                <table cellspacing="0" cellpadding="5">
                  <tr>
                    <td>Brand</td>
                    <td>:</td>
                    <td><?= $produk['product_name']; ?></td>
                  </tr>

                  <tr>
                    <?php
                    $price = number_format($produk['price'], 0, ',', '.');
                    ?>
                    <td>Price</td>
                    <td>:</td>
                    <td>Rp <?= $price; ?></td>
                  </tr>

                  <tr>
                    <td>Weight</td>
                    <td>:</td>
                    <td><?= $produk['weight']; ?> Kg +-</td>
                  </tr>

                  <tr>
                    <td>Stock</td>
                    <td>:</td>
                    <td><?= $produk['product_stock']; ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <hr>
          </div>

          <div class="col-md-6 col-sm-12">
            <h6 class="text-white"><i class="fas fa-truck"></i> Delivery Options</h6>
            <input name="provinsi_asal" type="hidden" value="<?= $produk['province_id']; ?>" id="provinsi_asal" class="provinsi">
            <input name="kota_asal" type="hidden" value="<?= $produk['city_id']; ?>" id="kota_asal">
            <input name="berat" type="hidden" value="<?= $produk['weight']; ?>" id="berat">
            <input name="provinsi_tujuan" type="hidden" value="<?= $user['province_id']; ?>" id="provinsi_tujuan" class="provinsi">
            <input name="kota_tujuan" type="hidden" value="<?= $user['city_id']; ?>" id="kota_tujuan">
            <input type="hidden" name="id_user" value="<?= $user['id_user']; ?>">

            <div class="row">
              <div class="col">
                <select onclick="get_ongkir()" onmouseover="get_ongkir()" name="kurir" id="kurir" class="form-control mb-4">
                  <option value="pos" selected>POS</option>
                  <option value="tiki">TIKI</option>
                  <option value="jne">JNE</option>
                </select>
                <?= form_error('kurir'); ?>
              </div>

              <div class="col">
                <select name="service" id="service" class="form-control mb-4">

                </select>
                <!-- <input type="text" name="service" class="form-control"> -->
                <?= form_error('service'); ?>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-sm-12">
            <h6 class="text-white">Payment Method</h6>
            <select name="payment" class="form-control">
              <?php foreach ($banks as $row) : ?>
                <option value="<?= $row['id_bank']; ?>">Transfer via <?= strtoupper($row['bank_name']); ?></option>
              <?php endforeach; ?>
            </select><br>
          </div>

          <div class="col-md-6 col-sm-12">
            <h6 class="text-white" for="stok">Quantity of product :</h6>
            <div class="input-group">
              <input type="number" name="qty" class="form-control" min="1" max="<?= $produk['product_stock']; ?>" value="1">
              <div class="input-group-prepend">
                <span class="input-group-text">Pcs</span>
              </div>
            </div>
            <?= form_error('qty'); ?>
            <br>
          </div>

          <div class="col-md-6 col-sm-12">
            <button type="submit" class="btn btn-success mt-4">Make Order <i class="fas fa-money-check-alt"></i></button>
          </div>
        </div>
        </form>
  </div>
</div>


<!-- modal -->
<div class="modal fade" id="edit_alamat" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('member/edit_alamat/') . $this->session->id_user; ?>" method="post">
        <div class="modal-body">
          <input type="hidden" name="id_barang" value="<?= $produk['id_product']; ?>">
          <textarea name="address" cols="30" rows="10" class="form-control" value="<?= $user['address']; ?>"><?= $user['address']; ?></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>