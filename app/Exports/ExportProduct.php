<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportProduct implements FromCollection
{
    protected $search, $category;

    function __construct($req) {
        $this->search = $req->search;
        $this->category = $req->category;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $products = new Product;

        if($this->search) {
            $products = $products->where('name', 'like', '%' .$this->search. '%');
        }
        
        if($this->category) {
            $products = $products->where('category', $this->category);
        }
        
        $products = $products->orderBy('created_at', 'desc')->get();
        
        return $products;
    }
}
