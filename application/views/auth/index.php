<div class="body-auth auth-login">
  <div class="row m-0">
    <div class="col-md-5 col-sm-12">
      <div class="card p-3" id="form-login">
        <div class="container">
          <h3 class="title-login text-center">Sign in here...
            <hr class="hr">
          </h3>

          <?= $this->session->flashdata('message'); ?>

          <form action="<?= base_url('auth'); ?>" method="post">
            <label for="email">Email : </label>
            <input type="text" name="email" id="email" class="form-control" placeholder="Enter your email..." value="<?= set_value('email'); ?>" autofocus>
            <?= form_error('email', '<small class="text-danger pl-2">', '</small>'); ?>
            <br>
            <label for="password">Password : </label>
            <input type="password" name="password" id="password" placeholder="Enter your password..." class="form-control">
            <?= form_error('password', '<small class="text-danger pl-2">', '</small>'); ?>
            <br>
            <div class="row">
              <div class="col-md-6">
                <button type="submit" class="btn btn-primary tombol">Sign in</button>
                <a href="<?= base_url('auth/register') ?>" class="btn btn-success tombol mr-2">Sign up</a>
              </div>
              <div class="col-md-4 mt-1">
                <a href="<?= base_url(); ?>">Back to home <i class="fa fa-arrow-right"></i></a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>