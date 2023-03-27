<div class="p-6 2xl:p-8 rounded-[20px] bg-card">
    <h3 class="mb-6 text-md 2xl:text-lg font-bold">Способ доставки</h3>
    <div class="space-y-5">
        @foreach($deliveries as $delivery)
            <div class="form-radio">
                <input
                    type="radio"
                    name="delivery_type_id"
                    value="{{ $delivery->id }}"
                    id="delivery-method-pickup-{{ $delivery->id }}"
                    @checked($loop->first || old('delivery_id') === $delivery->id)
                >
                <label
                    for="delivery-method-pickup-{{ $delivery->id }}"
                    class="form-radio-label"
                >
                    {{ $delivery->title }}
                </label>
            </div>

            @if($delivery->with_address)
                <x-forms.text-input
                    :isError="$errors->has('customer.city')"
                    name="customer[city]"
                    type="text"
                    placeholder="Город"
                    value="{{ old('customer.city') }}"
                >
                </x-forms.text-input>

                @error('customer.city')
                <x-forms.error>
                    {{ $message }}
                </x-forms.error>
                @enderror

                <x-forms.text-input
                    :isError="$errors->has('customer.address')"
                    name="customer[address]"
                    type="text"
                    placeholder="Адрес"
                    value="{{ old('customer.address') }}"
                >
                </x-forms.text-input>

                @error('customer.address')
                <x-forms.error>
                    {{ $message }}
                </x-forms.error>
                @enderror
            @endif
        @endforeach
    </div>
</div>
