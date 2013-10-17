<div class="loginform">
	<?php
	echo $this->Form->create('User', array('url' => '/users/login',
		));
	echo $this->Form->input('username', array('label' => 'Nick'));
	echo $this->Form->input('password', array('label' => 'Šifra'));
	?> 
	<div class = "form-actions">
		<button type = "submit" class = "btn btn-success">Prijava</button>
	</div>
	</form>
</div>