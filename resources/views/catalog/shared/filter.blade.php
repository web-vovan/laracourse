<form
    action="{{ route('catalog', $category) }}"
    class="overflow-auto max-h-[320px] lg:max-h-[100%] space-y-10 p-6 2xl:p-8 rounded-2xl bg-card"
>
    <input type="hidden" name="sort" value="{{ request('sort') }}">

    @foreach(filters() as $filter)
        {!! $filter !!}
    @endforeach

    <!-- Filter item -->
{{--    <div>--}}
{{--        <h5 class="mb-4 text-sm 2xl:text-md font-bold">Цвет</h5>--}}
{{--        <div class="form-checkbox">--}}
{{--            <input type="checkbox" id="filters-item-9">--}}
{{--            <label for="filters-item-9" class="form-checkbox-label">Белый</label>--}}
{{--        </div>--}}
{{--        <div class="form-checkbox">--}}
{{--            <input type="checkbox" id="filters-item-10">--}}
{{--            <label for="filters-item-10" class="form-checkbox-label">Чёрный</label>--}}
{{--        </div>--}}
{{--        <div class="form-checkbox">--}}
{{--            <input type="checkbox" id="filters-item-11">--}}
{{--            <label for="filters-item-11" class="form-checkbox-label">Желтый</label>--}}
{{--        </div>--}}
{{--        <div class="form-checkbox">--}}
{{--            <input type="checkbox" id="filters-item-12">--}}
{{--            <label for="filters-item-12" class="form-checkbox-label">Розовый</label>--}}
{{--        </div>--}}
{{--        <div class="form-checkbox">--}}
{{--            <input type="checkbox" id="filters-item-13">--}}
{{--            <label for="filters-item-13" class="form-checkbox-label">Красный</label>--}}
{{--        </div>--}}
{{--        <div class="form-checkbox">--}}
{{--            <input type="checkbox" id="filters-item-14">--}}
{{--            <label for="filters-item-14" class="form-checkbox-label">Серый</label>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!-- Filter item -->
{{--    <div>--}}
{{--        <h5 class="mb-4 text-sm 2xl:text-md font-bold">Подсветка</h5>--}}
{{--        <div class="form-checkbox">--}}
{{--            <input type="checkbox" id="filters-item-7">--}}
{{--            <label for="filters-item-7" class="form-checkbox-label">Без подсветки</label>--}}
{{--        </div>--}}
{{--        <div class="form-checkbox">--}}
{{--            <input type="checkbox" id="filters-item-8">--}}
{{--            <label for="filters-item-8" class="form-checkbox-label">З подсветкой</label>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div>
        <button type="submit" class="w-full !h-16 btn btn-pink">Поиск</button>
    </div>

    @if(request('filters'))
        <div>
            <a href="{{ route('catalog', $category) }}" class="w-full !h-16 btn btn-outline">Сбросить фильтры</a>
        </div>
    @endif
</form>
