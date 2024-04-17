<?php

namespace App\Livewire;

use App\Notifications\ResponseUpdate;
use App\Http\Controllers\PostController;
use App\Mail\EmailResponse;
use App\Models\Post;
use App\Models\Response;
use Carbon\Carbon;
use DateTime;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\BaseFileUpload;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Contracts\View\View;
use Illuminate\Notifications\Notifiable;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithFileUploads as LivewireWithFileUploads;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Illuminate\Notifications\Messages\MailMessage;
use Spatie\MediaLibrary\InteractsWithMedia;

use function Filament\Support\is_slot_empty;
use function Livewire\store;

class CreateResponse extends Component implements HasForms
{
    use InteractsWithForms;
    use InteractsWithFormActions;
    use InteractsWithActions;
    use Notifiable;
    use WithFileUploads;
    use LivewireWithFileUploads;

    // public ?array $data = [];
    #[Locked]
    public  $post_title;
    public  $date_response;
    public ?string $full_name;    
    public ?string $contact;
    public ?string $email_address;
    public ?string $current_address;

    public $attachment;
    
    public $Disabled = false;


    // protected $validate = [
    //     'post_title' => 'required',
    //     'date_response' => 'required',
    //     'full_name' => 'required',
    //     'contact' => 'required',
    //     'email_address' => 'required',
    //     'current_address' => 'required',
    //     'attachment' => 'required|file|mimes:pdf,doc,docx|max:5120',
    // ];

    public function mount(Response $response): void
    {
        // $this->form->fill();
        $this->form->fill($response->toArray());

        // $this->date_response = Carbon::now()->format('M-d-Y');
        // $this->full_name = $response->full_name;
        // $this->contact = $response->contact;
        // $this->email_address = $response->email_address;
        // $this->current_address = $response->current_address;
        // $this->attachment = [];
        
    }
    
    
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('post_title')
                // ->relationship('post', 'title')
                // ->readOnly()
                ->label(__('Position'))
                // ->required()
                ->columnSpan(3),

                TextInput::make('full_name')
                ->label(__('Full Name'))
                ->required()
                ->columnSpan(3),

                TextInput::make('date_response')
                ->label(__('Date'))
                ->readOnly()
                ->required()
                ->columnSpan(1),

                TextInput::make('contact')
                ->label(__('Contact Number'))
                ->required()
                ->columnSpan(1),

                TextInput::make('email_address')
                ->label(__('Email'))
                ->required()
                ->columnSpan(1),

                TextInput::make('current_address')
                ->label(__('Current Addresss'))
                ->required()
                ->columnSpan(3),
                
                FileUpload::make('attachment')
                ->uploadingMessage('Uploading attachment...')
                ->directory('form-attachments')
                ->visibility('public')
                ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                ->maxSize(5120)
                ->getUploadedFileNameForStorageUsing(
                    fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                        ->prepend('job_response-'),)
                ->openable()
                ->downloadable()
                ->fetchFileInformation(true)
                ->moveFiles()
                ->nullable()
                ->storeFiles(true)
                ->required()
                ->columnSpan(3)
                ->id('attachment-form')

        
                // ,
                // Hidden::make('attachment')

        
                ,
                ])
            // ->statePath('data')
            ->model(Response::class);
            
            
    }
    
    
    public function create(): void
    {
        // $this->validate();
        $response = Response::create($this->form->getState());
    
        
        // dd($this->form->getState());
    
        // Save the relationships from the form to the post after it is created.
        $this->form->model($response)->saveRelationships();

        $response->notify(new ResponseUpdate($response));
        
        // $post_title = 'test message';
        
        
        // $this->form->fill();
        
        $this->redirect('/job');
        
    }
    
//     public function toMail(object $notifiable): MailMessage
// {
//     // $url = url('/attachment/'.$this->attachment->id);
//     // Response::create($this->form->getState());
    
//     dd($this->form->toMail());
 
//     return (new MailMessage)->view('mail.mail',['attachment' => $this->attachment]);
        
// }
    

    public function render() 
    {
        return view('livewire.create-response');
        
    }
}
