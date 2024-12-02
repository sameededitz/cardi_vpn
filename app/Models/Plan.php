<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Log;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Stripe\Price;
use Stripe\Stripe;
use Stripe\StripeClient;

class Plan extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'duration',
    ];

    protected $guarded = [];

    // Add a flag to prevent recursion
    protected static $stripeHandled = false;

    protected static function booted()
    {
        static::created(function ($plan) {
            if (!self::$stripeHandled) {
                self::$stripeHandled = true; // Prevents recursion

                Stripe::setApiKey(env('STRIPE_SECRET'));

                $price = Price::create([
                    'unit_amount' => $plan->price * 100,
                    'currency' => 'usd',
                    'recurring' => [
                        'interval' => 'month',
                        'interval_count' => $plan->duration,
                    ],
                    'product_data' => [
                        'name' => $plan->name,
                    ],
                ]);

                $plan->stripe_price_id = $price->id;
                $plan->save();

                self::$stripeHandled = false; // Reset the flag after operation
            }
        });

        // Automatically update the Stripe price when a plan is updated
        static::updated(function ($plan) {
            if ($plan->isDirty(['price', 'duration', 'name']) && !self::$stripeHandled) {
                self::$stripeHandled = true; // Prevents recursion

                Stripe::setApiKey(env('STRIPE_SECRET'));

                $price = Price::create([
                    'unit_amount' => $plan->price * 100,
                    'currency' => 'usd',
                    'recurring' => [
                        'interval' => 'month',
                        'interval_count' => $plan->duration,
                    ],
                    'product_data' => [
                        'name' => $plan->name,
                    ],
                ]);

                $plan->stripe_price_id = $price->id;
                $plan->save();

                self::$stripeHandled = false; // Reset the flag after operation
            }
        });

        // Automatically delete the Stripe price when a plan is deleted
        // static::deleting(function ($plan) {
        //     if ($plan->stripe_product_id) {
        //         $stripe = new StripeClient(env('STRIPE_SECRET'));
        //         self::$stripeHandled = true; // Prevents recursion

        //         try {
        //             // Retrieve the price object
        //             $price = $stripe->prices->retrieve($plan->stripe_price_id, []);
        //             dd($price);

        //             // Retrieve the product ID associated with this price
        //             $productId = $price->product;
        //             $stripe->products->delete($productId, []);
        //             self::$stripeHandled = false; // Reset the flag after operation
        //             // Optional: Log deletion or take additional action
        //         } catch (\Exception $e) {
        //             // Handle the exception if needed
        //             Log::error('Failed to delete Stripe product: ' . $e->getMessage());
        //             self::$stripeHandled = false; // Reset the flag after operation
        //         }
        //     }
        // });
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
