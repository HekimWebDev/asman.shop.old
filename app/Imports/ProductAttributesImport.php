<?php

namespace App\Imports;

use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductAttributesImport implements ToCollection, WithHeadingRow
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
            $productModel = Product::whereTranslation('name', $row['product_name'], 'en')
                ->first();

            $attributes = $this->stringToArray($row['attribute_name']);
            $attribute_values = $this->stringToArray($row['attribute_value']);
            $attributeValuesId = array();

            for ($i = 0; $i < sizeof($attributes); $i++) {
                $attributeModel = Attribute::whereTranslation('name', $attributes[$i], 'en')
                    ->first();

                if ($attributeModel) {
                    $attributeValueModel = $attributeModel->attributeValues()
                        ->whereTranslation('name', $attribute_values[$i], 'en')
                        ->first();

                    if ($attributeValueModel) {
                        $attributeValuesId[] = $attributeValueModel->id;
                    }
                }
            }

            $productModel->attributeValues()->sync($attributeValuesId);
        }
    }

    public function stringToArray(string $string): array
    {
        $string = preg_replace('~[\n]+~', '&', $string);
        $array = explode("&",  $string);

        return $array;
    }
}
