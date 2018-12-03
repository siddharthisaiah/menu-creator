<h3>Register</h3>

<div>
    <?php if (isset($user_registered)) { ?>
	<?php if ($user_registered['success']) { ?>
	    <div class="alert alert-success alert-dismissable">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<?= $user_registered['msg']; ?>
	    </div>
	<?php } else { ?>
	    <div class="alert alert-danger alert-dismissable">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<?= $user_registered['msg']; ?>
	    </div>
	<?php } ?>
    <?php } ?>
</div>

<?= form_open('login/create_user', 'class="m-t" role="form" '); ?>
<div class="form-group">
    <input type="text" name="firstname" class="form-control" placeholder="First Name" required="">
</div>

<div class="form-group">
    <input type="text" name="lastname" class="form-control" placeholder="Last Name" required="">
</div>

<div class="form-group">
    <input type="text" name="username" class="form-control" placeholder="User Name" required="">
</div>

<div class="form-group">
    <input type="email" name="email" class="form-control" placeholder="Email" required="">
</div>
<div class="form-group">
    <input type="password" name="password" class="form-control" placeholder="Password" required="">
</div>
<div class="form-group">
    <input type="password" name="confirm-password" class="form-control" placeholder="Confirm Password" required="">
</div>
<div class="form-group">
    <div class="checkbox i-checks">
	<label> <input type="checkbox" id="terms"><i></i> I accept the <a>terms and conditions</a> </label>
    </div>
</div>
<button type="submit" class="btn btn-primary block full-width m-b" id="register" disabled>Register</button>

<p class="text-muted text-center"><small>Already have an account?</small></p>
<a class="btn btn-sm btn-white btn-block" href="login">Login</a>
<?= form_close(); ?>



<script>
 $(document).ready(function() {
     // enable register button if user accepts terms and conditions
     $('#terms').on('ifChecked', function(event) {
	 $('#register').prop('disabled', false);
     });

     // disable register button if user does not accept terms and conditions
     $('#terms').on('ifUnchecked', function(event) {
	 $('#register').prop('disabled', true);
     });
 });
</script>




