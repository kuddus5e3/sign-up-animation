<?php
	$name = json_decode(json_encode($_POST['name'], true));
	$email = json_decode(json_encode($_POST['email'], true));
	$college = json_decode(json_encode($_POST['college'], true));
	$year_sem = json_decode(json_encode($_POST['year_sem'], true));
	$phone_number = json_decode(json_encode($_POST['phone_number'], true));
	$aim = json_decode(json_encode($_POST['aim'], true));
	$dreamed_big = json_decode(json_encode($_POST['dreamed_big'], true));
	$goal = json_decode(json_encode($_POST['goal'], true));
	$use_or_not = json_decode(json_encode($_POST['use_or_not'], true));
	$about_us = json_decode(json_encode($_POST['about_us'], true));
	$course = json_decode(json_encode($_POST['course'], true));
	$terms_conditions = json_decode(json_encode($_POST['terms_conditions'], true));
	if(!empty($email)||!empty($passwd)||!empty($repasswd)||!empty($name)||!empty($college)||!empty($year_sem)||!empty($course)||!empty($phone_number)||!empty($aim)||!empty($dreamed_big)||!empty($goal)||!empty($use_or_not)||!empty($about_us)||!empty($terms_conditions))
	{

	  $host = "localhost";
	  $dbusername="root";
	  $dbpassword="";
	  $dbname = "d99c";
	  $conn = new mysqli($host,$dbusername,$dbpassword,$dbname);
	//  mysqli_select_db($conn,$dbname);

	  if(mysqli_connect_error())
	  {
	    die('Connect Error('.mysqli_connect_error().')'.mysqli_connect_error());
	  }
	  else
	  {
	    $select = "SELECT email From register Where email= ? Limit 1";
	    $INSERT = "INSERT Into register (name, email, college, year_sem, phone_number, aim, dreamed_big, goal, use_or_not, about_us, course, terms_conditions ) Values(?,?,?,?,?,?,?,?,?,?,?,?)";

	    //prepare Statement
	    $stmt = $conn->prepare($select);
	    $stmt->bind_param("s",$email);
	    $stmt->execute();
	    $stmt->bind_result($email);
	    $stmt->store_result();
	    $rnum = $stmt->num_rows;
	    if($rnum==0)
	    {
	      $stmt->close();
	      $stmt = $conn->prepare($INSERT);
	      $stmt->bind_param("ssssisssssss",$name,$email,$college,$year_sem,$phone_number,$aim,$dreamed_big,$goal,$use_or_not,$about_us,$course,$terms_conditions);
	      $stmt->execute();
	      echo "successfully registered";
	      //if(mysqli_affected_rows($conn))
	      //{
	      //echo "<br>".$email."&nbsp registered successfully <br>";
	      //}
	    }
	    else
	    {
	      echo "Sorry. E-mail is already in use";
	    }
	    //$result=mysqli_query($conn,$query);
	    $stmt->close();
	    $conn->close();
	   }
	}
	else
	{
	  echo "All fields are required";
	  die();
	}
	//mysqli_close($conn);
?>
