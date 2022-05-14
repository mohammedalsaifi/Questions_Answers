<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @foreach ($items as $item)
        <li class="nav-item">
            <a href="{{ route($item['route']) }}" class="nav-link">
                <i class="nav-icon {{ $item['icon'] }}"></i>
                <p>
                    {{ $item['title'] }}
                </p>
            </a>
        </li>
        @endforeach
    </ul>
</nav>