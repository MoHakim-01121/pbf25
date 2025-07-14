<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stuffus - Give All You Need</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-white">
    <script>
        // Product data
        const products = [
            {
                id: 1,
                name: 'Phone Holder Sale!',
                price: 29.90,
                reviews: 121,
                category: 'Home',
                image: '/api/placeholder/200/200'
            },
            {
                id: 2,
                name: 'Headband',
                price: 32.00,
                reviews: 234,
                category: 'Music',
                image: '/api/placeholder/200/200'
            },
            {
                id: 3,
                name: 'Aladdin Cleaner',
                price: 29.90,
                reviews: 167,
                category: 'Clean',
                image: '/api/placeholder/200/200'
            },
            {
                id: 4,
                name: 'CCTV Maling',
                price: 50.00,
                reviews: 431,
                category: 'Home',
                image: '/api/placeholder/200/200'
            },
            {
                id: 5,
                name: 'Stuffus Pillar S2',
                price: 9.90,
                reviews: 321,
                category: 'Clean',
                image: '/api/placeholder/200/200'
            },
            {
                id: 6,
                name: 'Stuffus R175',
                price: 234.10,
                reviews: 312,
                category: 'Music',
                image: '/api/placeholder/200/200'
            }
        ];
    </script>

    <!-- Header/Navigation -->
    <header class="container mx-auto px-4 py-4 flex justify-between items-center">
        <div class="flex items-center">
            <a href="#" class="text-2xl font-bold">
                <i class="fas fa-box-open mr-1"></i> 
                Stuffus
            </a>
        </div>
        <div class="hidden md:flex space-x-6">
            <a href="#" class="text-gray-800 hover:text-gray-600">
                Home
            </a>
            <a href="#" class="text-gray-800 hover:text-gray-600">
                Shop
            </a>
            <a href="#" class="text-gray-800 hover:text-gray-600">
                Blog
            </a>
        </div>
        <div class="flex items-center space-x-4">
            <button class="text-gray-800 hover:text-gray-600">
                <i class="fas fa-search"></i>
            </button>
            <button class="text-gray-800 hover:text-gray-600">
                <i class="fas fa-shopping-cart"></i>
                <span class="bg-red-500 text-white rounded-full h-4 w-4 text-xs flex items-center justify-center absolute translate-x-3 -translate-y-2">2</span>
            </button>
            <img src="/api/placeholder/32/32" alt="User" class="w-8 h-8 rounded-full">
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative">
        <div class="container mx-auto overflow-hidden">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/2 flex items-center">
                    <div class="p-10">
                        <h1 class="text-8xl font-bold text-gray-800 mb-6">Stuffus</h1>
                        <p class="text-xl mb-6">Give All You Need</p>
                        <div class="flex items-center space-x-2 mb-4">
                            <input type="text" placeholder="Search for products" class="px-4 py-2 border border-gray-300 rounded-md flex-grow">
                            <button class="bg-black text-white px-6 py-2 rounded-md">Search</button>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/2">
                    <img src="/images/image1.jpg" alt="Person using Stuffus" class="w-full object-cover">
                </div>
            </div>
        </div>
    </section>

    <!-- Category Nav -->
    <section class="container mx-auto px-4 py-4 mb-8">
        <div class="flex justify-between items-center mb-4">
            <div class="flex space-x-4">
                <a href="#" class="bg-black text-white px-6 py-2 rounded-full">All</a>
                <a href="#" class="text-gray-800 hover:text-gray-600 px-6 py-2">Music</a>
                <a href="#" class="text-gray-800 hover:text-gray-600 px-6 py-2">Phone</a>
                <a href="#" class="text-gray-800 hover:text-gray-600 px-6 py-2">Storage</a>
                <a href="#" class="text-gray-800 hover:text-gray-600 px-6 py-2">Clean</a>
            </div>
            <a href="#" class="text-blue-500 hover:underline">See All Products</a>
        </div>
    </section>

    <!-- Products Section -->
    <section class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8" id="productContainer">
            <!-- Products will be loaded here via JavaScript -->
        </div>
    </section>

    <!-- Video Section -->
    <section class="container mx-auto px-4 py-16">
        <div class="relative">
            <img src="/api/placeholder/1200/500" alt="Video thumbnail" class="w-full h-96 object-cover rounded-lg">
            <div class="absolute inset-0 flex flex-col justify-end p-8 bg-gradient-to-t from-black/70 to-transparent rounded-lg">
                <div class="flex items-center space-x-2 mb-4">
                    <button class="bg-white text-black h-12 w-12 rounded-full flex items-center justify-center">
                        <i class="fas fa-play"></i>
                    </button>
                    <span class="text-white">Play Video</span>
                </div>
                <h2 class="text-white text-3xl font-bold mb-2">When Your Home bright with Stuffus</h2>
                <p class="text-white text-sm mb-4">Step Up Your Tech Game! Transform Your Space! Elevate Your Home Office Experience! Everything You Need In One Place.</p>
            </div>
        </div>
    </section>

    <!-- New Arrival -->
    <!-- <section class="container mx-auto px-4 py-16">
        <p class="text-gray-500 mb-2">NEW ARRIVAL</p>
        <h2 class="text-3xl font-bold mb-6">Sangkalala Sound</h2>
        
        <div class="flex flex-col md:flex-row">
            <div class="md:w-2/3 mb-8 md:mb-0 md:pr-16">
                <p class="text-gray-600 mb-8">Discover sound excellence with the perfect blend of modern elegance and amazing cutting-edge tech and captivating design. Immerse yourself in premium sophistication, bringing pure listening experience to unprecedented heights.</p>
                
                <div class="space-y-8">
                    <div class="flex items-start space-x-4">
                        <div class="bg-gray-100 rounded-full h-10 w-10 flex items-center justify-center">
                            <i class="fas fa-volume-up"></i>
                        </div>
                        <div>
                            <h3 class="font-bold mb-1">Super Sound</h3>
                            <p class="text-gray-600 text-sm">High quality audio with deep and magnificent bass</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="bg-gray-100 rounded-full h-10 w-10 flex items-center justify-center">
                            <i class="fas fa-battery-full"></i>
                        </div>
                        <div>
                            <h3 class="font-bold mb-1">Samson Battery</h3>
                            <p class="text-gray-600 text-sm">16000+ mAh can sustain you for 24 hours</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="bg-gray-100 rounded-full h-10 w-10 flex items-center justify-center">
                            <i class="fas fa-paint-brush"></i>
                        </div>
                        <div>
                            <h3 class="font-bold mb-1">Clean Design</h3>
                            <p class="text-gray-600 text-sm">Minimalistic looking with all amenities</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="md:w-1/3">
                <img src="/api/placeholder/400/300" alt="Sangkalala Sound" class="w-full rounded-lg">
            </div>
        </div>
    </section> -->

    <!-- Categories Section -->
    <section class="container mx-auto px-4 py-16">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold">
                Explore our curated categories<br>
                and transform your living spaces
            </h2>
            <div class="flex space-x-2">
                <button class="bg-gray-200 h-10 w-10 rounded-full flex items-center justify-center">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="bg-gray-200 h-10 w-10 rounded-full flex items-center justify-center">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="rounded-lg overflow-hidden relative">
                <img src="/api/placeholder/300/300" alt="Music" class="w-full h-full object-cover">
                <div class="absolute bottom-4 left-4">
                    <span class="bg-white px-4 py-1 rounded-full text-sm">Music</span>
                </div>
            </div>
            <div class="rounded-lg overflow-hidden relative">
                <img src="/api/placeholder/300/300" alt="Home" class="w-full h-full object-cover">
                <div class="absolute bottom-4 left-4">
                    <span class="bg-white px-4 py-1 rounded-full text-sm">Home</span>
                </div>
            </div>
            <div class="rounded-lg overflow-hidden relative">
                <img src="/api/placeholder/300/300" alt="Phone" class="w-full h-full object-cover">
                <div class="absolute bottom-4 left-4">
                    <span class="bg-white px-4 py-1 rounded-full text-sm">Phone</span>
                </div>
            </div>
            <div class="rounded-lg overflow-hidden relative">
                <img src="/api/placeholder/300/300" alt="Storage" class="w-full h-full object-cover">
                <div class="absolute bottom-4 left-4">
                    <span class="bg-white px-4 py-1 rounded-full text-sm">Storage</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="container mx-auto px-4 py-16">
        <div class="bg-gray-900 rounded-lg p-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-6 md:mb-0">
                    <h2 class="text-white text-3xl font-bold mb-2">Ready to Get<br>Our New Stuff?</h2>
                    <p class="text-gray-400 text-sm mb-4">Stuffus for Homes and Needs</p>
                    <p class="text-gray-400 text-sm">We'll tailor our approach, identify the best approach, and then <br>create a bespoke smart UI changing what's right for you.</p>
                </div>
                <div class="flex">
                    <input type="email" placeholder="Your email" class="px-4 py-2 rounded-l-md w-64">
                    <button class="bg-gray-800 text-white px-6 py-2 rounded-r-md">Send</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="container mx-auto px-4 py-16 border-t border-gray-200">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-8">
            <div>
                <h3 class="font-bold mb-4">About</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-600 hover:text-gray-900">Blog</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-gray-900">Meet The Team</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-gray-900">Contact Us</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-bold mb-4">Support</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-600 hover:text-gray-900">Contact Us</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-gray-900">Returns</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-gray-900">Shipping</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-gray-900">FAQ</a></li>
                </ul>
            </div>
        </div>
        
        <div class="flex flex-col md:flex-row justify-between items-center pt-8 border-t border-gray-200">
            <p class="text-gray-600 text-sm mb-4 md:mb-0">© Copyright 2023 Stuffus. All Rights Reserved.</p>
            <div class="flex space-x-4">
                <a href="#" class="bg-gray-900 text-white h-8 w-8 rounded-full flex items-center justify-center">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="bg-gray-900 text-white h-8 w-8 rounded-full flex items-center justify-center">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="bg-gray-900 text-white h-8 w-8 rounded-full flex items-center justify-center">
                    <i class="fab fa-linkedin-in"></i>
                </a>
                <a href="#" class="bg-gray-900 text-white h-8 w-8 rounded-full flex items-center justify-center">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
        </div>
        
        <div class="flex justify-between mt-8 text-sm text-gray-500">
            <a href="#" class="hover:text-gray-900">Terms of Service</a>
            <a href="#" class="hover:text-gray-900">Privacy Policy</a>
        </div>
    </footer>

    <script>
        // Function to render products
        function renderProducts() {
            const container = document.getElementById('productContainer');
            
            products.forEach(product => {
                const productElement = document.createElement('div');
                productElement.className = 'bg-gray-50 rounded-lg p-4';
                productElement.innerHTML = `
                    <img src="${product.image}" alt="${product.name}" class="w-full h-48 object-cover mb-4 rounded">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-gray-800">${product.category}</span>
                    </div>
                    <h3 class="font-bold text-lg mb-1">${product.name}</h3>
                    <div class="flex items-center space-x-1 mb-2">
                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                        <i class="fas fa-star text-gray-300 text-xs"></i>
                        <span class="text-xs text-gray-600">(${product.reviews} Reviews)</span>
                    </div>
                    <div class="flex justify-between items-center mb-4">
                        <span class="font-bold text-xl">$${product.price.toFixed(2)}</span>
                    </div>
                    <div class="flex space-x-2">
                        <button class="bg-gray-200 text-gray-800 px-4 py-2 rounded text-sm flex-grow">Add to Cart</button>
                        <button class="bg-black text-white px-4 py-2 rounded text-sm flex-grow">Buy Now</button>
                    </div>
                `;
                container.appendChild(productElement);
            });
        }
        
        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
            renderProducts();
        });
    </script>
</body>
</html>