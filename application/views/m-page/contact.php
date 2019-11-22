<div class="body-contact b-cont">
  <div class="container" id="content-contact">
    <div class="row">
      <div class="col-md-8">
        <div class="card p-2" id="form-contact">
          <div class="container">
            <h2 class="text-center">Contact Us
              <hr class="hr">
            </h2>

            <?= $this->session->flashdata('message'); ?>

            <form action="" method="post">
              <label for="name">Name : </label>
              <?php if (empty($user)) : ?>
                <input type="text" name="name" id="name" placeholder="Fullname..." value="<?= set_value('name'); ?>" class="form-control">
              <?php else : ?>
                <input type="text" name="name" id="name" value="<?= $user['fullname']; ?>" class="form-control">
              <?php endif; ?>
              <?= form_error('name', '<small class="text-danger pl-2">', '</small>'); ?>
              <br>
              <label for="email">Email : </label>
              <?php if (empty($user)) : ?>
                <input type="text" name="email" id="email" placeholder="example@what.com..." value="<?= set_value('email'); ?>" class="form-control">
              <?php else : ?>
                <input type="text" name="email" id="email" value="<?= $user['email']; ?>" class="form-control">
              <?php endif; ?>
              <?= form_error('email', '<small class="text-danger pl-2">', '</small>'); ?>

              <br>
              <label for="message">Message...</label>
              <textarea name="message" id="message" rows="6" placeholder="Fill in with your message..." class="form-control"><?= set_value('message'); ?></textarea>
              <?= form_error('message', '<small class="text-danger pl-2">', '</small>'); ?>
              <br>
              <button type="submit" class="btn btn-primary">Send</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>