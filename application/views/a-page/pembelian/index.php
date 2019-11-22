<div class="container mt-3 mb-3">
  <form action="" method="post" class="mt-3" id="form-search">
    <div class="row">
      <div class="col-md-4">
        <div class="input-group">
          <input type="text" name="keyword" class="form-control tombol" placeholder="Search">
          <div class="input-group-append">
            <button class="btn btn-primary tombol" type="submit"><i class="fa fa-search"></i></button>
          </div>
        </div>
      </div>
    </div>
  </form>

  <div class="row">
    <div class="col-md-2 col-sm-12">
      <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#formAdd" style="width: 90%;">
        Add new PO <i class="fa fa-file"></i>
      </button>
    </div>

    <div class="col-md-7 col-sm-12">
      <?php if ($this->session->flashdata('message')) : ?>
        <?= $this->session->flashdata('message'); ?>
      <?php else : ?>
        <div class="alert alert-warning text-center mt-3">
          Untuk mencari purchase order silahkan masukkan angka akhir saja!<br> <b>contoh = 'PO/2/1566729339 => 1566729339'</b>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <div class="row">
    <?php foreach ($po as $row) : ?>
      <div class="col-md-3 col-sm-12">
        <div class="card mt-3">
          <div class="card-image-top text-center p-2">
            <?php
              $ekstensi = pathinfo($row['file_name'], PATHINFO_EXTENSION);

              if ($ekstensi == 'pdf') {
                $imagefile = 'pdf.png';
              } else if ($ekstensi == 'docx') {
                $imagefile = 'word.jpg';
              } else if ($ekstensi == 'xlsx') {
                $imagefile = 'excel.png';
              }
              ?>
            <img src="<?= base_url('assets/img/') . $imagefile; ?>" width="55%" height="70%">
          </div>

          <div class="card-body">
            <h5><b>PO/<?= $row['id_pembelian']; ?>/<?= $row['created_at']; ?></b></h5>
            <p><?= date('d F Y', $row['created_at']); ?></p>
            <div class="text-center">
              <a href="<?= base_url('pembelian/download/') . $row['file_name']; ?>" target="blank" class="btn btn-success"><i class="fa fa-download"></i></a>
              <a href="<?= base_url('pembelian/readFile/') . $row['file_name']; ?>" target="blank" class="btn btn-info"><i class="fa fa-book"></i></a>
              <a href="<?= base_url('pembelian/delete/') . $row['id_pembelian']; ?>" onclick="return confirm('You sure delete this ?');" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- pagination -->
  <?= $this->pagination->create_links(); ?>
</div>

<!-- modal add PO-->
<div class="modal fade" id="formAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Add new Purchase Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('pembelian/add'); ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_user" value="<?= $user['id_user']; ?>">
        <div class="modal-body">
          <label for="title">Choose file PO : <i class="text-warning">type file docx, pdf, xlsx</i></label>
          <div class="input-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" name="dokumen" id="inputGroupFile04">
              <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
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