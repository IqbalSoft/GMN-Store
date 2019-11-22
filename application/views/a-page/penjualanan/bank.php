<div class="container py-3">
  <h3>List Of Bank for transfer</h3>
  <a href="<?= base_url('penjualanan/addBank'); ?>" class="btn btn-primary mb-3">Add New Bank</a>

  <div class="row">
    <div class="col-md-5 col-sm-12">
      <?= $this->session->flashdata('message'); ?>
    </div>
  </div>

  <table class="table-striped table-responsive text-center" cellspacing="0" cellpadding="17">
    <tr>
      <td></td>
      <th>Bank Name</th>
      <th>Rekening Number</th>
      <th>Action</th>
    </tr>
    <?php $i = 1;
    foreach ($banks as $row) : ?>
      <tr>
        <td><?= ++$start;; ?>|</td>
        <td><?= strtoupper($row['bank_name']); ?></td>
        <td><?= $row['no_rekening']; ?></td>
        <td>
          <a href="<?= base_url('penjualanan/deleteBank/') . $row['id_bank']; ?>" class="badge badge-danger" onclick="return confirm('you sure delete this ?');">Delete</a>
          <a href="<?= base_url('penjualanan/editBank/') . $row['id_bank']; ?>" class="badge badge-info">Edit</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>

  <?= $this->pagination->create_links(); ?>

  <!-- alert kalau data kosong -->
  <?php if (empty($banks)) : ?>
    <div class="row mt-3">
      <div class="col-md-5 col-sm-12">
        <div class="alert alert-danger text-center">No Banks for now</div>
      </div>
    </div>
  <?php endif; ?>
</div>