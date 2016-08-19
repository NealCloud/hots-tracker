<?php
//connect to database
require 'mysql_connect.php';
//create output array
$output = ["success" => false];
//check if post ajax made
if($_SERVER["REQUEST_METHOD"] == 'POST'){
    //hold post data
    $output['data'] = $_POST;
    //check if name role and universe are set
    if(isset($_POST['name']) && isset($_POST['role']) && isset($_POST['universe'])){
        //require finder functions to query and find the correct number that match role/universe
        require 'finderfunc.php';
        //TODO: sanitize inputs
        //set heroname
        $heroName = $_POST['name'];

        //find hero role number
        $heroRole = $_POST['role'];
        $rolequery = "SELECT id FROM HeroRole WHERE Role = '$heroRole'";
        $heroRole = singleQuery($rolequery, $conn, 'id');

        //find hero universe number
        $heroUni = $_POST['universe'];
        $uniquery = "SELECT id FROM HeroUniverse WHERE universe = '$heroUni'";
        $heroUni = singleQuery($uniquery, $conn, 'id');

        //$output['extra'] = ($heroName . $heroUni . $heroRole);
        //set query for insert
        $query = "INSERT INTO `Heroes` ( `name`, `role`, `universe`) VALUES ('$heroName', '$heroRole', '$heroUni');";
        $result = mysqli_query($conn, $query);
        //check if query success
        if($result){
            //output id of newly inserted row
            $output['id']= $last_id = mysqli_insert_id($conn);
            $output['success'] = true;
        }
    }
}//output an error
else{
    $output['error'] = 'no post request made';
}
//close and print output array
mysqli_close($conn);
print_r(json_encode($output));