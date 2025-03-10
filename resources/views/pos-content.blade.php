<div class="flex space-x-4">
  <!-- Product List with Search -->
  <div class="flex-1 bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-4">Products</h2>

    <!-- Search Input -->
    <input
      type="text"
      id="search-input"
      placeholder="Search products by title or SKU"
      class="mb-4 p-2 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
    />

    <div class="grid grid-cols-1 gap-4" id="product-list">
      <!-- Product items will appear here -->
    </div>
  </div>

  <!-- Cart Section -->
  <div class="flex-1 bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-4">Cart</h2>
    <div id="cart-items" class="space-y-4">
      <!-- Cart items will appear here -->
    </div>
    <div class="flex justify-between items-center mt-6">
      <span class="font-semibold text-xl">Total:</span>
      <span id="total" class="text-2xl font-bold">Rp 0.00</span>
    </div>
    <button id="checkout" class="mt-6 bg-blue-600 text-white py-2 px-4 w-full rounded-lg hover:bg-blue-700">Checkout</button>
  </div>
</div>

<script>
  const productListContainer = document.getElementById("product-list");
  const searchInput = document.getElementById("search-input");
  const totalPrice = document.getElementById("total");
  const cartItemsContainer = document.getElementById("cart-items");

  let products = [];
  let cartItems = [];

  // Fetch products from backend
  async function fetchProducts(query = "") {
    try {
      const response = await fetch(`/products?query=${encodeURIComponent(query)}`);
      if (!response.ok) throw new Error("Failed to fetch products");

      products = await response.json(); // Store globally
      renderProducts(products);
    } catch (error) {
      console.error("Error fetching products:", error);
    }
  }

  // Render products
  function renderProducts(products) {
    productListContainer.innerHTML = "";
    products.forEach(product => {
      const productItem = document.createElement("div");
      productItem.classList.add("flex", "justify-between", "items-center", "border-b", "py-3");
      productItem.innerHTML = `
        <span>${product.name} (SKU: ${product.sku})</span>
        <span>Rp ${product.price.toFixed(2)}</span>
        <button class="bg-green-500 text-white px-3 py-1 rounded-lg" onclick="addToCart('${product.sku}')">Add</button>
      `;
      productListContainer.appendChild(productItem);
    });
  }

  // Add item to cart
  function addToCart(sku) {
    const product = products.find(p => p.sku === sku);
    if (!product) return;

    const existingItem = cartItems.find(item => item.sku === sku);
    if (existingItem) {
      existingItem.quantity += 1;
    } else {
      cartItems.push({ ...product, quantity: 1 });
    }
    updateCart();
  }

  // Remove item from cart
  function removeFromCart(sku) {
    cartItems = cartItems.filter(item => item.sku !== sku);
    updateCart();
  }

  // Change quantity
  function changeQuantity(sku, quantity) {
    const cartItem = cartItems.find(item => item.sku === sku);
    if (!cartItem) return;

    if (quantity <= 0) {
      removeFromCart(sku);
    } else {
      cartItem.quantity = quantity;
      updateCart();
    }
  }

  // Update cart UI
  function updateCart() {
    cartItemsContainer.innerHTML = "";
    let total = 0;

    cartItems.forEach(item => {
      total += item.price * item.quantity;

      const cartItem = document.createElement("div");
      cartItem.classList.add("flex", "justify-between", "items-center", "border-b", "py-3");
      cartItem.innerHTML = `
        <div>
          <span>${item.name} (SKU: ${item.sku})</span>
          <div class="flex items-center mt-1">
            <button class="bg-gray-300 text-black px-2 py-1 rounded-lg" onclick="changeQuantity('${item.sku}', ${item.quantity - 1})">-</button>
            <span class="mx-2">${item.quantity}</span>
            <button class="bg-gray-300 text-black px-2 py-1 rounded-lg" onclick="changeQuantity('${item.sku}', ${item.quantity + 1})">+</button>
          </div>
        </div>
        <span>Rp ${(item.price * item.quantity).toFixed(2)}</span>
        <button class="bg-red-500 text-white px-3 py-1 rounded-lg" onclick="removeFromCart('${item.sku}')">Remove</button>
      `;

      cartItemsContainer.appendChild(cartItem);
    });

    totalPrice.innerText = `Rp ${total.toFixed(2)}`;
  }

  // Checkout button
  document.getElementById("checkout").addEventListener("click", async () => {
    if (cartItems.length === 0) {
        alert("Your cart is empty!");
        return;
    }

    try {
        const response = await fetch("/orders", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            },
            body: JSON.stringify({ cart: cartItems })
        });

        const data = await response.json();

        if (response.ok) {
            alert("Order placed successfully!");
            cartItems.length = 0;
            updateCart();
        } else {
            alert("Error: " + data.message);
        }
    } catch (error) {
        console.error("Error:", error);
    }
  });


  // Event listener for search input
  searchInput.addEventListener("input", () => {
    const searchTerm = searchInput.value.trim();
    fetchProducts(searchTerm); // Fetch filtered products when user types
  });

  // Initial fetch of all products when page loads
  document.addEventListener("DOMContentLoaded", () => fetchProducts());
</script>
