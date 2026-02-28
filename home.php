<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: loginpage.html");
    exit();
}
?> 
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>



  <style>
    .wid {
      height: 80px;
      width: 90px;

    }

    .fontsize {
      font-size: 12px;
    }

  .bg-col{
    background-color: #ebf4f4;
  }

  .bg-row{
    background-color: #ebf4f4;
  }
  </style>
</head>

<body>
  <div class="container-fluid">
    <!-- Navbar -->
    <div class="navbar navbar-expand-md bg-col">
      <div class="container-fluid">

        <span class="fw-bold fs-3 ps-5">Food Dash</span>
        <button
  class="btn btn-sm btn-outline-primary d-flex align-items-center gap-2 d-block d-md-none"
  onclick="openCart()"
  type="button"
>
 
  <span class="position-relative">
    <i class="bi bi-cart"></i>

    <span
      
      class=" cart-count position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
    >
      0
    </span>
  </span>

 
</button>

        <form class="d-flex" role="search" onsubmit="return filterProducts()">
          <input type="search" class="form-control me-3" id="searchInput" placeholder="Search products" />
          <button class="btn btn-outline-success" type="submit">
            Search
          </button>
        </form>


        <!-- CART ICON -->
       <button
  class="btn btn-outline-primary d-flex align-items-center gap-2 d-none d-md-block"
  onclick="openCart()"
  type="button"
>
 
  <span class="position-relative">
    <i class="bi bi-cart3 fs-4"></i>

    <span
      
      class="cart-count position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
    >
      0
    </span>
  </span>

  <span >My Cart</span>
