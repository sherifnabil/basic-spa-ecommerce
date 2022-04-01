<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Categories;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Category;

class DeleteController extends Controller
{
    public function __invoke(Request $request, $id): Response
    {
        $category = Category::query()->find($id);

        if (! $category) {
            return new Response(
                content: 'Not Found Entity',
                status: Response::HTTP_NOT_FOUND
            );
        }

        $category->delete();

        return new Response(
            content: null,
            status: Response::HTTP_ACCEPTED
        );
    }
}
