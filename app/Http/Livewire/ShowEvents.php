<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class ShowEvents extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $eventCategory = '';

    protected $listeners = ['changeFilter', 'resetFilter'];

    /**
     * @param $param
     * @param $value
     */
    public function changeFilter($param, $value)
    {
        $this->reset();

        $this->$param = $value;
    }

    public function resetFilter()
    {
        $this->reset();
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        $events = $this->eventCategoryWise();

        return view('livewire.show-events', compact('events'));
    }

    /**
     * @return mixed
     */
    public function eventCategoryWise()
    {
        /** @var Event $query */
        $query = Event::with('eventCategory');

        $query->when(! empty($this->eventCategory), function (Builder $q) {
            $q->where('category_id', '=', $this->eventCategory);
        });

        return $query->paginate(6);
    }
}
