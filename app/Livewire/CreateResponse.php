<?php

namespace App\Livewire;

use App\Models\Response;
use Carbon\Carbon;
use DateTime;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CreateResponse extends Component implements HasForms
{
    use InteractsWithForms;
    
    // public ?array $data = [];

    public ?string $post_id;
    public $date_response;
    public ?string $full_name = null;    
    public ?string $contact = null;
    public ?string $email_address = null;
    public ?string $current_address = null;
    public ?string $attachment = null;
    public ?string $slug = null;

    
    public function mount(Response $response): void
    {
        // $this->form->fill();
        $this->form->fill($response->toArray());
        $this->date_response = new Carbon('now');
        
        // $this->form->fill($date_response = new Carbon('now');
    }
    
    
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('post_id')
                ->label(__('Position')),
                // ->relationship('post', 'title'),
                TextInput::make('full_name')
                ->label(__('Full Name')),
                TextInput::make('date_response')
                ->label(__('Date'))
                ->readOnly(),
                TextInput::make('contact')
                ->label(__('Contact Number')),
                TextInput::make('email_address')
                ->label(__('Email')),
                TextInput::make('current_address')
                ->label(__('Current Addresss')),
                TextInput::make('attachment')
                ->label(__('File Attachment')),
                TextInput::make('slug'),
                // IconColumn::make('status')
                //     ->boolean(),
            ])
            // ->statePath('data')
            ->model(Response::class);
            
    }
    
    public function create(): void
    {
        // dd($this->form->getState());
        // Response::create($this->form->getState());
        $response = Response::create($this->form->getState());
    
        // Save the relationships from the form to the post after it is created.
        $this->form->model($response)->saveRelationships();
        $this->form->fill();
        $this->redirectRoute('/job');
        
    }


    public function render()
    {
        return view('livewire.create-response');
    }
}
