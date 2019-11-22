<div class="body-invoice b-about">
  <div class="container py-3">
    <div class="card p-3" style="margin-top:6%;">
      <h3 class="text-center text-dark">Add New Bank
        <hr class="hr">
      </h3>
      <form action="" method="post">
        <div class="bank_name mb-4">
          <input type="hidden" name="id_user" value="<?= $user['id_user']; ?>">
          <label for="name" class="text-dark">Bank Name :</label>
          <input type="text" name="bank_name" id="name" class="form-control" placeholder="Enter Bank Name" value="<?= set_value('bank_name'); ?>">
          <?= form_error('bank_name', '<small class="text-danger pl-2">', '</small>'); ?>
        </div>

        <div class="no-rek mb-3">
          <label for="no-rek" class="text-dark">Rekening Number :</label>
          <input type="text" name="no_rekening" id="no-rek" class="form-control" placeholder="Enter Rekening Number" value="<?= set_value('no_rekening'); ?>">
          <?= form_error('no_rekening', '<small class="text-danger pl-2">', '</small>'); ?>
        </div>


        <button type="submit" class="btn btn-success">Save</button>
        <a href="<?= base_url('penjualanan/bank'); ?>" class="btn btn-danger">Cancel</a>
      </form>
    </div>
  </div>
</div>