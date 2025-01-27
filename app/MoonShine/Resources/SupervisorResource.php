<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Supervisor;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\ImportExport\Contracts\HasImportExportContract;
use MoonShine\ImportExport\ExportHandler;
use MoonShine\ImportExport\Traits\ImportExportConcern;
use MoonShine\Laravel\Handlers\Handler;
use MoonShine\Support\Enums\SortDirection;
use MoonShine\UI\Fields\Email;
use MoonShine\UI\Fields\Text;

/**
 * @extends ModelResource<Supervisor>
 */
class SupervisorResource extends ModelResource implements HasImportExportContract
{
    use ImportExportConcern;
    protected string $model = Supervisor::class;

    protected string $title = 'Supervisores';

    
    protected bool $createInModal = false;

    protected bool $editInModal = false;

    protected bool $detailInModal = false;

    protected bool $columnSelection = true;

    protected int $itemsPerPage = 10;

    protected bool $errorsAbove = true;

    protected bool $isPrecognitive = true;

    protected ?string $alias = 'supervisores';

    protected string $sortColumn = 'order';

    protected SortDirection $sortDirection = SortDirection::ASC;

    

    public function getRedirectAfterSave(): string
    {
        return 'admin/resource/supervisores/index-page';
    }


    protected function export(): ? Handler
    {
        return ExportHandler::make(__('moonshine::ui.export'))
            ->filename(sprintf('Directores_%s', date('Ymd-His'))) // Nombre y fecha del archivo


        ;
    }

    protected function exportFields(): iterable // Campos  que se exportarán
    {
        return [
            ID::make(),
            Text::make('Nombre', 'nombre'),
            Text::make('Apellido Paterno', 'apellido_paterno'),
            Text::make('Apellido Materno', 'apellido_materno'),
            Email::make('Email', 'email'),
            Text::make('Telefono', 'telefono'),
            Text::make('Zona', 'zona'),
            Text::make('Sector', 'sector'),
        ];
    }

    protected function indexFields(): iterable
    {
        return [
            // ID::make()->sortable(),
            Text::make('#', 'order')->sortable(),
            Text::make('Nombre', 'nombre')->sortable(),
            Text::make('Apellido Paterno', 'apellido_paterno')->sortable(),
            Text::make('Apellido Materno', 'apellido_materno')->sortable(),
            Email::make('Email', 'email')->sortable(),
            Text::make('Telefono', 'telefono')->sortable(),
            Text::make('Zona', 'zona')->sortable(),
            Text::make('Sector', 'sector')->sortable(),

        ];
    }


    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Text::make('Nombre', 'nombre')->placeholder('Nombre del supervisor'),
                Text::make('Apellido Paterno', 'apellido_paterno')->placeholder('Apellido paterno'),
                Text::make('Apellido Materno', 'apellido_materno')->placeholder('Apellido materno'),
                Email::make('Email', 'email')->placeholder('Correo electronico'),
                Text::make('Teléfono', 'telefono')->placeholder('Teléfono'),
                Text::make('Zona', 'zona')->placeholder('Zona'),
                Text::make('Sector', 'sector')->placeholder('Sector'),

                

            ])
        ];
    }

    /**
     * @return list<FieldContract>
     */
    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Nombre', 'nombre'),
            Text::make('Apellido Paterno', 'apellido_paterno'),
            Text::make('Apellido Materno', 'apellido_materno'),
            Email::make('Email', 'email'),
            Text::make('Teléfono', 'telefono'),
            Text::make('Zona', 'zona'),
            Text::make('Sector', 'sector'),

        ];
    }


    protected function filters(): iterable // Campos que se mostrarán en los filtros
    {
        return [
            Text::make('Nombre', 'nombre')->placeholder('Buscar por nombre'),
            Text::make('Apellido Paterno', 'apellido_paterno')->placeholder('Buscar por apellido paterno'),
            Text::make('Apellido Materno', 'apellido_materno')->placeholder('Buscar por apellido materno'),
            Email::make('Email', 'email')->placeholder('Buscar por email'),
            Text::make('Teléfono', 'telefono')->placeholder('Buscar por teléfono'),
            Text::make('Zona', 'zona')->placeholder('Buscar por zona'),
            Text::make('Sector', 'sector')->placeholder('Buscar por sector'),
        ];
    }

    protected function search(): array // Campos que se mostrarán en la búsqueda
    {
        return [
            'nombre',
            'apellido_paterno',
            'apellido_materno',
            'email',
            'telefono',
            'zona',
            'sector',
        ];
    }
  
    protected function rules(mixed $item): array
    {
        return [
            'nombre' => ['required', 'string', 'max:255'],
            'apellido_paterno' => ['required', 'string', 'max:255'],


        ];
    }
}
