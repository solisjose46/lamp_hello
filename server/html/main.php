<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";

//get borks of those followed by logged in user
$following="select users.userID, users.username, borks.bork from users inner join borks on users.userID=borks.userID where users.userID=(
	select user2_ID from following where user1_ID=".$_SESSION["id"]."
)";

//get borks of those not followed by logged in user
$discover="select users.userID, users.username, borks.bork from users inner join borks on users.userID=borks.userID where users.userID!=".$_SESSION["id"]." and users.userID!=(
        select user2_ID from following where user1_ID=".$_SESSION["id"]."
)"; 

//follow user *check if entry already exists
//$follow_exists="select exists(select * from following where user1_ID=".$_SESSION["id"]." and user2_ID=".$following_obj->userID.")";
//if 0 run:
//$follow_query="insert into following (user1_ID, user2_ID) values (".$_SESSION["id"].",".$following_obj->userID.")";
//else do nothing

//unfollow user *check if relationship if exists
//$unfollow_exists ="select exists(select * from following where user1_ID=3 and user2_ID=1)"
//if 1 run
//$unfollow_query="delete from following where user1_ID=".$_SESSION["id"]." and user2_ID=".$discover_obj->userID."";





//-----testing-----



if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(isset($_POST["submit"]) && $_POST["submit"]=="Bork!"){
		if(strlen($_POST["content"]) > 0 && strlen($_POST["content"]) < 140){
			//create bork query
			//$make_bork="insert into borks (userID, bork) values (".$_SESSION["id"].",'".$_POST["content"]."')";
			//$rs_make = $link->query($make_bork);
			if($rs_make){
				print_r("posted!");
			}
			else{
				print_r("oh no!");
			}
			print_r("gt");
		}
		else{
			print_r("Bork should not be empty or over 140 characters");
		}
	}
	else{
		print_r($_POST);
	}
}


//-----testing-----



//execute queries, test for failure later
$rs_following = $link->query($following);
$rs_discover = $link->query($discover);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Borks</title>
  </head>
  <body>
    <div class="container-fluid">
        <div class="row border-bottom border-dark"><div class="col"><h1>Home</h1></div></div>
        <!-- Logged in user borks here -->
        <div class="row">
            <div class="col">
	    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                    <div class="form-group">
                        <img src="https://www.kindpng.com/picc/m/205-2055865_dog-face-transparent-dog-meme-face-png-png.png" alt="profile picture" style="width:100px;height:100px;" class="rounded">
			<label><strong>@<?php echo $_SESSION["username"]; ?></strong></label>
                        <input type="text" name="content" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" value="Bork!">
                    </div>
                </form>
            </div>
	</div>

        <!-- Logged in user's following borks here -->
	<div class="row border-bottom border-dark"><div class="col"><h1>Following</h1></div></div>
<?php
while($following_obj = $rs_following->fetch_object()){
echo '
<div class="row">
<div class="col">
    <form action="'.$_SERVER["PHP_SELF"].'" method="post">
	<div class="form-group">
	    <img src="https://www.kindpng.com/picc/m/205-2055865_dog-face-transparent-dog-meme-face-png-png.png" alt="profile picture" style="width:100px;height:100px;" class="rounded">
	    <label name="username"><strong>@'.$following_obj->username.'</strong></label>
<input type="text" name="content" class="form-control" readonly value="'.$following_obj->bork.'">
	</div>
	<div class="form-group">
	    <input type="submit" class="btn btn-outline-dark" name="unfollow" value="unfollow">
	</div>
    </form>
</div>
</div>
';
}

?>
        <!-- these are randos borks here so page isnt empty -->
        <div class="row border-bottom border-dark"><div class="col"><h1>Discover</h1></div></div>
<?php
while($discover_obj = $rs_discover->fetch_object()){
	echo '
	    <div class="row">
            <div class="col">
		<form>
                    <div class="form-group">
                        <img src="https://www.kindpng.com/picc/m/205-2055865_dog-face-transparent-dog-meme-face-png-png.png" alt="profile picture" style="width:100px;height:100px;" class="rounded">
                        <label><strong>@'.$discover_obj->username.'</strong></label>
                        <p>'.$discover_obj->bork.'</p>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Follow">
                    </div>
                </form>
            </div>
	</div>

';}
?>
	<div class="row">
	    <div class="col">
		<p><a href="logout.php">Sign Out</a></p>
		<p><a href="reset-password.php">Reset Your Password</a></p>
	    </div>
	</div>
    </div>
  </body>
</html>
