<!DOCTYPE html>

<!-- 
Name: lai Kok Wui
Student ID: 101211447
Date: 9 October 2020
-->

<html lang=en>
    <head>
        <title>About Page - Job Vacancy Posting System</title>
        <meta charset="utf-8" /> 
        <meta name="description" content="Job Vacancy Posting System About Page" />   
        <meta name="keywords" content="About page, job vacancy system about" /> 
        <meta name="author" content="Lai Kok Wui" /> 
        <link rel="stylesheet" type="text/css" href="styles.css" />
    </head>
    <body>
        <header>
            <h1>About This Website</h1>
        </header>
        <article>
            <p>This is a Job Posting System specifiy for Assignment 1 of COS30020 Web Application Development using PHP.</p>
            
            <div class="list">
                <ul>
                    <?php 
                    echo "<li>PHP Version: ". phpversion() ."</li>"; 
                    echo "<li>I completed Task 1 to Task 8</li>"; 
                    echo "<li>Stop People Adding Expired Job (Additional).</li>"; 
					echo "<li>Remove Expired Job Post (Additional).</li>"; 
                    ?>
                </ul>
            </div>
        </article>
        <footer>
            <ul>
              <li><a href="index.php">Back to Home Page</a></li>  
            </ul>
        </footer>
    </body>
</html>
