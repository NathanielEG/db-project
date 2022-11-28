<!DOCTYPE html>

<html lang="en">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="styles/main.css">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        
        <meta name="author" content="Alex Chan, Nathaniel Gonzalez, & Cory Ooten">
        <meta name="description" content="Website for clothing">
        <meta name="keywords" content="Tops, Bottoms, Accessories">        
        <title>NAC</title>
        <script src="https://cdn.jsdelivr.net/npm/less@4" ></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

        <script>
          function confirmLogout() {
            let text = "Are you sure you want to logout?";
            if (confirm(text) == true) {
              var ajax = new XMLHttpRequest();
              ajax.open("GET", "?command=logout", false);
              ajax.send(null);
            }
          }
        </script>
    </head>

    <body class="bg-dark">
        <!--Navigation Bar-->
        <nav class="navbar navbar-expand-lg navbar-light bg-dark bg-gradient" aria-label="nav">
            <div class="container-fluid">
              <a class="navbar-brand acitve text-light">NAC</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link active text-light" aria-current="page" href="?command=homepage">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active text-light" href="?command=mens">Mens</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active text-light" href="?command=womens">Womens</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active text-light" href="?command=kids">Kids</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link acitve text-light" href="?command=wishlist">Wishlist</a>
                  </li>
                  <!--If not logged in, will show as "Login", else if logged in, will show as "Logout"-->
                  <li class="nav-item">
                    <a href="" class="nav-link active text-light" onclick="confirmLogout()">Logout</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>        

          <!--Search Bar-->
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-light" type="button">Search</button>
          </form>

          <!--Scrollspy Side Navigation Bar-->
          <nav id="navbar-example3" class="navbar navbar-light bg-dark bg-gradient flex-column align-items-stretch p-3 sidebar" aria-label="nav">
            <a class="navbar-brand text-light">Sections</a>
            <hr class="text-light">
            <nav class="nav nav-pills flex-column" aria-label="nav">
              <a class="nav-link highlight" href="#tops">Tops</a>
              <a class="nav-link highlight" href="#bottoms">Bottoms</a>
              <a class="nav-link highlight" href="#accessories">Accessories</a>
            </nav>
          </nav>
          
          <div class="home_sections">

            <div class="jumbotron">
                <h1 class="display-3" style="color: yellow">Kid's Clothing</h1>
                <hr class="my-4 text-light"> 
            </div>  

            <!--Tops Section-->
            <section id="tops">
              <div class="jumbotron">
                <h3 class="display-4 text-light">Tops</h3>
                <hr class="my-4 text-light"> 
              </div>
              <!--Cards for each individual article of clothing-->
              <section class="row">
                <?php 
                    $count = 0;
                    foreach ($tops as $top) {
                        if ($count > 3){
                            break;
                        }
                    ?>
                      <div class="card col-4 bg-dark bg-gradient" style="width: 18rem;">
                        <img src="<?php echo $top["imageID"];?>" class="card-img-top padding-top" alt="<?php echo $top["name"];?>"> 
                        <div class="card-body">
                          <h5 class="card-title text-light"><?php echo $top["name"];?></h5> 
                          
                        </div>
                      </div>
                    <?php
                        $count+=1;
                    }
                ?>
            
              </section>
            </section>
            
            <!--Bottoms Section-->
            <section id="bottoms">
              <div class="jumbotron">
                <h3 class="display-4 text-light">Bottoms</h3>
                <hr class="my-4 text-light"> 
              </div>
              <!--Cards for each individual article of clothing-->
              <section class="row">
              <?php 
                    $count = 0;
                    foreach ($bottoms as $bottom) {
                        if ($count > 3){
                            break;
                        }
                    ?>
                      <div class="card col-4 bg-dark bg-gradient" style="width: 18rem;">
                        <img src="<?php echo $bottom["imageID"];?>" class="card-img-top padding-top" alt="<?php echo $bottom["name"];?>"> 
                        <div class="card-body">
                          <h5 class="card-title text-light"><?php echo $bottom["name"];?></h5> 
                          
                        </div>
                      </div>
                    <?php
                        $count+=1;
                    }
                ?>
                
              </section>
            </section>
            
            <!--Accessories Section-->
            <section id="accessories">
              <div class="jumbotron">
                <h3 class="display-4 text-light">Accessories</h3>
                <hr class="my-4 text-light"> 
              </div>
              <!--Cards for each individual article of clothing-->
              <section class="row">
              <?php 
                    $count = 0;
                    foreach ($accessories as $accessory) {
                        if ($count > 3){
                            break;
                        }
                    ?>
                      <div class="card col-4 bg-dark bg-gradient" style="width: 18rem;">
                        <img src="<?php echo $accessory["imageID"];?>" class="card-img-top padding-top" alt="<?php echo $accessory["name"];?>"> 
                        <div class="card-body">
                          <h5 class="card-title text-light"><?php echo $accessory["name"];?></h5>
                          
                        </div>
                      </div>
                    <?php
                        $count+=1;
                    }
                ?>
                
              </section>
            </section>
          </div>

          <footer class="py-3 my-4">
            <div class = "col-12">
            <ul class="nav justify-content-center border-bottom border-light pb-3 mb-3">
                <li class="nav-item"><a href="?command=homepage" class="nav-link px-2 text-light">Home</a></li>
                <li class="nav-item"><a href="?command=mens" class="nav-link px-2 text-light">Mens</a></li>
                <li class="nav-item"><a href="?command=womens" class="nav-link px-2 text-light">Womens</a></li>
                <li class="nav-item"><a href="?command=kids" class="nav-link px-2 text-light">Kids</a></li>
                <li class="nav-item"><a href="?command=wishlist" class="nav-link px-2 text-light">Wishlist</a></li>
                <li class="nav-item"><a href="" class="nav-link px-2 text-light" onclick="confirmLogout()">Logout</a></li>
            </ul>
            <p class="text-center text-light">Made by Alex Chan, Nathaniel Gonzalez, & Cory Ooten © 2022</p>
            </div>
          </footer>


    </body>
          
</html>