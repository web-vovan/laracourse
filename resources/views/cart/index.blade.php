@extends('layouts.app')

@section('title', 'Корзина')

@section('content')
    @include('cart.shared.breadcrumbs')

    <section>
        <!-- Section heading -->
        <h1 class="mb-8 text-lg lg:text-[42px] font-black">Корзина покупок</h1>

        @if($items->isEmpty())
            <div class="py-3 px-6 rounded-lg bg-pink text-white">Корзина пуста</div>
        @else
            <!-- Message -->
            <div class="lg:hidden py-3 px-6 rounded-lg bg-pink text-white">Таблицу можно пролистать вправо →</div>
            <!-- Adaptive table -->
            <div class="overflow-auto">
                <table class="min-w-full border-spacing-y-4 text-white text-sm text-left" style="border-collapse: separate">
                    <thead class="text-xs uppercase">
                    <th scope="col" class="py-3 px-6">Товар</th>
                    <th scope="col" class="py-3 px-6">Цена</th>
                    <th scope="col" class="py-3 px-6">Количество</th>
                    <th scope="col" class="py-3 px-6">Сумма</th>
                    <th scope="col" class="py-3 px-6"></th>
                    </thead>
                    <tbody>

                    @each('cart.shared.item', $items, 'item')

                    </tbody>
                </table>
            </div>

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mt-8">
            <div class="text-[32px] font-black">Итого: {{ cart()->amount() }}</div>
            <div class="pb-3 lg:pb-0">
                <form action="{{ route('cart.truncate') }}" method="POST">
                    @csrf
                    @method('delete')

                    <button type="submit" class="text-body hover:text-pink font-medium">Очистить корзину</button>
                </form>
            </div>
            <div class="flex flex-col sm:flex-row lg:justify-end gap-4">
                <a href="{{ route('catalog') }}" class="btn btn-pink">За покупками</a>
                <a href="checkout.html" class="btn btn-purple">Оформить заказ</a>
            </div>
        </div>
        @endif

    </section>
@endsection
