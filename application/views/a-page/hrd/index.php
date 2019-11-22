<div class="container py-3">

  <h3 class="mb-3">Company Staff</h3>

  <div class="row mb-3">
    <div class="col-md-4 col-12">
      <form action="" method="post" id="form-search">
        <div class="input-group mb-3">
          <input type="text" name="keyword" class="form-control tombol" placeholder="Search" autofocus autocomplete="off">
          <div class="input-group-append">
            <input class="btn btn-primary tombol d-flex" type="submit" name="submit" value="search">
          </div>
        </div>
      </form>
    </div>

    <div class="col-md-4 col-12">
      <a href="<?= base_url('hrd/addNewStaff'); ?>" class="btn btn-success btn-sm">Add New Staff</a>
    </div>
  </div>

  <div class="row">
    <div class="col-md-10 col-12">
      <?php if ($this->session->flashdata('message')) : ?>
        <?= $this->session->flashdata('message'); ?>
      <?php else : ?>
        <div class="alert alert-warning text-center">
          Untuk mencari berdasarkan id staff silahkan masukkan angka saja!
        </div>
      <?php endif; ?>
    </div>
  </div>

  <table class="table-striped table-responsive text-center" cellspacing="0" cellpadding="10">
    <thead>
      <tr>
        <td></td>
        <th>Id Staff</th>
        <th>Staff Name</th>
        <th>Email</th>
        <th>Position</th>
        <th>Join Since</th>
        <th>Action</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($pegawai as $row) : ?>
        <tr>
          <td><?= ++$start; ?></td>
          <td>stf-<?= $row['id_user']; ?></td>
          <td><?= $row['fullname']; ?></td>
          <td><?= $row['email'] ?></td>
          <td><?= $row['role_name']; ?></td>
          <td><?= date('d F Y', $row['date_created']); ?></td>
          <td>
            <?php if ($row['active_staff'] == 1) {
                $href = 'deactivate';
                $class = 'danger';
                $titleBd = 'Deactive';
              } else {
                $href = 'activate';
                $class = 'success';
                $titleBd = 'Activate';
              } ?>
            <a href="<?= base_url('hrd/detailPegawai/') . $row['id_user']; ?>" class="badge badge-primary">Detail</a>
            <a href="<?= base_url('hrd/') . $href . '/' . $row['id_user']; ?>" class="badge badge-<?= $class; ?>"><?= $titleBd; ?> Staff</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <!-- pagination -->
  <?= $this->pagination->create_links(); ?>

  <!-- alert if staff is empty -->
  <?php if (empty($pegawai)) : ?>
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger text-center">
          Staff not found!
          <a href="">Back to home</a>
        </div>
      </div>
    </div>
  <?php endif; ?>
</div>