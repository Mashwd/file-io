<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>log-in</title>
</head>
<body style="background: #F3F3F3;">
	<?php 
		define("filepath", "data.txt");

        $userName = $password = $email = "";
        $userNameErr = $passwordErr = "";
        $successfulMessage = $errorMessage = "";
        $flag = false;
        $logFlag = false;

        if($_SERVER['REQUEST_METHOD'] === "POST") {
	        $userName = $_POST['username'];
	        $password = $_POST['password'];

	        if(empty($userName)) {
		        $userNameErr = "Username can not be empty!";
		        $flag = true;
	        }
	        if(empty($password)) {
		        $passwordErr = "Password can not be empty!";
		        $flag = true;
	        }
	        if(!$flag)
	        {
	        	 $userName = test_input($userName);
	        	 $password = htmlspecialchars($password);

	        	 $fileData = read();
	    		 $fileDataExplode = json_decode($fileData,true);
	    		 
		    	foreach((object)$fileDataExplode as $candidate) {
				    if($candidate['userName'] === $userName and $candidate['password'] === $password)
				    {
				    	$logFlag = True;
				    	header('Location: \log in\index.html ');
				    }
			    }

			    if(!$logFlag)
			    {
			    	$errorMessage = "log-in failed";
			    }
			    
	        }
	    }

        function test_input($data) {
	        $data = trim($data);
	        $data = stripslashes($data);
	        $data = htmlspecialchars($data);
	        return $data;
        }

        function read() {
		    $resource = fopen(filepath, "r");
		    $fz = filesize(filepath);
		    $fr = "";
		    if($fz > 0) {
		    	$fr = fread($resource, $fz);
	    	}
		    fclose($resource);
		    return $fr;
		}
	    
    ?>

	<div style = "position: absolute; top: 40%; left: 50%; transform: translate(-49%, -49%);">

		<h2 style="text-align:center; font-size: 30px;font-family:optima;">Please log-in!</h2> 

		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" autocomplete = 'off'>
			<fieldset style = "background: lightgreen;">

				<div>
					<label for="username" style=" width: 40%; float: left;">Username <span style="color: red;">*</span>: </label>
					<input type="text" name="username" id="username" style = "width: 50%; float: right;">
					<span style="color: red;"><?php echo $userNameErr; ?></span>
				</div>

				<br><br>

				<div style="width: 100%; display: inline-block ;">
					 <label for="password" style="width: 40%; float: left;">Pasword <span style="color: red;">*</span>: </label>
					<input type="password" name="password" id="password" style = "width: 50%; float: right;">
					<span style="color: red;"><?php echo $passwordErr; ?></span>
				</div>

				<br><br>

				<input type="submit" name="submit" value="log in" style="background: ghostwhite; font-family: Times roman; ">

			</fieldset>
		</form>

		<!--<span style="color: green;"><?php /*echo $successfulMessage;*/ ?></span> -->
		<span style="color: red;"><?php echo $errorMessage; ?></span>

	</div>

</body>
</html>