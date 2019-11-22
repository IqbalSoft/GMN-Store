<!-- navbar -->
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="<?= base_url('gudang'); ?>">GMN Store</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ml-auto">
        <a class="nav-item nav-link active" href="<?= base_url('gudang'); ?>">Home</a>
        <a class="nav-item nav-link" href="<?= base_url('product'); ?>">Product</a>
        <div class="dropdown">
          <button class="btn btn-primary tombol dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="<?= base_url('assets/img/user/') . $user['picture']; ?>" style="width: 20px;border-radius: 50%;"> <?php
                                                                                                                        $num_char   = 6;
                                                                                                                        $text       = $user['fullname'];
                                                                                                                        echo substr($text, 0, $num_char) . '..';
                                                                                                                        ?>
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="<?= base_url('member/profileAdmin'); ?>">My Profile</a>
            <a class="dropdown-item" href="<?= base_url('member/edit'); ?>">Edit Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">Logout</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</nav>
<!-- akhir navbar -->