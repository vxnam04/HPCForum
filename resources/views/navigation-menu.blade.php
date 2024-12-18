<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="/" class="text-lg font-bold text-gray-800">
                    <img src="{{ asset('img/Logochu.png') }}" alt="Logo" width="200">
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                <!-- Hiển thị khi người dùng đã đăng nhập -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <!-- Profile -->
                        <x-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <div class="border-t border-gray-200"></div>
                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                {{ __('Đăng xuất') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @else
                <!-- Hiển thị khi người dùng chưa đăng nhập -->
                <div class="flex" style="justify-content: center; gap: 20px; line-height: 40px">
                    <!-- Nút Đăng nhập -->
                    <a href="{{ route('login') }}" 
                        style="
                            display: inline-block; 
                            padding: 12px 24px; 
                            font-size: 1rem; 
                            font-weight: 600; 
                            color: white; 
                            background: linear-gradient(45deg, #1abc9c, #16a085); 
                            border-radius: 12px; 
                            text-decoration: none; 
                            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
                            transition: transform 0.3s ease, box-shadow 0.3s ease, background 0.3s ease;
                        " 
                        onmouseover="this.style.background='linear-gradient(45deg, #16a085, #1abc9c)'; this.style.transform='scale(1.05)'; this.style.boxShadow='0 6px 10px rgba(0, 0, 0, 0.2)';" 
                        onmouseout="this.style.background='linear-gradient(45deg, #1abc9c, #16a085)'; this.style.transform='scale(1)'; this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)';">
                        {{ __('Đăng nhập') }}
                    </a>
                
                    <!-- Nút Đăng ký -->
                    <a href="{{ route('register') }}" 
                        style="
                            display: inline-block; 
                            padding: 12px 24px; 
                            font-size: 1rem; 
                            font-weight: 600; 
                            color: white; 
                            background: linear-gradient(45deg, #5dade2, #3498db); 
                            border-radius: 12px; 
                            text-decoration: none; 
                            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
                            transition: transform 0.3s ease, box-shadow 0.3s ease, background 0.3s ease;
                        " 
                        onmouseover="this.style.background='linear-gradient(45deg, #3498db, #5dade2)'; this.style.transform='scale(1.05)'; this.style.boxShadow='0 6px 10px rgba(0, 0, 0, 0.2)';" 
                        onmouseout="this.style.background='linear-gradient(45deg, #5dade2, #3498db)'; this.style.transform='scale(1)'; this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)';">
                        {{ __('Đăng ký') }}
                    </a>
                </div>
                
                @endauth
            </div>

            <!-- Hamburger Menu -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @auth
            <!-- Profile -->
            <x-responsive-nav-link href="{{ route('profile.show') }}">
                {{ __('Profile') }}
            </x-responsive-nav-link>
            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf
                <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                    {{ __('Đăng xuất') }}
                </x-responsive-nav-link>
            </form>
            @else
            <!-- Login & Register -->
            <x-responsive-nav-link href="{{ route('login') }}">
                {{ __('Đăng nhập') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('register') }}">
                {{ __('Đăng ký') }}
            </x-responsive-nav-link>
            @endauth
        </div>
    </div>
</nav>
