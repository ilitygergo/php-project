<?php
	if(isset($_GET['msg'])) {
		echo htmlspecialchars($_GET['msg']);
	} else {
		echo 'No';
	}
