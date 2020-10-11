<?php  
 $connect = mysqli_connect("localhost", "root", "", "tbl_images");  
 if(isset($_POST["Submit"]))  
 {  
      $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));  
      $title=  mysqli_real_escape_string($connect, $_POST['title']);
      $description=  mysqli_real_escape_string($connect, $_POST['desc']);
      $query = "INSERT INTO tbl_images(name, title, description) VALUES ('$file', '$title', '$description')";  
      if(mysqli_query($connect, $query))  
      {  
           echo '<script>alert("Image Inserted into Database")</script>';  
      }  
 }  
 ?>  
 <HTML>  
      <HEAD>    
           <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
           <link rel="stylesheet" href="../node_modules/font-awesome/css/font-awesome.min.css">
            <link rel="stylesheet" href="../node_modules/bootstrap-social/bootstrap-social.css">
           <TITLE>Simple PHP Shopping Cart</TITLE>
            <link href="style.css" type="text/css" rel="stylesheet" />
            <link href="styles.css" rel="stylesheet">
      </HEAD>  
      <BODY>  
        <nav class="navbar navbar-dark navbar-expand-sm fixed-top">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Navbar">
            <span class="navbar-toggler-icon"></span>
        </button>           
        <a class="navbar-brand mr-auto" href="#"><img src="product-images/logo.png" height="30" width="41"></a>
        <div class="collapse navbar-collapse" id="Navbar"> 
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item"><a class="nav-link" href="../index.php"><span class="fa fa-shopping-cart fa-lg"></span> Product Display Window</a></li>
                    <li class="nav-item active"><a class="nav-link" href="#"><span class="fa fa-info fa-lg"></span> Product Registration Page</a></li>
                    <li class="nav-item"><a class="nav-link" href="./index2.html"><span class="fa fa-home fa-lg"></span> Information</a></li>
                </ul>  
        </div>         
    </div>
</nav>
           <br /><br />  
           <div class="container" style="width:500px;">  
                <h3 align="center">Register your Product here with us. Enjoy the experience!!!</h3>  
                <br />  
                <form method="post" enctype="multipart/form-data">  
                     Title  &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="title" id="title" /> 
                     <br />
                     Description <input type="text" name="desc" id="desc" /> 
                     <br />
                     Image <input type="file" name="image" id="image" /> 
                     <br />  
                     <input type="submit" name="Submit" id="Submit" value="Submit" class="btn btn-info" />  
                     <input type="reset" value="Reset" name="Reset" id="reset" class="btn btn-info">
                </form>  
                <br />  
                <br />  
                
            
           </div>  
      </BODY>  
 </HTML>  
 <script>  
 $(document).ready(function(){  
      $('#Submit').click(function(){  
           var image_name = $('#image').val();  
           if(image_name == '')  
           {  
                alert("Please Select Image");  
                return false;  
           }  
           else  
           {  
                var extension = $('#image').val().split('.').pop().toLowerCase();  
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
                {  
                     alert('Invalid Image File');  
                     $('#image').val('');  
                     return false;  
                }  
           }  
      });  
 });  
 </script>  