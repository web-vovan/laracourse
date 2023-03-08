@extends('layouts.app')

@section('content')

<!-- Breadcrumbs -->
@include('product.shared.breadcrumbs')

<!-- Main product -->
<section class="flex flex-col lg:flex-row gap-10 xl:gap-14 2xl:gap-20 mt-12">

    <div class="basis-full lg:basis-2/5 xl:basis-2/4">
        <div class="overflow-hidden h-auto max-h-[620px] lg:h-[480px] xl:h-[620px] rounded-3xl">
            <img src="{{ $product->makeThumbnail('345x320') }}" class="object-cover w-full h-full" alt="SteelSeries Aerox 3 Snow">
        </div>
    </div>

    <div class="basis-full lg:basis-3/5 xl:basis-2/4">
        <div class="grow flex flex-col lg:py-8">
            <h1 class="text-lg md:text-xl xl:text-[42px] font-black">{{ $product->title }}</h1>

            @include('product.shared.rating')

            <div class="flex items-baseline gap-4 mt-4">
                <div class="text-pink text-lg md:text-xl font-black">{{ $product->price }}</div>
                <div class="text-body text-md md:text-lg font-bold line-through">{{ $product->price }}</div>
            </div>

            @include('product.shared.properties')

            <!-- Add to cart -->
            @include('product.shared.add-to-cart')
        </div>
    </div>

</section>

<!-- Description -->
<section class="mt-12 xl:mt-16 pt-8 lg:pt-12 border-t border-white/10">
    <h2 class="mb-12 text-lg lg:text-[42px] font-black">Описание</h2>
    <article class="text-xs md:text-sm">
        {{ $product->text }}
    </article>
</section>

<!-- Watched products  -->
@if ($viewedProducts)
    @include('product.shared.viewed-products')
@endif

@endsection
