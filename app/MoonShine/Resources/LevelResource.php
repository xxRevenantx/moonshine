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

use App\MoonShine\Resources\DirectorResource;

use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\ImportExport\Contracts\HasImportExportContract;
use MoonShine\ImportExport\Traits\ImportExportConcern;

use MoonShine\ImportExport\ExportHandler;


use MoonShine\Laravel\Fields\Slug;
use MoonShine\Laravel\Handlers\Handler;
use MoonShine\UI\Fields\Color;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\File;


//RELACIONES
use MoonShine\Laravel\Fields\Relationships\BelongsTo;


use MoonShine\Support\Enums\SortDirection;

use MoonShine\UI\Components\ActionButton;
use MoonShine\Support\AlpineJs;
use MoonShine\Support\Enums\JsEvent;
use MoonShine\Support\ListOf;

use MoonShine\Actions\Action;
use Barryvdh\DomPDF\Facade\Pdf;
use MoonShine\Laravel\QueryTags\QueryTag;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Fields\Select;

/**
 * @extends ModelResource<Level>
 */
class LevelResource extends ModelResource implements HasImportExportContract
{
    use ImportExportConcern;
    protected string $model = Level::class;

    protected string $title = 'Niveles';

    protected bool $createInModal = false;

    protected bool $editInModal = true;

    protected bool $detailInModal = false;

    protected bool $columnSelection = true;

    protected int $itemsPerPage = 10;

    protected bool $errorsAbove = true;

    protected bool $isPrecognitive = true;

    protected ?string $alias = 'niveles';

    protected string $sortColumn = 'order';

    protected bool $isLazy = true;

    protected SortDirection $sortDirection = SortDirection::ASC;




    protected function topButtons(): ListOf
        {
            return parent::topButtons()->add(
            ActionButton::make('Actualizar', '#')->icon('arrow-path')
                    ->dispatchEvent(AlpineJs::event(JsEvent::TABLE_UPDATED, $this->getListComponentName())),

                    ActionButton::make('PDF',  route('level_pdf'))->blank()->icon('cloud-arrow-down')
                );
        }

    public function getRedirectAfterSave(): string
    {
        return 'admin/resource/niveles/index-page';
    }


    public function getTitle(): string
    {
        return "Niveles";
    }



    protected function export(): ? Handler
    {
        return ExportHandler::make(__('moonshine::ui.export'))
            ->filename(sprintf('Niveles_%s', date('Ymd-His'))) // Nombre y fecha del archivo





        ;
    }

    protected function exportFields(): iterable // Campos  que se exportarán
    {
        return [
            ID::make(),
            Text::make('Nivel', 'level'),
            Text::make('Slug', 'slug'),
            Color::make('Color', 'color'),
            Text::make("C.C.T.", "cct"),
            BelongsTo::make('Director', 'director',
            fn($item) => "$item->nombre $item->apellido_materno $item->apellido_paterno",
            resource: DirectorResource::class),

            BelongsTo::make('Supervisor', 'supervisor',
             fn($item) => "$item->nombre $item->apellido_materno $item->apellido_paterno",
             resource: SupervisorResource::class
             ),
            Image::make('Logo', 'imagen'),



        ];
    }





    protected function indexFields(): iterable // Campos que se mostrarán en la tabla
    {
        return [
            // ID::make()->sortable(),
            Text::make('#', 'order')->sortable(),
            Image::make('Logo', 'imagen')->sortable(),
            Text::make('Nivel', 'level')->sortable(),
            Text::make('Slug', 'slug')->sortable(),
            Color::make('color', 'color')->sortable(),
            Text::make("C.C.T.", "cct")->sortable(),
            BelongsTo::make('Director', 'director',
            fn($item) => "$item->nombre $item->apellido_materno $item->apellido_paterno",
            resource: DirectorResource::class)->sortable(),

            BelongsTo::make('Supervisor', 'supervisor',
             fn($item) => "$item->nombre $item->apellido_materno $item->apellido_paterno",
             resource: SupervisorResource::class
             )->sortable(),


        ];
    }


    protected function formFields(): iterable // Campos que se mostrarán en el formulario
    {
        return [
            Box::make([
                ID::make(),

                Image::make('Imagen', 'imagen')->allowedExtensions(['jpg', 'png'])->dir('imagenes'),

                Text::make('Nivel', 'level')->placeholder("Escribe el título del post")
                ->reactive(),
                Slug::make('Slug', 'slug')
                    ->from('level')
                    ->unique()
                    ->live()
                    ->locked()
                    ,

                Color::make('Color', 'color')->default('#000000'),
                Text::make("C.C.T.", "cct")->placeholder("Escribe el C.C.T.")
                ->reactive(),

                BelongsTo::make('Director', 'director',
                fn($item) => "$item->nombre $item->apellido_materno $item->apellido_paterno",
                resource: DirectorResource::class)->reactive()->nullable(),

                BelongsTo::make('Supervisor', 'supervisor',
                 fn($item) => "$item->nombre $item->apellido_materno $item->apellido_paterno",
                 resource: SupervisorResource::class
                 )->reactive()->nullable(),






            ])
        ];
    }


    protected function detailFields(): iterable
    {
        return [
            ID::make(),

            Text::make('Nivel', 'level'),
            Text::make('Slug', 'slug'),
            Color::make('Color', 'color'),
            Text::make("C.C.T.", "cct"),
            BelongsTo::make('Director', 'director',
            fn($item) => "$item->nombre $item->apellido_materno $item->apellido_paterno",
            resource: DirectorResource::class),

            BelongsTo::make('Supervisor', 'supervisor',
             fn($item) => "$item->nombre $item->apellido_materno $item->apellido_paterno",
             resource: SupervisorResource::class
             ),

            Image::make('Logo', 'imagen'),


        ];
    }
    protected function filters(): iterable // Campos que se mostrarán en los filtros
    {
        return [
            Text::make('Nivel', 'level')->placeholder("Buscar por nivel"),

          

            Text::make("C.C.T.", "cct")->placeholder("Buscar por C.C.T."),
            BelongsTo::make('Director', 'director',
            fn($item) => "$item->nombre $item->apellido_materno $item->apellido_paterno",
            resource: DirectorResource::class)->nullable(),

            BelongsTo::make('Supervisor', 'supervisor',
             fn($item) => "$item->nombre $item->apellido_materno $item->apellido_paterno",
             resource: SupervisorResource::class)->nullable(),
        ];
    }

    protected function search(): array // Campos que se mostrarán en la búsqueda
    {
        return [
            'level', 'slug', 'cct'


        ];
    }


    protected function rules(mixed $item): array
    {
        return [
            'level' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255'],
            'imagen' => ['image', 'mimes:jpg,png', 'max:2048'],

        ];
    }

    public function validationMessages(): array // Mensajes de validación
    {
        return [
            'level.required' => 'El nivel es requerido',
            'slug.required' => 'El slug es requerido',

        ];
    }

    public function prepareForValidation(): void
    {
        request()?->merge([
            'cct' => request()
                ?->string('cct')
                ->upper()
                ->value()

        ]);
    }




}
