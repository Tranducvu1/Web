
document.addEventListener("DOMContentLoaded", () => {
    const scrollContainer1 = document.getElementById("scroll-container");
    const prevButton1 = document.getElementById("prev-button");
    const nextButton1 = document.getElementById("next-button");

    const scrollContainer2 = document.getElementById("scroll-container-2");
    const prevButton2 = document.getElementById("prev-button-2");
    const nextButton2 = document.getElementById("next-button-2");

    const scrollContainer3 = document.getElementById("scroll-container-3");
    const prevButton3 = document.getElementById("prev-button-3");
    const nextButton3 = document.getElementById("next-button-3");

    // Số pixel cuộn mỗi lần
    const scrollAmount = 300;

    // Xử lý nút Next và Prev cho phần đầu tiên
    nextButton1.addEventListener("click", () => {
        scrollContainer1.scrollBy({ left: scrollAmount, behavior: "smooth" });
    });
    prevButton1.addEventListener("click", () => {
        scrollContainer1.scrollBy({ left: -scrollAmount, behavior: "smooth" });
    });

    // Xử lý nút Next và Prev cho phần thứ hai
    nextButton2.addEventListener("click", () => {
        scrollContainer2.scrollBy({ left: scrollAmount, behavior: "smooth" });
    });
    prevButton2.addEventListener("click", () => {
        scrollContainer2.scrollBy({ left: -scrollAmount, behavior: "smooth" });
    });
    nextButton3.addEventListener("click", () => {
        scrollContainer3.scrollBy({ left: scrollAmount, behavior: "smooth" });
    });
    prevButton3.addEventListener("click", () => {
        scrollContainer3.scrollBy({ left: -scrollAmount, behavior: "smooth" });
    });
});


document.addEventListener("DOMContentLoaded", () => {
    const cartCountElement = document.getElementById("cart-count");
    const addToCartButtons = document.querySelectorAll(".add-to-cart");
    const cartItemsList = document.getElementById("cart-items");

    let cartCount = 0;
    let cartItems = []; // Danh sách sản phẩm trong giỏ hàng

    addToCartButtons.forEach(button => {
        button.addEventListener("click", (event) => {
            const productCard = event.target.closest(".pet-card");
            const productName = productCard.querySelector(".card-title").textContent;
            const productPrice = productCard.querySelector(".price").textContent.trim();

            // Cập nhật số lượng trên menu
            cartCount++;

            // Cập nhật danh sách hiển thị trong modal
            updateCartList();
        });
    });

    function updateCartList() {
        //   cartItemsList.innerHTML = ""; // Xóa danh sách cũ
        cartItems.forEach(item => {
            const li = document.createElement("li");
            li.className = "list-group-item d-flex justify-content-between align-items-center";
            li.textContent = `${item.name} - ${item.price}`;
            cartItemsList.appendChild(li);
        });
    }

    const buyButtons = document.querySelectorAll(".btn-success"); // Lấy tất cả nút "Buy"
    const selectedItemsTextarea = document.getElementById("selectedItems");
    const checkoutModal = new bootstrap.Modal(document.getElementById("checkoutModal"));

    buyButtons.forEach(button => {
        button.addEventListener("click", (event) => {
            event.preventDefault(); // Ngăn chặn hành vi mặc định của nút

            const productCard = event.target.closest(".pet-card");
            const productName = productCard.querySelector(".card-title").textContent;
            const productPrice = productCard.querySelector(".price").textContent.trim();

            // Hiển thị thông tin sản phẩm đã chọn trong form
            selectedItemsTextarea.value = `${productName} - ${productPrice}`;
            checkoutModal.show(); // Mở modal điền thông tin
        });
    });
});


document.addEventListener("DOMContentLoaded", () => {
    const cartCountElement = document.getElementById("cart-count");
    const addToCartButtons = document.querySelectorAll(".add-to-cart");
    const cartItemsList = document.getElementById("cart-items");

    // Lấy giỏ hàng từ localStorage 
    let cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];
    updateCartList();

    addToCartButtons.forEach(button => {
        button.addEventListener("click", (event) => {
            const productCard = event.target.closest(".pet-card");
            const productName = productCard.querySelector(".card-title").textContent;
            const productPrice = productCard.querySelector(".price").textContent.trim();


            const existingItem = cartItems.find(item => item.name === productName);

            if (existingItem) {

                existingItem.quantity++;
            } else {
                // Thêm sản phẩm mới vào giỏ hàng
                cartItems.push({ name: productName, price: productPrice, quantity: 1, selected: false });
            }

            // Lưu giỏ hàng vào localStorage
            localStorage.setItem("cartItems", JSON.stringify(cartItems));


            updateCartList();
        });
    });

    function updateCartList() {
        cartCountElement.textContent = cartItems.reduce((sum, item) => sum + item.quantity, 0); // Tổng số sản phẩm
        //   cartItemsList.innerHTML = "";

        cartItems.forEach(item => {
            const li = document.createElement("li");
            li.className = "list-group-item d-flex justify-content-between align-items-center";
            li.innerHTML = `
       <div style="display: flex; align-items: center;">
           <input type="checkbox" class="select-item" data-name="${item.name}" ${item.selected ? "checked" : ""}>
           <span style="flex: 1; margin-left: 10px;">${item.name} - ${item.price}</span>
           <button class="btn-sm btn-secondary decrease-quantity" data-name="${item.name}">-</button>
           <span style="margin: 0 10px;">${item.quantity}</span>
           <button class="btn-sm btn-secondary increase-quantity" data-name="${item.name}">+</button>
       </div>
       <button class="btn btn-sm btn-danger remove-item" data-name style="margin-top: 6px;margin-left:10px!important"="${item.name}">Xóa</button>
   `;
            cartItemsList.appendChild(li);
        });


        addQuantityEvents();
    }

    function addQuantityEvents() {
        // Tăng số lượng
        document.querySelectorAll(".increase-quantity").forEach(button => {
            button.addEventListener("click", (event) => {
                const productName = event.target.getAttribute("data-name");
                const item = cartItems.find(item => item.name === productName);
                if (item) item.quantity++;
                localStorage.setItem("cartItems", JSON.stringify(cartItems));
                updateCartList();
            });
        });

        // Giảm số lượng
        document.querySelectorAll(".decrease-quantity").forEach(button => {
            button.addEventListener("click", (event) => {
                const productName = event.target.getAttribute("data-name");
                const item = cartItems.find(item => item.name === productName);
                if (item && item.quantity > 1) {
                    item.quantity--;
                } else {
                    // Nếu số lượng là 1, xóa sản phẩm khỏi giỏ hàng
                    cartItems = cartItems.filter(item => item.name !== productName);
                }
                localStorage.setItem("cartItems", JSON.stringify(cartItems));
                updateCartList();
            });
        });

        // Xóa sản phẩm
        document.querySelectorAll(".remove-item").forEach(button => {
            button.addEventListener("click", (event) => {
                const productName = event.target.getAttribute("data-name");
                cartItems = cartItems.filter(item => item.name !== productName);
                localStorage.setItem("cartItems", JSON.stringify(cartItems));
                updateCartList();
            });
        });

        // Chọn sản phẩm
        document.querySelectorAll(".select-item").forEach(checkbox => {
            checkbox.addEventListener("change", (event) => {
                const productName = event.target.getAttribute("data-name");
                const item = cartItems.find(item => item.name === productName);
                if (item) item.selected = event.target.checked;
                localStorage.setItem("cartItems", JSON.stringify(cartItems));
            });
        });
    }


});
