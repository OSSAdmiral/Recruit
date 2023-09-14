<?php

namespace App\Livewire;

use App\Models\JobOpenings;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Title;
use Livewire\Component;

class CareerLandingPage extends Component
{
    public ?bool $showRemote = false;

    public ?array $jobTypeFilter = [];

    public array|Builder|null $jobTypeList = [];

    public array|Builder|Collection|null $jobsList = [];

    public function mount()
    {
        $this->jobsList = static::queryTable()->count() <= 0 ? [] : static::queryTable()->get();
        static::jobTypes();
        //        ddd($this->jobTypeList );
    }

    private static function queryTable(): Builder
    {
        return JobOpenings::jobStillOpen()->where('published_career_site', '=', true);
    }

    private function jobTypes(): void
    {
        $this->jobTypeList = static::queryTable()->count() < 0 ? [] : self::queryTable()->select(['JobType'])->distinct()->get()->toArray();
    }

    #[Title('Work with us')]
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.career-landing-page', [
            'jobLists' => $this->jobsList->toArray(),
            'jobTypes' => $this->jobTypeList,
        ]);
    }
}
