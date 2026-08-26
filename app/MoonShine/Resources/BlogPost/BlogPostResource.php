<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\BlogPost;

use App\Models\BlogPost;
use App\MoonShine\Resources\Category\CategoryResource;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

/**
 * Раздел админки «Статьи».
 * Текст статьи хранится в поле content и выводится на странице /blog/{slug}.
 */
class BlogPostResource extends ModelResource
{
    protected string $model = BlogPost::class;

    protected string $title = 'Статьи';

    protected string $column = 'title';

    protected array $with = ['category'];

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Заголовок', 'title'),
            BelongsTo::make('Категория', 'category', 'name', CategoryResource::class)->nullable(),
            Switcher::make('Опубликовано', 'is_published'),
            Date::make('Дата публикации', 'published_at')->format('d.m.Y')->sortable(),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make('Основное', [
                ID::make(),
                Text::make('Заголовок', 'title')->required(),
                Text::make('Ссылка (slug)', 'slug')
                    ->hint('Латиницей, например: kuznechnyy-master-klass. Если оставить пустым — заполнится автоматически.'),
                Textarea::make('Текст статьи', 'content')
                    ->hint('Можно использовать HTML-теги: <p>, <b>, <ul>, <img>')
                    ->customAttributes(['rows' => 15]),
                BelongsTo::make('Категория', 'category', 'name', CategoryResource::class)->nullable(),
                Text::make('Автор', 'author_name'),
            ]),

            Box::make('Публикация', [
                Switcher::make('Опубликовано', 'is_published'),
                Select::make('Статус', 'status')->options([
                    'active' => 'Активная',
                    'draft' => 'Черновик',
                    'archive' => 'Архив',
                ])->default('draft'),
                Date::make('Дата публикации', 'published_at')->withTime(),
            ]),

            Box::make('SEO', [
                Text::make('Meta title', 'meta_title'),
                Textarea::make('Meta description', 'meta_description'),
                Image::make('Картинка Open Graph', 'og_image')
                    ->dir('blog')
                    ->removable()
                    ->hint('Изображение для превью при отправке ссылки в мессенджеры'),
            ]),
        ];
    }

    protected function detailFields(): iterable
    {
        return $this->formFields();
    }

    protected function rules(DataWrapperContract $item): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'status' => ['required', 'in:active,draft,archive'],
        ];
    }

    protected function search(): array
    {
        return ['id', 'title', 'slug'];
    }
}
