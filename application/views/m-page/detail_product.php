<?php
if ($dProduk['product_stock'] == 0) {
  $disabled = 'disabled';
  $alert =  'Empty Stock';
} else {
  $disabled = '';
  $alert = '';
}
?>
<div class="body-invoice bd-detailP">
  <div id="content-detail m-0 py-3">
    <a href="<?= base_url('shop'); ?>" class="btn btn-outline-success text-white m-3">
      <i class="fa fa-arrow-left"></i> Back</a>
    <div class="row m-0">
      <div class="col-md-4 col-sm-12">
        <img src="<?= base_url('assets/img/produk/') . $dProduk['image']; ?>" class="mb-3 img-detail">
      </div>

      <div class="col-md-8 col-sm-12">
        <div class="card p-2">
          <div class="row">
            <div class="col-md-5">
              <div class="alert alert-warning" style="height: 70%;">
                <p>PERHATIAN!!! apabila ingin mengecek ongkir silahkan atur atur di sent to <i class="far fa-smile"></i> .</p>
              </div>
            </div>

            <div class="col-md-6">
              <h2 class="title-detail"><?= $dProduk['product_name']; ?></h2>
            </div>
          </div>

          <div class="mt-3 mb-4" id="nav-detail">
            <e style="color: #ffbf00;">
              4.0
              <?php for ($i = 1; $i <= 4; $i++) : ?>
              <i class="fa fa-star"></i>
              <?php endfor; ?>
            </e> |
            <a href="">Product Comments</a> |
            <i>Stock <b><?= $dProduk['product_stock']; ?> Pcs</b></i>
          </div>
          <?php $price = number_format($dProduk['price'], 0, ',', '.'); ?>
          <h4 id="harga">Rp. <?= $price; ?></h4>

          <form action="">
            <input name="provinsi_asal" type="hidden" value="<?= $dProduk['province_id']; ?>" onchange="get_kota('asal')" id="provinsi_asal" class="provinsi">
            <input name="kota_asal" type="hidden" value="<?= $dProduk['city_id']; ?>" id="kota_asal">
            <input name="berat" type="hidden" value="<?= $dProduk['weight']; ?>" id="berat">
            <div class="row">
              <div class="col col-md-2 col-sm-12">
                <b class="mr-2">Sent to </b>
                <img src="<?= base_url('assets/img/courier.jpeg'); ?>" width="26%">
              </div>

              <div class="col-md-2 col-sm-12">
                <label>Province</label>
                <select name="" onclick="get_kota('tujuan')" onmouseover="get_kota('tujuan')" id="provinsi_tujuan" class="form-control provinsi mb-4">
                </select>
              </div>

              <div class="col-md-2 col-sm-12">
                <label>City</label>
                <select name="" id="kota_tujuan" class="form-control mb-4">
                </select>
              </div>

              <div class="col-md-2 col-sm-12">
                <label>Courier</label>
                <select onclick="get_ongkir()" onmouseover="get_ongkir()" name="kurir" id="kurir" class="form-control mb-4">
                  <option value="pos" selected>POS</option>
                  <option value="tiki">TIKI</option>
                  <option value="jne">JNE</option>
                </select>
              </div>

              <div class="col-md-4 col-sm-12">
                <label>Service</label>
                <select name="service" id="service" class="form-control mb-4">

                </select>
              </div>
            </div>
          </form>

          <h6><b>Description Product :</b></h6>
          <p>
            <?php
            $num_char = 150;
            $text = $dProduk['descriptions'];
            echo substr($text, 0, $num_char) . '...';
            ?> <a href="" data-toggle="modal" data-target="#readMore">Read More</a>
          </p>

          <a href="<?= base_url('shop/buy/') . $dProduk['id_product'];  ?>" class="btn btn-success tombol <?= $disabled; ?>">Buy Now</a>
        </div>
      </div>
    </div>

    <!-- bagian comments -->
    <div class="row m-0">
      <div class="col-md-12">
        <div class="card p-3 mt-3">
          <h2>Comments : </h2>

          <?php for ($i = 1; $i <= 3; $i++) : ?>
          <div class="ml-3" id="comments">
            <span style="font-size: 17px;" class="mt-3"><b>Muhammad Iqbal</b></span>
            <p style="font-size: 13px;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, quis?</p>
            <hr>
          </div>
          <?php endfor; ?>

        </div>
      </div>
    </div>
  </div>


  <!-- Button trigger modal -->
  <!-- Modal -->
  <div class="modal fade" id="readMore" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle">Description</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?= $dProduk['descriptions']; ?>
        </div>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div> -->
      </div>
    </div>
  </div>
</div>