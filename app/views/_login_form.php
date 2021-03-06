<?php if (isset($errors) && count($errors) > 0) { ?>

  <ul id="errors">
    <?php foreach($errors as $error) { ?>
      <li class="error"><?php echo $error; ?></li>
    <?php } ?>
  </ul>

  <div class="clear"></div>
<?php } ?>

<div id='login'>
  <h2>Login</h2>
  <form action="login.php" method="post">
    <div class='labels'>
      <label for='username'>Username</label>
      <label for='password'>Password</label>
    </div>
    <div class='inputs'>
      <input name='form_type' type='hidden' value='login'/>
      <input name='username' type='text' />
      <input name='password' type='password' />
      <input type='submit' />
      <a href='forgot_password.php'>Forgot Your Password?</a>
    </div>
  </form>
</div>
