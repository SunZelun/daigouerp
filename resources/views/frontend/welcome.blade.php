<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>肉球球的梳妆台 - 新加坡 正品 代购</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="css/home.css">

        <style>
            body,h1,h2,h3,h4,h5,h6 {font-family: "Karma", sans-serif}
            .w3-bar-block .w3-bar-item {padding:20px}
        </style>
    </head>

    <body>
    
    <!-- Sidebar (hidden by default) -->
    <nav class="w3-sidebar w3-bar-block w3-card w3-top w3-xlarge w3-animate-left" style="display:none;z-index:2;width:40%;min-width:300px" id="mySidebar">
        <a href="javascript:void(0)" onclick="menu_close()"
        class="w3-bar-item w3-button">关闭菜单</a>
        <a href="#product" onclick="menu_close()" class="w3-bar-item w3-button">产品</a>
        <a href="#about" onclick="menu_close()" class="w3-bar-item w3-button">关于代购</a>
    </nav>
    
    <!-- Top menu -->
    <div class="w3-top">
        <div class="w3-white w3-xlarge" style="max-width:1200px;margin:auto">
        <div class="w3-button w3-padding-16 w3-left" onclick="menu_open()">&#9776;</div>
        <div class="w3-right w3-padding-16">
            <a href="#about" style="text-decoration: none;">戳我购买</a>
        </div>
        <div class="w3-center w3-padding-16">肉球球的梳妆台</div>
        </div>
    </div>
        
    <!-- !PAGE CONTENT! -->
    <div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:100px">
    
        <!-- First Photo Grid-->
        <div class="w3-row-padding w3-padding-16 w3-center" id="product">
        <div class="w3-quarter">
            <img src="images/products/10.jpg" alt="Sandwich" style="width:100%">
            <h3>The Perfect Sandwich, A Real NYC Classic</h3>
            <p>Just some random text, lorem ipsum text praesent tincidunt ipsum lipsum.</p>
        </div>
        <div class="w3-quarter">
            <img src="images/products/2.jpg" alt="Steak" style="width:100%">
            <h3>Let Me Tell You About This Steak</h3>
            <p>Once again, some random text to lorem lorem lorem lorem ipsum text praesent tincidunt ipsum lipsum.</p>
        </div>
        <div class="w3-quarter">
            <img src="images/products/3.jpg" alt="Cherries" style="width:100%">
            <h3>Cherries, interrupted</h3>
            <p>Lorem ipsum text praesent tincidunt ipsum lipsum.</p>
            <p>What else?</p>
        </div>
        <div class="w3-quarter">
            <img src="images/products/4.jpg" alt="Pasta and Wine" style="width:100%">
            <h3>Once Again, Robust Wine and Vegetable Pasta</h3>
            <p>Lorem ipsum text praesent tincidunt ipsum lipsum.</p>
        </div>
        </div>
        
        <!-- Second Photo Grid-->
        <div class="w3-row-padding w3-padding-16 w3-center">
        <div class="w3-quarter">
            <img src="images/products/5.jpg" alt="Popsicle" style="width:100%">
            <h3>All I Need Is a Popsicle</h3>
            <p>Lorem ipsum text praesent tincidunt ipsum lipsum.</p>
        </div>
        <div class="w3-quarter">
            <img src="images/products/6.jpg" alt="Salmon" style="width:100%">
            <h3>Salmon For Your Skin</h3>
            <p>Once again, some random text to lorem lorem lorem lorem ipsum text praesent tincidunt ipsum lipsum.</p>
        </div>
        <div class="w3-quarter">
            <img src="images/products/7.jpg" alt="Sandwich" style="width:100%">
            <h3>The Perfect Sandwich, A Real Classic</h3>
            <p>Just some random text, lorem ipsum text praesent tincidunt ipsum lipsum.</p>
        </div>
        <div class="w3-quarter">
            <img src="images/products/8.jpg" alt="Croissant" style="width:100%">
            <h3>Le French</h3>
            <p>Lorem lorem lorem lorem ipsum text praesent tincidunt ipsum lipsum.</p>
        </div>
        </div>
    
        <!-- Pagination -->
        <div class="w3-center w3-padding-32">
        <div class="w3-bar">
            <a href="#" class="w3-bar-item w3-button w3-hover-black">&laquo;</a>
            <a href="#" class="w3-bar-item w3-black w3-button">1</a>
            <a href="#" class="w3-bar-item w3-button w3-hover-black">2</a>
            <a href="#" class="w3-bar-item w3-button w3-hover-black">3</a>
            <a href="#" class="w3-bar-item w3-button w3-hover-black">4</a>
            <a href="#" class="w3-bar-item w3-button w3-hover-black">&raquo;</a>
        </div>
        </div>
        
        <hr id="about">
    
        <!-- About Section -->
        <div class="w3-container w3-padding-32 w3-center">  
        <h3>About Me, The Food Man</h3><br>
        <img src="/w3images/chef.jpg" alt="Me" class="w3-image" style="display:block;margin:auto" width="800" height="533">
        <div class="w3-padding-32">
            <h4><b>I am Who I Am!</b></h4>
            <h6><i>With Passion For Real, Good Food</i></h6>
            <p>Just me, myself and I, exploring the universe of unknownment. I have a heart of love and an interest of lorem ipsum and mauris neque quam blog. I want to share my world with you. Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla. Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
            <br>
    
            <img src="images/qr.jpg" alt="加我微信" style="width:30%; min-width: 300px;">
        </div>
        </div>
        <hr>
    
    <!-- End page content -->
    </div>
    
    <script>
    // Script to open and close sidebar
    function menu_open() {
        document.getElementById("mySidebar").style.display = "block";
    }
        
    function menu_close() {
        document.getElementById("mySidebar").style.display = "none";
    }
    </script>
    
    </body>
</html>
