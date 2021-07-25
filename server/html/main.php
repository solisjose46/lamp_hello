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
                <form>
                    <div class="form-group">
                        <img src="https://www.kindpng.com/picc/m/205-2055865_dog-face-transparent-dog-meme-face-png-png.png" alt="profile picture" style="width:100px;height:100px;" class="rounded">
                        <label><strong>@username</strong></label>
                        <input type="text" name="bork" class="form-control">
                        <!-- <span class="invalid-feedback"><?php echo $username_err; ?></span> -->
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Bork!">
                    </div>
                </form>
            </div>
        </div>
        <!-- Logged in user's following borks here -->
        <div class="row border-bottom border-dark"><div class="col"><h1>Following</h1></div></div>
        <!-- <div class="row">
            <div class="col">
                <form>
                    <div class="form-group">
                        <img src="https://www.kindpng.com/picc/m/205-2055865_dog-face-transparent-dog-meme-face-png-png.png" alt="profile picture" style="width:100px;height:100px;" class="rounded">
                        <label><strong>@follower</strong></label>
                        <p>My dawg just got handled by city pound</p>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-outline-dark" value="unfollow">
                    </div>
                </form>
            </div>
        </div> -->
        <!-- these are randos borks here so page isnt  -->
        <div class="row border-bottom border-dark"><div class="col"><h1>Discover</h1></div></div>
        <!-- <div class="row">
            <div class="col">
                <form>
                    <div class="form-group">
                        <img src="https://www.kindpng.com/picc/m/205-2055865_dog-face-transparent-dog-meme-face-png-png.png" alt="profile picture" style="width:100px;height:100px;" class="rounded">
                        <label><strong>@rando</strong></label>
                        <p>Follow me my guy ruff ruff</p>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Follow">
                    </div>
                </form>
            </div>
        </div> -->
    </div>
  </body>
</html>