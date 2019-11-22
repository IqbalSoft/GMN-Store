<div class="container py-3">
  <h3>Role Access</h3>

  <div class="row mb-3">
    <div class="col-md-4 col-12">
      <form action="" method="post" id="form-search">
        <div class="input-group mb-3">
          <input type="text" name="keyword" class="form-control tombol" placeholder="Search Role">
          <div class="input-group-append">
            <button class="btn btn-primary tombol d-flex" type="submit"><i class="fa fa-search"></i></button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="row">
    <div class="col-md-5 col-12">
      <?php if ($this->session->flashdata('message')) : ?>
        <?= $this->session->flashdata('message'); ?>
      <?php else : ?>
        <div class="alert alert-warning text-center">
          Untuk mencari berdasarkan Role Number silahkan masukkan angka saja!
        </div>
      <?php endif; ?>
    </div>

    <table class="table table-striped table-responsive text-center" cellspacing="0" cellpadding="10">
      <thead>
        <tr>
          <th></th>
          <th>Role Number</th>
          <th>Role Name</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>
        <?php $i = 1;
        foreach ($role as $row) : ?>
          <tr>
            <td><?= $i++; ?></td>
            <td>rl-<?= $row['role_id']; ?></td>
            <td><?= $row['role_name']; ?></td>
            <td>
              <?php if ($row['status'] == 1) : ?>
                <a href="<?= base_url('hrd/deactivate_role/') . $row['role_id']; ?>" class="badge badge-danger">Deactivated</a>
              <?php else : ?>
                <a href="<?= base_url('hrd/activate_role/') . $row['role_id']; ?>" class="badge badge-success">Activated</a>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <?php if (empty($role)) : ?>
    <div class="row">
      <div class="col-md-5 col-12">
        <div class="alert alert-danger text-center">Role not found!</div>
      </div>
    </div>
  <?php endif; ?>