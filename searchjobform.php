<!DOCTYPE html>

<!-- 
Name: lai Kok Wui
Student ID: 101211447
Date: 9 October 2020
-->

<html lang=en>
    <head>
        <title>Search Job Vacancy Page</title>
        <meta name="description" content="Job Vacancy Information" />   
        <meta name="keywords" content="jab search,job vacancy system" /> 
        <meta name="author" content="Lai Kok Wui" /> 
        <link rel="stylesheet" type="text/css" href="styles.css" />
    </head>
    <body>
        <header>
            <h1>Search Job Vacancy System</h1>
        </header>
        <article>
            <form action = "searchjobprocess.php" method = "GET" >
				<div class="searchbox">
					<label for="title" class="labeltitle">Search:</label>
					<input type="text" id="job_title" name="job_title" placeholder="e.g IT Manager"><br/>
				</div>
                <fieldset>
                    <legend>Search Filter</legend>
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
                    <button type="submit">Search</button>
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
