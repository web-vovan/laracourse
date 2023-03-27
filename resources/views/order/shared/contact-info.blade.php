<div class="p-6 2xl:p-8 rounded-[20px] bg-card">
    <h3 class="mb-6 text-md 2xl:text-lg font-bold">Контактная информация</h3>
    <div class="space-y-3">
        <x-forms.text-input
            :isError="$errors->has('customer.first_name')"
            name="customer[first_name]"
            type="text"
            placeholder="Имя"
            value="{{ old('customer.first_name') }}"
            required>
        </x-forms.text-input>

        @error('customer.first_name')
        <x-forms.error>
            {{ $message }}
        </x-forms.error>
        @enderror

        <x-forms.text-input
            name="customer[last_name]"
            type="text"
            placeholder="Фамилия"
            value="{{ old('customer.last_name') }}"
            required>
        </x-forms.text-input>

        <x-forms.text-input
            :isError="$errors->has('customer.phone')"
            name="customer[phone]"
            type="text"
            placeholder="Номер телефона"
            value="{{ old('customer.phone') }}"
            required>
        </x-forms.text-input>

        @error('customer.phone')
        <x-forms.error>
            {{ $message }}
        </x-forms.error>
        @enderror

        <x-forms.text-input
            :isError="$errors->has('customer.email')"
            name="customer[email]"
            type="email"
            placeholder="Email"
            value="{{ old('customer.email') }}"
            required>
        </x-forms.text-input>

        @error('customer.email')
        <x-forms.error>
            {{ $message }}
        </x-forms.error>
        @enderror

        <div x-data="{ createAccount: @php echo old('create_account') ? 'true' : 'false' @endphp }">
            <div class="py-3 text-body">Вы можете создать аккаунт после оформления заказа</div>
            <div class="form-checkbox">
                <input
                    name="create_account"
                    type="checkbox"
                    id="checkout-create-account"
                    value="1"
                    @checked(old('create_account'))
                >
                <label for="checkout-create-account" class="form-checkbox-label" @click="createAccount = ! createAccount">Зарегистрировать аккаунт</label>
            </div>
            <div
                x-show="createAccount"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="mt-4 space-y-3"
            >
                <x-forms.text-input
                    :isError="$errors->has('password')"
                    name="password"
                    type="password"
                    placeholder="Придумайте пароль">
                </x-forms.text-input>

                @error('password')
                <x-forms.error>
                    {{ $message }}
                </x-forms.error>
                @enderror

                <x-forms.text-input
                    :isError="$errors->has('password_confirmation')"
                    name="password_confirmation"
                    type="password"
                    placeholder="Повторите пароль">
                </x-forms.text-input>

                @error('password_confirmation')
                <x-forms.error>
                    {{ $message }}
                </x-forms.error>
                @enderror
            </div>
        </div>
    </div>
</div>
