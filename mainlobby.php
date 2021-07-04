<?php

session_start() ; 
include 'config.php' ; 

$conn = NEW mysqli($servername, $username, $password, $dbname);
      // Check connection
if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
}

// Displaying student main lobby

if( $_SESSION['Category'] == "Student"){ 

    //To get the student table name. 
    $tablename = $_SESSION['CollegeID'] ; 
    $tablename = "s" . $tablename ; 
    $_SESSION['studenttablename'] = $tablename ; 

    //For displaying all the teams they have enrolled in. 
    $selectAllTeamNames = "SELECT * FROM $tablename " ; 
    if ( $result = mysqli_query( $conn, $selectAllTeamNames ) ) { 
        while ( $row = mysqli_fetch_assoc($result) ) { 
            $teams = $row['TeamName'] ; 
            echo "Team : $teams <br>"; 
        }
    }
    else{ 
        echo "<script>alert('You have to join a new team.')</script>" ; 
    }

?>

    <button onclick="location.href='jointeam.php'">Join Team</button>

<?php

}   // Displaying teacher main lobby
else { 
      
    $CollegeID  = $_SESSION['CollegeID'] ; 

    // Trying to display all the teams teacher has created.
    $selectAllTeam = "SELECT * FROM teams where TeacherID = '$CollegeID' " ; 
    if ( $result = mysqli_query( $conn, $selectAllTeam ) ) { 
        while ( $row = mysqli_fetch_assoc($result) ) { 
            $teams = $row['TeamName'] ; 
            echo "Team : $teams <br>"; 
        }
    }

?>

    <button onclick="location.href='createteam.php'">Create Team</a></button>

<?php

}

?>

<!DOCTYPE html>
<html>
    <body>
        <h1>Welcome to your online classroom</h1>
    </body>
</html>