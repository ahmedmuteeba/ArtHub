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
	<?php include('includes/header.php'); ?>
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
				include('db.php');
				
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
						$artRating = $row['artRating'];
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
							}
						}


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

			<?php include('includes/footer.php'); ?>
			
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