<?php

namespace App\Imports;

use App\Models\Category;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CategoriesImport implements ToCollection, WithHeadingRow
{
    use Importable;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        // $errors = collect();

        foreach ($rows as $row) {
            if ($row['parent_name']) {
                $parent_id = Category::whereTranslation('name', $row['parent_name'])->firstOrFail()->id;
            } else {
                $parent_id = null;
            }

            // dd($parent_id);

            $data = [
                'parent_id' => $parent_id,
                'status' => $row['status'],
                'tk' => [
                    'name' => $row['name_tk'],
                ],
                'en' => [
                    'name' => $row['name_en'],
                ],
                'ru' => [
                    'name' => $row['name_ru'],
                ],
            ];

            $category = Category::create($data);

            // if (!$category->exists) {
            //     $errors->push($error);
            // }
        }

        // return $errors;
    }
}
