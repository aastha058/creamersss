<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Food Ordering UI</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary: #ff6b6b;
      --secondary: #4ecdc4;
      --dark: #2b2d42;
      --light-gray: #e9ecef;
    }
    * {margin:0;padding:0;box-sizing:border-box;}
    body {font-family: 'Segoe UI', sans-serif;background:#f8f9fa;color:var(--dark);}
    .container {max-width:1200px;margin:auto;padding:0 15px;}

    /* Header */
    header {background:white;box-shadow:0 2px 10px rgba(0,0,0,0.1);position:sticky;top:0;z-index:100;}
    .header-content {display:flex;justify-content:space-between;align-items:center;padding:15px 0;}
    .logo h1 {color:var(--primary);}
    .nav-links {display:flex;gap:20px;}
    .nav-links a {text-decoration:none;color:var(--dark);font-weight:500;}
    .nav-links a:hover {color:var(--primary);}
    .cart-icon {position:relative;font-size:22px;cursor:pointer;}
    .cart-count {position:absolute;top:-8px;right:-8px;background:var(--primary);color:white;font-size:12px;width:18px;height:18px;border-radius:50%;display:flex;justify-content:center;align-items:center;}

    /* Search & Filters */
    .search-box {display:flex;justify-content:center;margin:20px 0;}
    .search-box input {width:60%;padding:12px;border:2px solid var(--light-gray);border-radius:30px;font-size:16px;outline:none;}
    .filters {display:flex;justify-content:center;gap:10px;flex-wrap:wrap;}
    .filter-btn {padding:8px 16px;border:1px solid var(--light-gray);border-radius:30px;cursor:pointer;background:white;}
    .filter-btn.active, .filter-btn:hover {background:var(--primary);color:white;}

    /* Food Grid */
    .container-grid {display:grid;grid-template-columns:repeat(auto-fill,minmax(250px,1fr));gap:25px;margin:30px 0;}
    .card {background:#fff;border-radius:12px;box-shadow:0 5px 15px rgba(0,0,0,0.08);overflow:hidden;transition:.3s;}
    .card:hover {transform:translateY(-5px);}
    .card-img {width:100%;height:180px;object-fit:cover;}
    .card-body {padding:15px;}
    .card-title {font-size:18px;margin-bottom:8px;}
    .card-footer {display:flex;justify-content:space-between;align-items:center;}
    .price {font-weight:bold;color:var(--primary);}
    .qty-controls {display:flex;align-items:center;gap:8px;}
    .qty-btn {width:30px;height:30px;border-radius:50%;border:none;background:var(--light-gray);cursor:pointer;}
    .qty-btn:hover {background:var(--primary);color:white;}
    .qty-input {width:35px;text-align:center;border:1px solid var(--light-gray);border-radius:5px;}

    /* Cart Modal */
    .cart-modal {position:fixed;top:0;right:-400px;width:350px;height:100vh;background:white;box-shadow:-5px 0 15px rgba(0,0,0,0.1);transition:.3s;z-index:1000;overflow-y:auto;}
    .cart-modal.open {right:0;}
    .cart-header {padding:20px;border-bottom:1px solid var(--light-gray);display:flex;justify-content:space-between;}
    .cart-items {padding:20px;}
    .cart-item {display:flex;justify-content:space-between;align-items:center;margin-bottom:15px;}
    .cart-total {padding:20px;border-top:1px solid var(--light-gray);display:flex;justify-content:space-between;font-weight:bold;}
    .checkout-btn {display:block;width:90%;margin:15px auto;padding:12px;background:var(--primary);color:white;border:none;border-radius:5px;font-size:16px;cursor:pointer;}
    .overlay {position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);display:none;z-index:999;}
    .overlay.active {display:block;}

    @media(max-width:768px){.search-box input{width:80%}.cart-modal{width:300px}}
  </style>
</head>
<body>

  <!-- Header -->
  <header>
    <div class="container">
      <div class="header-content">
        <div class="logo"><h1>FoodExpress</h1></div>
        <nav class="nav-links">
          <a href="#">Home</a><a href="#">Menu</a><a href="#">About</a><a href="#">Contact</a>
        </nav></div>
    </div>
  </header>

  <!-- Search -->
  <section class="search-section container">
    <div class="search-box"><input type="text" placeholder="Search food..." id="searchInput"></div>
    <div class="filters"><button class="filter-btn active">All</button><button class="filter-btn">Fast Food</button><button class="filter-btn">Indian</button><button class="filter-btn">Desserts</button></div>
  </section>

  <!-- Food Grid -->
  <div class="container">
    <div class="container-grid" id="foodGrid">
      <div class="card" data-name="Burger" data-price="150">
        <img src="https://source.unsplash.com/400x300/?burger" class="card-img">
        <div class="card-body">
          <h3 class="card-title">Burger</h3>
          <p>Juicy patty with veggies & sauce.</p>
          <div class="card-footer"><span class="price">₹150</span>
            <button class="qty-btn add-to-cart">Add</button>
          </div>
        </div>
      </div>
      <div class="card" data-name="Pizza" data-price="299">
        <img src="https://source.unsplash.com/400x300/?pizza" class="card-img">
        <div class="card-body">
          <h3 class="card-title">Pizza</h3>
          <p>Cheesy delight with fresh toppings.</p>
          <div class="card-footer"><span class="price">₹299</span>
            <button class="qty-btn add-to-cart">Add</button>
          </div>
        </div>
      </div>
      <div class="card" data-name="Burger" data-price="150">
        <img src="https://source.unsplash.com/400x300/?burger" class="card-img">
        <div class="card-body">
          <h3 class="card-title">Burger</h3>
          <p>Juicy patty with veggies & sauce.</p>
          <div class="card-footer"><span class="price">₹150</span>
            <button class="qty-btn add-to-cart">Add</button>
          </div>
        </div>
      </div>
      <div class="card" data-name="Pizza" data-price="299">
        <img src="https://source.unsplash.com/400x300/?pizza" class="card-img">
        <div class="card-body">
          <h3 class="card-title">Pizza</h3>
          <p>Cheesy delight with fresh toppings.</p>
          <div class="card-footer"><span class="price">₹299</span>
            <button class="qty-btn add-to-cart">Add</button>
          </div>
        </div>
      </div>
      <div class="card" data-name="Burger" data-price="150">
        <img src="https://source.unsplash.com/400x300/?burger" class="card-img">
        <div class="card-body">
          <h3 class="card-title">Burger</h3>
          <p>Juicy patty with veggies & sauce.</p>
          <div class="card-footer"><span class="price">₹150</span>
            <button class="qty-btn add-to-cart">Add</button>
          </div>
        </div>
      </div>
      <div class="card" data-name="Pizza" data-price="299">
        <img src="https://source.unsplash.com/400x300/?pizza" class="card-img">
        <div class="card-body">
          <h3 class="card-title">Pizza</h3>
          <p>Cheesy delight with fresh toppings.</p>
          <div class="card-footer"><span class="price">₹299</span>
            <button class="qty-btn add-to-cart">Add</button>
          </div>
        </div>
      </div>
      <div class="card" data-name="Burger" data-price="150">
        <img src="https://source.unsplash.com/400x300/?burger" class="card-img">
        <div class="card-body">
          <h3 class="card-title">Burger</h3>
          <p>Juicy patty with veggies & sauce.</p>
          <div class="card-footer"><span class="price">₹150</span>
            <button class="qty-btn add-to-cart">Add</button>
          </div>
        </div>
      </div>
      <div class="card" data-name="Pizza" data-price="299">
        <img src="https://source.unsplash.com/400x300/?pizza" class="card-img">
        <div class="card-body">
          <h3 class="card-title">Pizza</h3>
          <p>Cheesy delight with fresh toppings.</p>
          <div class="card-footer"><span class="price">₹299</span>
            <button class="qty-btn add-to-cart">Add</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Cart Modal -->
  <div class="overlay" id="overlay"></div>
  <div class="cart-modal" id="cartModal">
    <div class="cart-header"><h3>Your Cart</h3><button id="closeCart">&times;</button></div>
    <div class="cart-items" id="cartItems"><p class="empty-cart-msg">Cart is empty</p></div>
    <div class="cart-total"><span>Total:</span><span id="cartTotal">₹0</span></div>
    <button class="checkout-btn">Checkout</button>
  </div>

</body>
</html>
