<section class="mt-16 xl:mt-24">
    <h2 class="mb-12 text-lg lg:text-[42px] font-black">Просмотренные товары</h2>
    <!-- Products list -->
    @foreach($viewedProducts as $product)
        <div class="products grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-x-8 gap-y-8 lg:gap-y-10 2xl:gap-y-12">
            @include('catalog.shared.product', ['product' => $product])
        </div>
    @endforeach
</section>
