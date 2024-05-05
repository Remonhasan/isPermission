<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <title>Ecommerce</title>

  
    <link rel="icon" type="{{ asset('frontend/image/png') }}" href="images/favicon.png"><!-- fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i"><!-- css -->
    <link rel="stylesheet" href="{{ asset('frontend/vendor/bootstrap-4.2.1/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/vendor/owl-carousel-2.3.4/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    
    <script src="{{ asset('frontend/vendor/jquery-3.3.1/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/bootstrap-4.2.1/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/owl-carousel-2.3.4/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/nouislider-12.1.0/nouislider.min.js') }}"></script>
    <script src="{{ asset('frontend/js/number.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="{{ asset('frontend/vendor/svg4everybody-2.1.9/svg4everybody.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    <script>
        svg4everybody();
    </script><!-- font - fontawesome -->
    <link rel="stylesheet" href="{{ asset('frontend/vendor/fontawesome-5.6.1/css/all.min.css') }}">
    <!-- font - stroyka -->
    <link rel="stylesheet" href="{{ asset('frontend/fonts/stroyka/stroyka.css') }}">
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-97489509-6"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-97489509-6');
    </script>
    
   
</head>

<body>

    <!-- quickview-modal -->
    <div id="quickview-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content"></div>
        </div>
    </div><!-- quickview-modal / end --><!-- mobilemenu -->

    <div class="mobileMenu">
        @include('layouts.frontend.mobileMenu')
    </div>

    <div class="site">
        @include('layouts.frontend.header')


        <div class="site__body">
            @yield('frontend_content')
        </div>

        <footer class="site__footer">
            @include('layouts.frontend.footer')
        </footer>

    </div>

</body>

{{-- <script>
    // Initially load all products
    fetch('/products?categoryId=all')
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            // Update the product list with all products
            updateProductList(data.products);
        })
        .catch(function(error) {
            console.error('Error fetching products:', error);
        });

    // Add event listener to category buttons
    document.querySelectorAll('.block-header__group').forEach(function(button) {
        button.addEventListener('click', function() {
            var categoryId = button.dataset.categoryId;
            fetchProductsByCategory(categoryId);
        });
    });

    // Function to fetch products by category ID
    function fetchProductsByCategory(categoryId) {
        // Make an AJAX request to the server
        fetch('/products?categoryId=' + categoryId)
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                // Update the product list with the new products based on the selected category
                updateProductList(data.products);
            })
            .catch(function(error) {
                console.error('Error fetching products:', error);
            });
    }

    // Function to update the product list with new products
    function updateProductList(products) {
    var productList = document.querySelector('.product-all');
    productList.innerHTML = ''; // Clear the existing product list

    // Iterate over the received products and append them to the product list
    products.forEach(function(product) {
        var productHtml = `
                        <div class="product-card">
                            <button class="product-card__quickview" type="button"><svg
                                    width="16px" height="16px">
                                    <use xlink:href="images/sprite.svg#quickview-16"></use>
                                </svg> <span class="fake-svg-icon"></span></button>
                            <div class="product-card__badges-list">
                                <div class="product-card__badge product-card__badge--new">New</div>
                            </div>
                            <div class="product-card__image"><a href="product.html"><img
                                        src="{{ asset('${product.image}') }}" alt=""></a>
                            </div>
                            <div class="product-card__info">
                                <div class="product-card__name"><a href="product.html">${product.name_en}</a></div>
                                <div class="product-card__rating">
                                    <div class="rating">
                                        <div class="rating__body"><svg
                                                class="rating__star rating__star--active" width="13px"
                                                height="12px">
                                                <g class="rating__fill">
                                                    <use xlink:href="images/sprite.svg#star-normal"></use>
                                                </g>
                                                <g class="rating__stroke">
                                                    <use xlink:href="images/sprite.svg#star-normal-stroke">
                                                    </use>
                                                </g>
                                            </svg>
                                            <div
                                                class="rating__star rating__star--only-edge rating__star--active">
                                                <div class="rating__fill">
                                                    <div class="fake-svg-icon"></div>
                                                </div>
                                                <div class="rating__stroke">
                                                    <div class="fake-svg-icon"></div>
                                                </div>
                                            </div><svg class="rating__star rating__star--active"
                                                width="13px" height="12px">
                                                <g class="rating__fill">
                                                    <use xlink:href="images/sprite.svg#star-normal"></use>
                                                </g>
                                                <g class="rating__stroke">
                                                    <use xlink:href="images/sprite.svg#star-normal-stroke">
                                                    </use>
                                                </g>
                                            </svg>
                                            <div
                                                class="rating__star rating__star--only-edge rating__star--active">
                                                <div class="rating__fill">
                                                    <div class="fake-svg-icon"></div>
                                                </div>
                                                <div class="rating__stroke">
                                                    <div class="fake-svg-icon"></div>
                                                </div>
                                            </div><svg class="rating__star rating__star--active"
                                                width="13px" height="12px">
                                                <g class="rating__fill">
                                                    <use xlink:href="images/sprite.svg#star-normal"></use>
                                                </g>
                                                <g class="rating__stroke">
                                                    <use xlink:href="images/sprite.svg#star-normal-stroke">
                                                    </use>
                                                </g>
                                            </svg>
                                            <div
                                                class="rating__star rating__star--only-edge rating__star--active">
                                                <div class="rating__fill">
                                                    <div class="fake-svg-icon"></div>
                                                </div>
                                                <div class="rating__stroke">
                                                    <div class="fake-svg-icon"></div>
                                                </div>
                                            </div><svg class="rating__star rating__star--active"
                                                width="13px" height="12px">
                                                <g class="rating__fill">
                                                    <use xlink:href="images/sprite.svg#star-normal"></use>
                                                </g>
                                                <g class="rating__stroke">
                                                    <use xlink:href="images/sprite.svg#star-normal-stroke">
                                                    </use>
                                                </g>
                                            </svg>
                                            <div
                                                class="rating__star rating__star--only-edge rating__star--active">
                                                <div class="rating__fill">
                                                    <div class="fake-svg-icon"></div>
                                                </div>
                                                <div class="rating__stroke">
                                                    <div class="fake-svg-icon"></div>
                                                </div>
                                            </div><svg class="rating__star" width="13px" height="12px">
                                                <g class="rating__fill">
                                                    <use xlink:href="images/sprite.svg#star-normal"></use>
                                                </g>
                                                <g class="rating__stroke">
                                                    <use xlink:href="images/sprite.svg#star-normal-stroke">
                                                    </use>
                                                </g>
                                            </svg>
                                            <div class="rating__star rating__star--only-edge">
                                                <div class="rating__fill">
                                                    <div class="fake-svg-icon"></div>
                                                </div>
                                                <div class="rating__stroke">
                                                    <div class="fake-svg-icon"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-card__rating-legend">9 Reviews</div>
                                </div>
                                <ul class="product-card__features-list">
                                    <li>Speed: 750 RPM</li>
                                    <li>Power Source: Cordless-Electric</li>
                                    <li>Battery Cell Type: Lithium</li>
                                    <li>Voltage: 20 Volts</li>
                                    <li>Battery Capacity: 2 Ah</li>
                                </ul>
                            </div>

                            <div class="product-card__actions">
                                <div class="product-card__availability">Availability: <span
                                        class="text-success">In Stock</span></div>
                                <div class="product-card__prices">${product.price}</div>
                                <div class="product-card__buttons"><button
                                        class="btn btn-primary product-card__addtocart" type="button">Add To
                                        Cart</button> <button
                                        class="btn btn-secondary product-card__addtocart product-card__addtocart--list"
                                        type="button">Add To Cart</button> <button
                                        class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__wishlist"
                                        type="button"><svg width="16px" height="16px">
                                            <use xlink:href="images/sprite.svg#wishlist-16"></use>
                                        </svg> <span
                                            class="fake-svg-icon fake-svg-icon--wishlist-16"></span></button>
                                    <button
                                        class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare"
                                        type="button"><svg width="16px" height="16px">
                                            <use xlink:href="images/sprite.svg#compare-16"></use>
                                        </svg> <span
                                            class="fake-svg-icon fake-svg-icon--compare-16"></span></button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>`;
        productList.insertAdjacentHTML('beforeend', productHtml);
    });
}
</script> --}}

<script>
    // Initialize cart array
    var cart = [];

    // Add event listener to "Add to Cart" buttons
    document.querySelectorAll('.product-card__addtocart').forEach(function(button) {
        button.addEventListener('click', function() {
            // Get the product information from the button's data attributes
            var productId = button.dataset.productId;
            var productName = button.dataset.productName;
            var productPrice = button.dataset.productPrice;
            var productImage = button.dataset.productImage;

            // Add the product to the cart array
            cart.push({ 
                id: productId, 
                name: productName, 
                price: productPrice, 
                image: productImage 
            });

            // Update the cart count
            var cartCountElement = document.getElementById('cartCount');
            var currentCount = parseInt(cartCountElement.textContent);
            cartCountElement.textContent = currentCount + 1;

            // Store the updated cart data in session storage
            sessionStorage.setItem('cart', JSON.stringify(cart));

            // Show the "Added to cart" notification
            toastr.success('Added to cart');
        });
        
    });
</script>


</html>
