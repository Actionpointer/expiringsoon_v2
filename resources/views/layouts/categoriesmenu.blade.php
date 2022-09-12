<ul class="header__category-content dark">
    <li class="header__category-content-item">
        <a href="#">
            <button class="bar-content">
                <span class="bar"></span>
            </button>
            All Categories
            <span class="toggle-icon">
                <svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.75 1.375L6 6.625L11.25 1.375" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </span>
        </a>
        <ul class="header__category-content-dropdown">
          
            @foreach($categories as $category)
            <li>
                <a href="{{route('product.list')}}?cat={{$category->id}}">{{$category->name}}</a>
            </li>
            @endforeach
            <li>
                <a href="shop.php">
                    <span class="icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.25 3.75V11.25H3.75V12.75H11.25V20.25H12.75V12.75H20.25V11.25H12.75V3.75H11.25Z" fill="currentColor"></path>
                        </svg>
                    </span>
                    View All
                </a>
            </li>
        </ul>
    </li>
</ul>