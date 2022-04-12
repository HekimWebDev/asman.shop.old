<?php

namespace App\Imports;

use App\Models\AttributeGroup;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AttributesImport implements ToCollection, WithHeadingRow
{
    use Importable;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $attribute_groups = $this->stringToArray($row['attribute_group_name']);
            $attributeGroupModel = AttributeGroup::whereTranslation('name', $attribute_groups[0], 'tk')
                ->whereTranslation('name', $attribute_groups[1], 'ru')
                ->whereTranslation('name', $attribute_groups[2], 'en')
                ->first();

            if (!$attributeGroupModel) {
                $attributeGroupModel = AttributeGroup::create([
                    'tk' => ['name' => $attribute_groups[0]],
                    'ru' => ['name' => $attribute_groups[1]],
                    'en' => ['name' => $attribute_groups[2]],
                ]);
            }

            $attributes = $this->stringToArray($row['attribute_name']);
            $attributeModel = $attributeGroupModel->attributes()
                ->whereTranslation('name', $attributes[0], 'tk')
                ->whereTranslation('name', $attributes[1], 'ru')
                ->whereTranslation('name', $attributes[2], 'en')
                ->first();

            if (!$attributeModel) {
                $attributeModel = $attributeGroupModel->attributes()->create([
                    'tk' => ['name' => $attributes[0]],
                    'ru' => ['name' => $attributes[1]],
                    'en' => ['name' => $attributes[2]],
                ]);
            }

            $attribute_values = $this->stringToArray($row['attribute_value']);
            $attributeValueModel = $attributeModel->attributeValues()
                ->whereTranslation('name', $attribute_values[0], 'tk')
                ->whereTranslation('name', $attribute_values[1], 'ru')
                ->whereTranslation('name', $attribute_values[2], 'en')
                ->first();

            if (!$attributeValueModel) {
                $attributeValueModel = $attributeModel->attributeValues()->create([
                    'tk' => ['name' => $attribute_values[0]],
                    'ru' => ['name' => $attribute_values[1]],
                    'en' => ['name' => $attribute_values[2]],
                ]);
            }
        }
    }

    public function stringToArray(string $string): array
    {
        $string = preg_replace('~[\n]+~', '&', $string);
        $array = explode("&",  $string);

        return $array;
    }
}
