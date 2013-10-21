<div class="loginform">
	<h2>Farm admin login</h2>
	<?php
	echo $this->Form->create('User', array('url' => '/users/login',
		));
	echo $this->Form->input('username', array('label' => 'Username'));
	echo $this->Form->input('password', array('label' => 'Password'));
	?> 
	<div class = "form-actions">
		<button type = "submit" class = "btn btn-success">Login</button>
	</div>
	</form>
</div>