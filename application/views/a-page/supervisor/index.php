<div class="container py-3">
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

  <table class="table table-striped table-responsive mt-3" cellpadding="30">
    <tbody class="text-center">
      <?php foreach ($message as $m) : ?>
        <tr <?php if ($m['status_read'] == '0') {
                echo 'class="font-weight-bold font-italic"';
              } ?>>
          <td><?= $m['fullname']; ?></td>
          <td><?= $m['email'] ?></td>
          <td>
            <?php
              $numchar = 30;
              $text = substr($m['message'], 0, $numchar) . '....';
              echo $text;
              ?>
          </td>
          <td>
            <a href="<?= base_url('supervisor/readMessage/') . $m['id_message']; ?>" class="text-primary fa fa-eye" title="read message"></a>
            <a href="<?= base_url('supervisor/deleteMessage/') . $m['id_message']; ?>" onclick="return confirm('You sure delete this ?');" class="text-danger fa fa-trash" title="delete message"></a> |
            <?= date('d M', $m['created_at']); ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <!-- pagination -->
  <?= $this->pagination->create_links(); ?>

  <!-- alert jika data kosong -->
  <?php if (empty($message)) : ?>
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-warning text-center font-weight-bold">
          Message is empty!
        </div>
      </div>
    </div>
  <?php endif; ?>
</div>