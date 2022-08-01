<!DOCTYPE html>

<!-- 
Name: lai Kok Wui
Student ID: 101211447
Date: 9 October 2020
-->

<html lang=en>
    <head>
        <title>Post Job Vacancy Page</title>
        <meta charset="utf-8" /> 
        <meta name="description" content="Post job vacancy page" />   
        <meta name="keywords" content="post job form, form html" /> 
        <meta name="author" content="Lai Kok Wui" /> 
        <link rel="stylesheet" type="text/css" href="styles.css" />
    </head>
    <body>
        <header>
            <h1>Job Vacancy Posting System</h1>
        </header>
        <article>
            <form action="postjobprocess.php" method="POST">
                <fieldset class="generalform">
                    <legend>General Information</legend>
                    <div>
                        <div>
							<label class="labeltitle">Position ID:</label><br/>
                            <input class="inputgeneral" type="text" id="position_id" name="position_id" placeholder="e.g PID0001">
                        </div>
                        <div>
                            <label class="labeltitle">Title:</label><br/>
                            <input class="inputgeneral" type="text" id="job_title" name="job_title" placeholder="e.g. IT Manager">
                        </div>
                    </div>
                    <div>
						<div>
							<label class="labeltitle">Description:</label><br/>
							<textarea type="text" id="job_desc" name="job_desc" placeholder="e.g. This position promotes and supports the use of information technology throughout the organisation." rows="4" cols="50"></textarea>
						</div>
                        <div>
							<?php 
							$today = date('d-m-Y'); 
							echo "<label class=\"labeltitle\">Closing Date:</label><br/>";
							echo "<input class=\"inputgeneral\" type=\"type\" id=\"close_date\" name=\"close_date\" placeholder=\"dd-mm-yyyy\" value=\"{$today}\"><br/>";
							?>
                        </div>
                    </div>
				</fieldset>
				<fieldset>
					<legend>Advanced Information</legend>
					<div class="advancedform">
						<div>
							<label class="labeltitle">Position:</label><br/>
							<input type="radio" id="position" name="position" value="Full Time"><label>Full Time</label><br/>
							<input type="radio" id="position" name="position" value="Part Time"><label>Part Time</label><br/>
						</div>
						<div>
							<label class="labeltitle">Contract:</label><br/>
							<input type="radio" id="contract" name="contract" value="On-going"><label>On-going</label><br/>
							<input type="radio" id="contract" name="contract" value="Fixed Term"><label>Fixed Term</label><br/>
						</div>
						<div>
							<label class="labeltitle">Application by:</label><br/>
							<input type="checkbox" id="post" name="post" value="Post"><label>Post</label><br/>
							<input type="checkbox" id="email" name="email" value="Mail"><label>Mail</label><br/>
						</div>
					</div>
					<div class="location">
						<label for="location" class="labeltitle">Location:</label>
						<select id="location" name="location">
							<option value="">---</option>
                            <option value="Betong">Betong</option>
                            <option value="Bintulu">Bintulu</option>
                            <option value="Kapit">Kapit</option>
                            <option value="Kuching">Kuching</option>
                            <option value="Limbang">Limbang</option>
                            <option value="Miri">Miri</option>
                            <option value="Mukah">Mukah</option>
                            <option value="Samarahan">Samarahan</option>
                            <option value="Sariket">Sariket</option>
                            <option value="Serian">Serian</option>
                            <option value="Sibu">Sibu</option>
                            <option value="Sri Aman">Sri Aman</option>
						</select><br/>
					</div>
                </fieldset>
                <div class="submitbutton">
                    <button type="submit">Submit</button>
                </div>
            </form>
        </article>
        <footer>
            <ul>
               <li><a href="index.php">Return to Home Page</a></li>
            </ul>
        </footer>
    </body>
</html>
