<?php

namespace App\ViewModels;

use App\Http\Requests\CategoryFormRequest;
use App\Models\Category;

class CategoryViewModel
{

    public static function all($request, $data, $category = null): void
    {
        if ($request->method('POST')){
            $data = [
                'name' => [
                    'tk' => $data['name:tk'],
                    'en' => $data['name:en'],
                    'ru' => $data['name:ru'],
                ],
                'description' => [
                    'tk' => $data['description:tk'],
                    'en' => $data['description:en'],
                    'ru' => $data['description:ru'],
                ]
            ];

            if ($request->input('parent_id')) {
                $category = Category::find($request->input('parent_id'))->children()->create($data);
            } else {
                $category = Category::create($data);
            }

            $category->status = $request->status ?? 0;
            $category->save();

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $category->addMedia($request->file('image'))->toMediaCollection('categories');
            }
        }

        if ($request->method('PUT')){
            $category->update($data);
            $category->status = $data['status'] ?? 0;

            if ($request->hasFile('image')) {
                $category->media()->delete();
                $category->addMedia($request->file('image'))->toMediaCollection('categories');
            }

            $category->save();
        }
    }

}
