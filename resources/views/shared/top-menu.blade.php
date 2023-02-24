<nav class="2xl:flex gap-8">
    @foreach($menu as $item)
        <a
            href="{{ route($item['routeName']) }}"
            class="text-white hover:text-pink @if(request()->routeIs($item['routeName'])) font-bold @endif">
            {{ $item['title'] }}
        </a>
    @endforeach
</nav>
