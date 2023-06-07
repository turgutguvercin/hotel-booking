
<?php

function getConnection()
{
    define('DB_NAME', '');
    define('DB_USER', '');
    define('DB_PASSWORD', '');
    define('DB_HOST', 'localhost');
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or

        die("Can not connect to DB");
    return $conn;
}


function makePageStart($title, $cssFile)
{

    $pageStartContent = <<<PAGESTART
    <!doctype html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>$title</title>
    // add fontawesome cdn
    <link href=$cssFile rel="stylesheet" type="text/css">
    </head>
    <body>
PAGESTART;
    $pageStartContent .= "\n";
    return $pageStartContent;
}


function startMain()
{
    return "<main>";
}

function endMain()
{
    return "</main>";
}


function makeNavBar(array $links)
{
    $total = null;
    foreach ($links as $link => $val) {
        $total .=  "<li><a href=$link> $val </a></li>";
    }

    $navMenuContent = <<<NAVMENU
    <nav>
    <ul>
    $total
    </ul>
    </nav>
NAVMENU;
    $navMenuContent .= "\n";
    return $navMenuContent;
}

function makeHotelCard($hotelname, $description, $price, $location, $image)
{
    $hotelCardContent = <<<HOTELCARD
        
    <div class="listed-item">
        <img src="assets/images/$image" alt="">
        <div class="item-text">
        <p><b>$hotelname</b></p>
        <p>$location</p>
        <br>
        <p>$description </p>
        <br>
        <p>From $price £</p>
        </div>
        <form id="details" method="get" action="details.php">
            <input type="hidden" name="hotelname" value="$hotelname">
            <input class='button' type="submit" value="Details">
        </form>
    </div>
    
HOTELCARD;
    $hotelCardContent .= "\n";
    return $hotelCardContent;
}

function makeFooter()
{
    $footer = <<<FOOTER
    <footer>
        <div>
            <p> <i class="fab fa-earlybirds"></i> Pigeon.com </p>
           
        </div>
        <div id="useful-links" >
            <h3>USEFUL LINKS</h3>
            <ul>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Credits</a></li>
                <li><a href="#">Report</a></li>

            </ul>
        </div>
        <div>
            FOLLOW US
            <ul class="social">
                <li>
                    <a href="http://instagram.com" ><i class="footer-icon fab fa-instagram fa-2x"></i></a>
                    <!-- https://fontawesome.com/v4.7/icon/instagram -->
                </li>
                <li>
                    <a  href="http://twitter.com"><i class="footer-icon fab fa-twitter fa-2x"></i></a>
                    <!-- https://fontawesome.com/v5.15/icons/twitter -->
                </li>
                
                <li>
                    <a  href="http://facebook.com"> <i class="footer-icon fab fa-facebook-square fa-2x"></i></a>
                    <!-- https://fontawesome.com/v5.15/icons/facebook-square?style=brands -->
                </li>
            </ul>
        </div>

        <div>

            <img src="assets/images/application-stores-logo.png" alt="">
        </div
    </footer>
FOOTER;

    $footer .= "\n";
    return $footer;
}



function makeHotelDetails($hotelID, $image, $hotelName, $price, $details)
{
    $hotelDetails = <<<HOTELDETAILS
    
    <div class="main-arrange">
    <img src="assets/images/$image" alt="">
           
          
           <div class="table-div">
                <table>
                    <tr>
                        <th>$hotelName</th>
                        <form action="book.php" method="GET">
                        <th><input id="button" type="Submit" value="Book Now" ></th>
                        <input type="text" value='$hotelName' name="hotelname" hidden>
                        <input type="text" value='$hotelID' name="hotelID" hidden>
                        </form>  
                        
                    </tr>
                    <tr>
                        <td>Room Only - NON REFUNDABLE</td>
                        <td class="price">From $price £</td>
                        
                    </tr>
                    <tr>
                        <td>Room & Breakfast - NON REFUNDABLE</td>
                        <td class="price">From $price £</td>
                    </tr>

                </table>
                <p>
                 $details
                </p>

                <div class="room-properties">

                    <div><i class="fas fa-smoking-ban"></i> <div>Non-Smoking</div></div>
                    <!-- https://fontawesome.com/v5.15/icons/smoking-ban -->
                    <div><i class="fas fa-fan"></i><div>A/C</div></div>
                    <!-- https://fontawesome.com/v5.15/icons/fan -->
                    <div><i class="fas fa-tv"></i><div>TV</div></div>
                    <!-- https://fontawesome.com/v5.15/icons/tv -->
                    <div><i class="fas fa-wifi"></i><div>Free Wifi</div></div>
                    <!-- https://fontawesome.com/v5.15/icons/wifi -->
                    <div><i class="fas fa-parking"></i><div>Parking</div></div>
                    <!-- https://fontawesome.com/v5.15/icons/parking -->

                </div>

           </div>

    </div>
HOTELDETAILS;

    $hotelDetails .= "\n";

    return $hotelDetails;
}

function makePageEnd()
{

    return "</body>";
}
