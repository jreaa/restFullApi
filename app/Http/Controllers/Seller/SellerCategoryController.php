<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Models\Seller;
use Illuminate\Http\Request;

class SellerCategoryController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('scope:read-general')->only('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller)
    {
        $categories = $seller->products()
                        ->whereHas('categories')
                        ->with('categories')
                        ->get()
                        ->pluck('categories')
                        ->collapse()
                        ->unique('id')
                        ->values();
        $this->showAll($categories);
    }

}
