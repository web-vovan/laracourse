@extends('layouts.app')

@section('content')

<!-- Breadcrumbs -->
@include('catalog.shared.breadcrumbs')

<section>
    <!-- Section heading -->
    <h2 class="text-lg lg:text-[42px] font-black">Категории</h2>

    <!-- Categories -->
    <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-5 gap-3 sm:gap-4 md:gap-5 mt-8">
        @each('catalog.shared.category', $categories, 'category')
    </div>
</section>

<section class="mt-16 lg:mt-24">
    <!-- Section heading -->
    <h2 class="text-lg lg:text-[42px] font-black">Каталог товаров</h2>

    <div class="flex flex-col lg:flex-row gap-12 lg:gap-6 2xl:gap-8 mt-8">

        <!-- Filters -->
        <aside class="basis-2/5 xl:basis-1/4">
            @include('catalog.shared.filter')
        </aside>

        <div class="basis-auto xl:basis-3/4">
            <!-- Sort by -->
            @include('catalog.shared.sort-block')

            <!-- Products list -->
            <div class="products grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-x-6 2xl:gap-x-8 gap-y-8 lg:gap-y-10 2xl:gap-y-12">
                @each('catalog.shared.product', $products, 'product')
            </div>

            <!-- Page pagination -->
            <div class="mt-12">
                {{ $products->withQueryString()->links() }}
            </div>
        </div>
    </div>
</section>
@endsection