</button>



      </div>
    </div>
    <!-- Hot Deals -->
     <div class="bg-row">
    <div class="row mt-3 ms-md-5 ps-md-5 ">
      <h5 class="mb-3 ps-5 pt-2">Hot Deals</h5>
      <div class="col-3 col-sm-3 col-md-auto mb-sm-0">
        <a href="GroceryAndKitchen.html" class="text-decoration-none text-dark ">
          <div class="card-auto">
            <img src="fruits.png" class="card-img-top wid" alt="...">
            <div class="card-body">
              <h5 class="card-title fontsize mt-2 ps-1">Grocery and <br> Kitchen</h5>
            </div>
          </div>
        </a>
      </div>
      <div class="col-3 col-sm-3 col-md-auto mb-sm-0 ">
        <a href="SnacksAndDrinks.html" class="text-decoration-none text-dark">
          <div class="card-auto">
            <img src="chips.png" class="card-img-top wid" alt="...">
            <div class="card-body">
              <h5 class="card-title mt-2 ps-1 fontsize">Snacks</h5>
            </div>
          </div>
        </a>
      </div>
      <div class="col-3 col-sm-3 col-md-auto mb-sm-0">
        <a href="Beverages.html" class="text-decoration-none text-dark">
          <div class="card-auto">
            <img src="drinks.png" class="card-img-top wid" alt="...">
            <div class="card-body">
              <h5 class="card-title mt-2 ps-1 fontsize">Beverages</h5>
            </div>
          </div>
        </a>
      </div>
    </div>

    <!-- Grocery and Kitchen -->
    <div class="row mt-3 ms-md-5 ps-md-5">
      <h5 class="mb-3 mt-2 ps-5">Grocery & Kitchen</h5>
      <div class="col-3 col-sm-3 col-md-auto mb-3 mb-sm-0">
        <a href="FreshVegetables.html" class="text-decoration-none text-dark">
          <div class="card-auto">
            <img src="veg.png" class="card-img-top wid" alt="...">
            <div class="card-body ">
              <h5 class="card-title mt-2 ps-1 fontsize">Fresh <br>
                Vegetables</h5>
            </div>
          </div>
        </a>
      </div>
      <div class="col-3 col-sm-3 col-md-auto mb-3 mb-sm-0">
        <a href="FreshFruits.html" class="text-decoration-none text-dark">
          <div class="card-auto">
            <img src="fruits.png" class="card-img-top wid" alt="...">
            <div class="card-body">
              <h5 class="card-title fontsize ps-1 mt-2">Fresh Fruits</h5>
            </div>
          </div>
        </a>
      </div>
      <div class="col-3 col-sm-3 col-md-auto mb-3 mb-sm-0">
        <a href="DairyBreadAndEggs.html" class="text-decoration-none text-dark">
          <div class="card-auto">
            <img
              src="https://instamart-media-assets.swiggy.com/swiggy/image/upload/fl_lossy,f_auto,q_auto,w_200/NI_CATALOG/IMAGES/CIW/2025/12/24/ceb53190-72a3-466b-a892-8989615788c9_fe00456c-3b5a-4e74-80e2-c274a4c9f818.png"
              class="card-img-top wid" alt="...">
            <div class="card-body">
              <h5 class="card-title mt-2 ps-1 fontsize">Dairy, Bread <br> and eggs</h5>
            </div>
          </div>
        </a>
      </div>
    </div>

    <!-- Snacks and Drinks-->
    <div class="row mt-3 ms-md-5 ps-md-5">
      <h5 class="mb-3 mt-2 ps-5">Snacks and Drinks</h5>
      <div class="col-4 col-sm-4 col-md-auto mb-3 mb-sm-0">
        <a href="ChipsAndNamkeens.html" class="text-decoration-none text-dark">
          <div class="card-auto">
            <img src="chips.png" class="card-img-top wid" alt="...">
            <div class="card-body ">
              <h5 class="card-title mt-2 ps-1 fontsize ">Chips and <br> namkeens</h5>
            </div>
          </div>
        </a>
      </div>
      <div class="col-3 col-sm-3 col-md-auto mb-3 mb-sm-0">
        <a href="NoodlesPastaAndVermicelli.html" class="text-decoration-none text-dark">
          <div class="card-auto">
            <img
              src="https://instamart-media-assets.swiggy.com/swiggy/image/upload/fl_lossy,f_auto,q_auto,w_200/NI_CATALOG/IMAGES/CIW/2025/10/8/6a51d704-b2cc-4787-aced-162fae80a0ce_042fb322-f6db-412d-ba43-f83d090aa463"
              class="card-img-top wid" alt="...">
            <div class="card-body">
              <h5 class="card-title fontsize ps-1 mt-2">Noodles, Pasta and <br> Vermicelli</h5>
            </div>
          </div>
        </a>
      </div>
      <div class="col-3 col-sm-3 col-md-auto mb-3 mb-sm-0">
        <a href="Chocolates.html" class="text-decoration-none text-dark">
          <div class="card-auto">
            <img
              src="https://instamart-media-assets.swiggy.com/swiggy/image/upload/fl_lossy,f_auto,q_auto,w_200/NI_CATALOG/IMAGES/CIW/2025/10/8/405730cd-115c-4530-8f32-74e50c09f378_1dab5493-a168-4485-a66f-da4bc7510de3"
              class="card-img-top wid" alt="...">
            <div class="card-body">
              <h5 class="card-title mt-2 ps-1 fontsize">Chocolates</h5>
            </div>
          </div>
        </a>
      </div>
      <div class="col-3 col-sm-3 col-md-auto mb-3 mb-sm-0">
        <a href="Icecreams.html" class="text-decoration-none text-dark">
          <div class="card-auto">
            <img
              src="https://instamart-media-assets.swiggy.com/swiggy/image/upload/fl_lossy,f_auto,q_auto,w_200/NI_CATALOG/IMAGES/CIW/2025/10/8/5b0984b8-303b-4a80-81b7-9656f1950b67_63aaae7c-1add-4357-8ae1-5a9662d6b240"
              class="card-img-top wid" alt="...">
            <div class="card-body">
              <h5 class="card-title mt-2 ps-1 fontsize">Ice creams</h5>
            </div>
          </div>
        </a>
      </div>
      <div class="col-3 col-sm-3 col-md-auto mb-3 mb-sm-0">
        <a href="BiscuitsAndCakes.html" class="text-decoration-none text-dark">
          <div class="card-auto">
            <img
              src="https://instamart-media-assets.swiggy.com/swiggy/image/upload/fl_lossy,f_auto,q_auto,w_200/NI_CATALOG/IMAGES/CIW/2025/10/8/baa03922-9920-4588-b397-a5faad7f4ff5_b2be157f-a054-402a-b5e6-dbb8eff8ae4a"
              class="card-img-top wid" alt="...">
            <div class="card-body">
              <h5 class="card-title mt-2 ps-1 fontsize">Biscuits and <br>Cakes</h5>
            </div>
          </div>
        </a>
      </div>
      <div class="col-3 col-sm-3 col-md-auto mb-3 mb-sm-0">
        <a href="Beverages.html" class="text-decoration-none text-dark">
          <div class="card-auto">
            <img
              src="https://instamart-media-assets.swiggy.com/swiggy/image/upload/fl_lossy,f_auto,q_auto,w_200/NI_CATALOG/IMAGES/CIW/2025/10/8/5bec1f84-4aa5-49ae-9c3d-9a0dcb9fe2ad_d990b4fc-4629-4cc6-bc7a-ace787fb378a"
              class="card-img-top wid" alt="...">
            <div class="card-body">
              <h5 class="card-title mt-2 ps-1 fontsize">Beverages</h5>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>



  <div class="modal fade" id="cartModal" tabindex="-1">
    <div class="modal-dialog modal-md modal-dialog-end">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">My Cart</h5>
          <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body" id="cartItems"></div>

        <div class="px-3">
          <h6>Phone Number</h6>
          <ul class="list-group mb-2" id="phoneList"></ul>
          <input id="phoneInput" class="form-control mb-2" placeholder="Enter phone number">
          <button class="btn btn-primary btn-sm mb-3" onclick="savePhone()">Save Phone</button>

          <h6>Address</h6>
          <ul class="list-group mb-2" id="addressList"></ul>
          <textarea id="addressInput" class="form-control mb-2" placeholder="Enter address"></textarea>
          <button class="btn btn-primary btn-sm" onclick="saveAddress()">Save Address</button>
        </div>

        <div class="modal-footer">
          <h5>Total ₹<span id="cartTotal">0</span></h5>
          <button class="btn btn-success" onclick="placeOrder()">Place Order</button>
        </div>

      </div>
    </div>
  </div>
  <script src="cart.js"></script>
</body>

</html>