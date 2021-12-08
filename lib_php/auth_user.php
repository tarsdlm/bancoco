<?php
    
    include 'conection.php';
	
	if (isset($_POST['usuario']) && isset($_POST['contrasena'])) {
		
		$usuario = $_POST['usuario'];
		$pass = $_POST['contrasena'];

		$call = mysqli_prepare($con, 'CALL login(?, ?, @Pexiste, @Pid_cliente)');
		mysqli_stmt_bind_param($call, 'ss', $usuario, $pass);
		mysqli_stmt_execute($call);
		
		$select = mysqli_query($con, 'SELECT @Pexiste, @Pid_cliente');
		$result = mysqli_fetch_assoc($select);
		$existe     = $result['@Pexiste'];
		$id_user     = $result['@Pid_cliente'];

		if ($existe == TRUE) {
			session_set_cookie_params(0);
			session_start();
			$_SESSION['iduser'] = $id_user;
			
		}
	}

?>