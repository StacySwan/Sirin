<?php

declare(strict_types=1);

namespace App\Providers;

use App\MoonShine\Resources\Review\ReviewResource;
use Illuminate\Support\ServiceProvider;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use MoonShine\Laravel\DependencyInjection\MoonShineConfigurator;
use App\MoonShine\Resources\MoonShineUser\MoonShineUserResource;
use App\MoonShine\Resources\MoonShineUserRole\MoonShineUserRoleResource;
use App\MoonShine\Resources\BlogPost\BlogPostResource;
use App\MoonShine\Resources\Category\CategoryResource;
use App\MoonShine\Resources\Page\PageResource;
use App\MoonShine\Resources\Product\ProductResource;
use App\MoonShine\Resources\Service\ServiceResource;

class MoonShineServiceProvider extends ServiceProvider
{
    /**
     * @param  CoreContract<MoonShineConfigurator>  $core
     */
    public function boot(CoreContract $core): void
    {
        $core
            ->resources([
                MoonShineUserResource::class,
                MoonShineUserRoleResource::class,
                ReviewResource::class,
                BlogPostResource::class,
                CategoryResource::class,
                PageResource::class,
                ProductResource::class,
                ServiceResource::class,
            ])
            ->pages([
                ...$core->getConfig()->getPages(),
            ])
        ;
    }
}
