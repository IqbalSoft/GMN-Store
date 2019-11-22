<div class="container py-3">
  <form action="" method="post" class="mb-3" id="form-search">
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

  <table class="table table-striped table-responnsive text-center" cellspacing="0" cellpadding="5">
    <thead>
      <tr>
        <th>No</th>
        <th>Name</th>
        <th>Email</th>
        <th>Position</th>
        <th>Action</th>
      </tr>
    </thead>

    <tbody>
      <?php $i = 1;
      foreach ($d_user as $row) : ?>
        <tr>
          <td><?= ++$start; ?></td>
          <td><?= $row['fullname']; ?></td>
          <td><?= $row['email']; ?></td>
          <td><?= strtoupper($row['role_name']); ?></td>
          <td>
            <a href="<?= base_url('supervisor/detailUser/') . $row['id_user']; ?>" class="badge badge-info"><i class="fa fa-eye"></i> Detail</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <!-- pagination -->
  <?= $this->pagination->create_links(); ?>

  <!-- alert data is empty -->
  <?php if (empty($d_user)) : ?>
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-warning text-center">
          User is empty !
        </div>
      </div>
    </div>
  <?php endif; ?>
</div>