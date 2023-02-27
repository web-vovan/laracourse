<ul class="breadcrumbs flex flex-wrap gap-y-1 gap-x-4 mb-6">
    <li><a href="{{ route('home') }}" class="text-body hover:text-pink text-xs">Главная</a></li>
    <li><a href="{{ route('catalog') }}" class="text-body hover:text-pink text-xs">Каталог</a></li>
    <li>
            <span class="text-body text-xs">
                {{ $product->title }}
            </span>
    </li>
</ul>
