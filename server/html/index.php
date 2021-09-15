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

// get borks of those followed by logged in user
$following="select users.userID, users.username, borks.bork from users inner join borks on users.userID=borks.userID where users.userID in (
        select user2_ID from following where user1_ID=".$_SESSION["id"]."
)";

//get borks of those not followed by logged in user
$discover="select users.userID, users.username, borks.bork from users inner join borks on users.userID=borks.userID where users.userID!=".$_SESSION["id"]." and users.userID not in (
        select user2_ID from following where user1_ID=".$_SESSION["id"]."
)";

// executing queries
$rs_following = $link->query($following);
$rs_discover = $link->query($discover);

//for feedback
$bork_succ = "";
$feedback = "";

//-----POST-----
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(isset($_POST["submit"]) && $_POST["submit"]=="Bork!"){
		if(strlen($_POST["content"]) > 0 && strlen($_POST["content"]) < 140){
			$make_bork="insert into borks (userID, bork) values (".$_SESSION["id"].",'".$_POST["content"]."')";
			$rs_make_bork = $link->query($make_bork);
			$bork_succ = "Posted!";
		}
		else{
			$bork_succ = "Bork cannot be empty or over 140 characters";
		}
	}
	elseif(isset($_POST["submit"]) && $_POST["submit"]=="follow"){
		print_r($_SESSION["id"]);
		$make_follow="insert into following (user1_ID, user2_ID) values (".$_SESSION["id"].", ".$_POST["discoverID"].")";
		$rs_make_follow = $link->query($make_follow);
		$feedback = "Following!";
		header("location:index.php");
	}
	elseif(isset($_POST["submit"]) && $_POST["submit"]=="unfollow"){
		print_r($_POST);
		$make_unfollow="delete from following where user1_ID=".$_SESSION["id"]." and user2_ID=".$_POST["followID"]."";
		$rs_make_unfollow = $link->query($make_unfollow);
		$feedback = "unfollowed";
		header("location:index.php");
	}

}
//-----POST-----
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
	<div class="row bg-info"><div class="col"><strong><?php echo $feedback; ?></strong></div></div>
        <div class="row border-bottom border-dark"><div class="col"><h1>Home</h1></div></div>
	<!-- Logged in user borks here -->
        <div class="row">
            <div class="col">
	    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                    <div class="form-group">
                        <img src="https://www.kindpng.com/picc/m/205-2055865_dog-face-transparent-dog-meme-face-png-png.png" alt="profile picture" style="width:100px;height:100px;" class="rounded">
			<label><strong>@<?php echo $_SESSION["username"]; ?></strong></label>
			<input type="text" name="content" class="form-control">
			<div class="bg-info"><strong><?php echo $bork_succ; ?></strong></div>
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
	<input type="hidden" name="followID" value='.$following_obj->userID.'>
	</div>
	<div class="form-group">
	    <input type="submit" class="btn btn-outline-dark" name="submit" value="unfollow">
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
		<form action="'.$_SERVER["PHP_SELF"].'" method="post">
                    <div class="form-group">
                        <img src="https://www.kindpng.com/picc/m/205-2055865_dog-face-transparent-dog-meme-face-png-png.png" alt="profile picture" style="width:100px;height:100px;" class="rounded">
                        <label><strong>@'.$discover_obj->username.'</strong></label>
			<p>'.$discover_obj->bork.'</p>
		<input type="hidden" name="discoverID" value='.$discover_obj->userID.'>
		    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="submit" value="follow">
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
