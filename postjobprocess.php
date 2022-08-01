<!DOCTYPE html>

<!--
Name: lai Kok Wui
Student ID: 101211447
Date: 9 October 2020
-->

<html lang="en"> 
    <head> 
        <title>Job Post Process</title> 
        <meta charset="utf-8" /> 
        <meta name="description" content="Web application development" />   
        <meta name="keywords" content="PHP, write file php" /> 
        <meta name="author" content="Lai Kok Wui" /> 
        <link rel="stylesheet" type="text/css" href="styles.css" />
    </head> 
    <body> 
        <header>
            <h1>Job Vacancy Information</h1> 
        </header>
        <article>
			<?php
			$dir = "..\..\data\jobposts"; // folder name
			$file = "jobs.txt"; // text file name
			
			$filename = $dir . "\\" . $file;
			$handle = fopen($filename, "r");

			if (!is_dir($dir)) {
				mkdir($dir,0777, true); // if not create one folder name $dir
			}

			if (!empty($_POST["position_id"]) && !empty($_POST["job_title"]) && !empty($_POST["job_desc"]) && !empty($_POST["close_date"]) && !empty($_POST["position"]) && !empty($_POST["contract"]) && (!empty($_POST["post"]) || !empty($_POST["email"])) && !empty($_POST["location"])) {
				// Capture the datas
				$position_id = $_POST["position_id"];
				$job_title = $_POST["job_title"];
				$job_desc = str_replace("\n","",$_POST["job_desc"]);
				$close_date = $_POST["close_date"];
				$position = $_POST["position"];
				$contract = $_POST["contract"];
				$location = $_POST["location"];
				
				// get application type post
				if (!empty($_POST["post"])) { 
					$post = $_POST["post"]; 
				}
				
				// get application type email
				if (!empty($_POST["email"])) { 
					$email = $_POST["email"]; 
				}
				
				$valid = true;
				$unique = true;
				
				// PHP validate Position ID format. after that, check is it used
				if (!preg_match("/^[A-Z]{3}+\d{4}$/", $position_id)) {
					echo "<p class=\"error\">\nPosition ID must be fulfill these requirements:</p>";
					echo "<p class=\"error\">- First Three Letters must be Capitalise Letters!</p>";
					echo "<p class=\"error\">- Last Four Letters must be 4 digits number!</p>";
					$valid = false;
				}
				else { 
					if ($handle) {
						while (!feof($handle)) { 
							$data = fgets($handle);
							$split = (explode("\t",$data)); // split the text from file
							if ($position_id == $split[0]) {
								$unique = false;
								fclose($handle);
								break;
							}
						}
					}
					else {
						echo "<p class=\"error\">Error opening jobs.txt to validate position ID!</p>";
					}
				}
				
				// PHP validate Job Title is not empty , no special characters and it is maximum 30 characters 
				if (!preg_match("/^[A-Za-z0-9 .,!]{1,30}$/", $job_title) || $job_title == " ") {
					echo "<p class=\"error\">\nJob Title must be fulfill these requirements:</p>";
					echo "<p class=\"error\">- Cannot Include Special Characters e.g. '@' '$' '%' '^' '&' '*'!</p>";
					echo "<p class=\"error\">- except '!' ' ' ',' '.', these are allowed!</p>";
					echo "<p class=\"error\">- Maximum 30 Characters!</p>";
					echo "<p class=\"error\">- Job title cannot be empty!</p>";
					$valid = false;
				}
				
				// PHP validate Job descriptions is not empty and it is maximum 250 characters 
				if (!preg_match("/^(.|\s){1,250}$/", $job_desc) || $job_desc == " ") {
					echo "<p class=\"error\">\nJob Descriptions must be fulfill these requirements:</p>";
					echo "<p class=\"error\">- Maximum 250 Characters!</p>";
					echo "<p class=\"error\">- Job Description cannot be empty!</p>";
					$valid = false;
				}
				
				// PHP validate Closing date format, check is it valid, check is it expired
				if (!preg_match("/^[0-9]{2}-[0-9]{2}-[0-9]{4}$/", $close_date, $dateMatches)) { 
					echo "<p class=\"error\">\nClosing date must be fulfill these requirements:</p>";
					echo "<p class=\"error\">- Closing Date Format DD-MM-YYYY";
					echo "<p class=\"error\">- Closing cannot be empty!</p>";
					$valid = false;
				}
				else {
					$today = strtotime(date('d-m-Y')); 
					$curdate = strtotime($close_date);
					$date = explode("-", $close_date);
					if (!checkdate($date[1],$date[0],$date[2])) {
						echo "<p class=\"error\">\nPlease Enter valid Date!</p>"; // invalid date
						$valid = false;
					}
					if (($curdate >= $today) === FALSE) { 
						echo "<p class=\"error\">\nClosing date must be today or later!</p>"; // expired
						$valid = false;
					}
				}
				
				$handle = fopen($filename, "a");
				if ($handle) {
					if ($unique && $valid) {
						// check the post and mail input do decide on how to write it onto the txt file
						if ((!empty($_POST["post"]) && !empty($_POST["email"]))) {
							$data = "{$position_id}\t{$job_title}\t{$job_desc}\t{$close_date}\t{$position}\t{$contract}\t{$post}"." or "."{$email}\t{$location}"; 
						}
						else {
							if (!empty($_POST["post"])) {
								$data = "{$position_id}\t{$job_title}\t{$job_desc}\t{$close_date}\t{$position}\t{$contract}\t{$post}\t{$location}"; 
							}
							if (!empty($_POST["email"])) {
								$data = "{$position_id}\t{$job_title}\t{$job_desc}\t{$close_date}\t{$position}\t{$contract}\t{$email}\t{$location}";
							}
						}
						// check if the file is writeable
						if (is_writable($filename)) { // can write
							echo "<p class=\"success\">Thank you for posting!</p>"; // echo thank you for signning
							fwrite($handle, $data."\n"); // write the file
						}
						else { // cannot write
							echo "<p class=\"error\">Job post unsuccesful!</p>"; // echo cannot write
						}
						fclose($handle); // close file
					}
					else {
						if (!$unique) {
							echo "<p class=\"error\">\nSame Position ID found! Please enter a unique position ID!</p>";
						}
						if (!$valid) {
							echo "<p class=\"error\">\nInvalid Fill!</p>";
						}
					}
				}
				else {
					echo "<p class=\"error\">Error opening jobs.txt to write!</p>";
				}
			}
			else { // no input 
				if (empty($_POST["position_id"])) {
					echo "<p class=\"error\">You must fill in Position ID!</p>"; // echo no Position ID input
				}
				if (empty($_POST["job_title"])) {
					echo "<p class=\"error\">You must fill in Job Title!</p>"; // echo no input
				}
				if (empty($_POST["job_desc"])) { 
					echo "<p class=\"error\">You must fill in Job Description!</p>"; // echo no input
				}
				if (empty($_POST["close_date"])){
					echo "<p class=\"error\">You must fill in Close Date!</p>"; // echo no input
				}
				if (empty($_POST["position"])){
					echo "<p class=\"error\">You must check at least one (Full Time or Part Time)!</p>"; // echo no input
				}
				if (empty($_POST["contract"])){
					echo "<p class=\"error\">You must check at least one (On-going or Fixed Term)!</p>"; // echo no input
				}
				if (empty($_POST["post"]) && empty($_POST["email"])) {
					echo "<p class=\"error\">You must check at least one (Post or Mail)!</p>"; // echo no input
				}
				if (empty($_POST["location"])) {
					echo "<p class=\"error\">You must select the Location!</p>"; // echo no input
				}
			}
			?>
        </article>
        <footer>
            <ul>
               <li><a href="index.php">Return to Home Page</a></li> 
            </ul>
        </footer>
    </body>
</html>
