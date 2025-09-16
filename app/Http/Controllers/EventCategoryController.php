<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEventCategoryRequest;
use App\Http\Requests\UpdateEventCategoryRequest;
use App\Models\Event;
use App\Models\EventCategory;
use App\Repositories\EventCategoryRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class EventCategoryController extends AppBaseController
{
    /**
     * @var ;
     */
    public $eventCategoryRepo;

    /**
     * @param  EventCategoryRepository  $eventCategoryRepository
     */
    public function __construct(EventCategoryRepository $eventCategoryRepository)
    {
        $this->eventCategoryRepo = $eventCategoryRepository;
    }

    /**
     * @param  Request  $request
     * @return Application|Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        return view('admin.event-category.index');
    }

    /**
     * @param  CreateEventCategoryRequest  $request
     * @return mixed
     */
    public function store(CreateEventCategoryRequest $request)
    {
        $input = $request->all();
        $input['is_active'] = (isset($input['is_active'])) ? 1 : 0;
        $this->eventCategoryRepo->store($input);

        return $this->sendSuccess('Event Category saved successfully.');
    }

    /**
     * @param  EventCategory  $eventCategory
     * @return mixed
     */
    public function edit(EventCategory $eventCategory)
    {
        $eventCategory->load('events');

        return $this->sendResponse($eventCategory, 'Event Category retrieved successfully.');
    }

    /**
     * @param  UpdateEventCategoryRequest  $request
     * @param  EventCategory  $eventCategory
     * @return mixed
     */
    public function update(UpdateEventCategoryRequest $request, EventCategory $eventCategory)
    {
        $input = $request->all();
        $input['is_active'] = (isset($input['is_active'])) ? 1 : 0;
        if (isset($input['is_active_true'])) {
            $input = Arr::except($input, ['is_active_true']);
            $input['is_active'] = 1;
        }
        $this->eventCategoryRepo->update($input, $eventCategory->id);

        return $this->sendSuccess('Event Category updated successfully.');
    }

    /**
     * @param  EventCategory  $eventCategory
     * @return mixed
     */
    public function destroy(EventCategory $eventCategory)
    {
        $event = Event::where('category_id', '=', $eventCategory->id)->exists();

        if (! $event) {
            $eventCategory->delete();

            return $this->sendSuccess('Event Category deleted successfully.');
        }

        return $this->sendError('Event Category cannot be deleted.');
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function changeCategoryStatus(Request $request): JsonResponse
    {
        $eventCategory = EventCategory::findOrFail($request->get('id'));
        $eventCategory->is_active = ($eventCategory->is_active == 0) ? '1' : '0';
        $eventCategory->save();

        return $this->sendResponse($eventCategory, 'Status updated successfully.');
    }
}
