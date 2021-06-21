<?php session_start(); /* Starts the session */
if(!isset($_SESSION['UserData']['Username'])){
header("location:login.php");
exit;
}

if(!empty($_GET['bit'])){
    //convert to integer
    $inte=(string)$_GET['bit'];
    //get value of a bitcoin from url
    $api_url = 'https://api.coindesk.com/v1/bpi/currentprice.json';

// Read JSON file
    $json_data = file_get_contents($api_url);

// Decode JSON data into PHP array
    $response_data = json_decode($json_data);

// All user data exists in 'data' object
    $user_data = $response_data->bpi;
    //extract value

    $asd=$_GET['cur'];
    if ($asd == 0) {
        $bit_value=$user_data->USD->rate;
        $bit_final= (float)$bit_value*$inte;
    }
    elseif ($asd == 1) {
        $bit_value=$user_data->GPB->rate;
        $bit_final= (float)$bit_value*$inte;
    }
    elseif($asd == 2 ){
        $bit_value=$user_data->EUR->rate;
        $bit_final= (float)$bit_value*$inte;
    }


}
$api_url = 'https://api.coindesk.com/v1/bpi/currentprice.json';

// Read JSON file
$json_data = file_get_contents($api_url);

// Decode JSON data into PHP array
$response_data = json_decode($json_data);

// All user data exists in 'data' object
$user_data = $response_data->bpi;

?>
<html>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<Head>
    <title>Bitcoin Calcualtor</title>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Bitcoin Calcualtor</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>

        </ul>
    </div>
</nav>
<div id="contents">
    <center>  <h1>Bitcoin Calculator</h1>
        <br/>
        <form action="index.php">
            <input type="text" name="bit">
            <br/>
            <select name="cur" size="1">
                <option value="0">USD
                <option value="1">GBP
                <option value="2">EUR

            </select>
            <input type="submit" value="Get rates" />



        </form>
        <?php
        if(!empty($bit_final)){
            echo '<h3>'.number_format($bit_final).'</h3>';
        }

        ?>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Currency</th>
                <th scope="col">Value</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <?php
                echo "<th scope='row'>".$user_data->EUR->code."</th>";
                echo "<td>".$user_data->EUR->rate."</td>";
                ?>
            </tr>
            <tr>
                <?php
                echo "<th scope='row'>".$user_data->USD->code."</th>";
                echo "<td>".$user_data->USD->rate."</td>";
                ?>

            </tr>
            <tr>
                <?php
                echo "<th scope='row'>".$user_data->GBP->code."</th>";
                echo "<td>".$user_data->GBP->rate."</td>";
                ?>
            </tr>
            </tbody>
        </table>
    </center>
</div>
</body>
</html>