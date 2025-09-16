<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Models\Team;
use App\Models\VideoSection;
use App\Repositories\TeamRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Response;

class TeamController extends AppBaseController
{
    /** @var TeamRepository */
    private TeamRepository $teamRepository;

    public function __construct(TeamRepository $teamRepo)
    {
        $this->teamRepository = $teamRepo;
    }

    /**
     * Display a listing of the Team.
     *
     * @param  Request  $request
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        return view('admin.teams.index');
    }

    /**
     * Store a newly created Team in storage.
     *
     * @param  CreateTeamRequest  $request
     * @return JsonResponse
     */
    public function store(CreateTeamRequest $request)
    {
        $input = $request->all();

        $team = $this->teamRepository->store($input);

        return $this->sendSuccess('Team member saved successfully.');
    }

    /**
     * Display the specified Team.
     *
     * @param  Team  $team
     * @return Application|Factory|View
     */
    public function show(Team $team)
    {
        return view('admin.teams.show')->with('team', $team);
    }

    /**
     * Show the form for editing the specified Team
     *
     * @param  Team  $teamMember
     * @return JsonResponse
     */
    public function edit(Team $teamMember)
    {
        return $this->sendResponse($teamMember, 'Team member retrieved successfully');
    }

    /**
     * Update the specified Team in storage.
     *
     * @param  UpdateTeamRequest  $request
     * @param  Team  $team
     * @return JsonResponse
     */
    public function update(UpdateTeamRequest $request, Team $team)
    {
        $team = $this->teamRepository->update($request->all(), $team->id);

        return $this->sendSuccess('Team member updated successfully.');
    }

    /**
     * Remove the specified Team from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $team = $this->teamRepository->find($id);

        $team->delete();

        return $this->sendSuccess('Team deleted successfully.');
    }

    /**
     * @return Application|Factory|View
     */
    public function getTeam()
    {
        $teams = Team::all();
        $video = VideoSection::pluck('value', 'key');

        return view('front_landing.teams', compact('teams', 'video'));
    }
}
