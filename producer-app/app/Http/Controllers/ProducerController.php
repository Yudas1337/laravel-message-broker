<?php

namespace App\Http\Controllers;

use App\Services\ProducerMessageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProducerController extends Controller
{
    public function __construct(
        private readonly ProducerMessageService $service
    )
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function index(Request $request): RedirectResponse
    {
        $message = $request->message;
        $this->service->sendMessage('hello-queue', $message);

        return back()->with('message', 'Message sent successfully!');
    }
}
