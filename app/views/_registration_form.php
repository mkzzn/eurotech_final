

<?php
  $text_fields = array('name', 'company', 'address1', 'address2', 'city', 'state', 'zip', 'country', 'phone', 'fax', 'email', 'login');

  if (count($errors) > 0) {
?>
  <ul id="errors">
<?php
    foreach($errors as $error) {
?>

  <li class="error"><?php echo $error; ?></li>

<?php
    }
?>
  </ul>
<?php
  }

if (count($errors) > 0) {
?>

<div id='register'>
  <h2>Register</h2>
  <form action="register.php" method="post">
    <div class='labels'>
      <label for='name'>Name</label>
      <label for='company'>Company</label>
      <label for='address1'>Address1</label>
      <label for='address2'>Address2</label>
      <label for='city'>City</label>
      <label for='state'>State</label>
      <label for='zip'>Zip Code</label>
      <label for='country'>Country</label>
      <label for='phone'>Phone</label>
      <label for='fax'>Fax</label>
      <label for='email'>Email</label>
      <label for='login'>Login</label>
      <label for='password'>Password</label>
      <label for='confirm_password'>Confirm Password</label>
    </div>
    <div class='inputs'>
      <input name='form_type' type='hidden' value='register'/>
<?php
  foreach($text_fields as $field) {
?>      

      <input name='<?php echo $field; ?>' type='text' value='<?php echo $$field; ?>'>

<?php
  }
?>      

      <input name='password' type='password' />
      <input name='confirm_password' type='password' />
      <input type='submit' />
    </div>
  </form>
</div>

<?php
  } else {
?>

  <div id="notice">You've successfully registered!  Enter your username and password below to log in.</div>

<?php  
    include '_login_form.php';
  }
?>
