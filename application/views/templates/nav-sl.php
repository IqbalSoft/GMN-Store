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
        <div class="dropdown">
          <button class="btn btn-primary tombol dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="<?= base_url('assets/img/user/') . $user['picture']; ?>" style="width: 20px;border-radius: 50%;"> <?php
                                                                                                                        $num_char   = 8;
                                                                                                                        $text       = $user['fullname'];
                                                                                                                        echo substr($text, 0, $num_char) . '...';
                                                                                                                        ?>
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="z-index: 999999;">
            <a class="dropdown-item" href="<?= base_url('member/'); ?>">My Profile</a>
            <a class="dropdown-item" href="<?= base_url('member/edit/'); ?>">Edit Profile</a>
            <a class="dropdown-item" href="<?= base_url('shop/history_order'); ?>">Purchase History</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">Logout</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</nav>
<!-- akhir navbar -->