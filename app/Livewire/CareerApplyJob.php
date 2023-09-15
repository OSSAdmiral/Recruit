<?php

namespace App\Livewire;

use AbanoubNassem\FilamentGRecaptchaField\Forms\Components\GRecaptcha;
use Afatmustafa\FilamentTurnstile\Forms\Components\Turnstile;
use App\Models\JobOpenings;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Attributes\Title;
use Livewire\Component;

class CareerApplyJob extends Component implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    public ?array $data = ['attachment' => null];

    public $captcha = '';

    public static ?JobOpenings $jobDetails;

    public ?string $referenceNumber;

    public function mount($jobReferenceNumber)
    {
        // search for the job reference number, if not valid, redirect to all job
        $this->jobOpeningDetails($jobReferenceNumber);
        $this->referenceNumber = $jobReferenceNumber;

    }

    public function updated()
    {
        $this->jobOpeningDetails($this->referenceNumber);
    }

    private function jobOpeningDetails($reference): void
    {
        static::$jobDetails = JobOpenings::jobStillOpen()->where('JobOpeningSystemID', '=', $reference)->first();
        if (! static::$jobDetails) {
            // redirect back as the job opening is closed or tampered id or not existing
            Notification::make()
                ->title('Job Opening is already closed or doesn\'t exist.')
                ->icon('heroicon-o-x-circle')
                ->iconColor('warning')
                ->send();
           $this->redirectRoute('career.landing_page');
        }
    }

    public function create(): void
    {
        dd($this->form->getState());
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Application')
                        ->icon('heroicon-o-user')
                        ->columns(2)
                        ->schema(array_merge($this->applicationStepWizard(),
                            [Forms\Components\Grid::make('1')->schema($this->captchaField())]
                        )),
                    Wizard\Step::make('Assessment')
                        ->visible(false)
                        ->icon('heroicon-o-user')
                        ->columns(2)
                        ->schema(array_merge([], $this->assessmentStepWizard())),
                ])
                    ->nextAction(
                        fn (Action $action) => $action->view('career-form.apply-job-components.NextActionButton'),
                    )
                    ->submitAction(view('career-form.apply-job-components.SubmitApplicationButton')),
            ]);
    }

    private function assessmentStepWizard(): Wizard\Step|array
    {
        return [];
    }

    private function applicationStepWizard(): array
    {
        return
            [
                Forms\Components\Section::make('Basic Information')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('FirstName')
                            ->required()
                            ->label('First Name'),
                        Forms\Components\TextInput::make('LastName')
                            ->required()
                            ->label('Last Name'),
                        Forms\Components\TextInput::make('mobile')
                            ->required(),
                        Forms\Components\TextInput::make('Email')
                            ->required()
                            ->email(),
                    ]),
                Forms\Components\Section::make('Address Information')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('Street'),
                        Forms\Components\TextInput::make('City'),
                        Forms\Components\TextInput::make('Country'),
                        Forms\Components\TextInput::make('ZipCode'),
                        Forms\Components\TextInput::make('State'),
                    ]),
                Forms\Components\Section::make('Professional Details')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('CurrentEmployer')
                            ->label('Current Employer (Company Name)'),
                        Forms\Components\TextInput::make('CurrentJobTitle')
                            ->label('Current Job Title'),
                        Forms\Components\Select::make('experience')
                            ->options([
                                '1year' => '1year',
                                '2year' => '2 Years',
                                '3year' => '3 Years',
                                '4year' => '4 Years',
                                '5year' => '5 Years',
                                '6year' => '6 Years',
                                '7year' => '7 Years',
                                '8year' => '8 Years',
                                '9year' => '9 Years',
                                '10year+' => '10 Years & Above',
                            ])
                            ->label('Experience'),
                    ]),
                Forms\Components\Section::make('Educational Details')
                    ->schema([
                        Forms\Components\Repeater::make('School')
                            ->label('')
                            ->addActionLabel('+ Add Degree Information')
                            ->schema([
                                Forms\Components\TextInput::make('school_name')
                                    ->required(),
                                Forms\Components\TextInput::make('major')
                                    ->required(),
                                Forms\Components\Select::make('duration')
                                    ->options([
                                        '4years' => '4 Years',
                                        '5years' => '5 Years',
                                    ])
                                    ->required(),
                                Forms\Components\Checkbox::make('pursuing')
                                    ->inline(false),
                            ])
                            ->deletable(true)
                            ->columns(4),
                    ]),
                Forms\Components\Section::make('Experience Details')
                    ->schema([
                        Forms\Components\Repeater::make('ExperienceDetails')
                            ->label('')
                            ->addActionLabel('Add Experience Details')
                            ->schema([
                                Forms\Components\Checkbox::make('current')
                                    ->label('Current?')
                                    ->inline(false),
                                Forms\Components\TextInput::make('company_name'),
                                Forms\Components\TextInput::make('duration'),
                                Forms\Components\TextInput::make('role'),
                                Forms\Components\Textarea::make('company_address'),
                            ])
                            ->deletable(true)
                            ->columns(5),
                    ]),
                Forms\Components\FileUpload::make('attachment')
                    ->preserveFilenames()
                    ->directory('JobCandidate-attachments')
                    ->visibility('private')
                    ->openable()
                    ->downloadable()
                    ->previewable()
                    ->acceptedFileTypes([
                        'application/pdf',
                    ])
                    ->required()
                    ->label('Resume'),
            ];
    }

    private function captchaField(): array
    {
        if (! config('recruit.enable_captcha')) {
            return [];
        }
        if (config('recruit.enable_captcha') && config('recruit.captcha_provider') === 'Google') {
            return [GRecaptcha::make('captcha')];
        }
        if (config('recruit.enable_captcha') && config('recruit.captcha_provider_name') === 'Cloudflare') {
            return [
                Turnstile::make('turnstile')
                    ->theme('light')
                    ->size('normal')
                    ->language('en-US')
            ];
        }
    }

    #[Title('Apply Job ')]
    public function render()
    {
        return view('livewire.career-apply-job', [
            'jobDetail' => static::$jobDetails,
        ]);
    }
}
