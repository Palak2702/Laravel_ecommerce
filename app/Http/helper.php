<?php


use App\Models\Product;

function calculatePrice($productId, $quantity)
{
    $productDetails = Product::find($productId);

    if (!$productDetails) {
        return [
            'original_price' => 0,
            'discount' => 0,
            'discount_price' => 0
        ];
    }

    $unitPrice = $productDetails->price_per_kg_inr;
    $original_price = $unitPrice * $quantity;

    $discount = 0;
    $discount_price = $original_price;

    if ($productDetails->discount_type == '%') {
        $discount = ($productDetails->discount / 100) * $unitPrice * $quantity;
        $discount_price = $original_price - $discount;
    } elseif ($productDetails->discount_type == 'rs') {
        $discount = $productDetails->discount * $quantity;
        $discount_price = $original_price - $discount;
    }

    return [
        'original_price' => $original_price,
        'discount' => $discount,
        'discount_price' => $discount_price
    ];
}
