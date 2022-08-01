<!DOCTYPE html> 

<!--
Name: lai Kok Wui
Student ID: 101211447
Date: 9 October 2020
-->

<html lang="en"> 
    <head> 
        <title>Job Search Process</title> 
        <meta charset="utf-8" /> 
        <meta name="description" content="Job Vacancy Information" />   
        <meta name="keywords" content="jab search,job vacancy system" /> 
        <meta name="author" content="Lai Kok Wui" /> 
        <link rel="stylesheet" type="text/css" href="styles.css" />
	</head>
    <body>
        <header>
            <h1>Search Job Vacancy Information</h1> 
        </header>
        <article>
            <?php
            $dir = "..\..\data\jobposts"; // folder name
            $file = "jobs.txt"; // text file name
            $filename = $dir."\\".$file; // locate the file
            $job_title = $_GET["job_title"]; // get the job title
			$valid = true;
            
            $handle = fopen($filename, "r"); // open the file in read mode
            $list = array(); // open an empty array
			
            // PHP validate Job Title is not empty , no special characters and it is maximum 30 characters 
			if ($job_title == " " || empty($_GET["job_title"])) {
				echo "<p class=\"error\">Job title cannot be empty!</p>";
				$valid = false;
			}
			else {
				if ($valid) {
					if ($handle) {
						$today = strtotime(date('d-m-Y'));
						while (!feof($handle)) {  // loop while not end of file
							$data = fgets($handle);  //read a line from the text file
							// if job title is found
							if ((strpos($data, $job_title)) !== FALSE) {
								$split = (explode("\t",$data)); // split the text from file
								$curdate = strtotime($split[3]);
								// if the date is not expired
								if (($curdate >= $today) !== FALSE) {
									$date = (explode("-", $split[3]));
									$dates = $date[2].$date[1].$date[0];
									$list[$data] = $dates; // add new element into associative array
								}
							}
						}
						fclose($handle); // close the text file

						if (!empty($_GET["position"])) {
							$position = $_GET["position"];
							foreach ($list as $x => $x_value) {
								$x_split = (explode("\t",$x));
								if ((strpos($x_split[4], $position)) === FALSE) { 
									unset($list[$x]); 
								}
							}
						}

						if (!empty($_GET["contract"])) {
							$contract =  $_GET["contract"];
							foreach ($list as $x => $x_value) {
								$x_split = (explode("\t",$x));
								if ((strpos($x_split[5], $contract)) === FALSE) { 
									unset($list[$x]); 
								}
							}
						}

						if (!empty($_GET["post"]) || !empty($_GET["email"])) {
							if (!empty($_GET["post"]) && !empty($_GET["email"])) { 
								$post = $_GET["post"];
								$email = $_GET["email"]; 
								$application = $post." or ".$email;
								foreach ($list as $x => $x_value) {
									$x_split = (explode("\t",$x));
									if ((strpos($x_split[6], $application)) === FALSE) { 
										unset($list[$x]); 
									}
								}
							}
							else {
								if (!empty($_GET["post"])) { 
									$post = $_GET["post"]; 
									foreach ($list as $x => $x_value) {
										$x_split = (explode("\t",$x));
										if ((strpos($x_split[6], $post)) === FALSE) { 
											unset($list[$x]); 
										}
									}
								}
								if (!empty($_GET["email"])) { 
									$email = $_GET["email"]; 
									foreach ($list as $x => $x_value) {
										$x_split = (explode("\t",$x));
										if ((strpos($x_split[6], $email)) === FALSE) { 
											unset($list[$x]); 
										}
									}
								}
							}
						}

						if (!empty($_GET["location"])) {
							$location = $_GET["location"];
							foreach ($list as $x => $x_value) {
								$x_split = (explode("\t",$x));
								if ((strpos($x_split[7], $location)) === FALSE) { 
									unset($list[$x]); 
								}
							}
						}

						// if list is not empty
						if (!empty($list)) {
							// Sort the associative array in asending order
							asort($list);
							// Loop through the $list array
							foreach ($list as $x => $x_value) {
								$x_split = (explode("\t",$x));
								echo "<div class=\"listbox\"><p class=\"id_and_title\">$x_split[0] $x_split[1] [ $x_split[7]]</p>";
								echo "<p class=\"advanced_info\">[{$x_split[4]} | {$x_split[5]} | {$x_split[6]}]</p>";
								echo "<p class=\"job_desc\"><span>[Job descriptions]</span></br>{$x_split[2]}</p>";
								echo "<p class=\"close_date\">Closing Date: {$x_split[3]}</p></div>";
							}
						} 
						else {
							echo "<div class=\"error\"><p>No results found</p>";
							echo "<p>Try different keywords or remove search filters</p></div>";
						}
					}
					else {
						echo "<p class=\"error\">Cannot Open File!</p>";
					}
				}
            }
            ?>
        </article>
        <footer>
            <ul id="searchfooter">
                <li><a href="searchjobform.php">Search for another job vacancy</a></li>
                <li><a href="index.php">Return to Home Page</a></li>
            </ul>
        </footer>
    </body> 
</html> 
