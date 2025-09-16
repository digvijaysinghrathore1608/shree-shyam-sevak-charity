<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmailSubscribeRequest;
use App\Models\EmailSubscribe;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class EmailSubscribeController extends AppBaseController
{
    /**
     * @param  Request  $request
     * @return Application|Factory|View
     *
     * @throws \Exception
     */
    public function index()
    {
        return view('admin.email_subscribe.index');
    }

    /**
     * @param  CreateEmailSubscribeRequest  $request
     * @return mixed
     */
    public function store(CreateEmailSubscribeRequest $request)
    {
        EmailSubscribe::create($request->all());

        return $this->sendSuccess('Subscribed successfully.');
    }

    /**
     * @param  EmailSubscribe  $emailSubscribe
     * @return mixed
     */
    public function destroy(EmailSubscribe $emailSubscribe)
    {
        $emailSubscribe->delete();

        return $this->sendSuccess('Email deleted successfully.');
    }
}
