<?php
session_start();
include('db.php');

if (!isset($_SESSION['username'])) {
	$_SESSION['msg'] = "You have to log in first";
	header('location: login.html');
}

$username = $_SESSION['username'];
$sqluser = "select * FROM users where userName = '$username'";
$resultuser = mysqli_query($conn, $sqluser);
$rowuser = mysqli_fetch_assoc($resultuser);
$userId = $rowuser['userId'];
$fullName = $rowuser['fullName'];

$sqlprof = "select * FROM profile where userId = '$userId'";
$resultprof = mysqli_query($conn, $sqlprof);
$rowprof = mysqli_fetch_assoc($resultprof);

if (mysqli_num_rows($resultprof) > 0) {
	// echo 'successfull';
} else {
	header('location: createprofile.php');
	exit;
}

$profileBio = $rowprof['profileBio'];
$profileEmail = $rowprof['profileEmail'];
$businessName = $rowprof['businessName'];
$profilePic = $rowprof['profilePic'];
$profilePicData = base64_encode($profilePic);
$profilePicSource = "data:image/jpeg;base64,{$profilePicData}";

$sqlbusiness = "select * FROM business where businessName = '$businessName'";
$resultbusiness = mysqli_query($conn, $sqlbusiness);
$rowbusiness = mysqli_fetch_assoc($resultbusiness);
$facebook = $rowbusiness['socialLink1'];
$insta = $rowbusiness['socialLink2'];
$linkden = $rowbusiness['socialLink3'];
$address = $rowbusiness['address'];
$location = $rowbusiness['location'];
$contact = $rowbusiness['contact'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Art Web</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/global.css" rel="stylesheet">
	<link href="css/profile.css" rel="stylesheet">
	<link href="css/artwork.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz@9..144&display=swap" rel="stylesheet">
	<script src="js/bootstrap.bundle.min.js"></script>

</head>

<body>
	<?php include('includes/header.php'); ?>

	<section id="about_pg" class="p_4">
		<div style="width:70px;"></div>
		<div class="container-xl">
			<div class="row about_pg1 justify-content-center" style="padding-bottom: 50px 0;">
				<div class="product_2im clearfix position-relative text-center">
					<div class="product_2imi clearfix">
						<div class="grid clearfix" style="padding-left: 38%;">
							<figure class="profilepic" style="height: 300px; width: 300px; border-radius: 100px;">
								<a href="#"><img src="<?php echo $profilePicSource; ?>" class="w-100" alt="abc"></a>
							</figure>
						</div>
					</div>
					<div class="product_2imi1 position-absolute clearfix w-100 top-0 text-center"></div>
				</div>
				<div class="col-md-6">
					<div class="about_pg1i row">
						<div class="col-md-12 text-center">
							<div class="about_pg1ir">
								<h3><?php echo $businessName ?></h3>
								<p class="mb-0"><?php echo $profileBio ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>


			<div class="row about_pg2 mt-5">
				<div class="col-md-4">
					<div class="about_pg2i p-3" style="height: 225px">
						<h5 class="mb-3">ABOUT ME</h5>
						<div class="about_pg2i1 row">
							<div class="col-md-3 col-3">
								<div class="about_pg2i1l">
									<h6 class="font_14 mb-0">Name:</h6>
								</div>
							</div>
							<div class="col-md-9 col-9">
								<div class="about_pg2i1r">
									<h6 class="font_14 mb-0 col_light"><?php echo $fullName ?></h6>
								</div>
							</div>
						</div>
						<div class="about_pg2i1 row mt-3" style="padding-top:15px;">
							<div class="col-md-3 col-3">
								<div class="about_pg2i1l">
									<h6 class="font_14 mb-0">Location:</h6>
								</div>
							</div>
							<div class="col-md-9 col-9">
								<div class="about_pg2i1r">
									<h6 class="font_14 mb-0 col_light"><?php echo $location ?></h6>
								</div>
							</div>
						</div>
						<div class="about_pg2i1 row mt-3" style="padding-top:15px;">
							<div class="col-md-3 col-3">
								<div class="about_pg2i1l">
									<h6 class="font_14 mb-0">Address:</h6>
								</div>
							</div>
							<div class="col-md-9 col-9">
								<div class="about_pg2i1r">
									<h6 class="font_14 mb-0 col_light"><?php echo $address ?></h6>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="about_pg2i p-3" style="height: 225px">
						<h5 class="mb-3">GET IN TOUCH</h5>
						<h6 class="font_14 mb-3 col_light"><i class="fa fa-phone text-purple me-2"></i><?php echo $contact ?></h6>
						<h6 class="font_14 mb-4 col_light"><i class="fa fa-envelope text-purple me-2"></i><?php echo $profileEmail ?></h6>

						<a href='messages.php' id="open-chat-sidebar" class="chat-button" style="background-color: #533483; color: #d9bedc; padding: 10px 20px 10px ; border-radius: 12px; text-align: center; width: max-content; margin-bottom:10px;">
							<i class="fa fa-comments" style="font-size:16px; text-decoration: none; font-weight: bold;"> View Conversations</i>
						</a>
					</div>
				</div>
				<div class="col-md-4">
					<div class="about_pg2i p-3" style="height: 225px">
						<h5 class="mb-3">FOLLOW US ON</h5>
						<ul class="social-network social-circle mb-0">
							<li style="display: block; margin:10px;"><a style="margin-right:20px;" href="<?php $socialLink1 ?>" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a>Facebook</li>
							<li style="display: block; margin:10px;"><a style="margin-right:20px;" href="<?php $socialLink2 ?>" class="icoTwitter" title="Twitter"><i class="fa fa-instagram"></i></a>Twitter</li>
							<li style="display: block; margin:10px;"><a style="margin-right:20px;" href="<?php $socialLink3 ?>" class="icoLinkedin" title="Linkedin"><i class="fa fa-linkedin"></i></a>Linkedin</li>
						</ul>
					</div>
				</div>
			</div>
			<div>
				<div>
					<h3 style="margin-top:50px">UPLOADED ARTWORKS</h3>
					<hr>
				</div>
				<div class="row product_2 mt-4">
					<?php
					// Example code for fetching artwork data from the database and generating HTML code

					$sql = "SELECT * FROM artwork WHERE userId=$userId";
					$result = $conn->query($sql);
					$columnCount = 2; // Define the number of columns per row
					$counter = 0; // Initialize the counter variable

					// Loop through the artworks and generate the HTML code
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							$artId = $row['artId'];
							$artName = $row['artName'];
							$artDetails = $row['artDetails'];
							$artDimensions = $row['artDimensions'];
							$artPrice = $row['artPrice'];
							$facebook = $rowbusiness['socialLink1'];
							$insta = $rowbusiness['socialLink2'];
							$linkden = $rowbusiness['socialLink3'];
							$artPicture1 = $row['artPicture1'];
							$artPicture2 = $row['artPicture2'];
							$artPicture3 = $row['artPicture3'];
							$imageData = base64_encode($artPicture1);
							$imageSrc = "data:image/jpeg;base64,{$imageData}";
							// Generate the HTML code for each artwork
							echo '
			<div class="col-md-' . (8 / $columnCount) . '">
				<div class="prod_main p-1 bg-white clearfix">
					<div class="product_2im clearfix position-relative">
						<div class="product_2imi clearfix">
							<div class="grid clearfix">
								<figure class="effect-jazz mb-0">
									<a href="detail.php?artId=' . $artId . '"><img src="' . $imageSrc . '" class="w-100" alt="abc"></a>
								</figure>
							</div>
						</div>
						<div class="product_2imi1 position-absolute clearfix w-100 top-0 text-center">
						</div>
					</div>
					<div class="product_2im1 position-relative clearfix">
						<div class="clearfix product_2im1i text-center pt-3 pb-4" >
							<h5 class="font_14 text-uppercase " style="height:35px; padding:auto;"><a class="col_dark" href="detail.html">' . $artName . '</a></h5>
							<span class="font_12 col_yell">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star-o"></i>
							</span>
							<h6 class="col_dark mt-2 mb-0">$' . $artPrice . '</h6>
						</div>
					</div>
				</div>
			</div>
			';

							$counter++;
							if ($counter % $columnCount === 0) {
								echo '</div><div class="row product_2 mt-4">';
							}
						}
					}

					// Close the last row if the number of artworks is not divisible by the column count
					if ($counter % $columnCount !== 0) {
						echo '</div>';
					}

					// Close the database connection
					$conn->close();

					// Display a message when no artworks are found
					if ($counter === 0) {
						echo '<div class="row mt-4"><div class="col-md-12">No artworks found.</div></div>';
					}
					?>
				</div>

			</div>
	</section>
	<?php include('includes/footer.php'); ?>
	<script>
		window.onscroll = function() {
			myFunction();
		};

		var navbar_sticky = document.getElementById("navbar_sticky");
		var sticky = navbar_sticky.offsetTop;
		var navbar_height = document.querySelector('.navbar').offsetHeight;

		function myFunction() {
			if (window.pageYOffset >= sticky + navbar_height) {
				navbar_sticky.classList.add("sticky");
				document.body.style.paddingTop = navbar_height + 'px';
			} else {
				navbar_sticky.classList.remove("sticky");
				document.body.style.paddingTop = '0';
			}
		}

		// Ensure the chat sidebar is hidden by default when the page loads
		window.onload = function() {
			document.getElementById('chat-sidebar').classList.remove('chat-sidebar-active');
		};

		// JavaScript to toggle the sidebar
		document.getElementById('open-chat-sidebar').onclick = function() {
			document.getElementById('chat-sidebar').classList.add('chat-sidebar-active');
		};

		document.getElementById('close-chat-sidebar').onclick = function() {
			document.getElementById('chat-sidebar').classList.remove('chat-sidebar-active');
		};
	</script>


</body>

</html>