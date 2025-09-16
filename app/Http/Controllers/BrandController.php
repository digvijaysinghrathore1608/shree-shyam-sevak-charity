<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use App\Repositories\BrandRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BrandController extends AppBaseController
{
    /**
     * @var BrandRepository
     */
    public BrandRepository $brandRepo;

    /**
     * @param  BrandRepository  $brandRepository
     */
    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepo = $brandRepository;
    }

    /**
     * @param  Request  $request
     * @return Application|Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        return view('admin.brands.index');
    }

    /**
     * @param  CreateBrandRequest  $request
     * @return JsonResponse
     */
    public function store(CreateBrandRequest $request)
    {
        $input = $request->all();
        $this->brandRepo->store($input);

        return $this->sendSuccess('Brand saved successfully.');
    }

    /**
     * @param  Brand  $brand
     * @return JsonResponse
     */
    public function edit(Brand $brand)
    {
        return $this->sendResponse($brand, 'Brand retrieved successfully.');
    }

    /**
     * @param  UpdateBrandRequest  $request
     * @param  Brand  $brand
     * @return JsonResponse
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $input = $request->all();
        $this->brandRepo->update($input, $brand->id);

        return $this->sendSuccess('Brand updated successfully.');
    }

    /**
     * @param  brand  $brand
     * @return JsonResponse
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();

        return $this->sendSuccess('Brand successfully.');
    }
}
