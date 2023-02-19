<nav class="2xl:flex gap-8">
    @foreach(Support\Menu::make() as $item)
        <a href="{{ $item['link'] }}" class="text-white hover:text-pink font-bold">
            {{ $item['title'] }}
        </a>
    @endforeach
</nav>
