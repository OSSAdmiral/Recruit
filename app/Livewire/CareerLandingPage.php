<?php

namespace App\Livewire;

use App\Models\JobOpenings;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Title;
use Livewire\Component;

class CareerLandingPage extends Component
{
    public ?bool $showRemote;
    public ?array $jobTypeFilter;
    protected static array|Builder|null $jobTypeList;

    private static function queryTable(): Builder
    {
        return JobOpenings::query()->where('published_career_site', '=', true);
    }
    private static function jobTypes(): array|\Illuminate\Database\Eloquent\Collection
    {
        return self::$jobTypeList = self::queryTable()->select(['JobType'])->distinct()->get();
    }

    #[Title('Work with us')]
    public function render()
    {
        return view('livewire.career-landing-page');
    }
}
