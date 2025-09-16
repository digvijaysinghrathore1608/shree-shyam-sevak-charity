<div class="aside-menu-container" id="sidebar">
    <div class="aside-menu-container__aside-logo flex-column-auto">
        <a data-turbo="false" href="{{ route('landing.home') }}"
           class="text-decoration-none sidebar-logo d-flex align-items-center"
           title="{{ (strlen(getAppName()) > 12 ) ? substr(getAppName(), 0,12).'...' : getAppName() }}">
            <div class="image image-mini me-3">
                <img src="{{ getLogoUrl() }}"
                     class="img-fluid object-fit-cover" alt="profile image" width="40px" height="30px">
            </div>
            <span class="text-gray-900 fs-4">{{ (strlen(getAppName()) > 12 ) ? substr(getAppName(), 0,12).'...' : getAppName() }}</span>
        </a>
        <button type="button"
                class="btn px-0 text-gray-600 aside-menu-container__aside-menubar d-lg-block d-none sidebar-btn">
            <i class="fa-solid fa-bars fs-1"></i>
        </button>
    </div>
    <form class="d-flex position-relative aside-menu-container__aside-search search-control py-3 mt-1">
        <div class="position-relative w-100">
            <input class="form-control" type="text" placeholder="Search" aria-label="Search" id="menuSearch"
                   name="search">
            <span class="aside-menu-container__search-icon position-absolute d-flex align-items-center top-0 bottom-0">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
        </div>
    </form>
    <div class="sidebar-scrolling">
        <ul class="aside-menu-container__aside-menu nav flex-column">
            @include('user.layouts.menu')
            <div class="no-record text-center d-none">No matching records found</div>
        </ul>
    </div>
</div>
<div class="bg-overlay" id="sidebar-overly"></div>
