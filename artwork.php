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
	<link href="css/artwork.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz@9..144&display=swap" rel="stylesheet">
	<script src="js/bootstrap.bundle.min.js"></script>

</head>

<body>
	<section id="header">
		<nav class="navbar navbar-expand-md navbar-light" id="navbar_sticky">
			<div class="container-xl">
				<a class="navbar-brand fs-2 p-0 fw-bold" href="index.html"><i
						class="fa fa-pencil col_pink me-1 align-middle"></i> Art<span class="col_pink span_1">Hub</span>
					<br> <span class="font_12 span_2">Art Realm</span></a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
					data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
					aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mb-0 ms-auto">

						<li class="nav-item">
							<a class="nav-link" aria-current="page" href="index.html">Home</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
								data-bs-toggle="dropdown" aria-expanded="false">
								Profile
							</a>
							<ul class="dropdown-menu drop_1" aria-labelledby="navbarDropdown">
								<li><a class="dropdown-item" href="profile.php"> View</a></li>
								<li><a class="dropdown-item border-0" href="createprofile.html"> Create</a></li>
							</ul>
						</li>
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="artwork.php">Artworks </a>
						</li>

						<li class="nav-item">
							<a class="nav-link" aria-current="page" href="uploadpost.html">Upload </a>
						</li>

						<li class="nav-item">
							<a class="nav-link" aria-current="page" href="logout.php">Logout</a>
						</li>

					</ul>
				</div>
			</div>
		</nav>
	</section>

	<section id="center" class="center_o bg_gray pt-2 pb-2">
		<div class="container-xl">
			<div class="row center_o1">
				<div class="col-md-5">
					<div class="center_o1l">
						<h2 class="mb-0">Artwork</h2>
					</div>
				</div>
				<div class="col-md-7">
					<div class="center_o1r text-end">
						<h6 class="mb-0"><a href="#">Home</a> <span class="me-2 ms-2"><i class="fa fa-caret-right"></i></span>Artwork</h6>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="product" class="p_4">
		<div class="container-xl">
			<div class="row product_1">
				<div class="col-md-9">
					<div class="product_1l">
						<p class="mb-0 mt-2">Showing 1–12 of 23 results</p>
					</div>
				</div>
				<div class="col-md-3">

	<!-- option to filter artworks -->

  <div class="product_1r">
    <form method="POST" action="">
      <select name="categories" class="form-select bg_gray col_light" required="">
        <option value="">Filter</option>
		<option value="show all">Show all</option>
        <option value="oilpainting">Oil painting</option>
        <option value="acrylic">Acrylic</option>
        <option value="abstract">Abstract</option>
        <option value="still life painting">Still life</option>
		
      </select>
      <button type="submit" name="submit" style="background-color:#e5c6f5;width:306px;color:#533483;
	border-right: 1px solid black;
	border-left: 1px solid black; 
	border-top: 0.1px solid black;
	border-bottom: 1px solid black;">Apply Filter</button>
    </form>
  </div>
