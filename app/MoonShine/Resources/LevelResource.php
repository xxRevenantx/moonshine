<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;


use Illuminate\Database\Eloquent\Model;
use App\Models\Level;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;

use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\ImportExport\Contracts\HasImportExportContract;
use MoonShine\ImportExport\Traits\ImportExportConcern;

use MoonShine\ImportExport\ExportHandler;
use MoonShine\Laravel\Fields\Slug;
use MoonShine\Laravel\Handlers\Handler;
use MoonShine\UI\Fields\Color;
use MoonShine\UI\Fields\Image;



//RELACIONES
use App\MoonShine\Resources\DirectorResource;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;


/**
 * @extends ModelResource<Level>
 */
class LevelResource extends ModelResource implements HasImportExportContract
{
    use ImportExportConcern;
    protected string $model = Level::class;

    protected string $title = 'Niveles';

    protected bool $createInModal = true;

    protected bool $editInModal = true;

    protected bool $detailInModal = true;

    protected bool $columnSelection = true;

    protected int $itemsPerPage = 10;

    protected bool $errorsAbove = true;


    public static string $orderField = 'order'; // Default sort field

    public static string $orderType = 'DESC'; // Default sort type

      /**
     * @return list<FieldContract>
     */
    protected function export(): ? Handler
    {
        return ExportHandler::make(__('moonshine::ui.export'))
            ->filename(sprintf('Niveles%s', date('Ymd-His'))) // Nombre y fecha del archivo


        ;
    }

    protected function exportFields(): iterable // Campos  que se exportarán
    {
        return [
            ID::make(),
            Text::make('Nivel', 'level'),
            Text::make('Slug', 'slug'),

        ];
    }

    protected function indexFields(): iterable // Campos que se mostrarán en la tabla
    {
        return [
            ID::make()->sortable() ->columnSelection(true),

            // Image::make('Avatar', 'images')->sortable(),
            Text::make('Nivel', 'level')->sortable(),
            Text::make('Slug', 'slug')->sortable(),
            Color::make('color', 'color')->sortable(),
            Text::make("C.C.T.", "cct")->sortable(),
            BelongsTo::make('Director', 'director',
            formatted: 'nombre', )->sortable(),
            BelongsTo::make('Supervisor', 'supervisor',
            formatted: 'nombre', )->sortable(),


        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable // Campos que se mostrarán en el formulario
    {
        return [
            Box::make([
                ID::make(),
                Text::make('Nivel', 'level')->placeholder("Escribe el título del post")
                ->reactive(),
                Slug::make('Slug')
                    ->from('level')
                    ->unique()
                    ->live()




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
            Text::make('Nivel', 'level'),
            Text::make('Slug', 'slug')
        ];
    }
    protected function filters(): iterable // Campos que se mostrarán en los filtros
    {
        return [
            Text::make('Nivel', 'level')->placeholder("Buscar por nivel"),
            Text::make('Slug', 'slug')->placeholder("Buscar por slug"),
        ];
    }

    protected function search(): array // Campos que se mostrarán en la búsqueda
    {
        return ['id', 'level', 'slug'];
    }

    /**
     * @param Level $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [
            'level' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255'],

        ];
    }

    public function validationMessages(): array // Mensajes de validación
    {
        return [
            'level.required' => 'El nivel es requerido',
            'slug.required' => 'El slug es requerido',

        ];
    }





}
