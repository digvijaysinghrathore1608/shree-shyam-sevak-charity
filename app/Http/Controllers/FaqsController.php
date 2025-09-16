<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFaqsRequest;
use App\Http\Requests\UpdateFaqsRequest;
use App\Models\Faqs;
use App\Repositories\FaqsRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class FaqsController extends AppBaseController
{
    /**
     * @var FaqsRepository
     */
    public $faqsRepo;

    /**
     * @param  FaqsRepository  $faqsRepository
     */
    public function __construct(FaqsRepository $faqsRepository)
    {
        $this->faqsRepo = $faqsRepository;
    }

    /**
     * @param  Request  $request
     * @return Application|Factory|View
     *
     * @throws \Exception
     */
    public function index()
    {
        return view('admin.faqs.index');
    }

    /**
     * @param  CreateFaqsRequest  $request
     * @return mixed
     */
    public function store(CreateFaqsRequest $request)
    {
        $input = $request->all();

        $this->faqsRepo->store($input);

        return $this->sendSuccess('FAQs saved successfully.');
    }

    /**
     * @param  Faqs  $faq
     * @return mixed
     */
    public function edit(Faqs $faq)
    {
        return $this->sendResponse($faq, 'FAQs retrieved successfully.');
    }

    /**
     * @param  UpdateFaqsRequest  $request
     * @param  Faqs  $faq
     * @return mixed
     */
    public function update(UpdateFaqsRequest $request, Faqs $faq)
    {
        $input = $request->all();

        $this->faqsRepo->update($input, $faq->id);

        return $this->sendSuccess('FAQs updated successfully..');
    }

    /**
     * @param  Faqs  $faq
     * @return mixed
     */
    public function show(Faqs $faq)
    {
        return $this->sendResponse($faq, 'FAQ Retrieved Successfully.');
    }

    /**
     * @param  Faqs  $faq
     * @return mixed
     */
    public function destroy(Faqs $faq)
    {
        $faq->delete();

        return $this->sendSuccess('FAQs deleted successfully.');
    }
}