</div>
</div>
			<div class="row product_2 mt-4">
				<?php
				session_start();
				// Example code for fetching artwork data from the database and generating HTML code
				$servername = 'localhost';
				$dbUsername = 'root';
				$dbPassword = '';
				$dbName = 'project';

				$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);
				if ($conn->connect_error) {
					die('Connection failed: ' . $conn->connect_error);
				}
				$selectedCategory = isset($_POST['categories']) ? $_POST['categories'] : null;
				// Check if the user selected the "Show all" option
				$showAll = ($selectedCategory === 'show all');

				$sql = "SELECT * FROM artwork";
				if (!$showAll && !empty($selectedCategory)) {
					$categoryIdQuery = "SELECT categoryId FROM categories WHERE categoryName = '$selectedCategory'";
					$categoryIdResult = $conn->query($categoryIdQuery);
					
					if ($categoryIdResult->num_rows > 0) {
					  $categoryIdRow = $categoryIdResult->fetch_assoc();
					  $categoryId = $categoryIdRow['categoryId'];
					  $sql .= " WHERE categoryId = '$categoryId'";
					}
				}  
				$result = $conn->query($sql);
				$columnCount = 4; // Define the number of columns per row
				$counter = 0; // Initialize the counter variable

				// Loop through the artworks and generate the HTML code
				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						$artId = $row['artId'];
						$artName = $row['artName'];
						$artDetails = $row['artDetails'];
						$artDimensions = $row['artDimensions'];
						$artPrice = $row['artPrice'];
						$artPicture1 = $row['artPicture1'];
						$artPicture2 = $row['artPicture2'];
						$artPicture3 = $row['artPicture3'];
						$imageData = base64_encode($artPicture1);
						$imageSrc = "data:image/jpeg;base64,{$imageData}";
						$artRating=$row['artRating'];
						// Generate the HTML code for each artwork
						echo '
        <div class="col-md-' . (12 / $columnCount) . '">
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
                    <div class="clearfix product_2im1i text-center pt-3 pb-4">
                        <h5 class="font_14 text-uppercase"><a class="col_dark" href="detail.html">' . $artName . '</a></h5>';
							
									echo ' <h6 class="font_14 mt-3 col_pink ">  
									<span class="col_yell">';
									for ($i = 1; $i <= 5; $i++) {
									  if ($i <= $artRating) {
										echo '<i class="fa fa-star"></i>';
									  } else {
										echo '<i class="fa fa-star-o"></i>';
									  }}
									
						
						echo  '<h6 class="col_dark mt-2 mb-0">$' . $artPrice . '</h6>
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

	<section id="footer" class="pt-3 pb-3">
		<div class="container-fluid">
			<div class="row footer_1">
				<div class="col-md-3">
					<div class="footer_1i">
						<hr class="line_1">
						<h5 class="mb-3">ABOUT</h5>
						<p>An innovative online art platform fostering global connections between artists and art lovers. Explore captivating artworks, engage with talented creators, and build your own art collection.</p>
						<p> Experience the vibrant world of ARTHUB - Where Art Flourishes!</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="footer_1i">
						<hr class="line_1">
						<h5 class="mb-3">RECENT WORKS</h5>
						<div class="footer_1i1 row">
							<div class="col-md-4 col-4 p-0">
								<div class="footer_1i1i">
									<div class="grid clearfix">
										<figure class="effect-jazz mb-0">
											<a href="#"><img src="home images/1.jpg" class="w-100" alt="abc"></a>
										</figure>
									</div>
								</div>
							</div>
							<div class="col-md-4 col-4 p-0">
								<div class="footer_1i1i">
									<div class="grid clearfix">
										<figure class="effect-jazz mb-0">
											<a href="#"><img src="home images/2.jpeg" class="w-100" alt="abc"></a>
										</figure>
									</div>
								</div>
							</div>
							<div class="col-md-4 col-4 p-0">
								<div class="footer_1i1i">
									<div class="grid clearfix">
										<figure class="effect-jazz mb-0">
											<a href="#"><img src="home images/16.jpg" class="w-100" alt="abc"></a>
										</figure>
									</div>
								</div>
							</div>
						</div>
						<div class="footer_1i1 row">
							<div class="col-md-4 col-4 p-0">
								<div class="footer_1i1i">
									<div class="grid clearfix">
										<figure class="effect-jazz mb-0">
											<a href="#"><img src="home images/21.jpeg" class="w-100" alt="abc"></a>
										</figure>
									</div>
								</div>
							</div>
							<div class="col-md-4 col-4 p-0">
								<div class="footer_1i1i">
									<div class="grid clearfix">
										<figure class="effect-jazz mb-0">
											<a href="#"><img src="home images/22.jpeg" class="w-100" alt="abc"></a>
										</figure>
									</div>
								</div>
							</div>
							<div class="col-md-4 col-4 p-0">
								<div class="footer_1i1i">
									<div class="grid clearfix">
										<figure class="effect-jazz mb-0">
											<a href="#"><img src="home images/23.jpg" class="w-100" alt="abc"></a>
										</figure>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="footer_1i">
						<hr class="line_1">
						<h5 class="mb-3">TAG CLOUD</h5>
						<ul class="mb-0">
							<li class="d-inline-block"><a class="d-block">ARTHub</a></li>
							<li class="d-inline-block"><a class="d-block">ArtCommunity</a></li>
							<li class="d-inline-block"><a class="d-block">CreativeJourney</a></li>
							<li class="d-inline-block"><a class="d-block">ARTHubCreatives</a></li>
							<li class="d-inline-block"><a class="d-block">ArtisticExpression</a></li>
							<li class="d-inline-block"><a class="d-block">ARTHubArtists</a></li>
							<li class="d-inline-block"><a class="d-block">ExploreArt</a></li>
							<li class="d-inline-block"><a class="d-block">ARTHubOnline</a></li>
							<li class="d-inline-block"><a class="d-block">ArtInspiration</a></li>
							<li class="d-inline-block"><a class="d-block">ArtLovers</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<div class="footer_1i">
						<hr class="line_1">
						<h5 class="mb-3">RECENT NEWS</h5>
						<p class="font_14 mb-2"><a href="detail.html">Digital art sensation breaks records a painting sells for millions in online auction.</a></p>
						<h6 class="col_light font_14"><i class="fa fa-clock-o col_pink me-1"></i> May 18 <a class="col_light" href="#"><i class="fa fa-comment-o col_pink me-1 ms-3"></i>23</a></h6>
						<hr>
						<p class="font_14 mb-2"><a href="detail1.html">Online sensation: Stunning painting goes viral, captivating art enthusiasts worldwide.</a></p>
						<h6 class="col_light font_14"><i class="fa fa-clock-o col_pink me-1"></i> July 19 <a class="col_light" href="#"><i class="fa fa-comment-o col_pink me-1 ms-3"></i> 12</a></h6>
						<hr>
						<p class="font_14 mb-2"><a href="detail3.html">Online sensation: Stunning artwork goes viral, captivating global art enthusiasts.</a></p>
						<h6 class="col_light font_14"><i class="fa fa-clock-o col_pink me-1"></i> June 17 <a class="col_light" href="#"><i class="fa fa-comment-o col_pink me-1 ms-3"></i> 31</a></h6>
					</div>
				</div>
			</div>
			<div class="row footer_2 mt-4 text-center">
				<div class="col-md-12">
					<ul>
						<li class="d-inline-block me-3 font_14"><a href="#">CONTACT</a></li>
						<li class="d-inline-block me-3 font_14"><a href="#">PRIVACY POLICY</a></li>
						<li class="d-inline-block me-3 font_14"><a href="#">TERMS OF USE</a></li>
						<li class="d-inline-block font_14"><a href="#">FAQ</a></li>
					</ul>
					<p class="mb-0">© 2023 ArtHub. All Rights Reserved | Design by MNM</p>
				</div>
			</div>
		</div>
	</section>

	<script>
		window.onscroll = function() {
			myFunction()
		};

		var navbar_sticky = document.getElementById("navbar_sticky");
		var sticky = navbar_sticky.offsetTop;
		var navbar_height = document.querySelector('.navbar').offsetHeight;

		function myFunction() {
			if (window.pageYOffset >= sticky + navbar_height) {
				navbar_sticky.classList.add("sticky")
				document.body.style.paddingTop = navbar_height + 'px';
			} else {
				navbar_sticky.classList.remove("sticky");
				document.body.style.paddingTop = '0'
			}
		}
	</script>

</body>

</html>