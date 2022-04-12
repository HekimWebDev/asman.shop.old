<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Traits\YandexDisk;
use Arhitector\Yandex\Disk;
use Illuminate\Console\Command;

class ImportCategoryFromYandex extends Command
{
    use YandexDisk;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = '1C:category';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Syncing categories in 1C';

    public array $sections;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $disk = new Disk($this->token);

        $resource = $disk->getResource($this->import_path . '/' . $this->import_file);

        $resource->download($this->download($this->import_file));

        $xml = simplexml_load_file($this->openFile($this->import_file));

        $categories = $xml->Классификатор->Группы->Группа->Группы->Группа;

        $categoryIds = $this->categories($categories, null);
        $categoryModelIds = Category::all()->pluck('one_c_id');
        $diffIds = $categoryModelIds->diff($categoryIds);
        $diffIds->each(
            fn($id) => Category::where('one_c_id', $id)->delete()
        );

        $this->deleteFile($this->import_file);

        $this->info('Categories synced successfully.');
    }

    public function categories($categories, $parent_id = null)
    {
        foreach ($categories as $category) {
            $categoryModel = Category::firstOrCreate(
                ['one_c_id' => $category->Ид],
                [
                    'one_c_parent_id' => $parent_id,
                    'status' => 0,
                    'ru' => ['name' => $category->Наименование],
                    'tk' => ['name' => $category->Наименование],
                    'en' => ['name' => $category->Наименование]
                ]
            );

            $categoryModel->one_c_parent_id = $parent_id;
            $categoryModel->translate('ru')->name = $category->Наименование->__toString();
            $categoryModel->save();

            $this->sections[] = $category->Ид->__toString();

            if (isset($category->Группы)) {
                $this->categories($category->Группы->Группа, $category->Ид->__toString());
            }
        }

        return $this->sections;
    }
}
