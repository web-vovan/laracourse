<div>
    <h5 class="mb-4 text-sm 2xl:text-md font-bold">{{ $filter->title() }}</h5>

    @foreach($filter->values() as $brand)
        <div class="form-checkbox">
            <input
                id="{{ $filter->id($brand['id']) }}"
                name="{{ $filter->name($brand['id']) }}"
                value="{{ $brand['id'] }}"
                @checked($filter->requestValue($brand['id']))
                type="checkbox"
            >
            <label
                for="{{ $filter->id($brand['id']) }}"
                class="form-checkbox-label"
            >
                {{ $brand['title'] }}
            </label>
        </div>
    @endforeach
</div>
