

{{-- add in the header of main blade file --}}
<script src="{{ asset('js/cart.js') }}"></script>


{{-- used for displaying categories and products  --}}
<div class="menu-container">
    @foreach($categories as $category)
    <div class="menu-category">
        <div>
            <h3>{{ $category->category_name }}</h3>
            <p>{{ $category->category_id }}</p>
        </div>
        <div class="products">
            @foreach($category->products as $product)
            <div class="product">
                <h4>{{ $product->product_name }}</h4>
                <p>{{ $product->product_description }}</p>
                <p>Price: ₱{{ number_format($product->product_price, 2) }}</p>
                <button class="add-to-cart" data-id="{{ $product->id }}">Add to Cart</button>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>

<div id="cart" class="cart-container">
    <h3>Your Receipt</h3>
    <ul id="cart-items">
        <!-- Dynamically populated -->
    </ul>
    <p id="total-price">Total: ₱0.00</p>
    <button id="checkout-button">Checkout</button>
</div>


