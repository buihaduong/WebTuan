<?php
	$servername = "localhost";
	$username = "user_tuan";
	$password = "tuan123456";
	$dbname = "tuan";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT * FROM user";
	$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Once a saint</title>

    <link rel="stylesheet" href="dist/stylesheets/superslides.css">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
      $(document).ready(function () {
        $("button#submit").click(function(){
            $.ajax({
                type: "POST",
                url: "src/insert.php", 
                data: $('form.new_data').serialize(),
                success: function(msg){
                    $("#myModal").modal('hide'); //hide popup  
                    alert(msg);
                },
                error: function(){
                    alert("failure");
                }
            });
        });
    });
    </script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.animate-enhanced.min.js"></script>
    <script src="dist/jquery.superslides.js" type="text/javascript" charset="utf-8"></script>
    <script>
      $(function() {
        $('#slides').superslides({
          hashchange: true
        });
      });
    </script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
  </head>
  <body>
    <div id="footer_over">
      <button id="btn_add" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
        +
      </button>
    </div>
    <div id="slides">
      <div class="slides-container">
        
        <img src="images/surly.jpeg" width="1024" height="682" alt="Surly">
        <img src="images/cinelli-front.jpeg" width="1024" height="683" alt="Cinelli">
        <img src="images/affinity.jpeg" width="1024" height="685" alt="Affinity">
        <?php
        	if ($result->num_rows > 0) {
		    // output data of each row

			    while($row = $result->fetch_assoc()) {
			        // print_r($row);
			        echo "<img src=\"" . $row["img_link"] ."\">";
			    }
			}
        ?>
      </div>

      <nav class="slides-navigation">
        <a href="#" class="next">
          <i class="icon-chevron-right glyphicon glyphicon-menu-right"></i>
        </a>
        <a href="#" class="prev">
          <i class="icon-chevron-left glyphicon glyphicon-menu-left"></i>
        </a>
      </nav>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Send In Your Data</h4>
          </div>
          <div class="modal-body">
            <form class="new_data" name="new_data">
              <div class="form-group">
                <label for="name" class="control-label">Name:</label>
                <input type="text" class="form-control" id="name" name="name">
              </div>
              <div class="form-group">
                <label for="class_data" class="control-label">Class:</label>
                <input type="text" class="form-control" id="class_data" name="class_data">
              </div>
              <div class="form-group">
                <label for="email" class="control-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email">
              </div>
              <div class="form-group">
                <label for="img_link" class="control-label">Photo:</label>
                <input type="url" class="form-control" id="img_link" name="img_link">
              </div>
              <div class="g-recaptcha" data-sitekey="6LctigQTAAAAABiKU3Gas-5IgxIIEwU0qxJ25j1r"></div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="submit">Submit</button>
          </div>
        </div>
      </div>
    </div>

<!--     <div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <strong>Success!</strong> Your message has been sent successfully.
    </div> -->
    <style type="text/css">
      #footer_over{
        width: 100%;
        height: 25%;
        position:fixed;
        bottom:0;
        z-index: 100;
      }
      #btn_add{
        position: relative;
        left: 90%;
        margin-top: 5%;
      }
      .icon-chevron-left{
        font-size: xx-large;
        color: white;
      }
      .icon-chevron-right{
        font-size: xx-large;
        color: white;
      }
    </style>
    <script type="text/javascript">
      $(document).ready(function () {
        $('#footer_over').mouseover(function (){
          // alert("mouseover");
          $('#btn_add').removeClass("disabled").removeClass("hidden");
        })
      });
      $(document).ready(function () {
        $('#footer_over').mouseout(function (){
          // alert("mouseout");
          $('#btn_add').addClass("disabled").addClass("hidden");
        })
      });
    </script>  
  </body>
</html>

<?php
	$conn->close();
?>