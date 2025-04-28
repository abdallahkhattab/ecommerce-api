<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce API Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <span class="text-indigo-600 font-bold text-xl">E-Commerce API</span>
                    </div>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-8">
                    <a href="#features" class="text-gray-600 hover:text-indigo-600 px-3 py-2 text-sm font-medium">Features</a>
                    <a href="#documentation" class="text-gray-600 hover:text-indigo-600 px-3 py-2 text-sm font-medium">Documentation</a>
                    <a href="#" class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-700">Get API Key</a>
                </div>
                <div class="flex items-center sm:hidden">
                    <button id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-indigo-600 hover:bg-gray-100 focus:outline-none">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile menu -->
        <div id="mobile-menu" class="sm:hidden hidden">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="#features" class="text-gray-600 hover:text-indigo-600 block px-3 py-2 text-base font-medium">Features</a>
                <a href="#documentation" class="text-gray-600 hover:text-indigo-600 block px-3 py-2 text-base font-medium">Documentation</a>
                <a href="#" class="bg-indigo-600 text-white block px-3 py-2 rounded-md text-base font-medium">Get API Key</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block">Powerful E-Commerce</span>
                            <span class="block text-indigo-600">API Platform</span>
                        </h1>
                        <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            A comprehensive REST API solution for your e-commerce applications. Integrate our powerful endpoints to handle user authentication, cart management, and order processing.
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <a href="#documentation" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10">
                                    View Documentation
                                </a>
                            </div>
                            <div class="mt-3 sm:mt-0 sm:ml-3">
                                <a href="#features" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-gray-100 hover:bg-gray-200 md:py-4 md:text-lg md:px-10">
                                    Explore Features
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 150 150" class="h-56 w-full sm:h-72 md:h-96 lg:w-full lg:h-full">
                <!-- Background Circle -->
                <circle cx="75" cy="75" r="70" fill="#00796B"/>
        
                <!-- API Symbol: Connecting lines -->
                <path d="M25 75 L45 55" stroke="#fff" stroke-width="4" stroke-linecap="round"/>
                <path d="M45 55 L65 75" stroke="#fff" stroke-width="4" stroke-linecap="round"/>
                <path d="M65 75 L45 95" stroke="#fff" stroke-width="4" stroke-linecap="round"/>
                <path d="M45 95 L25 75" stroke="#fff" stroke-width="4" stroke-linecap="round"/>
        
                <!-- Rectangle to symbolize data flow -->
                <rect x="85" y="65" width="45" height="20" rx="5" ry="5" fill="#ffffff"/>
        
                <!-- Text "API" -->
                <text x="50%" y="85%" text-anchor="middle" alignment-baseline="middle" font-size="20" font-family="Arial, sans-serif" fill="#ffffff">
                    API
                </text>
            </svg>
        </div>
        
        
                
    </div>

    <!-- Features Section -->
    <div id="features" class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Features</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    API Features Summary
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                    Complete API solution for building robust e-commerce applications
                </p>
            </div>

            <div class="mt-10">
                <div class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
                    <!-- Feature 1 -->
                    <div class="relative">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div class="ml-16">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">User Authentication & Authorization</h3>
                            <p class="mt-2 text-base text-gray-500">
                                Secure authentication for most actions. Admin privileges for certain operations like updating order status.
                            </p>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div class="relative">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="ml-16">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Cart Management</h3>
                            <p class="mt-2 text-base text-gray-500">
                                Add products to cart, remove products, and clear entire cart with simple API calls.
                            </p>
                        </div>
                    </div>

                    <!-- Feature 3 -->
                    <div class="relative">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <div class="ml-16">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Order Management</h3>
                            <p class="mt-2 text-base text-gray-500">
                                Create orders, update order status, process payments, and retrieve detailed order information.
                            </p>
                        </div>
                    </div>

                    <!-- Feature 4 -->
                    <div class="relative">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                            <i class="fas fa-database"></i>
                        </div>
                        <div class="ml-16">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Product and Order Data Handling</h3>
                            <p class="mt-2 text-base text-gray-500">
                                View product details in orders including pricing, quantity, and descriptions.
                            </p>
                        </div>
                    </div>

                    <!-- Feature 5 -->
                    <div class="relative">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                            <i class="fas fa-key"></i>
                        </div>
                        <div class="ml-16">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">API Authentication</h3>
                            <p class="mt-2 text-base text-gray-500">
                                Most endpoints require authentication; admin privileges necessary for certain actions.
                            </p>
                        </div>
                    </div>

                    <!-- Feature 6 -->
                    <div class="relative">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="ml-16">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Error Handling</h3>
                            <p class="mt-2 text-base text-gray-500">
                                Proper error responses for unauthorized access or invalid requests.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Documentation Section -->
    <div id="documentation" class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Documentation</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Comprehensive API Reference
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                    Everything you need to integrate our API into your application
                </p>
            </div>

            <div class="mt-10 bg-white shadow rounded-lg overflow-hidden">
                <div class="px-6 py-8 border-b border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900">API Documentation</h3>
                    <p class="mt-2 text-gray-600">
                        Our API documentation provides detailed information about all available endpoints, request parameters, and response formats.
                    </p>
                    <div class="mt-5">
                        <a href="https://documenter.getpostman.com/view/25852325/2sB2cSgiS4" target="_blank" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                            <i class="fas fa-external-link-alt mr-2"></i> View Full Documentation
                        </a>
                    </div>
                </div>

                <div class="px-6 py-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick API Example</h3>
                    <div class="bg-gray-800 rounded-md p-4 overflow-x-auto">
                        <pre class="text-gray-300 text-sm">
