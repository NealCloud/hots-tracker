<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
//connect to database
require 'mysql_connect.php';
//create output
$output = ["success" => false];
//check is post request is made;
if($_SERVER["REQUEST_METHOD"] == 'POST'){
    //check if name post is sent
    if(isset($_POST['name'])){
        //set heroName to from post
        $heroName = $_POST['name'];
        //TODO: sanitize the name instead;
        if(strlen($heroName) < 15){

            //make the query based on name
            $query = "SELECT * FROM Heroes WHERE name = '$heroName'";
            $result = mysqli_query($conn, $query);
            //for each result loop through
            if(mysqli_num_rows($result) > 0){
                //set to success and initialize counter;
                $output['success'] = true;
                $counter = 0;
                //require finder functions to point to right number - value table pairs
                require 'finderfunc.php';
                //loop through each query row found
                while($row = mysqli_fetch_assoc($result)){
                    //asssing row info to hero info;
                    $heroInfo = $row;
                    //parse the into heroRole into an int
                    $heroRole = (int)$heroInfo['role'];
                    //create a query to find the
                    $rolequery = "SELECT Role FROM HeroRole WHERE id = '$heroRole'";
                    //send the query to finder functions to return the value
                    $heroRole = singleQuery($rolequery, $conn, 'Role');

                    //do the same for hero universe
                    $heroUni = (int)$heroInfo['universe'];
                    $univQuery = "SELECT universe FROM HeroUniverse WHERE id = '$heroUni'";
                    $heroUni = singleQuery($univQuery, $conn, 'universe');
                    //assign the found hero values to an array called heroes in the output
                    $output['heroes'][$counter] =
                        ['name' => $heroInfo['name'],
                            'role' => $heroRole,
                            'universe' => $heroUni];
                    //increate the counter after each found is added;
                    $counter++;
                }
            }
        }
    }
    else{//ouput an error if missing a data params
        $output['error'] = 'expected parameter name, universe or role ';
    }
}
else{ //error out if no post request
 $output['error'] = 'expected a Post method';
}
//close database and print output
mysqli_close($conn);
print_r(json_encode($output));
