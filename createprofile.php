<!DOCTYPE html>
<html>

<head>
  <title>Create Profile</title>
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
  <?php include('includes/header.php'); ?>

  <section id="center" class="center_o bg_gray pt-2 pb-2">
    <div class="container-xl">
      <div class="row center_o1">
        <div class="col-md-5">
          <div class="center_o1l">
            <h2 class="mb-0">Profile</h2>
          </div>
        </div>
        <div class="col-md-7">
          <div class="center_o1r text-end">
            <h6 class="mb-0"><a href="#">Home</a> <span class="me-2 ms-2"><i class="fa fa-caret-right"></i></span>Create
              Profile</h6>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="upload-form" style="background-color: #fdf4f5;">
    <form action="storeprofile.php" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="businessName">Profile Name:</label>
        <input type="text" name="businessName" id="businessName" required>
      </div>

      <div class="form-group">
        <label for="profileBio">Profile Bio:</label>
        <textarea name="profileBio" id="profileBio" rows="4"></textarea>
      </div>

      <div class="form-group">
        <label for="profileEmail">Profile Email:</label>
        <input type="text" name="profileEmail" id="profileEmail">
      </div>

      <div class="form-group">
        <label for="socialLink1">Facebook Link:</label>
        <input type="text" name="socialLink1" id="socialLink1">
      </div>

      <div class="form-group">
        <label for="socialLink2">Instagram Link:</label>
        <input type="text" name="socialLink2" id="socialLink2">
      </div>

      <div class="form-group">
        <label for="socialLink3">Linkedin Link:</label>
        <input type="text" name="socialLink3" id="socialLink3">
      </div>

      <div class="form-group">
        <label for="contact">Contact:</label>
        <input type="text" name="contact" id="contact">
      </div>

      <div class="form-group">
        <label for="location">Location:</label>
        <input type="text" name="location" id="location">
      </div>

      <div class="form-group">
        <label for="address">Address:</label>
        <textarea name="address" id="address" rows="4"></textarea>
      </div>

      <div class="form-group">
        <label for="profilePic">Profile Picture:</label>
        <input type="file" name="profilePic" id="profilePic" accept="image/*">
      </div>

      <button type="submit">Create</button>
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

</body>

</html>

<script src="script.js"></script>
</body>

</html>