<!DOCTYPE html>

<!-- 
Name: lai Kok Wui
Student ID: 101211447
Date: 9 October 2020
-->

<html lang=en>
    <head>
        <title>Admin Page - Remove Expired Job System</title>
        <meta charset="utf-8" /> 
        <meta name="description" content="Job Vacancy Posting System About Page" />   
        <meta name="keywords" content="About page, job vacancy system about" /> 
        <meta name="author" content="Lai Kok Wui" /> 
        <link rel="stylesheet" type="text/css" href="styles.css" />
    </head>
    <body>
        <header>
            <h1>Admin Page - Remove Expired Job System</h1>
        </header>
        <article>
            <?php
			$dir = "..\..\data\jobposts"; // folder name
            $file = "jobs.txt"; // text file name
            $filename = $dir."\\".$file; // locate the file
			$handle = fopen($filename, "r"); // open the file in read mode
			$deleted = false; // check whether any job is deleted
			
			// test the existence of "jobs.txt"
			if (!file_exists($filename)) {
				echo "<p class=\"error\">The file contains data is not available! Please try again.</p>";
			}
			else {
				$handle = fopen ($filename, "a+");
				$list = array(); // open an empty array
				if ($handle) {
					while (!feof($handle)) {  // loop while not end of file
						$data = fgets($handle);  //read a line from the text file
						if (strpos($data, "\n")) {
							$split = (explode("\t",$data)); // split the text from file
							$list[$data] = $split[3]; // add new element into associative array
						}
					}
					fclose($handle); // close the text file

					foreach ($list as $x => $x_value) {
						$today = strtotime(date('d-m-Y'));
						$close_date = strtotime($x_value);
						if (($close_date >= $today) === FALSE) {
							$data = file_get_contents($filename); // get this content
							$data = str_replace($x,'',$data); // replace the line with empty string
							file_put_contents($filename, $data); // put the content in again after str_replace
							$deleted = true; // deleted jobs true
						}
					}

					// check if the file is writeable
					if (is_writable($filename)) { // can write
						if ($deleted) {
							echo "<p class=\"success\">All expired job(s) are successfully cleared!</p>"; // confirmation message
						}
						else{
							echo "<p class=\"error\">No Expired job found!</p>"; // confirmation message
						}
							
					}
				}
			}
			?>
        </article>
        <footer>
            <ul>
              <li><a href="index.php">Back to Home Page</a></li>  
            </ul>
        </footer>
    </body>
</html>
