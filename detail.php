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
  <linK href="css/addreview.css" rel="stylesheet""
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
							<a class="nav-link active" aria-current="page" href="index.html">Home</a>
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
							<a class="nav-link" aria-current="page" href="artwork.php">Artworks </a>
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
            <h2 class="mb-0">Detail</h2>
          </div>
        </div>
        <div class="col-md-7">
          <div class="center_o1r text-end">
            <h6 class="mb-0"><a href="#">Home</a> <span class="me-2 ms-2"><i class="fa fa-caret-right"></i></span> Artwork Detail</h6>
          </div>
        </div>
      </div>
    </div>
  </section>

</body>
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

// Fetch artwork data from the database based on artId
if (isset($_GET['artId'])) {
  $artId = $_GET['artId'];

  // Prepare the SQL statement with a parameter placeholder
  $sql = "SELECT * FROM artwork WHERE artId = $artId";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $artName = $row['artName'];
      $artDetails = $row['artDetails'];
      $artDimensions = $row['artDimensions'];
      $artPrice = $row['artPrice'];
      $artPicture1 = $row['artPicture1'];
      $artPicture2 = $row['artPicture2'];
      $artPicture3 = $row['artPicture3'];
      $imageData1 = base64_encode($artPicture1);
      $imageSrc1 = "data:image/jpeg;base64,{$imageData1}";
      $imageData2 = base64_encode($artPicture2);
      $imageSrc2 = "data:image/jpeg;base64,{$imageData2}";
      $imageData3 = base64_encode($artPicture3);
      $imageSrc3 = "data:image/jpeg;base64,{$imageData3}";
      $artRating = $row['artRating'];

      // Generate HTML code for the artwork details
      echo '<section id="detail" class="p_4">
                    <div class="container-xl">
                        <div class="row detail_1">
                            <div class="col-md-5">
                                <div class="detail_1l">
                                    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-indicators">
                                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-label="Slide 1"></button>
                                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2" class="" aria-current="true"></button>
                                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3" class=""></button>
                                        </div>
                                        
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <img src="' . $imageSrc1 . '" class="d-block w-100" alt="abc">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="' . $imageSrc2 . '" class="d-block w-100" alt="abc">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="' . $imageSrc3 . '" class="d-block w-100" alt="abc">
                                            </div>
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="detail_1r">
                                    <h2>' . $artName . '</h2>
                                    <h6 class="font_14 mt-3 col_pink ">';
      echo ' <h6 class="font_14 mt-3 col_pink ">  
                                    <span class="col_yell">';
      for ($i = 1; $i <= 5; $i++) {
        if ($i <= $artRating) {
          echo '<i class="fa fa-star"></i>';
        } else {
          echo '<i class="fa fa-star-o"></i>';
        }
      }
    }
    echo  '<h4 class="mt-3" style="color: #000000;">$' . $artPrice . '</h4>
                                    <p>' . $artDetails . '</p>
                                    <p> Dimensions: ' . $artDimensions . '</p>
                                    <p>Category: <a class="col_pink hover_white" href="#">Posters</a></p>';
    $sqlLink = "SELECT socialLink1, socialLink2, socialLink3 FROM business";
    $result = $conn->query($sqlLink);
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $socialLink1 = $row['socialLink1'];
      $socialLink2 = $row['socialLink2'];
      $socialLink3 = $row['socialLink3'];

      // Insert the social media links into the HTML code
      echo '<ul class="social-network social-circle mb-0">
                                      <li><a href="#" class="icoRss" title="Rss"><i class="fa fa-skype"></i></a></li>
                                      <li><a href="' . $socialLink1 . '" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                      <li><a href="#" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                      <li><a href="' .$socialLink2 . '" class="icoGoogle" title="Google +"><i class="fa fa-instagram"></i></a></li>
                                      <li><a href="' . $socialLink3 . '" class="icoLinkedin" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                  </div>
              </section>';
    } else {
      echo 'Social media links not found.';
    }




    $reviewSql = "SELECT r.reviewId, r.artId, r.userId, r.comment,r.rating,r.reviewDate, p.profilePic, u.fullName
              FROM reviews r
              JOIN profile p ON r.userId = p.userId
              JOIN users u ON r.userId = u.userId WHERE artId = $artId";
    $reviewResult = $conn->query($reviewSql);

    if ($reviewResult->num_rows > 0) {
      while ($row = $reviewResult->fetch_assoc()) {
        $reviewId = $row['reviewId'];
        $artId = $row['artId'];
        $userId = $row['userId'];
        $comment = $row['comment'];
        $profilePic = $row['profilePic'];
        $picture = base64_encode($profilePic);
        $pictureSrc = "data:image/jpeg;base64,{$picture}";
        $fullName = $row['fullName'];
        $rating = $row['rating'];
        $reviewDate = $row['reviewDate'];

        // Generate HTML code for the review with user profile data
        echo '
        	<div class="profilei1 row mt-3">
        <div class="col-lg-1 col-md-2 col-2">
        <div class="profilei1l">
        <img src="' . $pictureSrc . '" class="w-100" alt="abc" style="height:120px;">
        </div>
        </div>
        <div class="col-lg-11 col-md-10 ps-0 col-10">
        <div class="profilei1r p-3">
        <h6 class="col_light font_14">
        <span class="fw-bold">' . $fullName . '</span>-' . $reviewDate . '
        </h6>';
        echo ' <h6 class="font_14 mt-3 col_pink ">  
									<span class="col_yell">';
        for ($i = 1; $i <= 5; $i++) {
          if ($i <= $rating) {
            echo '<i class="fa fa-star"></i>';
          } else {
            echo '<i class="fa fa-star-o"></i>';
          }
        }

        echo ' <p class="mt-3 mb-0">' . $comment . '</p>
        </div>
        </div>
        </div>
        </div>';
      }
    } else {
      echo 'No reviews found.';
    }
    echo '
    <div class="container">
    <h3>Add Review</h3>
    <form method="POST" action="addreview.php">
    <input type="hidden" name="artId" value="' . $artId . '">
        <div>
            <label for="fullName">Full Name:</label>
            <input type="text" id="name" name="fullName" required>
        </div>
        <div>
            <label for="comment">Comment:</label>
            <textarea id="comment" name="comment" required></textarea>
        </div>
        <div>
            <label for="rating">Rating:</label>
            <div id="star-rating">
                <input type="radio" id="star5" name="rating" value="1" required>
                <label for="star5">1 stars</label>
                <input type="radio" id="star4" name="rating" value="2" required>
                <label for="star4">2 stars</label>
                <input type="radio" id="star3" name="rating" value="3" required>
                <label for="star3">3 stars</label>
                <input type="radio" id="star2" name="rating" value="4" required>
                <label for="star2">4 stars</label>
                <input type="radio" id="star1" name="rating" value="5" required>
                <label for="star1">5 star</label>
            </div>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <input type="submit" value="Submit">
        </div>
    </form>
</div>

  ';
  } else {
    echo 'Artwork not found.';
  }

  // Close the statement
} else {
  echo 'No artwork selected.';
}

$conn->close();
?>

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