<?php

namespace App\Controllers;

use App\Models\Dish;
use App\Models\Category;

class MenuController extends Controller
{
    public function index()
    {

        $pdo = PDO();


        $categoryModel = new Category($pdo);
        $categories = $categoryModel->getAll();


        $dishModel = new Dish($pdo);
        $allDishes = $dishModel->all();


        $dishesByCategory = [];
        foreach ($allDishes as $dish) {
            $catId = $dish['category_id'];
            $dishesByCategory[$catId][] = $dish;
        }

        $this->sendPage('menu', [
            'title' => 'Thực đơn',
            'categories' => $categories,
            'dishesByCategory' => $dishesByCategory
        ]);
    }
}
