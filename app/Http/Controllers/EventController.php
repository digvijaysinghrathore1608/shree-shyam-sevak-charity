<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\EventParticipant;
use App\Repositories\EventRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Laracasts\Flash\Flash;

class EventController extends AppBaseController
{
    /**
     * @var EventRepository
     */
    public $eventRepo;

    /**
     * @param  EventRepository  $eventRepository
     */
    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepo = $eventRepository;
    }

    /**
     * @param  Request  $request
     * @return Application|Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        return view('admin.events.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $events = EventCategory::where('is_active', 1)->pluck('name', 'id');

        return view('admin.events.create', compact('events'));
    }

    /**
     * @param  CreateEventRequest  $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateEventRequest $request)
    {
        $input = $request->all();
        $this->eventRepo->store($input);

        Flash::success('Event created successfully.');

        return redirect(route('events.index'));
    }

    /**
     * @return Application|Factory|View
     */
    public function edit(Event $event)
    {
        $events = EventCategory::where('is_active', 1)->pluck('name', 'id');

        return view('admin.events.edit', compact('events', 'event'));
    }

    /**
     * @param  UpdateEventRequest  $request
     * @param  Event  $event
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $this->eventRepo->update($request->all(), $event->id);

        Flash::success('Event updated successfully.');

        return redirect(route('events.index'));
    }

    /**
     * @param  Event  $event
     * @return mixed
     */
    public function destroy(Event $event)
    {
        $eventParticipantCount = EventParticipant::where('event_id', $event->id)->count();

        if ($eventParticipantCount > 0) {
            return $this->sendError('Registered Event can\'t be deleted.');
        }
        $event->delete();

        return $this->sendSuccess('Event deleted successfully.');
    }

    /**
     * @param  Event  $event
     * @return Application|Factory|View
     */
    public function show(Event $event)
    {
        return view('admin.events.show', compact('event'));
    }

    /**
     * @return Application|Factory|View
     */
    public function getEventList($id = null)
    {
        if ($id) {
            $eventCategoryId = $id;
        } else {
            $eventCategoryId = '';
        }

        $eventCategories = EventCategory::withCount('events')->get();

        return view('front_landing.events', compact('eventCategories', 'eventCategoryId'));
    }

    /**
     * @param  Event  $event
     * @return Application|Factory|View
     */
    public function eventDetail(Event $event)
    {
        return view('front_landing.events_detail', compact('event'));
    }

    /**
     * @param  CreateBookRequest  $request
     * @return JsonResponse
     */
    public function bookSeat(CreateBookRequest $request)
    {
        $seatCount = Event::where('id', '=', $request->event_id)->first();

        if ($seatCount->available_tickets == 0) {
            return $this->sendError('Sorry !! Seats Already Full.');
        } else {
            $exist = EventParticipant::where('event_id', '=', $request->event_id)->where('email', '=',
                $request->email)->exists();
            if ($exist) {
                return $this->sendError('You have already registered for this event.');
            }
            $input = $request->all();
            EventParticipant::create($input);

            $seatUpdate = Event::where('id', '=', $request->event_id)->first();
            $seatUpdate->available_tickets = $seatUpdate->available_tickets - 1;
            $seatUpdate->save();

            return $this->sendSuccess('Seat Booked successfully.');
        }
    }

    /**
     * @param  Request  $request
     * @return Application|Factory|View
     *
     * @throws \Exception
     */
    public function showParticipateList($id)
    {
        return view('admin.events.event_participate', compact('id'));
    }

    /**
     * @param  EventParticipant  $eventParticipant
     * @return JsonResponse
     */
    public function destroyParticipate(EventParticipant $eventParticipant)
    {
        $eventParticipant->delete();

        $event = Event::whereId($eventParticipant->event_id)->first()->only('available_tickets');
        $availableTickets = $event['available_tickets'] + 1;
        Event::whereId($eventParticipant->event_id)->update([
            'available_tickets' => $availableTickets,
        ]);

        return $this->sendSuccess('Event Participant deleted successfully.');
    }
}
