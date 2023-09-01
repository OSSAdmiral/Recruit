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

    private static function queryTable(): Builder
    {
        return JobOpenings::query()->where('published_career_site', '=', true);
    }

    private function jobTypes(): array|\Illuminate\Database\Eloquent\Collection
    {
       return $this->jobTypeList = $jobTypeList = self::queryTable()->select(['JobType'])->distinct()->get();
    }

    #[Title('Work with us')]
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.career-landing-page', [
            'jobTypeFilter' => $this->jobTypeList
        ]);
    }
}
