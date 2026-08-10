<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

/**
 * Автоматически делает slug (адрес страницы) из заголовка,
 * если админ не заполнил его руками.
 *
 * «Кузнечный мастер-класс» -> «kuznechnyy-master-klass»
 */
trait HasSlug
{
    // Из какого поля берём заголовок. При необходимости переопределяется в модели.
    protected function slugSourceField(): string
    {
        return property_exists($this, 'slugSource') ? $this->slugSource : 'title';
    }

    public static function bootHasSlug(): void
    {
        static::saving(function ($model): void {
            $source = $model->slugSourceField();

            if (blank($model->slug) && filled($model->{$source})) {
                $model->slug = static::makeSlug((string) $model->{$source});
            }
        });
    }

    /**
     * Переводит кириллицу в латиницу и делает адрес вида «kuznechnyy-master-klass».
     */
    public static function makeSlug(string $value): string
    {
        $map = [
            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e',
            'ё' => 'e', 'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k',
            'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r',
            'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch', 'ъ' => '', 'ы' => 'y', 'ь' => '',
            'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
        ];

        $value = mb_strtolower($value);
        $value = strtr($value, $map);

        return Str::slug($value);
    }
}
