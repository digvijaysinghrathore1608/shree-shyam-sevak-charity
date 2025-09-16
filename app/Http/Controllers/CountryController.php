<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Country;
use App\Repositories\CountryRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CountryController extends AppBaseController
{
    /**
     * @var CountryRepository
     */
    public $countryRepo;

    /**
     * @param  CountryRepository  $countryRepository
     */
    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepo = $countryRepository;
    }

    /**
     * @param  Request  $request
     * @return Application|Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        return view('admin.country.index');
    }

    /**
     * @param  CreateCountryRequest  $request
     * @return mixed
     */
    public function store(CreateCountryRequest $request)
    {
        $input = $request->all();
        $this->countryRepo->store($input);

        return $this->sendSuccess('Country saved successfully.');
    }

    /**
     * @param  Country  $country
     * @return mixed
     */
    public function edit(Country $country)
    {
        return $this->sendResponse($country, 'Country retrieved successfully.');
    }

    /**
     * @param  UpdateCountryRequest  $request
     * @param  Country  $country
     * @return mixed
     */
    public function update(UpdateCountryRequest $request, Country $country)
    {
        $input = $request->all();
        $this->countryRepo->update($input, $country->id);

        return $this->sendSuccess('Country updated successfully.');
    }

    /**
     * @param  Country  $country
     * @return mixed
     */
    public function destroy(Country $country)
    {
        $country->delete();

        return $this->sendSuccess('Country deleted successfully.');
    }
}
