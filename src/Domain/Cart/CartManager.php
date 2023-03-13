<?php

namespace Domain\Cart;

use Domain\Cart\Contracts\CartIdentityStorageContract;
use Domain\Cart\Models\Cart;
use Domain\Cart\Models\CartItem;
use Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Support\ValueObjects\Price;

class CartManager
{
    protected CartIdentityStorageContract $identityStorage;

    public function __construct(CartIdentityStorageContract $identityStorage)
    {
        $this->identityStorage = $identityStorage;
    }

    private function getCacheKey(): string
    {
        return 'cart_ ' . $this->identityStorage->get();
    }

    private function forgetCache(): void
    {
        Cache::forget($this->getCacheKey());
    }


    private function storageData($id): array
    {
        $data =  [
            'storage_id' => $id,
        ];

        if (auth()->check()) {
            $data['user_id'] = auth()->id();
        }

        return $data;
    }

    private function stringedOptionValues(array $optionValues = []): string
    {
        sort($optionValues);

        return implode(';', $optionValues);
    }

    public function add(
        Product $product,
        int $quantity = 1,
        array $optionValues = []
    ): Model|Builder
    {
        $cart = Cart::query()
            ->updateOrCreate([
                'storage_id' => $this->identityStorage->get(),
            ], $this->storageData($this->identityStorage->get()));

        $cartItem = $cart->cartItems()->updateOrCreate([
            'product_id' => $product->id,
            'string_option_values' => $this->stringedOptionValues($optionValues),
        ], [
            'price' => $product->price,
            'quantity' => DB::raw("quantity + $quantity"),
            'string_option_values' => $this->stringedOptionValues($optionValues),
        ]);


        $cartItem->optionvalues()->sync($optionValues);

        $this->forgetCache();

        return $cart;
    }

    public function quantity(CartItem $item, int $quantity = 1): void
    {
        $item->update([
            'quantity' => $quantity
        ]);

        $this->forgetCache();
    }

    public function delete(CartItem $item): void
    {
        $item->delete();

        $this->forgetCache();
    }

    public function truncate(): void
    {
        $this->get()?->delete();

        $this->forgetCache();
    }

    public function items(): Collection
    {
        if (!$this->get()) {
            return collect([]);
        }

        return CartItem::query()
            ->with(['product', 'optionValues.option'])
            ->whereBelongsTo($this->get())
            ->get();
    }

    public function cartItems(): Collection
    {
        return $this->get()?->cartItems ?? collect([]);
    }

    public function count(): int
    {
        return $this->cartItems()->sum(function ($item) {
            return $item->quantity;
        });
    }

    public function amount(): Price
    {
        return Price::make(
            $this->cartItems()->sum(function ($item) {
                return $item->amount->raw();
            })
        );
    }

    public function get(): Cart|bool
    {
        return Cache::remember($this->getCacheKey(), now()->addHour(), function () {
            return Cart::query()
                ->with('cartItems')
                ->where('storage_id', $this->identityStorage->get())
                ->when(auth()->check(), function (Builder $query) {
                    $query->orWhere('user_id', auth()->id());
                })
                ->first() ?? false;
        });
    }

    public function updateStorageId(string $old, string $current): void
    {
        Cart::query()
            ->where('storage_id', $old)
            ->update($this->storageData($current));
    }
}
