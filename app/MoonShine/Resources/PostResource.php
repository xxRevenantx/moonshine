<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

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
use MoonShine\Laravel\Handlers\Handler;

use MoonShine\BulkActions\BulkAction;



/**
 * @extends ModelResource<Post>
 */
class PostResource extends ModelResource implements HasImportExportContract
{
    use ImportExportConcern;
    
    protected string $model = Post::class;

    protected string $title = 'Artículos';

    protected bool $createInModal = true;

    protected bool $editInModal = true;

    protected bool $detailInModal = true;

    protected bool $columnSelection = true;

    protected int $itemsPerPage = 10;

    protected bool $errorsAbove = true;

    protected string $orderField = 'id'; // Default sort field
 
    protected  string $orderType = 'ASC'; // Default sort type 
    



    /**
     * @return list<FieldContract>
     */
    protected function export(): ? Handler
    {
        return ExportHandler::make(__('moonshine::ui.export'))
            ->filename(sprintf('Artículos_%s', date('Ymd-His'))) // Nombre y fecha del archivo


        ;
    }

    protected function exportFields(): iterable // Campos  que se exportarán
    {
        return [
            ID::make(),
            Text::make('Título', 'title'),
            Text::make('Descripción', 'description'),

        ];
    }

    protected function indexFields(): iterable // Campos que se mostrarán en la tabla
    {
        return [
            ID::make()->sortable() ->columnSelection(true),
            Text::make('Título', 'title')->sortable(),
            Text::make('Descripción', 'description')->sortable(),
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
                Text::make('Título', 'title')->placeholder("Escribe el título del post"),
                Textarea::make('Descripción', 'description'),
                

            ])
        ];
    }

    /**
     * @return list<FieldContract>
     */
    protected function detailFields(): iterable // Campos que se mostrarán en el detalle
    {
        return [
            ID::make(),
            Text::make('Título', 'title'),
            Textarea::make('Descripción', 'description'),

           
        ];
    }

    protected function filters(): iterable // Campos que se mostrarán en los filtros
    {
        return [
            Text::make('Title', 'title')->placeholder("Filtra por título"),
            Text::make('Description', 'description')->placeholder("Filtra por descripción"),
        ];
    }

    protected function search(): array // Campos que se mostrarán en la búsqueda
    {
        return ['id', 'title', 'description'];
    }

    /**
     * @param Post $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array // Reglas de validación
    {
        return [
            'title' => ['required', 'string', 'min:5'],
            'description' => ['required', 'string', 'min:5']
        ];
    }

    public function validationMessages(): array // Mensajes de validación
    {
        return [
            'title.required' => 'El título es requerido',
            'title.string' => 'El título debe ser una cadena de texto',
            'title.min' => 'El título debe tener al menos 5 caracteres',
            'description.required' => 'La descripción es requerida',
            'description.string' => 'La descripción debe ser una cadena de texto',
            'description.min' => 'La descripción debe tener al menos 5 caracteres'

        ];
    }

    // ACCIONES MASIVAS
    public function bulkActions(): array
{
    return [
        BulkAction::make('Deactivation', function (Model $item) {
            $item->update(['active' => false]);
        }, 'Deactivated')
            ->withConfirm('Title', 'Modal content', 'Accept') 
    ];
}
}
