<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MoonShine\Contracts\Core\DependencyInjection\ConfiguratorContract;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use MoonShine\Laravel\DependencyInjection\MoonShine;
use MoonShine\Laravel\DependencyInjection\MoonShineConfigurator;
use App\MoonShine\Resources\MoonShineUserResource;
use App\MoonShine\Resources\MoonShineUserRoleResource;
use App\MoonShine\Resources\PostResource;
use App\MoonShine\Resources\LevelResource;
use App\MoonShine\Resources\DirectorResource;
use App\MoonShine\Resources\SupervisorResource;

class MoonShineServiceProvider extends ServiceProvider
{
    /**
     * @param  MoonShine  $core
     * @param  MoonShineConfigurator  $config
     *
     */
    public function boot(CoreContract $core, ConfiguratorContract $config): void
    {
        // $config->authEnable();

        $core
            ->resources([
                MoonShineUserResource::class, 
                MoonShineUserRoleResource::class,
                PostResource::class,
                LevelResource::class,
                DirectorResource::class,
                SupervisorResource::class,
            ])
            ->pages([
                ...$config->getPages(),
            ])
        ;
    }
}
