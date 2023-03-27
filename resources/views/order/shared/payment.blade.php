<div class="p-6 2xl:p-8 rounded-[20px] bg-card">
    <h3 class="mb-6 text-md 2xl:text-lg font-bold">Метод оплаты</h3>
    <div class="space-y-5">
        @foreach($payments as $payment)
            <div class="form-radio">
                <input
                    type="radio"
                    name="payment_method_id"
                    value="{{ $payment->id }}"
                    id="payment-method-{{ $payment->id }}"
                    @checked($loop->first || old('payment_method_id') === $payment->id)
                >
                <label
                    for="payment-method-{{ $payment->id }}"
                    class="form-radio-label"
                >
                    {{ $payment->title }}
                </label>
            </div>
        @endforeach
    </div>
</div>
