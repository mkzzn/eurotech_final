<?php if (isset($errors) && count($errors) > 0) { ?>

  <ul id="errors">
    <?php foreach($errors as $error) { ?>
      <li class="error"><?php echo $error; ?></li>
    <?php } ?>
  </ul>

  <div class="clear"></div>
<?php } ?>

<?php if (isset($notices) && count($notices) > 0) { ?>

  <ul id="notices">
    <?php foreach($notices as $notice) { ?>
      <li class="notice"><?php echo $notice; ?></li>
    <?php } ?>
  </ul>

  <div class="clear"></div>
<?php } ?>

<div id='login'>
  <h2>
    Forgot Password
    <div class="notation">Enter your email address and we'll send you your password!</div>
  </h2>
  <form action="forgot_password.php" method="post">
    <div class='labels'>
      <label for='email'>Email</label>
    </div>
    <div class='inputs'>
      <input name='form_type' type='hidden' value='forgot-password'/>
      <input name='email' type='text' />
      <input type='submit' />
    </div>
  </form>
</div>
