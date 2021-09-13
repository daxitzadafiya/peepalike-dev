<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Category;
use App\Subcategory;

class GeneralApiController extends Controller
{
    public function getCategory()
    {
        $category=Category::select('category_name', 'id')->get();
        $data = [
            "categories" => $category
        ];
        return $this->makeResponse('', $data);
    }

    public function getSubCategory(Request $request)
    {
        $id = $request->id;
        $category=Subcategory::select('sub_category_name', 'id')->where('category_id', $id)->get();
        $data = [
            "sub_categories" => $category
        ];
        return $this->makeResponse('', $data);
    }
}
