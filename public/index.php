<?php
include_once 'header.php';
include_once '../src/model/DbContext.php';

if(!isset($db))
{
    $db = new DBContext();
}

?>

<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="../assets/css/index.css">
</head>

<body>
<div class="container-fluid" id="home">
    <div id="demo" class="carousel slide" data-ride="carousel" height="800px" width="1800px">
        <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
        </ul>
        <div class="carousel-inner">
            <div class="carousel-item active fill">
                <img src="../assets/img/tea.jpg" alt="Tea" height="800px" width="1800px">
            </div>
            <div class="carousel-item fill">
                <img src="../assets/img/background.jpg" alt="Room" height="800px" width="1800px">
            </div>
            <div class="carousel-item fill">
                <img src="../assets/img/water.jpg" alt="Atmosphere" height="800px" width="1800">
            </div>
            <div class="carousel-caption">
                <h1 class="display-2">Experience True Serenity</h1>
                <button type="button" class="btn btn-outline-light btn-lg" data-toggle="modal" data-target="#myModal" data-backdrop="false">Order</button>
            </div>
            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-fluid">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>Please Select your User Type</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">

                            <a href="Order.php" class="btn btn-primary">Customer</a>
                            <a href="Order.php" class="btn btn-primary">Administrator</a>


                        </div>
                        <div class="modal-footer">

                        </div>
                    </div>

                </div>
            </div>
            <!--btn-outline-light btn-lg-->

        </div>
    </div>

    <a class="carousel-control-prev " href="#demo" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
        <span class="carousel-control-next-icon"></span>
    </a>
</div>


<div class="jumbotron jumbotron-fluid" id="about">
    <div class="container">
        <h1>
            About
        </h1>
        <hr>
        <h3 id="business-info">
            Union Tea Rooms is a well established chain of tea houses that are renowned for diverse selection and exceptional quality of global teas.
            Our founders James and Philip Franco, were avid travellers, their passion for travel led them to experience the cultural practises and traditions of people all around the world.
            In all of the cultures they encountered, there was one prominent custom, which was valued greatly amongst each community - Drinking Tea. The Franco brothers recognised the signifance of tea, not just as a drink, but also as something that brings people together and kindles happiness.
            Through their new found passion for tea, the brothers began a small shop in Union Street,Plymouth in 1985. Their vision was to share their love of tea with their local community. They focused on selecting the finest quality ingredients, offering exceptional service to customers and ensuring the welfare of staff.
            These values are at our core even to this day and is an instrumental part of our success.
        </h3>
        <img src="../assets/img/brothers.jpg" alt="Our Founders">
    </div>
</div>

<div class="col-md-8 card mx-auto" id="menu" ><!--style="margin: 0 auto;"-->

    <div class="card-body">
        <h1 class="card-title">Menu</h1>
        <hr>

        <?php
        $listString = "";
        $products = $db->Products();
        $className = 1;

        if($products)
        {
            foreach($products as $product)
            {
                $listString.="<div class=item".$className.">"."<p id=price>"."£".$product->getPrice()."</p>"."<h5 class='font-weight-bold'>".$product->getName()."</h5>".
                    "<p id='description'>"."<i>".$product->getDescription()."</i>"."</p>"."</div>";
                $className += 1;
            }
        }
        echo $listString;
        ?>
    </div>
</div>

<hr id="contact">

<div class="container-fluid padding" id="map and social">
    <div class="row text-center padding">
        <div class="col-12">
            <h1>Contact Us</h1>
        </div>
        <div class="container padding" id="mapid">
        </div>

        <script>
            var mymap = L.map('mapid').setView([50.369780, -4.153911], 13);
            L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                id: 'mapbox.streets',
                accessToken: 'pk.eyJ1IjoibWpvc2VwaDIwMDAiLCJhIjoiY2pwYjZ0bm5mMmt1ZzNwbGsyNDlwc2pxYSJ9.eO3rmj1X7-J00bIrsyvpCA'
            }).addTo(mymap);

            var marker = L.marker([50.369780, -4.153911]).addTo(mymap);
        </script>
        <div class="col-12 social padding">
            <a href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a>
            <a href=><i class="far fa-envelope"></i></a>
            <a href="https://twitter.com/home"><i class="fab fa-twitter"></i></a>
            <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
        </div>
    </div>
</div>

<div class="container-fluid bg-light" id="bottom">
    <div class="row text-center">
        <div class="col-md-6">
            <div class="row" id="footer-titles">
                <div class="col-md-1" id="footer-logo">
                    <img src="../assets/img/logo.png" alt="Logo" width="45px" height="40px">
                </div>
                <div class="col-md-6">
                    <h2 id="business-title">Union Tea Rooms</h2>
                </div>
            </div>

            <hr class="light">
            <p>Contact Number: 01752 123456</p>
            <p>Email: CustomerEnquiries@UnionTeaRooms.com</p>
            <p>74 Union Street</p>
            <p>PL4 7AZ</p>
            <p>Plymouth, Devon</p>
        </div>


        <div class="col-md-6" id="open-hours">
            <h4>Opening Times</h4>
            <hr class="light">
            <div id="hour-list">
                <p>Sunday: 9:00 AM - 6:00 PM</p>
                <p>Monday: 11:00 AM - 7:00 PM</p>
                <p>Tuesday: 9:00 AM - 3:00 PM</p>
                <p>Wednesday: 12:00 AM - 8:00 PM</p>
                <p>Thursday: 9:00 AM - 6:00 PM</p>
                <p>Friday: 9:00 AM - 6:00 PM</p>
            </div>
        </div>
    </div>
</div>



</body>


</html>

<?php
    include_once 'footer.php';
?>

