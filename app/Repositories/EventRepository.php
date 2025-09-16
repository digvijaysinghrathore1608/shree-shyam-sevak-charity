<?php

namespace App\Repositories;

use App\Models\Event;

/**
 * Class EventRepository
 */
class EventRepository extends BaseRepository
{
    public $fieldSearchable = [
        'title',
        'description',
        'event_date',
        'start_time',
        'end_time',
        'available_tickets',
        'event_organizer_name',
        'event_organizer_email',
        'event_organizer_phone',
        'event_organizer_website',
        'venue',
        'venue_location',
        'venue_phone',
        'status',
    ];

    /**
     * {@inheritDoc}
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * {@inheritDoc}
     */
    public function model()
    {
        return Event::class;
    }

    public function store($input)
    {
        $event = Event::create($input);

        if (isset($input['image']) && ! empty($input['image'])) {
            $event->addMedia($input['image'])->toMediaCollection(Event::PATH, config('app.media_disc'));
        }

        return $event;
    }

    /**
     * @param $input
     * @param $id
     * @return bool
     */
    public function update($input, $id)
    {
        $event = Event::findOrFail($id);

        $event->update($input);

        if (isset($input['image']) && ! empty($input['image'])) {
            $event->clearMediaCollection(Event::PATH);
            $event->addMedia($input['image'])->toMediaCollection(Event::PATH,
                config('app.media_disc'));
        }

        return $event;
    }
}
