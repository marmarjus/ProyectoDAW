<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryTaskController extends Controller
{
    public function getTasksCategory(Category $category)
    {
        $tasks = $category->tasks()->get();

        return response()->json($tasks);
    }

    public function getCategoriesTask(Task $task)
    {
        $categories = $task->categories()->get();

        return response()->json($categories);
    }

    public function assignCategoryToTask(Request $request, Task $task)
    {
        $categoryId = $request->get('category_id');

        if (!$categoryId) {
            return response()->json(['error' => 'Category ID es obligatorio'], 400);
        }

        $category = Category::find($categoryId);

        if (!$category) {
            return response()->json(['error' => 'Categoría no encontrada'], 404);
        }

        $task->categories()->attach($categoryId);

        return response()->json(['message' => 'Categoría asignada a tarea correctamente'], 200);
    }

}
