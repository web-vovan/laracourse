<tr>
    <td scope="row" class="py-4 px-4 md:px-6 rounded-l-2xl bg-card">
        <div class="flex flex-col lg:flex-row min-w-[200px] gap-2 lg:gap-6">
            <div class="shrink-0 overflow-hidden w-[64px] lg:w-[84px] h-[64px] lg:h-[84px] rounded-2xl">
                <img src="{{ $item->product->makeThumbnail('345x320') }}" class="object-cover w-full h-full" alt="SteelSeries Aerox 3 Snow">
            </div>
            <div class="py-3">
                <h4 class="text-xs sm:text-sm xl:text-md font-bold">
                    <a href="{{ route('product', $item->product) }}" class="inline-block text-white hover:text-pink">
                        {{ $item->product->title }}
                    </a>
                </h4>
                <ul class="space-y-1 mt-2 text-xs">
                    @foreach($item->optionValues as $optionValue)
                        <li class="text-body">
                            {{ $optionValue->option->title }}: {{ $optionValue->title }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </td>
    <td class="py-4 px-4 md:px-6 bg-card">
        <div class="font-medium whitespace-nowrap">{{ $item->product->price }}</div>
    </td>
    <td class="py-4 px-4 md:px-6 bg-card" x-data="{ count: {{ $item->quantity }} }">
        <form
            x-ref="cartItem{{ $item->id }}"
            action="{{ route('cart.quantity', $item) }}"
            method="POST"
        >
            @csrf

            <div class="flex items-stretch h-[56px] gap-2">
                <button
                    x-on:click="count--; if(count < 1){count = 1;}"
                    x-on:click.debounce="$refs.cartItem{{ $item->id }}.submit()"
                    type="button" class="w-12 h-full rounded-lg border border-body/10 hover:bg-card/20 active:bg-card/50 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs text-center font-bold shadow-transparent outline-0 transition">-</button>
                <input
                    x-model="count"
                    name="quantity"
                    type="number" class="h-full px-2 lg:px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs text-center font-bold shadow-transparent outline-0 transition" min="1" max="999" placeholder="К-во">
                <button
                    x-on:click="count++;"
                    x-on:click.debounce="$refs.cartItem{{ $item->id }}.submit()"
                    type="button" class="w-12 h-full rounded-lg border border-body/10 hover:bg-card/20 active:bg-card/50 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs text-center font-bold shadow-transparent outline-0 transition">+</button>
            </div>
        </form>
    </td>
    <td class="py-4 px-4 md:px-6 bg-card">
        <div class="font-medium whitespace-nowrap">{{ $item->amount }}</div>
    </td>
    <td class="py-4 px-4 md:px-6 rounded-r-2xl bg-card">
        <form action="{{ route('cart.delete', $item) }}" method="POST">
            @csrf
            @method('delete')

            <button type="submit" class="w-12 !h-12 !px-0 btn btn-pink" title="Удалить из корзины">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 52 52">
                    <path d="M49.327 7.857H2.673a2.592 2.592 0 0 0 0 5.184h5.184v31.102a7.778 7.778 0 0 0 7.776 7.776h20.735a7.778 7.778 0 0 0 7.775-7.776V13.041h5.184a2.592 2.592 0 0 0 0-5.184Zm-25.919 28.51a2.592 2.592 0 0 1-5.184 0V23.409a2.592 2.592 0 1 1 5.184 0v12.96Zm10.368 0a2.592 2.592 0 0 1-5.184 0V23.409a2.592 2.592 0 1 1 5.184 0v12.96ZM20.817 5.265h10.367a2.592 2.592 0 0 0 0-5.184H20.817a2.592 2.592 0 1 0 0 5.184Z"/>
                </svg>
            </button>
        </form>
    </td>
</tr>
