<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div class="flex items-center gap-4">
        <div class="flex items-center gap-2">
            <a
                href="{{ filter_url($category, ['catalog-view' => 'grid']) }}"
                class="
                    inline-flex
                    items-center
                    justify-center
                    w-10
                    h-10
                    rounded-md
                    bg-card
                    @if(is_catalog_view('grid'))
                        pointer-events-none text-pink
                    @else
                        text-white hover:text-pink
                    @endif
            ">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 52 52">
                    <path fill-rule="evenodd" d="M2.6 28.6h18.2a2.6 2.6 0 0 1 2.6 2.6v18.2a2.6 2.6 0 0 1-2.6 2.6H2.6A2.6 2.6 0 0 1 0 49.4V31.2a2.6 2.6 0 0 1 2.6-2.6Zm15.6 18.2v-13h-13v13h13ZM31.2 0h18.2A2.6 2.6 0 0 1 52 2.6v18.2a2.6 2.6 0 0 1-2.6 2.6H31.2a2.6 2.6 0 0 1-2.6-2.6V2.6A2.6 2.6 0 0 1 31.2 0Zm15.6 18.2v-13h-13v13h13ZM31.2 28.6h18.2a2.6 2.6 0 0 1 2.6 2.6v18.2a2.6 2.6 0 0 1-2.6 2.6H31.2a2.6 2.6 0 0 1-2.6-2.6V31.2a2.6 2.6 0 0 1 2.6-2.6Zm15.6 18.2v-13h-13v13h13ZM2.6 0h18.2a2.6 2.6 0 0 1 2.6 2.6v18.2a2.6 2.6 0 0 1-2.6 2.6H2.6A2.6 2.6 0 0 1 0 20.8V2.6A2.6 2.6 0 0 1 2.6 0Zm15.6 18.2v-13h-13v13h13Z" clip-rule="evenodd"/>
                </svg>
            </a>
            <a
                href="{{ filter_url($category, ['catalog-view' => 'list']) }}"
                class="
                    inline-flex
                    items-center
                    justify-center
                    w-10
                    h-10
                    rounded-md
                    bg-card
                    @if(is_catalog_view('list'))
                    pointer-events-none text-pink
                    @else
                    text-white hover:text-pink
                    @endif
            ">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 52 52">
                    <path fill-rule="evenodd" d="M7.224 4.875v4.694h37.555V4.875H7.224ZM4.877.181a2.347 2.347 0 0 0-2.348 2.347v9.389a2.347 2.347 0 0 0 2.348 2.347h42.25a2.347 2.347 0 0 0 2.347-2.347v-9.39A2.347 2.347 0 0 0 47.127.182H4.877Zm2.347 23.472v4.694h37.555v-4.694H7.224Zm-2.347-4.695a2.347 2.347 0 0 0-2.348 2.348v9.389a2.347 2.347 0 0 0 2.348 2.347h42.25a2.347 2.347 0 0 0 2.347-2.348v-9.388a2.347 2.347 0 0 0-2.347-2.348H4.877ZM7.224 42.43v4.695h37.555v-4.694H7.224Zm-2.347-4.694a2.347 2.347 0 0 0-2.348 2.347v9.39a2.347 2.347 0 0 0 2.348 2.346h42.25a2.347 2.347 0 0 0 2.347-2.347v-9.389a2.347 2.347 0 0 0-2.347-2.347H4.877Z" clip-rule="evenodd"/>
                </svg>
            </a>
        </div>
        <div class="text-body text-xxs sm:text-xs">Найдено: {{ $products->total() }} товаров</div>
    </div>
    <div class="flex flex-col sm:flex-row sm:items-center gap-3">
        <span class="text-body text-xxs sm:text-xs">Сортировать по</span>
        <div
            x-data="{sort: '{{ filter_url($category, ['sort' => request('sort')]) }}' }"
        >
            <select
                name="sort"
                x-model="sort"
                x-on:change="window.location = sort"
                class="form-select w-full h-12 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xxs sm:text-xs shadow-transparent outline-0 transition">
                <option
                    value="{{ filter_url($category, ['sort' => '']) }}"
                    class="text-dark"
                >
                    умолчанию
                </option>

                <option
                    value="{{ filter_url($category, ['sort' => 'price']) }}"
                    class="text-dark"
                >
                    от дешевых к дорогим
                </option>

                <option
                    value="{{ filter_url($category, ['sort' => '-price']) }}"
                    class="text-dark"
                >
                    от дорогих к дешевым
                </option>

                <option
                    value="{{ filter_url($category, ['sort' => 'title']) }}"
                    class="text-dark"
                >
                    наименованию
                </option>
            </select>
        </div>
    </div>
</div>
