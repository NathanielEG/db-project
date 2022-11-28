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

        <style>
          tr {
            border-bottom: 1px solid #ffffff;
          }
          .hover{
            color:red;
            cursor:pointer;
          }
        </style>

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
          
          
        <!--Table used to create list of clothing Items-->
        <div class="table-responsive">
            <table class="table list text-light" id="wishlist_table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Article Image</th>
                        <th scope="col">Article Name</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Price</th>
                        <th scope="col">Priority</th>
                        <th scope="col">Remove</th>
                    </tr>
                </thead>
            </table>
        </div>

        <!--Error message if ajax doesn't load json of wishlist data-->
        <div id="ajax_error_msg"></div>

        <!--Footer Element-->
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

        <script>
          var my_wishlist_json = null;
          
          function getItems() {
            var ajax = new XMLHttpRequest();
            ajax.open("GET", "?command=get_wishlist", true);
            ajax.responseType = "json";
            ajax.send(null);

            ajax.addEventListener("load", function () {
              if(this.status == 200){ // we properly recieved our wishlist data from our database in the form of json
                my_wishlist_json = this.response;
                console.log(my_wishlist_json);
                displayItems(); // create this function
                setClickDelete(); // keep adding button event function setters here
                setPriorityEvent();
              }
            });

            ajax.addEventListener("error", function() {
              document.getElementById("ajax_error_msg").innerHTML =
              "<div class='alert alert-danger'>An error loading wishlist json data via ajax occured. In getItems()</div>";
            });

          }

          function displayItems() {
            var table = document.getElementById("wishlist_table")
            
            var cnt = 1;
            // start for-each loop here on the 'my_wishlist_json' object -- allows us to not need to index our json object
            my_wishlist_json.forEach(function(item, index){
              var newRow = table.insertRow(table.rows.length); // may need to add class name here
              newRow.id = `${index}`; // added id to row

              var newCell = newRow.insertCell(0); // first cell indicated by 0
              newCell.innerHTML = "<td>" + cnt + "</td>";
  
              newCell = newRow.insertCell(1); // second cell
              newCell.innerHTML = `<td> <img src='${item['imageID']}' alt='${item['name']}' class='list_images pop'></td>`;
  
              newCell = newRow.insertCell(2); // third cell
              newCell.innerHTML = `<td class='align-middle'>${item['name']}</td>`;

              newCell = newRow.insertCell(3); // fourth cell
              newCell.innerHTML = `<td>${item['gender']}</td>`;

              newCell = newRow.insertCell(4); // fifth cell
              newCell.innerHTML = `<td>$${item['price'].toFixed(2)}</td>`;

              newCell = newRow.insertCell(5); // sixth cell
              var sel = `<select name='option_rating' aria-label='priority' id='${index}sel' class='form-select' style='width:70%'>`;
              var options = "";
              for(let i = 1; i < 6; i++){
                if(i === item['priority']){
                  options += `<option value='${i}' selected>${i}</option>`;
                } else {
                  options += `<option value='${i}'>${i}</option>`;
                }
              }
              var sel_closing = "</select>";
              var button = `<button type='submit' class='btn btn-success btn-xs' value='${item['productID']}' style='margin-top: 10px'>Set</button>`;
              newCell.innerHTML = `<td>${sel}${options}${sel_closing}<br>${button}</td>`;

              newCell = newRow.insertCell(6); // seventh cell
              newCell.innerHTML = `<td><button type='submit' class='btn btn-primary btn-xs' name='remove_item' value='${item['productID']}'>Delete Entry</button></td>`;

              cnt += 1;
            });
          }

          function setClickDelete(){
            // $(".btn-primary").hover(
            //     function() {
            //       $(this).text("Replaced");
            //     }, function() {
            //       $(this).text("Delete Entry");
            //     }
            //   );
            // ABOVE HOVER IS FOR DEBUGGING PURPOSES TO SEE IF SELECTOR WORKS

            $(".btn-primary").each(function(index, element){
              $(this).click(function(){
                
                $(`tr#${index}`).remove();

                let btnValue = this.value; // try using 'element' if 'this' doesn't work -- value should store product id (unique)
                $.post("?command=remove_item", {
                  btnValue: btnValue
                }); 
              });
            });
          }

          function setPriorityEvent(){
            $(".btn-success").each(function(index, element){
              $(this).click(function(){

                $(this).after(` <p id='${index}set' style='color:Lime'><br>Rating Set!</p>`);
                $(this).prop('disabled', true);

                setTimeout(function() {
                  document.getElementById(`${index}set`).remove();
                  $(element).prop('disabled', false);
                },2000);

                let selValue = $(`#${index}sel`).val();
                let option_id = this.value;
                $.post("?command=update_priority", {
                  selValue: selValue,
                  option_id: option_id
                });
              });
            });
          }

          getItems();
        </script>
   
      </body>
            
</html>
            