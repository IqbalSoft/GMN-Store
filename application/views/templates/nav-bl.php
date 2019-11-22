<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container">
    <a class="navbar-brand" href="<?= base_url(); ?>">GMN Store</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ml-auto">
        <a class="nav-item nav-m nav-link" href="<?= base_url(); ?>">Home</a>
        <a class="nav-item nav-m nav-link" href="<?= base_url('shop'); ?>">Shop</a>
        <a class="nav-item nav-m nav-link" href="<?= base_url('content/contact'); ?>">Contact</a>
        <a class="nav-item nav-m nav-link" href="<?= base_url('content/about'); ?>">About</a>
        <a class="nav-item btn btn-primary tombol" href="<?= base_url('auth') ?>">Sign-in</a>
      </div>
    </div>
  </div>
</nav>
<!-- akhir navbar -->