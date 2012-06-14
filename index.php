<?php

error_reporting(-1);
include_once 'bootstrap.php';
$db = DB::connect(DSN);


if(isset($_GET['action']) && $_GET['action'] == 'logout'){
    session_destroy();
    header('Location: ' . $_SERVER['SCRIPT_NAME']);
    die();
}


//set log in information
if(isset($_POST['submit']) && isset($_POST['log_in'])){
    $user_id = $_POST['log_in'];
    $_SESSION['user_id'] = $user_id;
    //redirect    
    header('Location: ' . $_SERVER['SCRIPT_NAME']);
die();

}

//login form
if(!isset($_SESSION['user_id'])){
    echo '<form method="post" action="'.$_SERVER['PHP_SELF'].'">';

    $query = "select id, name from experiment.dbo.[user] order by name";
    $q =  $db->prepare($query);
    $rs = $db->execute($q,$params);
    //$cnt = $rs->numRows();

    while($row = $rs->fetchRow(DB_FETCHMODE_ASSOC)){
        $user_id = $row['id'];
        $name = $row['name'];
        
        echo "<input type=\"radio\" name=\"log_in\" value=\"$user_id\">$name<BR>";
    }


    echo '<input type="submit" name="submit" value="submit">';
    echo '</form>';
    die();
}
















function getUserID(){
    return $_SESSION['user_id'];
}



$number_of_hours = 11;
$starting_hour = 7;

function getHour($i){
    if($i<=12)
        return $i;
    
    return $i - 12;
}

function getUserName($id,$db){
$query = "select name from experiment.dbo.[user] where id = ?";

    $q =  $db->prepare($query);
    $rs = $db->execute($q,array($id));
    $cnt = $rs->numRows();
    
    if($cnt < 1)
        return 'unknown';
        
    $row = $rs->fetchRow(DB_FETCHMODE_ASSOC);
    
    return $row['name'];
    
}


if(isset($_POST['submit'])){
    
    unset($_POST['submit']);
    
    $user_id = getUserID();
    
    //clear users' old checks
    $date = getdate();
    $month = $date['mon'];
    $year = $date['year'];
    $day = $date['mday'];
    $hour = $date['hours'];
    
    $query = "delete from Experiment.dbo.timeSlot where user_id = ? and year = ? and month = ? and day > ?";
    $params[] = $user_id;
    $params[] = $year;
    $params[] = $month;
    $params[] = $day;
    $q =  $db->prepare($query);
    $rs = $db->execute($q,$params);
    unset($params);
    
    $query = "delete from Experiment.dbo.timeSlot where user_id = ? and year = ? and month = ? and day = ? and hour >= ?";
    $params[] = $user_id;
    $params[] = $year;
    $params[] = $month;
    $params[] = $day;
    $params[] = $hour;
    //echo '<pre>';
    //print_r($query);
    //print_r($params);
    $q =  $db->prepare($query);
    $rs = $db->execute($q,$params);
unset($params);
    
    foreach($_POST as $key => $value){
        $contents = explode('_',$key);
        $year = $contents[0];
        $month = $contents[1];
        $day = $contents[2];
        $hour = $contents[3];
        //echo "yr: $year m: $month h: $hour<BR>";

        $query = "insert into Experiment.dbo.timeSlot(user_id, year, month, day, hour) values(?,?,?,?,?)";
        $params[] = $user_id;
        $params[] = $year;
        $params[] = $month;
        $params[] = $day;
        $params[] = $hour;

        $q =  $db->prepare($query);
        $rs = $db->execute($q,$params);
       /*
        echo '<pre>';
        echo $query . "<BR>";
        print_r($params);
        
        //*/
        //$cnt = $rs->numRows();
       unset($params);
    }
}


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>board o' time</title>

    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

