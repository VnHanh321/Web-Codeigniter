<div class="container" style="
    display: flex;
    justify-content: center;">
  <div
    class="col-12 col-md-9 col-lg-6 min-h-lg-screen d-flex flex-column justify-content-center py-lg-16 px-lg-20 position-relative">
    <div class="row">
      <div class="col-lg-10 col-md-9 col-xl-7 mx-auto">
        <div class="text-center mb-12">
          <h1 class="ls-tight font-bolder mt-6">
            Contact Page
          </h1>
          <p class="mt-2">Welcome back!</p>
          <p class="mt-2">We will contact you soon!!!</p>
        </div>
        <?php
        if ($this->session->flashdata('success')) {
          echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
        } elseif ($this->session->flashdata('error')) {
          echo '<div class="alert alert-dsanger">' . $this->session->flashdata('error') . '</div>';
        }
        ?>
        <form action="<?php echo base_url('send-contact') ?>" method="POST">
          <div style="margin: 20px;">
            <label class="form-label" for="email">Full name *</label>
            <input type="text" name="name" required class="form-control" placeholder="Your Username">
            <?php echo form_error('username') ?>
          </div>
          <div style="margin: 20px;">
            <label class="form-label" for="email">Email address *</label>
            <input type="email" name="email" required class="form-control" placeholder="Your email address">
            <?php echo form_error('email') ?>
          </div>
          <div style="margin: 20px;">
            <label class="form-label" for="password">Phone number *</label>
            <input type="text" name="phone" required class="form-control" placeholder="Phone number"
              autocomplete="current-password">
            <?php echo form_error('phone') ?>
          </div>
          <div style="margin: 20px;">
            <label class="form-label" for="password">Address *</label>
            <input type="text" name="address" required class="form-control" placeholder="Address">
            <?php echo form_error('address') ?>
          </div>
          <div style="margin: 20px;">
            <label class="form-label">Note</label>
            <textarea name="note" id="" rows="5" resize="'none"></textarea>
            <?php echo form_error('note') ?>
          </div>
          <div style="margin: 20px;">
            <button type="submit" class="btn btn-primary" style="padding: 10px; width:400px">
              Send
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>