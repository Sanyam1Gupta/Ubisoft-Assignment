<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
$connect = mysqli_connect("localhost", "root", "", "tbl_images"); 
$co=0; 
?>
<script>
    function sleep(ms) {
      return new Promise(resolve => setTimeout(resolve, ms));
   }
async function jsfunction(images,titles,descriptions){
   let v=0;
   let temp=0;
   let str="";
   let size;
   let rr=images.length;
    while(temp<images.length)
    {
        let t="data:image/jpg;base64,"+images[temp];
        let f="<div class='product-item'><img src='"+t+"' alt='sd' /><div>Title: '"+titles[temp]+"'</div><div>Short description: '"+descriptions[temp]+"'</div></div>"
    str=str+ f;
//// code
    temp++;
   }
   rr=images.length;
   document.getElementById("demo").innerHTML = document.getElementById("demo").innerHTML+ str;
}
</script>
<HTML>
<HEAD>
<link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="../node_modules/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="../node_modules/bootstrap-social/bootstrap-social.css">

<TITLE>Simple PHP Shopping Cart</TITLE>
<link href="style.css" type="text/css" rel="stylesheet" />
<link href="styles.css" rel="stylesheet">

<script src="https://www.gstatic.com/firebasejs/5.0.4/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.0.4/firebase-firestore.js"></script>
</HEAD>
<BODY>


<div class="row">
<div id="product-grid">
    <div class="txt-heading">Products</div>
        <p id="demo"></p>
    <?php  
                $query = "SELECT * FROM tbl_images ORDER BY id DESC";  
                $result = mysqli_query($connect, $query);  
                $images_array=array();
                $title_array= array();
                $desc_array= array();
                while($row = mysqli_fetch_array($result))  
                {  
                    //$mystuff = strtoupper($row['title']);
                    
                     array_push($images_array, base64_encode($row['name']));
                     array_push($title_array, $row['title']);
                     array_push($desc_array, $row['description']);
                } 
                $images_array= array_reverse($images_array);
                $title_array= array_reverse($title_array);
                $desc_array= array_reverse($desc_array);
    ?>  
               <script>
                let images1 = <?php echo json_encode($images_array) ?>;
                let titles1 = <?php echo json_encode($title_array) ?>;
                let descriptions1 = <?php echo json_encode($desc_array) ?>;
                jsfunction(images1,titles1,descriptions1);

               </script>
     <br />
     <br />
     <br />
</div>

</div>
</div>

<footer class="footer">
    <div class="container">
        <div class="row">             
            <div class="col-7 col-sm-5">
                <h5>Our Address</h5>
                <address>
                    Morena Link Rd,<br>   
                    IIITM Campus,<br>
                    Gwalior, Madhya Pradesh<br>
                    <i class="fa fa-phone fa-lg"></i>: +852 1234 5678<br>
                    <i class="fa fa-fax fa-lg"></i>: +852 8765 4321<br>
                    <i class="fa fa-envelope fa-lg"></i>: 
                    <a href="mailto:confusion@food.net">confusion@food.net</a>
                </address>
            </div>
            <div class="col-12 col-sm-4 align-self-center">
                <div class="text-center">
                    <a class="btn btn-social-icon btn-google" href="http://google.com/+"><i class="fa fa-google-plus"></i></a>
                    <a class="btn btn-social-icon btn-facebook" href="http://www.facebook.com/profile.php?id="><i class="fa fa-facebook"></i></a>
                    <a class="btn btn-social-icon btn-linkedin" href="http://www.linkedin.com/in/"><i class="fa fa-linkedin"></i></a>
                    <a class="btn btn-social-icon btn-twitter" href="http://twitter.com/"><i class="fa fa-twitter"></i></a>
                    <a class="btn btn-social-icon btn-google" href="http://youtube.com/"><i class="fa fa-youtube"></i></a>
                    <a class="btn btn-social-icon" href="mailto:"><i class="fa fa-envelope-o"></i></a>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">             
            <div class="col-auto">
                <p>© Copyright 2018 Ristorante Con Fusion</p>
            </div>
        </div>
    </div>
</footer>

<script src="../node_modules/jquery/dist/jquery.slim.min.js"></script>
<script src="../node_modules/popper.js/dist/umd/popper.min.js"></script>
<script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript"> 
var config = {
                        apiKey: "#copy apiKey from your account",
                        authDomain: "#use your value",
                        databaseURL: "use yours",
                        projectId: "use yours",
                        storageBucket: "use yours",
                        messagingSenderId: "use yours"

                };
        firebase.initializeApp(config);
        const db = firebase.firestore();
        db.settings( { timestampsInSnapshots: true });

        var item1 = <?php echo json_encode($_SESSION["cart_item"]); ?>; 
        //console.log(item1);
        var namearr = new Array();
        var quantityarr = new Array();
        for(var index in item1){
        namearr.push(item1[index]["name"]);
        quantityarr.push(item1[index]["quantity"])
        }   
        var totalquan=<?php echo $total_quantity; ?>;
        var totalprice=<?php echo $total_price; ?>;
        //console.log(totalprice);
        $(document).ready(function() {
            //console.log("abc");
            $('#btndeliver').click(function(e) {
            //alert("Order Placed");
            e.preventDefault();
            $(".error").remove();
            //console.log("xyz");
            var name = $('#deliveryAdd').val();
            var c =0;
            if (name.length < 1) 
            {
                $('#deliveryAdd').after('<span class="error">This field is required</span>');
                c=1;
            }
            if(c==0)
            {
                console.log("eventListener");
                db.collection('orders').add({
                    itemName: namearr,
                    itemQuantity: quantityarr,
                    totalQuantity: totalquan,
                    totalPrice: totalprice,
					deliveryAddress: name
                }).then(function(){
                    console.log("Status saved");
                    alert("Your Order is Placed!!! If You Want You Can Continue Shopping Or To Exit From Cart, Press \"Empty Cart\" Button");
					//<a href="index.php?action=empty"></a>
                }).catch(function(error){
                        console.log("error...error", error);
                                });
            }
            });
        });
</script>  
</BODY>
</HTML>

