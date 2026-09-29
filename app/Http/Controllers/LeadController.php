<?php

namespace App\Http\Controllers;

use App\Mail\LeadMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class LeadController extends Controller
{
    public function store(LeadRequest $request): RedirectResponse
    {
        $URL = url()->previous();

        $data = $request->safe()->except(['agree', 'company']);
        $data['url'] = $URL;

        try {
            Mail::to(env('MAIL_FROM_ADDRESS', 'hello@example.com'))->send(new LeadMail($data));
        } catch (\Throwable $e) {
            Log::error('Не удалось отправить письмо о заявке: ' . $e->getMessage());
        }

        return back()->with('success', 'Спасибо! Заявка принята, мы свяжемся с вами.');
    }

}
