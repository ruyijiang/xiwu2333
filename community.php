<?php
require("library/xwBE-0.0.1/connectDB.php");
require("library/xwBE-0.0.1/all.php");
include("library/xwFE-0.0.1/FEM.php");
?>
<style>body{padding-bottom:40px;color:#5a5a5a}.navbar-wrapper{position:absolute;top:0;right:0;left:0;z-index:20}.navbar-wrapper>.container{padding-right:0;padding-left:0}.navbar-wrapper .navbar{padding-right:15px;padding-left:15px}.navbar-wrapper .navbar .container{width:auto}.carousel{height:500px;margin-bottom:60px}.carousel-caption{z-index:10}.carousel .item{height:500px;background-color:#777}.carousel-inner>.item>img{position:absolute;top:0;left:0;min-width:100%;height:500px}.marketing .col-lg-4{margin-bottom:20px;text-align:center}.marketing h2{font-weight:400}.marketing .col-lg-4 p{margin-right:10px;margin-left:10px}.featurette-divider{margin:80px 0}.featurette-heading{font-weight:300;line-height:1;letter-spacing:-1px}@media (min-width:768px){.navbar-wrapper{margin-top:20px}.navbar-wrapper .container{padding-right:15px;padding-left:15px}.navbar-wrapper .navbar{padding-right:0;padding-left:0}.navbar-wrapper .navbar{border-radius:4px}.carousel-caption p{margin-bottom:20px;font-size:21px;line-height:1.4}.featurette-heading{font-size:50px}}@media (min-width:992px){.featurette-heading{margin-top:120px}}</style>
<div ng-controller="communityController">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class=""></li>
            <li data-target="#myCarousel" data-slide-to="1" class=""></li>
            <li data-target="#myCarousel" data-slide-to="2" class="active"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="item">
                <img class="first-slide" src="/img/main_bg/0e8fb0cd23e0d07f129f87067f4a3b4f8f92f23317219b-coNiZ0_fw658.gif" alt="First slide">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Example headline.</h1>
                        <p>Note: If you're viewing this page via a <code>file://</code> URL, the "next" and "previous" Glyphicon buttons on the left and right might not load/display properly due to web browser security rules.</p>
                        <p><a class="btn btn-lg btn-primary" role="button">Sign up today</a></p>
                    </div>
                </div>
            </div>
            <div class="item">
                <img class="second-slide" src="/img/main_bg/7a425521gw1eiiixmi2jij21hc0qagyf.jpg" alt="Second slide">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Another example headline.</h1>
                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        <p><a class="btn btn-lg btn-primary" role="button">Learn more</a></p>
                    </div>
                </div>
            </div>
            <div class="item active">
                <img class="third-slide" src="/img/main_bg/20130428100656532.jpg" alt="Third slide">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>One more for good measure.</h1>
                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        <p><a class="btn btn-lg btn-primary" role="button">Browse gallery</a></p>
                    </div>
                </div>
            </div>
        </div>
        <a class="left carousel-control" role="button" data-slide="prev" ng-href="/#/square#myCarousel">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">上一个</span>
        </a>
        <a class="right carousel-control" role="button" data-slide="next" ng-href="/#/square#myCarousel">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">下一个</span>
        </a>
    </div>
    <!--End of 轮播-->

    <div role="main" class="container" role="main" ng-controller="communityController">














        <hr>
        <?php echo $footer;?>
    </div>
</div>