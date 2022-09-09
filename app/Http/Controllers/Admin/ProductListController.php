<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductList;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductListController extends Controller
{
    public function ProductListByRemark(Request $request){
        $remark = $request->remark;
        $productlist = ProductList::where('remark',$remark)->limit(8)->get();
        return $productlist;
    }

    public function ProductListByCategory(Request $request){
        $category = $request->category;
        $productlist = ProductList::where('category',$category)->get();
        return $productlist;
    }

    public function ProductListBySubCategory(Request $request){
        $Category = $request->category;
        $SubCategory = $request->subcategory;
        $productlist = ProductList::where('category',$Category)
            ->where('subcategory',$SubCategory)->get();
        return $productlist;
    }

    public function ProductBySearch(Request $request){
        $key = $request->key;
        $productlist = ProductList::where('title','LIKE',"%{$key}%")
            ->orWhere('brand','LIKE',"%{$key}%")
            ->get();
        return $productlist;
    }
}
