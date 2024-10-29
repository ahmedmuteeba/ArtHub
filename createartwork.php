<!DOCTYPE html>
<html>

<head>
  <title>Upload Artwork</title>
  <title>Art Web</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/global.css" rel="stylesheet">
  <link href="css/index.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz@9..144&display=swap" rel="stylesheet">
  <link href="css/post.css" rel="stylesheet">
  <script src="js/bootstrap.bundle.min.js"></script>

</head>

<body>

  <?php
  session_start();
  if (!$_SESSION['profile'] == true) {
    header("Location: createprofile.php");
    exit;
  } ?>

  <?php include('includes/header.php'); ?>

  <section id="center" class="center_o bg_gray pt-2 pb-2">
    <div class="container-xl">
      <div class="row center_o1">
        <div class="col-md-5">
          <div class="center_o1l">
            <h2 class="mb-0">Upload</h2>
          </div>
        </div>
        <div class="col-md-7">
          <div class="center_o1r text-end">
            <h6 class="mb-0"><a href="#">Home</a> <span class="me-2 ms-2"><i class="fa fa-caret-right"></i></span>Upload
              Post</h6>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="upload-form" style="background-color: #fdf4f5;">
    <form action="storeartwork.php" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="artName">Art Name:</label>
        <input type="text" name="artName" id="artname" required>
      </div>

      <div class="form-group">
        <label for="artDetails">Art Details:</label>
        <textarea name="artDetails" id="artdetails" rows="4" required></textarea>
      </div>

      <div class="form-group">
        <label for="artDimensions">Art Dimensions:</label>
        <input type="text" name="artDimensions" id="artdimensions" required>
      </div>

      <div class="form-group">
        <label for="artPrice">Art Price:</label>
        <input type="text" name="artPrice" id="artprice" required>
      </div>

      <div class="form-group">
        <label for="category">Category:</label>
        <select name="category" id="category" required>
          <option value="6001">oil Painting</option>
          <option value="6004">still life</option>
          <option value="6002">Acrylics</option>
          <option value="6003">Abstract</option>
        </select>
      </div>

      <div class="form-group">
        <label for="artPicture1">Artwork Image: 1</label>
        <input type="file" name="artPicture1" id="artworkimage" accept="image/*" required>
      </div>

      <div class="form-group">
        <label for="artPicture2">Artwork Image: 2</label>
        <input type="file" name="artPicture2" id="artworkimage" accept="image/*">
      </div>

      <div class="form-group">
        <label for="artPicture3">Artwork Image: 3</label>
        <input type="file" name="artPicture3" id="artworkimage" accept="image/*">
      </div>

      <button type="submit">Upload</button>

    </form>
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
  <script>
    document.getElementById("upload-form").addEventListener("submit", function(event) {
      event.preventDefault(); // Prevent form submission

      var form = event.target;
      var formData = new FormData(form);

      var xhr = new XMLHttpRequest();
      xhr.open("POST", "storeartwork.php", true);
      xhr.onload = function() {
        if (xhr.status === 200) {
          var response = xhr.responseText;
          console.log(response); // You can handle the response here

          // Clear form fields if needed
          form.reset();
        }
      };
      xhr.send(formData);
    });
  </script>


</body>

</html>
</body>

</html>