<script>
$(document).ready(function(){
	$('.hour_checkbox').click(function(){ //on click
		var check_this_box = this.name;
		var row_arr = check_this_box.split("_");
		var row = row_arr[0] + '_' + row_arr[1] +  '_' + row_arr[2];

		$('input[name^="' + row + '_"]').attr('checked',false); //uncheck all in this row
		$('input[name=' + check_this_box + ']').attr('checked', true); //check the one selected

		//get all in this row		
//		console.log(this.name);
//		console.log('input[' + this.name + ']');
	});
});
</script>    

    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body>

<style type="text/css">

.dark_column{
    background-color: '#D1E2FF';
}

.light_column{
    background-color: '#FFF';
}

tr:hover{
    background-color: #98BFFF;
}

</style>
<?php


echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">' . PHP_EOL;
echo '<table class="table table-striped table-bordered table-condensed" cellpadding="4">';

echo '<tr><td>Date</td>'; //heading
for($i=$starting_hour;$i<($starting_hour + $number_of_hours);$i++){
    $hour = getHour($i);
    echo "<td>$hour</td>";
}
echo '</tr>'. PHP_EOL;

$date = getdate();
$month = $date['mon'];
$year = $date['year'];
unset($date);




$query = "select hour, day, user_id from Experiment.dbo.timeSlot where year = ? and month = ?";
$params[] = $year;
$params[] = $month;
$q =  $db->prepare($query);
$rs = $db->execute($q,$params);


//echo $query;
//print_r($params);

while($row = $rs->fetchRow(DB_FETCHMODE_ASSOC)){
    $hour = $row['hour'];
    $day = $row['day'];
    $existing_user_id = $row['user_id'];
    $already_checked[$day][$hour] = $existing_user_id;
}

$cnt = $rs->numRows();
unset($params);
//echo "user id: {$_SESSION['user_id']}<BR>";
//echo '<pre>already checked:';
//print_r($already_checked);

$date = mktime(0,0,0,$month,1,$year); //The get's the first of the month
$now =  time();

$links = array();
$checkbox_number = 1;
$user_id = getUserID();
for($n=1;$n <= date('t',$date);$n++){
    $display_date = mktime(0,0,0,$month,$n,$year);
    echo '<tr>';
    $day = $n;

    echo "<td>" . date('d F Y',$display_date) . '</td>';
    for($i=$starting_hour;$i<($starting_hour + $number_of_hours);$i++){
        $hour = getHour($i);
        $display_hour = $i; //24 hour clock type hour
        $display_time =  mktime($display_hour,0,0,$month,$n,$year); 
        
        $disabled = '';
        if($display_time < $now){
            $disabled = 'disabled';
        }
        
        $checked = '';
        $user_name  = '';
       
//echo 'ac: ' . $already_checked[$day][$hour] . '<br>';
        if(isset($already_checked[$day][$display_hour])){
            $checked = 'checked';
//echo "ac: $checked d: $day h: $hour " . $already_checked[$day][$hour] . "uid:" . $user_id . "<BR>";
            if($already_checked[$day][$display_hour] != $user_id){ //only change your own checked boxes
                //$disabled = 'disabled';
                $user_name = getUserName($already_checked[$day][$display_hour],$db);
                //echo "un: $user_name";
            }
        }
        
        if($i %2 == 0) {
            $column_color = 'dark_column';
        } else {
            $column_color = 'light_column';            
        }
        
//echo '<pre>';
//print_r($already_checked);         
        echo "<td class=\"$column_color\" id=\"$checkbox_number\" >";
        if(strlen($user_name)){
            echo $user_name;
        } else {
            echo "<input type=\"checkbox\" class=\"hour_checkbox\" name=\"{$year}_{$month}_{$day}_{$display_hour}\" value=\"1\" $disabled $checked>";
        }
        echo "</td>";
        $checkbox_number++;
    }
    echo '</tr>'. PHP_EOL;
}


echo '</table>';

echo '<input type="submit" name="submit" value="submit">';
echo '</form>';

echo "<a href=\"".$_SERVER['PHP_SELF']."?action=logout\">logout</a>";