<span class="text-indigo-400">// Example: Add a product to cart</span>
fetch('https://api.yourdomain.com/v1/cart/add', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
    'Authorization': 'Bearer YOUR_API_KEY'
  },
  body: JSON.stringify({
    productId: '12345',
    quantity: 2
  })
})
.then(response => response.json())
.then(data => console.log(data))
.catch(error => console.error('Error:', error));</pre>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-indigo-600">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
            <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                <span class="block">Ready to dive in?</span>
                <span class="block text-indigo-200">Start integrating our API today.</span>
            </h2>
            <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                <div class="inline-flex rounded-md shadow">
                    <a href="#" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-indigo-50">
                        Get started
                    </a>
                </div>
                <div class="ml-3 inline-flex rounded-md shadow">
                    <a href="https://documenter.getpostman.com/view/25852325/2sB2cSgiS4" target="_blank" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-700 hover:bg-indigo-800">
                        View docs
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white">
        <div class="max-w-7xl mx-auto py-12 px-4 overflow-hidden sm:px-6 lg:px-8">
            <nav class="-mx-5 -my-2 flex flex-wrap justify-center" aria-label="Footer">
                <div class="px-5 py-2">
                    <a href="#" class="text-base text-gray-500 hover:text-gray-900">Home</a>
                </div>
                <div class="px-5 py-2">
                    <a href="#features" class="text-base text-gray-500 hover:text-gray-900">Features</a>
                </div>
                <div class="px-5 py-2">
                    <a href="#documentation" class="text-base text-gray-500 hover:text-gray-900">Documentation</a>
                </div>
                <div class="px-5 py-2">
                    <a href="#" class="text-base text-gray-500 hover:text-gray-900">Pricing</a>
                </div>
                <div class="px-5 py-2">
                    <a href="https://github.com/abdallahkhattab" class="text-base text-gray-500 hover:text-gray-900">Contact</a>
                </div>
            </nav>
            <div class="mt-8 flex justify-center space-x-6">
                <a href="https://github.com/abdallahkhattab" class="text-gray-400 hover:text-gray-500">
                    <i class="fab fa-twitter text-xl"></i>
                </a>
                <a href="https://github.com/abdallahkhattab" class="text-gray-400 hover:text-gray-500">
                    <i class="fab fa-github text-xl"></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-gray-500">
                    <i class="fab fa-linkedin text-xl"></i>
                </a>
            </div>
            <p class="mt-8 text-center text-base text-gray-400">
                &copy; 2025 E-Commerce API. All rights reserved.
            </p>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                    
                    // Hide mobile menu after clicking
                    document.getElementById('mobile-menu').classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>