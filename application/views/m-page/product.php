<div class="body-product">
  <div class="container" id="content-product">
    <form action="" method="post" class="mt-3" id="form-search">
      <div class="row">
        <div class="col-md-4 col-12">
          <div class="input-group">
            <input type="text" name="keyword" class="form-control tombol" placeholder="Search">
            <div class="input-group-append">
              <button class="btn btn-primary tombol d-flex" type="submit"><i class="fa fa-search"></i></button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <div class="row" id="box">
      <?php foreach ($produk as $row) : ?>
        <?php
          if ($row['product_stock'] == 0) {
            $disabled = 'disabled';
            $alert =  'Empty Stock';
          } else {
            $disabled = '';
            $alert = '';
          }
          ?>
        <div class="col-md-3 col-sm-6 col-6">
          <div class="card card-product mt-5">
            <img src="<?= base_url('assets/img/produk/') . $row['image']; ?>" class="card-img-top">
            <div class="card-body">
              <h6 class="card-title">
                <a href="<?= base_url('shop/detail_product/') . $row['id_product']; ?>">
                  <?php
                    $num_char   = 15;
                    $text       = $row['product_name'];
                    echo substr($text, 0, $num_char) . '...';
                    ?>
                </a>
              </h6>
              <div class="row">
                <div class="col-md-12">
                  <p class="card-text" id="harga">
                    <?php
                      $price = number_format($row['price'], 0, ',', '.');
                      ?>
                    Rp. <?= $price; ?>
                  </p>
                </div>
              </div>
              <div class="row mt-2 mb-2">
                <div class="col-md-7 col-sm-12 province_name">
                  <h6 style="font-size: 14px;"><i class="fas fa-map-marker-alt"></i> <?= $row['province_name']; ?></h6>
                </div>
                <div class="col-md-1 col-sm-12">
                  <b class="badge badge-danger"><?= $alert; ?></b>
                </div>
              </div>
              <div class="row">

                <div class="col-md-12 text-center mt-2">
                  <!-- <a href="" class="btn btn-primary c-btn <?= $disabled; ?>">Add Cart</a> -->
                  <a href="<?= base_url('shop/buy/') . $row['id_product']; ?>" class="btn btn-success c-btn <?= $disabled; ?>">Buy Now</a></div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <?= $this->pagination->create_links(); ?>
  </div>
</div>