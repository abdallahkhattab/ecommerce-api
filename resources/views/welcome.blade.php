<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce API Platform | Developed by Abdallah Khattab</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        }
        .feature-card {
            transition: all 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.1), 0 8px 10px -6px rgba(59, 130, 246, 0.1);
        }
        .feature-icon {
            transition: all 0.3s ease;
        }
        .feature-card:hover .feature-icon {
            transform: scale(1.1);
        }
        .code-block {
            background-color: #1e293b;
            border-radius: 0.5rem;
            overflow-x: auto;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <svg class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <span class="ml-2 text-indigo-600 font-bold text-xl">E-Commerce API</span>
                    </div>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-8">
                    <a href="#features" class="text-gray-600 hover:text-indigo-600 px-3 py-2 text-sm font-medium">Features</a>
                    <a href="#pricing" class="text-gray-600 hover:text-indigo-600 px-3 py-2 text-sm font-medium">Pricing</a>
                    <a href="#documentation" class="text-gray-600 hover:text-indigo-600 px-3 py-2 text-sm font-medium">Documentation</a>
                    <a href="#about" class="text-gray-600 hover:text-indigo-600 px-3 py-2 text-sm font-medium">About Developer</a>
                    <button id="get-api-key" class="bg-indigo-600 text-white px-5 py-2 rounded-md text-sm font-medium hover:bg-indigo-700 transition duration-300">Get API Key</button>
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
                <a href="#pricing" class="text-gray-600 hover:text-indigo-600 block px-3 py-2 text-base font-medium">Pricing</a>
                <a href="#documentation" class="text-gray-600 hover:text-indigo-600 block px-3 py-2 text-base font-medium">Documentation</a>
                <a href="#about" class="text-gray-600 hover:text-indigo-600 block px-3 py-2 text-base font-medium">About Developer</a>
                <button id="mobile-get-api-key" class="mt-2 w-full bg-indigo-600 text-white block px-3 py-2 rounded-md text-base font-medium">Get API Key</button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative overflow-hidden">
        <div class="absolute inset-0 z-0 gradient-bg opacity-90"></div>
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pt-10 pb-16 sm:pb-24 lg:pb-32 px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl">
                    <span class="block">Powerful E-Commerce</span>
                    <span class="block text-indigo-200">API Platform</span>
                </h1>
                <p class="mt-6 max-w-lg mx-auto text-xl text-indigo-100 sm:max-w-3xl">
                    A comprehensive REST API solution for your e-commerce applications with role-based access control. Integrate our powerful endpoints to handle user authentication, cart management, and secure order processing.
                </p>
                <div class="mt-8 max-w-md mx-auto sm:flex sm:justify-center">
                    <div class="rounded-md shadow">
                        <a href="#documentation" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10 transition duration-300">
                            View Documentation
                        </a>
                    </div>
                    <div class="mt-3 rounded-md shadow sm:mt-0 sm:ml-3">
                        <a href="#features" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-700 hover:bg-indigo-800 md:py-4 md:text-lg md:px-10 transition duration-300">
                            Explore Features
                        </a>
                    </div>
                </div>
                <div class="mt-10">
                    <p class="text-sm text-indigo-100 font-medium">Developed by Abdallah Khattab</p>
                </div>
            </div>
        </div>
        <svg class="absolute bottom-0 left-0 right-0 w-full text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="currentColor" fill-opacity="1" d="M0,288L48,272C96,256,192,224,288,213.3C384,203,480,213,576,213.3C672,213,768,203,864,202.7C960,203,1056,213,1152,202.7C1248,192,1344,160,1392,144L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>

    <!-- Features Section -->
    <div id="features" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Features</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Comprehensive API Solution
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                    Everything you need to build robust e-commerce applications
                </p>
            </div>

            <div class="mt-16">
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <!-- Feature 1 -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden feature-card">
                        <div class="p-8">
                            <div class="flex items-center justify-center h-16 w-16 rounded-full bg-indigo-100 text-indigo-600 mx-auto mb-6 feature-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-8 w-8">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15h2v-2h-2v2zm0-4h2V7h-2v6z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 text-center">User Authentication & Role-Based Access</h3>
                            <p class="mt-4 text-base text-gray-500 text-center">
                                Secure authentication with JWT tokens and role-based access control to designate user, admin, and manager privileges.
                            </p>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 225" class="mt-6 rounded-lg w-full h-auto object-cover shadow-md">
                                <rect width="400" height="225" fill="#f3f4f6"/>
                                <circle cx="200" cy="80" r="50" fill="#4f46e5"/>
                                <path d="M180 80h40M200 60v40" stroke="#fff" stroke-width="8" stroke-linecap="round"/>
                                <rect x="50" y="140" width="300" height="50" rx="10" fill="#e5e7eb"/>
                                <text x="200" y="170" text-anchor="middle" font-size="20" font-family="Arial" fill="#1f2937">JWT Authentication</text>
                            </svg>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden feature-card">
                        <div class="p-8">
                            <div class="flex items-center justify-center h-16 w-16 rounded-full bg-indigo-100 text-indigo-600 mx-auto mb-6 feature-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-8 w-8">
                                    <path d="M7 8h10v2H7zm0 4h10v2H7zm-2 6h14v2H5zm14-8h2v10h-2zM3 10h2v10H3z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 text-center">Advanced Cart Management</h3>
                            <p class="mt-4 text-base text-gray-500 text-center">
                                Add products, update quantities, remove items, and synchronize carts across devices with simple API calls.
                            </p>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 225" class="mt-6 rounded-lg w-full h-auto object-cover shadow-md">
                                <rect width="400" height="225" fill="#f3f4f6"/>
                                <circle cx="80" cy="160" r="20" fill="#4f46e5"/>
                                <circle cx="120" cy="160" r="20" fill="#4f46e5"/>
                                <path d="M50 50h300v100H50z" fill="#e5e7eb"/>
                                <rect x="70" y="70" width="80" height="60" fill="#fff" stroke="#4f46e5" stroke-width="2"/>
                                <rect x="170" y="70" width="80" height="60" fill="#fff" stroke="#4f46e5" stroke-width="2"/>
                                <text x="200" y="190" text-anchor="middle" font-size="20" font-family="Arial" fill="#1f2937">Cart Items</text>
                            </svg>
                        </div>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden feature-card">
                        <div class="p-8">
                            <div class="flex items-center justify-center h-16 w-16 rounded-full bg-indigo-100 text-indigo-600 mx-auto mb-6 feature-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-8 w-8">
                                    <path d="M4 4h16v2H4zm0 4h16v2H4zm0 4h16v2H4zm0 4h16v2H4z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 text-center">Comprehensive Order Management</h3>
                            <p class="mt-4 text-base text-gray-500 text-center">
                                Create orders, track status updates, process returns, and retrieve detailed order analytics and history.
                            </p>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 225" class="mt-6 rounded-lg w-full h-auto object-cover shadow-md">
                                <rect width="400" height="225" fill="#f3f4f6"/>
                                <rect x="50" y="50" width="300" height="40" fill="#e5e7eb"/>
                                <rect x="50" y="100" width="300" height="40" fill="#e5e7eb"/>
                                <rect x="50" y="150" width="300" height="40" fill="#e5e7eb"/>
                                <path d="M70 60h20v20h-20zM70 110h20v20h-20zM70 160h20v20h-20z" fill="#4f46e5"/>
                                <text x="200" y="30" text-anchor="middle" font-size="20" font-family="Arial" fill="#1f2937">Order List</text>
                            </svg>
                        </div>
                    </div>

                    <!-- Feature 4 -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden feature-card">
                        <div class="p-8">
                            <div class="flex items-center justify-center h-16 w-16 rounded-full bg-indigo-100 text-indigo-600 mx-auto mb-6 feature-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-8 w-8">
                                    <path d="M4 4h16v12H8l-4 4V4zm2 2v10l2-2h10V6H6z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 text-center">Secure Stripe Payment Integration</h3>
                            <p class="mt-4 text-base text-gray-500 text-center">
                                Process payments securely using Stripe's payment gateway with support for various payment methods and currencies.
                            </p>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 Cooke400 225" class="mt-6 rounded-lg w-full h-auto object-cover shadow-md">
                                <rect width="400" height="225" fill="#f3f4f6"/>
                                <rect x="100" y="50" width="200" height="100" rx="10" fill="#e5e7eb"/>
                                <path d="M150 80h100v10H150zM150 110h100v10H150zM150 140h50v10h-50z" fill="#4f46e5"/>
                                <text x="200" y="180" text-anchor="middle" font-size="20" font-family="Arial" fill="#1f2937">Payment Form</text>
                            </svg>
                        </div>
                    </div>

                    <!-- Feature 5 -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden feature-card">
                        <div class="p-8">
                            <div class="flex items-center justify-center h-16 w-16 rounded-full bg-indigo-100 text-indigo-600 mx-auto mb-6 feature-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-8 w-8">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 text-center">Advanced API Security</h3>
                            <p class="mt-4 text-base text-gray-500 text-center">
                                Enterprise-grade security with rate limiting, HTTPS enforcement, API key authentication, and OWASP protection.
                            </p>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 225" class="mt-6 rounded-lg w-full h-auto object-cover shadow-md">
                                <rect width="400" height="225" fill="#f3f4f6"/>
                                <circle cx="200" cy="112.5" r="70" fill="#e5e7eb"/>
                                <path d="M180 112.5h40M200 92.5v40" stroke="#4f46e5" stroke-width="10" stroke-linecap="round"/>
                                <text x="200" y="180" text-anchor="middle" font-size="20" font-family="Arial" fill="#1f2937">Security Shield</text>
                            </svg>
                        </div>
                    </div>

                    <!-- Feature 6 -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden feature-card">
                        <div class="p-8">
                            <div class="flex items-center justify-center h-16 w-16 rounded-full bg-indigo-100 text-indigo-600 mx-auto mb-6 feature-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-8 w-8">
                                    <path d="M3 3h18v18H3zM7 7h10v2H7zm0 4h10v2H7zm0 4h10v2H7z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 text-center">Sales & Inventory Analytics</h3>
                            <p class="mt-4 text-base text-gray-500 text-center">
                                Access real-time inventory levels, product performance metrics, and comprehensive sales reports through API.
                            </p>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 225" class="mt-6 rounded-lg w-full h-auto object-cover shadow-md">
                                <rect width="400" height="225" fill="#f3f4f6"/>
                                <path d="M100 150h50v50h-50zM175 100h50v100h-50zM250 50h50v150h-50z" fill="#4f46e5"/>
                                <text x="200" y="30" text-anchor="middle" font-size="20" font-family="Arial" fill="#1f2937">Analytics Chart</text>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Role-Based Access Control Section -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Role-Based API Access</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Granular Permissions Control
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                    Secure your application with multi-level access control
                </p>
            </div>

            <div class="mt-16">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="px-6 py-8 sm:p-10">
                        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                            <!-- Role 1: User -->
                            <div class="border border-gray-200 rounded-xl p-6 bg-white shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-100 text-indigo-600 mb-4 mx-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">
                                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900 text-center mb-4">Customer Role</h3>
                                <ul class="space-y-3">
                                    <li class="flex items-center">
                                        <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        View products
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Manage personal cart
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Place orders
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        View order history
                                    </li>
                                </ul>
                            </div>

                            <!-- Role 2: Manager -->
                            <div class="border border-gray-200 rounded-xl p-6 bg-white shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-100 text-indigo-600 mb-4 mx-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900 text-center mb-4">Manager Role</h3>
                                <ul class="space-y-3">
                                    <li class="flex items-center">
                                        <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        All customer permissions
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Manage inventory
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Process orders
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Access basic reports
                                    </li>
                                </ul>
                            </div>

                            <!-- Role 3: Admin -->
                            <div class="border border-gray-200 rounded-xl p-6 bg-white shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-100 text-indigo-600 mb-4 mx-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15h2v-2h-2v2zm0-4h2V7h-2v6z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900 text-center mb-4">Admin Role</h3>
                                <ul class="space-y-3">
                                    <li class="flex items-center">
                                        <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        All manager permissions
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Manage users & permissions
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Full analytics access
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        System configuration
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stripe Payment Integration Section -->
    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Stripe Payment Integration</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Secure & Seamless Payments
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                    Integrate reliable payment processing with our Stripe-powered checkout system
                </p>
            </div>

            <div class="mt-16 flex flex-col lg:flex-row">
                <div class="lg:w-1/2 px-4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 400" class="rounded-xl shadow-lg mx-auto">
                        <rect width="600" height="400" fill="#f3f4f6"/>
                        <rect x="100" y="80" width="400" height="240" rx="20" fill="#fff" stroke="#e5e7eb" stroke-width="4"/>
                        <rect x="150" y="120" width="300" height="40" rx="5" fill="#e5e7eb"/>
                        <rect x="150" y="180" width="300" height="40" rx="5" fill="#e5e7eb"/>
                        <rect x="150" y="240" width="150" height="40" rx="5" fill="#4f46e5"/>
                        <text x="300" y="50" text-anchor="middle" font-size="30" font-family="Arial" fill="#1f2937">Stripe Checkout</text>
                    </svg>
                </div>
                <div class="lg:w-1/2 px-4 mt-8 lg:mt-0">
                    <div class="bg-gray-50 p-8 rounded-xl shadow">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Payment Features</h3>
                        <ul class="space-y-4">
                            <li class="flex">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-10 w-10 rounded-md bg-indigo-500 text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">
                                            <path d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-medium text-gray-900">Multiple Payment Methods</h4>
                                    <p class="mt-1 text-gray-500">Support for credit cards, digital wallets, and local payment methods.</p>
                                </div>
                            </li>
                            <li class="flex">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-10 w-10 rounded-md bg-indigo-500 text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8 3.59-8 8-3.59 8-8s-3.59 8-8 8z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-medium text-gray-900">PCI Compliance</h4>
                                    <p class="mt-1 text-gray-500">Secure payment processing that meets industry standards.</p>
                                </div>
                            </li>
                            <li class="flex">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-10 w-10 rounded-md bg-indigo-500 text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-medium text-gray-900">International Support</h4>
                                    <p class="mt-1 text-gray-500">Process payments in 135+ currencies with automatic conversion.</p>
                                </div>
                            </li>
                            <li class="flex">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-10 w-10 rounded-md bg-indigo-500 text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-medium text-gray-900">Subscription Handling</h4>
                                    <p class="mt-1 text-gray-500">API endpoints for creating and managing subscription plans.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pricing Section -->
    <div id="pricing" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Pricing</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Simple, Transparent Pricing
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                    Choose the plan that works best for your business
                </p>
            </div>

            <div class="mt-16 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Basic Plan -->
                <div class="border border-gray-200 rounded-xl bg-white shadow-md hover:shadow-lg transition-shadow overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-900">Starter</h3>
                        <p class="mt-4 text-gray-500">For small businesses starting their e-commerce journey</p>
                        <div class="mt-6">
                            <p class="text-4xl font-extrabold text-gray-900">$29<span class="text-base font-medium text-gray-500">/mo</span></p>
                        </div>
                        <ul class="mt-6 space-y-4">
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Up to 1,000 API calls/day
                            </li>
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Basic support
                            </li>
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Customer role access
                            </li>
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Stripe payment integration
                            </li>
                        </ul>
                        <div class="mt-8">
                            <a href="#" class="block w-full bg-indigo-600 text-white text-center py-3 rounded-md font-medium hover:bg-indigo-700">Choose Starter</a>
                        </div>
                    </div>
                </div>

                <!-- Pro Plan -->
                <div class="border border-gray-200 rounded-xl bg-white shadow-md hover:shadow-lg transition-shadow overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-900">Pro</h3>
                        <p class="mt-4 text-gray-500">For growing businesses with advanced needs</p>
                        <div class="mt-6">
                            <p class="text-4xl font-extrabold text-gray-900">$99<span class="text-base font-medium text-gray-500">/mo</span></p>
                        </div>
                        <ul class="mt-6 space-y-4">
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Up to 10,000 API calls/day
                            </li>
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Priority support
                            </li>
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Customer & manager role access
                            </li>
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Advanced analytics
                            </li>
                        </ul>
                        <div class="mt-8">
                            <a href="#" class="block w-full bg-indigo-600 text-white text-center py-3 rounded-md font-medium hover:bg-indigo-700">Choose Pro</a>
                        </div>
                    </div>
                </div>

                <!-- Enterprise Plan -->
                <div class="border border-gray-200 rounded-xl bg-white shadow-md hover:shadow-lg transition-shadow overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-900">Enterprise</h3>
                        <p class="mt-4 text-gray-500">For large-scale operations with custom requirements</p>
                        <div class="mt-6">
                            <p class="text-4xl font-extrabold text-gray-900">Custom</p>
                        </div>
                        <ul class="mt-6 space-y-4">
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Unlimited API calls
                            </li>
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Dedicated support
                            </li>
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Full role-based access
                            </li>
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Custom integrations
                            </li>
                        </ul>
                        <div class="mt-8">
                            <a href="#" class="block w-full bg-indigo-600 text-white text-center py-3 rounded-md font-medium hover:bg-indigo-700">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Documentation Section -->
    <div id="documentation" class="py-16 bg-white">
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

            <div class="mt-16 bg-white shadow rounded-lg overflow-hidden">
                <div class="px-6 py-8 border-b border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900">API Documentation</h3>
                    <p class="mt-2 text-gray-600">
                        Our API documentation provides detailed information about all available endpoints, request parameters, and response formats.
                    </p>
                    <div class="mt-5">
                        <a href="https://documenter.getpostman.com/view/25852325/2sB2cSgiS4" target="_blank" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5 mr-2">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14H8v-2h2v2zm0-4H8V8h2v4zm4 4h-2v-2h2v2zm0-4h-2V8h2v4z" />
                            </svg>
                            View Full Documentation
                        </a>
                    </div>
                </div>

                <div class="px-6 py-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick API Example</h3>
                    <div class="bg-gray-800 rounded-md p-4 overflow-x-auto code-block">
                        <pre class="text-gray-300 text-sm">
<span class="text-indigo-400">// Example: Add a product to cart</span>
fetch('https://api.ecommerce.com/v1/cart/add', {
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

    <!-- About Developer Section -->
    <div id="about" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">About the Developer</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Meet Abdallah Khattab
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                    The mind behind the E-Commerce API Platform
                </p>
            </div>

            <div class="mt-16 flex flex-col lg:flex-row items-center">
                <div class="lg:w-1/3 px-4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 300" class="rounded-full shadow-lg mx-auto">
                        <circle cx="150" cy="150" r="150" fill="#e5e7eb"/>
                        <circle cx="150" cy="100" r="50" fill="#4f46e5"/>
                        <path d="M100 180h100c0 30-22.4 50-50 50s-50-20-50-50z" fill="#4f46e5"/>
                    </svg>
                </div>
                <div class="lg:w-2/3 px-4 mt-8 lg:mt-0">
                    <p class="text-lg text-gray-600">
                        Abdallah Khattab is a passionate software engineer with expertise in building scalable APIs and e-commerce solutions. With a focus on security and performance, Abdallah designed this API platform to empower businesses with robust tools for online commerce.
                    </p>
                    <div class="mt-6 flex space-x-4">
                        <a href="https://github.com/abdallahkhattab" class="text-gray-400 hover:text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">
                                <path d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.483 0-.237-.009-.866-.014-1.698-2.782.604-3.369-1.34-3.369-1.34-.454-1.154-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.831.092-.647.35-1.087.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.307.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.579.688.482C19.137 20.164 22 16.418 22 12c0-5.523-4.477-10-10-10z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">
                                <path d="M19 3H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2zM8.95 9H6.95v9h2v-9zm-1 10.5a1.25 1.25 0 110-2.5 1.25 1.25 0 010 2.5zm12.05-10.5h-2v3.75c0 .83-.67 1.5-1.5 1.5s-1.5-.67-1.5-1.5V9h-2v9h2v-3c0-1.93 1.57-3.5 3.5-3.5s3.5 1.57 3.5 3.5v3h2v-9z" />
                            </svg>
                        </a>
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
                    <a href="#pricing" class="text-base text-gray-500 hover:text-gray-900">Pricing</a>
                </div>
                <div class="px-5 py-2">
                    <a href="#documentation" class="text-base text-gray-500 hover:text-gray-900">Documentation</a>
                </div>
                <div class="px-5 py-2">
                    <a href="#about" class="text-base text-gray-500 hover:text-gray-900">About Developer</a>
                </div>
            </nav>
            <div class="mt-8 flex justify-center space-x-6">
                <a href="https://github.com/abdallahkhattab" class="text-gray-400 hover:text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">
                        <path d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.483 0-.237-.009-.866-.014-1.698-2.782.604-3.369-1.34-3.369-1.34-.454-1.154-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.831.092-.647.35-1.087.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.307.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.579.688.482C19.137 20.164 22 16.418 22 12c0-5.523-4.477-10-10-10z" />
                    </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">
                        <path d="M19 3H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2zM8.95 9H6.95v9h2v-9zm-1 10.5a1.25 1.25 0 110-2.5 1.25 1.25 0 010 2.5zm12.05-10.5h-2v3.75c0 .83-.67 1.5-1.5 1.5s-1.5-.67-1.5-1.5V9h-2v9h2v-3c0-1.93 1.57-3.5 3.5-3.5s3.5 1.57 3.5 3.5v3h2v-9z" />
                    </svg>
                </a>
            </div>
            <p class="mt-8 text-center text-base text-gray-400">
                © 2025 E-Commerce API. All rights reserved.
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

        // Placeholder for Get API Key button (no Stripe functionality implemented)
        document.getElementById('get-api-key').addEventListener('click', function() {
            alert('Contact support to get your API key!');
        });
        document.getElementById('mobile-get-api-key').addEventListener('click', function() {
            alert('Contact support to get your API key!');
        });
    </script>
</body>
</html>