<header class='d-flex align-items-center justify-content-between flex-grow-1 header px-4 px-lg-7 px-xl-0'>
    <button type="button"
            class="btn px-0 aside-menu-container__aside-menubar text-gray-600 d-block d-xl-none sidebar-btn">
        <i class="fa-solid fa-bars fs-1"></i>
    </button>
    <nav class="navbar navbar-expand-xl navbar-light top-navbar d-xl-flex d-block px-3 px-xl-0 py-4 py-xl-0 "
         id="nav-header">
        <div class="container-fluid pe-0">
            <div class="navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @include('user.layouts.sub_menu')
                </ul>
            </div>
        </div>
    </nav>
    <ul class="nav align-items-center flex-nowrap">
        <li class="px-xxl-3 px-2">
            <div class="dropdown dropdown-transparent d-flex align-items-center py-4">
                <div class="image image-circle image-mini">
                    <img src="{{ getLogInUser()->profile_image }}"
                         class="img-fluid image-object-fit" alt="profile image">
                </div>
                <button class="btn dropdown-toggle ps-2 pe-0 text-gray-600" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false"data-bs-auto-close="outside">
                    {{ getLogInUser()->full_name }}
                    <i class="fa-solid fa-angle-down"></i>
                </button>
                <div class="dropdown-menu py-7 pb-4 my-2" aria-labelledby="dropdownMenuButton1">
                    <div class="text-center border-bottom pb-5">
                        <div class="image image-circle image-tiny mb-5">
                            <img src="{{ getLogInUser()->profile_image }}" class="img-fluid image-object-fit"
                                 alt="profile image">
                        </div>
                        <h3 class="text-gray-900">{{ getLogInUser()->full_name }}</h3>
                        <h4 class="mb-0 fw-400 fs-6">{{ getLogInUser()->email }}</h4>
                    </div>
                    <ul class="pt-4">
                        <li>
                            <a class="dropdown-item text-gray-900 cursor-pointer" href="{{ route('user.profile.setting') }}">
                            <span class="dropdown-icon me-4 text-gray-600">
                                <i class="fa-solid fa-user"></i>
                            </span>
                                {{ __('messages.user.account_setting') }}
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-gray-900 cursor-pointer" id="changePassword">
                                <span class="dropdown-icon me-4 text-gray-600">
                                    <i class="fa-solid fa-lock"></i>
                                </span>
                                {{ __('messages.user.change_password') }}
                            </a>
                        </li>
                        <li>
                            <div class="dropdown dropdown-hover">
                                <a class="dropdown-item text-gray-900" href="#" id="changeLanguage">
                                   <span class="dropdown-icon me-4 text-gray-600">
                                       <i class="fa-solid fa-globe"></i>
                                   </span>
                                    Language
                                </a>
                                <ul class="dropdown-menu rounded-10 px-5 py-3 d-block end-100">
                                    @foreach(getAllLanguage() as $language)
                                        <li>
                                            <a class="dropdown-item backendLanguage {{ getLogInUser()->language == $language->iso_code ? 'text-primary' : ''}}"
                                               data-prefix-value="{{ $language->iso_code }}">
                                                {{ $language->name }}
                                            </a>

                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a class="dropdown-item text-gray-900 d-flex cursor-pointer">
                                <span class="dropdown-icon me-4 text-gray-600">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                </span>
                                <form id="logout-form" action="{{url('/logout')}}" method="post">
                                    @csrf
                                </form>
                                <span onclick="event.preventDefault(); localStorage.clear();  document.getElementById('logout-form').submit();">
                                    Sign Out</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </li>
        <li>
            <button type="button" class="btn px-0 d-block d-xl-none header-btn pb-2">
                <i class="fa-solid fa-bars fs-1"></i>
            </button>
        </li>
    </ul>
</header>
