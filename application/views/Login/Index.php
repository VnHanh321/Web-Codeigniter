<div class="px-5 py-5 p-lg-0 bg-surface-secondary mb-12">
  <div class="d-flex justify-content-center">
    <div
      class="col-12 col-md-9 col-lg-6 min-h-lg-screen d-flex flex-column justify-content-center py-lg-16 px-lg-20 position-relative">
      <div class="row">
        <div class="col-lg-10 col-md-9 col-xl-7 mx-auto">
          <div class="text-center mb-12">
            <h1 class="ls-tight font-bolder mt-6">
              Login Admin Page
            </h1>
            <p class="mt-2">Welcome back!</p>
          </div>
          <?php
          if ($this->session->flashdata('success')) {
            echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
          } elseif ($this->session->flashdata('error')) {
            echo '<div class="alert alert-dsanger">' . $this->session->flashdata('error') . '</div>';
          }
          ?>
          <form action="<?php echo base_url('login-user') ?>" method="POST">
            <div class="mb-5">
              <label class="form-label" for="email">Email address</label>
              <input type="email" name="email" class="form-control" placeholder="Your email address">
              <?php echo form_error('email') ?>
            </div>
            <div class="mb-5">
              <label class="form-label" for="password">Password</label>
              <input type="password" name="password" class="form-control" placeholder="Password"
                autocomplete="current-password">
              <?php echo form_error('password') ?>
            </div>
            <div class="mb-5">
              <button type="submit" class="btn btn-primary w-full" style="width: 550px;">
                Login
              </button>
            </div>
            <div>
              <a href="<?php echo base_url('register-admin') ?>" class="btn btn-success" style="width: 550px;">Register
                admin</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>