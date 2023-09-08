<?php

namespace App\Livewire;

use App\Models\JobOpenings;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Title;
use Livewire\Component;

class CareerLandingPage extends Component
{
    public ?bool $showRemote = false;

    public ?array $jobTypeFilter = [];

    public array|Builder|null $jobTypeList = [];

    public array|Builder|null $jobsList = [];

    public function mount()
    {
        $this->jobsList = static::queryTable()->count() <= 0 ? [] : static::queryTable()->get()->toArray();
    }

    private static function queryTable(): Builder
    {
        return JobOpenings::jobStillOpen()->where('published_career_site', '=', true);
    }

    private function jobTypes(): array|\Illuminate\Database\Eloquent\Collection
    {
        return $this->jobTypeList = static::queryTable()->count() > 0 ? [] : self::queryTable()->select(['JobType'])->distinct()->get()->toArray();
    }

    #[Title('Work with us')]
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.career-landing-page', [
            'jobList' => $this->jobsList,
        ]);
    }
}
