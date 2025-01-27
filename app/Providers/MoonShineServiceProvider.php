<?php

declare(strict_types=1);

namespace App\Providers;


use App\Services\ThemeApplier;
use App\Models\Group;
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
use App\MoonShine\Resources\GroupResource;
use App\MoonShine\Resources\GradeResource;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use App\MoonShine\Resources\GenerationResource;

class MoonShineServiceProvider extends ServiceProvider
{
    /**
     * @param  MoonShine  $core
     * @param  MoonShineConfigurator  $config
     *
     */
    public function boot(
        CoreContract $core,
        ConfiguratorContract $config,
        ColorManagerContract $colorManager
    ): void {
        // $config->authEnable();

        // (new ThemeApplier($colorManager))->theme1();
        // (new ThemeApplier($colorManager))->theme2();
        // (new ThemeApplier($colorManager))->theme3();


        $core
            ->resources([
                MoonShineUserResource::class,
                MoonShineUserRoleResource::class,
                LevelResource::class,
                GroupResource::class,
                GradeResource::class,
                DirectorResource::class,
                SupervisorResource::class,
                GenerationResource::class,
            ])
            ->pages([
                ...$config->getPages(),
            ])
        ;
    }
}
