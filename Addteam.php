<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head> <link rel="stylesheet" type="text/css" href="addteam.css">
    <meta charset="utf-8">
    <title>Add Team</title>
  </head>

  <?php 
  $servername = "localhost";
  $username = 'root';
  $password = null;
  $dbName = 'sisimpur';

  $conn = mysqli_connect($servername,$username,$password ,$dbName);
  
  if (!$conn) {
    die('connection failed' . mysqli_connect_error());
  } 


   $sql = 'CREATE DATABASE IF NOT EXISTS ' . $dbName;

 IF($conn->query($sql) === TRUE) {
      echo 'database created successfully';
    } else {
      echo 'Error creating database:' . $conn->error;
    }

   echo "connected successfully";

   
  
   

     $sql = 'CREATE table IF NOT EXISTS add_team(
        id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        teamname VARCHAR(30) NOT NULL UNIQUE,
        establishing_date DATE NULL,
        league_title VARCHAR(30) NOT NULL,
        coach VARCHAR(30) NULL,
        captain VARCHAR(30) NOT NULL,
        image VARCHAR(150) NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP
)';

 IF($conn->query($sql) === TRUE) {
      echo 'table created successfully';
    } else {
      echo 'Error creating table:' . $conn->error;
    }


  $nameMsg = $numberMsg = $coachMsg = $captainMsg = '';
  $name = $date = $number = $coach = $captain = $image = $transportation = '';
 
 	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    print_r($_POST);

 		if(empty($_POST['teamname'])){
 			$nameMsg = "Name field is mandatory.";
 		}else{
 			$name = $_POST['teamname'];
      $name = sanitize($name);

      if(!preg_match("/^[a-zA-Z. ]*$/", $name)  || strlen($name) > 30){
        $nameMsg = "Name field must not exceed 30 characters & can't contain numbers.";
      }

 		}

 	  if (empty($_POST['titlecount'])) {
 		 $numberMsg = "Title field is mandatory";
 		}
 		else {
 			$number =$_POST['titlecount'];
      $number = sanitize($number);

      if(!filter_var($number, FILTER_VALIDATE_INT)){
        $numberMsg = "Please enter integers only";
      }

 		}

 	  if (empty($_POST['coach'])) {
 		 $coachMsg = 'Dont you have a coach?';
		}
    else{
	   $coach = $_POST['coach'];
     $coach = sanitize($coach);
    }

   if (empty($_POST['captain'])) {
		$captainMsg = 'Dont you know your captain?';
	 }	
	 else{
		$captain = $_POST['captain'];
    $$captain = sanitize($captain );
   
	 }

    $transportation = $_POST['transportation'];
    $transportation = sanitize($transportation);

 	  $date = $_POST['establishingdate'];
    $date = sanitize($date);
 	}

  function sanitize($data){

    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);

    return $data;

  }

  ?>



  <body>
  <div id="div1">
    <h2 align="center"> Please enter the following information </h2>
    <hr>
  </div>
  <hr>

  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div id="div2">
        Enter the name of the team<span style="color: red;">*</span> : 
        <input type="text" name="teamname" value="<?php echo $name; ?>">
        <p><?php echo $nameMsg; ?></p>
        <br>

        Enter the date it was established : 
        <input type="date" name="establishingdate" value="<?php echo $date; ?>"> 
        <br><br>

        Enter the number of league titles it has won<span style="color: red;">*</span> : 
        <input type="number" name="titlecount"  value="<?php echo $number; ?>">
        <br>
        <p><?php echo $numberMsg; ?>
        <br>

        Enter the name of the current coach of the team<span style="color: red;">*</span> : 
        <input type="text" name="coach" value="<?php echo $coach; ?>">
        <p><?php echo $coachMsg; ?></p>
        <br>

        Enter the name of the current captain of the team<span style="color: red;">*</span> : 
        <input type="text" name="captain" value="<?php echo $captain; ?>">
        <span><?php echo $captainMsg; ?></span>
        <br>

        Enter an image of the team :
        <input type="file" name="fileValue" class="btn1" >
        <br><br>
        <select name="transportation">
          <option value="volvo"    <?php if($transportation == "volvo"){ echo "selected"; }?>    >Volvo</option>
          <option value="saab"     <?php if($transportation == "saab"){ echo "selected"; }?>     >Saab</option>
          <option value="mercedes" <?php if($transportation == "Mercedes"){ echo "selected"; }?> >Mercedes</option>
          <option value="audi"     <?php if($transportation == "audi"){ echo "selected"; }?>     >Audi</option>
        </select>
        <input type="Submit" name="submit" value="Confirm">

    </div>
  </form>

</body>
</html>