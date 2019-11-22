<div class="container py-3">
  <div class="row">
    <div class="col-md-3 col-sm-12">
      <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#remainingStock" style="width: 90%;">
        Remaining Stock <i class="fa fa-file"></i>
      </button>
    </div>

    <div class="col-md-9 col-sm-12">
      <?= $this->session->flashdata('message'); ?>
    </div>
  </div>

  <div class="row mt-3">
    <?php foreach ($stock_remaining as $sr) : ?>
      <div class="col-md-4">
        <div class="card mb-3">
          <div class="card-image-top">
            <img src="<?= base_url('assets/img/stack.jpg'); ?>" style="width:100%;height: 30vh;">
          </div>
          <table cellspacing="0" cellpadding="5" class="m-2">
            <tr>
              <th>Date</th>
              <th>:</th>
              <td><?= date('d F Y', $sr['created_at']); ?></td>
            </tr>

            <tr>
              <th>Warehouse Name</th>
              <th>:</th>
              <td style="font-size: 14px;"><?= strtoupper($sr['warehouse_name']); ?></td>
            </tr>

            <tr>
              <th>Product Name</th>
              <th>:</th>
              <td><?= $sr['product_name']; ?></td>
            </tr>

            <tr>
              <th>Remaining Stock</th>
              <th>:</th>
              <td><?= $sr['stock']; ?> <b>Pcs</b></td>
            </tr>

            <tr>
              <th>Stock Product</th>
              <th>:</th>
              <td><?= $sr['product_stock']; ?> <b>Pcs</b></td>
            </tr>

            <tr>
              <th>Admin Name</th>
              <th>:</th>
              <td><?= $sr['fullname']; ?></td>
            </tr>

            <tr>
              <td><a href="<?= base_url('pembelian/editRS/') . $sr['id_remaining']; ?>" class="btn btn-primary" style="width: 100%;">Edit <i class="fa fa-edit"></i></a></td>
              <td></td>
              <td><a href="<?= base_url('pembelian/deleteRs/') . $sr['id_remaining']; ?>" class="btn btn-danger" style="width: 100%;" onclick="return confirm('You sure delete this ?');">Delete <i class="fa fa-trash"></i></a></td>
            </tr>
          </table>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- pagination -->
  <?= $this->pagination->create_links(); ?>
</div>

<!-- modal Add Remaining Stock-->
<div class="modal fade" id="remainingStock" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Add new Purchase Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('pembelian/remainingStock'); ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_user" value="<?= $user['id_user']; ?>">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <label for="gudang">Warehouse :</label>
              <select name="id_gudang" id="" class="form-control mb-3">
                <?php foreach ($gudang as $wn) : ?>
                  <option value="<?= $wn['id_warehouse']; ?>"><?= strtoupper($wn['warehouse_name']); ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="col-md-6 col-sm-12">
              <label for="produk">Product Name :</label>
              <select name="id_produk" id="" class="form-control mb-3">
                <?php foreach ($produk as $pm) : ?>
                  <option value="<?= $pm['id_product']; ?>"><?= $pm['product_name']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="col-sm-12">
              <label for="remaining">Remaining Product :</label>
              <input type="number" name="stok" id="remaining" min="1" class="form-control" placeholder="Enter Remaining Stock...">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Upload <i class="fa fa-upload"></i></button>
        </div>
      </form>
    </div>
  </div>
</div>