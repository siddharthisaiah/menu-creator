
<h3>Login</h3>

<?php if(isset($login_msg)) { ?>
    <div class="alert alert-danger alert-dismissable">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<?= $login_msg; ?>
    </div>
<?php } ?>


<?php echo form_open("login/authenticate", 'class="m-t" role="form"'); ?>
<div class="form-group">
    <input type="text" name="username" class="form-control" placeholder="Username" required="">
</div>
<div class="form-group">
    <input type="password" name="password" class="form-control" placeholder="Password" required="">
</div>
<button type="submit" class="btn btn-primary block full-width m-b">Login</button>
<?php echo form_close(); ?>

<a href=""><small>Forgot password?</small></a>
<p class="text-muted text-center"><small>Do not have an account?</small></p>
<a class="btn btn-sm btn-white btn-block" href="register">Create an account</a>
