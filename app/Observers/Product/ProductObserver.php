<?php

namespace App\Observers\Product;

use App\Models\Inventory;
use App\Models\Price;
use App\Models\Product;
use Carbon\Carbon;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        $product->code = $product->subgroup->code.$product->id;
        $product->updateQuietly();
        if ($product->price) {
            $this->createPrice($product);
        }

        if ($product->quantity) {
            $this->updateCreateInventory($product);
        }
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        if ($product->price) {
            $this->createPrice($product);
        }
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }

    protected function createPrice(Product $product)
    {
        $price = $product->activePrice;
        if ($price) {
            if ($price->price != $product->price) {
                $prices = Price::whereActive(true)->get();
                if (count($prices) > 0) {
                    foreach ($prices as $price) {
                        $price->active = false;
                        $price->save();
                    }
                }
                Price::create([
                    'product_id' => $product->id,
                    'price' => $product->price,
                    'active' => true,
                    'user_id' => auth()->id(),
                    'valid_from_date' => now(),
                ]);
            }
        } else {
            Price::create([
                'product_id' => $product->id,
                'price' => $product->price,
                'active' => true,
                'user_id' => auth()->id(),
                'valid_from_date' => now(),
            ]);
        }
    }

    protected function updateCreateInventory(Product $product)
    {
        Inventory::updateOrCreate(
            [
            'product_id' => $product->id,
            'user_id' => auth()->id(),
            ],
            [
                'quantity'=>$product->quantity,
                'last_updated_date'=>Carbon::now()
            ]
        );
    }
}
