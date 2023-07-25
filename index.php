<?php include 'databaseCon.php'; ?>
<?php 
//Get Total number of questions
$query = "SELECT * FROM `questions`" ;

//Get Results
$results = $mysqli -> query($query) or die($mysqli->error.__LINE__);
$total = $results->num_rows;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php Quizzer</title>
    <link rel="stylesheet" href="bootstrap (3).css" type="text/css">

</head>
<body>

<header>
    <div class="container">
   <h1>BAKING Quizzer</h1>
    
    </div>
</header>

<main>
    <div class="container">
<h2>test your baking Knowledge</h2>
<p>this is a multiple choice quuizz to test your Knowledge of Baking</p>
<ul>
    <li><strong>Number of Questions : </strong> <?php echo $total ; ?></li>
    <li><strong>Type : </strong> Multiple choice </li>
    <li><strong>Estimate Time : </strong> <?php echo $total * .5; ?> Minutes</li>


</ul>
<a href="question.php?n=1" class="btn btn-primary"> Start Quizz</a>
    </div>
</main>


<footer>
    <div class="container">
        Copyright &copy; 2022,PHP Quizzer
    </div>
</footer>   

    
</body>
</html>