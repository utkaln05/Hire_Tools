<?php
    require_once __DIR__ . '/auth.php';
    $con = new mysqli("localhost", "root", "", "finalproject") or die("connection failed");
    $select_query="Select * from rent";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="rent_tool.css">
    <script defer src="add_post.js"></script>
    <title>Rent Machine</title>
</head>
<body>

    <section class="header">
        <div class="nav-bar">
            <div class="left-side">
                <div class="logo">
                    <img src="Images/logo3.png" alt="Hire Tools" title="Hire Tools">
                </div>
            </div>
    
            <div class="right-side">
    
                <ul id="nav-links">
                    <li ><a href="index.php"><i class="fa fa-fw fa-home"></i>Home</a></li>
                    <li><a href="addrent.php"><i class="fa fa-bus" aria-hidden="true"></i>Add Rent Tool</a></li>
                    <li><a href="contactUs.php"><i class="fa fa-fw fa-envelope"></i>Contact Us</a></li>
                </ul>
    
                
          
            </div>
         
           
            <a href="logout.php"><button id="login"><i class="fa fa-fw fa-user"></i>Logout</button></a>
    
            
            <button class="right-bar">
                <span class="bar"></span>
            </button>
    
    
            <div class="mobile_nav">
            
                <ul id="mobile_nav_links">
                    <li ><a href="index.php"><i class="fa fa-fw fa-home"></i>Home</a></li>
                    <li><a href="addrent.php"><i class="fa fa-bus" aria-hidden="true"></i>Add Rent Tool</a></li>
                    <li><a href="contactUs.php"><i class="fa fa-fw fa-envelope"></i>Contact Us</a></li>
                </ul>
                <a href="logout.php"><button id="mobile_login"><i class="fa fa-fw fa-user"></i>Logout</button></a>
                <div class="mobile_footer">
                   <p>Copyright&copy; 2022 AgZone. All Rights Reserved</p>
                </div>
            </div>
    
           
           
        </div>
    
    </section>


    <div class="hero-image">
        
        <div class="rent-a-machine-text">
            <h1>Want to Rent a Tools?</h1>
        </div>
    </div>



    <a href="addrent.html">
    <section class="Add-Post"> 
        <button class="post_btn">
            Add Post
        </button>
        
    </section>
</a>





    <!--Products-->
    <section class="rent-box">
        <!--Garden Tractor-->
        <?php
            $result_query=mysqli_query($con,$select_query);
            
            // $row=mysqli_fetch_assoc($result_query);
            while( $row=mysqli_fetch_assoc($result_query)){
                $title = htmlspecialchars($row['toolName'] ?? '', ENT_QUOTES, 'UTF-8');
                $dec   = htmlspecialchars($row['MobileNo'] ?? '', ENT_QUOTES, 'UTF-8');
                $image = htmlspecialchars($row['Image'] ?? '', ENT_QUOTES, 'UTF-8');
                $price = htmlspecialchars($row['toolPrice'] ?? '', ENT_QUOTES, 'UTF-8');
            echo "<div class='boxes'>
            <div class='hero_img'>
                <img src='$image' alt='Tool image'>
            </div>
            <div class='machine-name'>
                <p>$title</p>
            </div>
            <div class='price'>
                <p>RS:$price</p>
            <br>
                <div class='Discription'>
                    <a><b>Contact: $dec</b></a>
                </div>
        </div>
        <div class='rent'>
            <button type='button'>Contact</button>
        </div>
    </div>";
}
        ?>
        <!-- <div class='boxes'>
            <div class='hero_img'>
                <img src=$image>
            </div>
            <div class="machine-name">
                <p>$title</p>
            </div>
            <div class="price">
                <p>$price</p>
            <br>
                <div class="Discription">

                    <a>$Description</a>
                </div> -->
                
                
               
                


       
          



    </section>




    <section class="footer">
        <div class="left-side-footer">
            <p>&copy;2025 All Rights Reserved </p>
        </div>
        <div class="right-side-footer">
            <p>Web Design and Development by<a href="index.html">Elite Team</a></p>
        </div>
    </section>


</body>
</html>

