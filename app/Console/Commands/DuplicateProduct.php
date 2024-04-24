<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class DuplicateProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:duplicate-product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $product = Product::where('id', 2)->first();
        Product::truncate();

        for($i = 0; $i <= 20; $i++) {
            Product::create([
                'name' => $product->name.' '.$i,
                'category' => $product->category,
                'purchase_price' => $product->purchase_price,
                'selling_price' => $product->selling_price,
                'qty' => $product->qty,
                'image_url' => $product->image_url,
            ]);
            $this->info($i);
        }
    }
}
