@extends('layouts.app')

@section('title', 'Оформление заказа')

@section('content')
    @include('order.shared.breadcrumbs')

    <section>
        <!-- Section heading -->
        <h1 class="mb-8 text-lg lg:text-[42px] font-black">Оформление заказа</h1>

        <form method="POST" action="{{ route('order.handle') }}" class="grid xl:grid-cols-3 items-start gap-6 2xl:gap-8 mt-12">

            @csrf

            <!-- Contact information -->
            @include('order.shared.contact-info')

            <!-- Shipping & Payment -->
            <div class="space-y-6 2xl:space-y-8">

                <!-- Shipping-->
                @include('order.shared.shipping')

                <!-- Payment-->
                @include('order.shared.payment')

            </div>

            <!-- Checkout -->
            <div class="p-6 2xl:p-8 rounded-[20px] bg-card">
                <h3 class="mb-6 text-md 2xl:text-lg font-bold">Заказ</h3>
                <table class="w-full border-spacing-y-3 text-body text-xxs text-left" style="border-collapse: separate">
                    <thead class="text-[12px] text-body uppercase">
                    <th scope="col" class="pb-2 border-b border-body/60">Товар</th>
                    <th scope="col" class="px-2 pb-2 border-b border-body/60">К-во</th>
                    <th scope="col" class="px-2 pb-2 border-b border-body/60">Сумма</th>
                    </thead>
                    <tbody>
                        @each('order.shared.item', $items, 'item')
                    </tbody>
                </table>
                <div class="text-xs font-semibold text-right">Всего: {{ cart()->amount() }}</div>

                <div class="mt-8 space-y-8">
                    <!-- Promocode -->
                    <div class="space-y-4">
                        <div class="flex gap-3">
                            <input type="text" class="grow w-full h-[56px] px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition" placeholder="Промокод">
                            <button type="submit" class="shrink-0 w-14 !h-[56px] !px-0 btn btn-purple">→</button>
                        </div>
                        <div class="space-y-3">
                            <div class="px-4 py-3 rounded-lg bg-[#137d3d] text-xs">Промокод <a href="#" class="mx-2 py-0.5 px-1.5 rounded-md border-dashed border-2 text-white hover:text-white/70 text-xs" title="Удалить промокод">&times; leeto15</a> успешно добавлен.</div>
                            <!-- <div class="px-4 py-3 rounded-lg bg-[#b91414] text-xs">Промокод <b>leeto15</b> удалён.</div> -->
                            <!-- <div class="px-4 py-3 rounded-lg bg-[#b91414] text-xs">Промокод <b>leeto15</b> не найден.</div> -->
                        </div>
                    </div>

                    <!-- Summary -->
                    <table class="w-full text-left">
                        <tbody>
                        <tr>
                            <th scope="row" class="pb-2 text-xs font-medium">Доставка:</th>
                            <td class="pb-2 text-xs">0 ₽</td>
                        </tr>
                        <tr>
                            <th scope="row" class="pb-2 text-xs font-medium">Промокод:</th>
                            <td class="pb-2 text-xs">0 ₽</td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-md 2xl:text-lg font-black">Итого:</th>
                            <td class="text-md 2xl:text-lg font-black">{{ cart()->amount() }}</td>
                        </tr>
                        </tbody>
                    </table>

                    <!-- Process to checkout -->
                    <button type="submit" class="w-full btn btn-pink">Оформить заказ</button>
                </div>
            </div>
        </form>
    </section>
@endsection
