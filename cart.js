// Global cart State
let cart = JSON.parse(localStorage.getItem("cart")) || [];
let phones = JSON.parse(localStorage.getItem("phones")) || [];
let addresses = JSON.parse(localStorage.getItem("addresses")) || [];

// product Helpers
function getProduct(card) {
  const name = card.querySelector("h5")?.innerText.trim();
  const priceText = card.querySelector(".money-color-fontsize")?.innerText;
  if (!name) return null;

  return {
    name,
    price: priceText ? Number(priceText.replace("₹", "")) : 0
  };
}

function findCartIndex(name) {
  return cart.findIndex(i => i.name === name);
}

// QTY BUTTON HANDLING
document.addEventListener("click", function (e) {
  const plusBtn = e.target.closest(".qty-plus");
  const minusBtn = e.target.closest(".qty-minus");

  if (!plusBtn && !minusBtn) return;

  const btn = plusBtn || minusBtn;
  const card = btn.closest(".card-auto");
  if (!card) return;

  const product = getProduct(card);
  if (!product) return;

  const qtyEl = card.querySelector(".qty-value");
  let qty = Number(qtyEl.innerText);
  const index = findCartIndex(product.name);

  if (plusBtn) {
    qty++;
    qtyEl.innerText = qty;
    index > -1
      ? (cart[index].quantity = qty)
      : cart.push({ ...product, quantity: 1 });
  }

  if (minusBtn) {
    if (qty === 0) return;
    qty--;
    qtyEl.innerText = qty;
    if (index > -1) {
      qty === 0 ? cart.splice(index, 1) : (cart[index].quantity = qty);
    }
  }

  saveCart();
  updateCartCount();
});


// CART HELPERS
function saveCart() {
  localStorage.setItem("cart", JSON.stringify(cart));
}

function updateCartCount() {
  const total = cart.reduce((s, i) => s + i.quantity, 0);

  document.querySelectorAll(".cart-count").forEach(el => {
    el.innerText = total;
    el.style.display = total > 0 ? "inline-block" : "none";
  });
}


//  CART MODAL
function openCart() {
  renderCart();
  renderPhones();
  renderAddresses();
  new bootstrap.Modal(document.getElementById("cartModal")).show();
}

function renderCart() {
  const container = document.getElementById("cartItems");
  const totalEl = document.getElementById("cartTotal");
  let total = 0;

  container.innerHTML = cart.map((item, i) => {
    total += item.price * item.quantity;
    return `
      <div class="row border-bottom py-2 align-items-center">
        <div class="col-12 col-md-6">
          <div class="fw-semibold">${item.name}</div>
          <small>₹${item.price}</small>
        </div>
        <div class="col-6 col-md-3 text-center">
          <button class="btn btn-sm btn-outline-secondary"
            onclick="changeQty(${i},-1)">−</button>
          <span class="mx-2 fw-bold">${item.quantity}</span>
          <button class="btn btn-sm btn-outline-secondary"
            onclick="changeQty(${i},1)">+</button>
        </div>
        <div class="col-6 col-md-3 text-end fw-bold">
          ₹${item.price * item.quantity}
        </div>
      </div>`;
  }).join("") || "<p class='text-center'>Your cart is empty</p>";

  totalEl.innerText = total;
}

function changeQty(index, delta) {
  cart[index].quantity += delta;
  if (cart[index].quantity <= 0) cart.splice(index, 1);
  saveCart();
  updateCartCount();
  renderCart();
  syncQtyUI();
}

//  SEARCH BUTTON
function filterProducts() {
  const keyword = document
    .getElementById("searchInput")
    .value
    .toLowerCase()
    .trim();

  const cards = document.querySelectorAll(".card-auto");

  // Category headings = full-width divs without card-auto
  const headings = document.querySelectorAll(
    ".card-auto ~ .w-100, .w-100.fw-bold"
  );

  // Reset when search is empty
  if (keyword === "") {
    cards.forEach(card => card.style.display = "");
    headings.forEach(h => h.style.display = "");
    return false;
  }

  // Hide ALL headings during search
  headings.forEach(h => h.style.display = "none");

  // Show ONLY matched products
  cards.forEach(card => {
    const title =
      card.querySelector("h5")?.innerText.toLowerCase() || "";
    card.style.display = title.includes(keyword) ? "" : "none";
  });

  return false;
}


//  SYNC QTY UI
function syncQtyUI() {
  document.querySelectorAll(".card-auto").forEach(card => {
    const product = getProduct(card);
    if (!product) return;

    const qtyEl = card.querySelector(".qty-value");
    const item = cart.find(i => i.name === product.name);
    qtyEl.innerText = item ? item.quantity : 0;
  });
}

// Phone
function savePhone() {
  const v = phoneInput.value.trim();
  if (!v) return alert("Enter phone number");
  phones.push(v);
  localStorage.setItem("phones", JSON.stringify(phones));
  phoneInput.value = "";
  renderPhones();
}

function deletePhone(i) {
  phones.splice(i, 1);
  localStorage.setItem("phones", JSON.stringify(phones));
  renderPhones();
}

function renderPhones() {
  phoneList.innerHTML = phones.map((p, i) => `
    <li class="list-group-item d-flex justify-content-between">
      ${p}
      <button class="btn btn-sm btn-danger"
        onclick="deletePhone(${i})">Delete</button>
    </li>`).join("");
}

// ADDRESS
function saveAddress() {
  const v = addressInput.value.trim();
  if (!v) return alert("Enter address");
  addresses.push(v);
  localStorage.setItem("addresses", JSON.stringify(addresses));
  addressInput.value = "";
  renderAddresses();
}

function deleteAddress(i) {
  addresses.splice(i, 1);
  localStorage.setItem("addresses", JSON.stringify(addresses));
  renderAddresses();
}

function renderAddresses() {
  addressList.innerHTML = addresses.map((a, i) => `
    <li class="list-group-item d-flex justify-content-between">
      ${a}
      <button class="btn btn-sm btn-danger"
        onclick="deleteAddress(${i})">Delete</button>
    </li>`).join("");
}

//  PLACE ORDER
function placeOrder() {
  if (!cart.length) return alert("Cart is empty");
  if (!phones.length) return alert("Add phone number");
  if (!addresses.length) return alert("Add address");

  const total = cart.reduce(
    (sum, item) => sum + item.price * item.quantity,
    0
  );

  const orderData = {
    cart: cart,
    phone: phones[phones.length - 1],
    address: addresses[addresses.length - 1],
    total: total
  };

  fetch("place_order.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify(orderData)
  })
    .then(res => res.text())
    .then(res => {
      if (res === "success") {
        alert("Order placed successfully!");

        // ✅ CLEAR CART, PHONE & ADDRESS
        cart = [];
        phones = [];
        addresses = [];

        localStorage.removeItem("cart");
        localStorage.removeItem("phones");
        localStorage.removeItem("addresses");

        updateCartCount();
        renderCart();
        renderPhones();
        renderAddresses();
        syncQtyUI();
      } else {
        alert("Order failed");
      }
    });
}



// INIT
document.addEventListener("DOMContentLoaded", () => {
  updateCartCount();
  syncQtyUI();
  renderPhones();
  renderAddresses();
});
