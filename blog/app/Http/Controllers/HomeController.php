<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function __construct(
        protected \App\Services\HomeService $homeService
    ) {
    }

    public function index()
    {
        $data = $this->homeService->getHomePageData();

        return view('home', $data);
    }
}
