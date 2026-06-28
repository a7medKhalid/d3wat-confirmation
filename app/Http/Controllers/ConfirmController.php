<?php

namespace App\Http\Controllers;

use App\Models\Confirmation;
use App\Models\ConfirmationSession;
use App\Services\KsaPhoneNormalizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConfirmController extends Controller
{
    public function __construct(private readonly KsaPhoneNormalizer $phoneNormalizer) {}

    public function show(Request $request)
    {
        if ($request->filled('phone')) {
            return $this->handleDirect($request);
        }

        return $this->handleSession($request);
    }

    private function handleDirect(Request $request)
    {
        [$phone, $error] = $this->phoneNormalizer->normalize($request->query('phone'));

        if ($error !== '') {
            return view('confirm.invalid', [
                'message' => $error,
            ]);
        }

        $name = trim((string) $request->query('name', ''));

        if ($name === '') {
            return view('confirm.invalid', [
                'message' => 'الاسم غير متوفر في الرابط',
            ]);
        }

        $existing = Confirmation::query()
            ->where('mode', Confirmation::MODE_DIRECT)
            ->where('phone', $phone)
            ->first();

        if ($existing) {
            return view('confirm.already-confirmed', [
                'name' => $existing->name,
                'sessionTitle' => null,
            ]);
        }

        Confirmation::query()->create([
            'phone' => $phone,
            'name' => $name,
            'mode' => Confirmation::MODE_DIRECT,
            'confirmed_at' => now(),
            'ip_address' => $request->ip(),
        ]);

        return view('confirm.confirmed', [
            'name' => $name,
            'sessionTitle' => null,
        ]);
    }

    private function handleSession(Request $request)
    {
        $session = ConfirmationSession::active();

        if (! $session) {
            return view('confirm.inactive');
        }

        $visitorKey = hash('sha256', $request->session()->getId());

        $existing = Confirmation::query()
            ->where('confirmation_session_id', $session->id)
            ->where('visitor_key', $visitorKey)
            ->first();

        if ($existing) {
            return view('confirm.already-confirmed', [
                'name' => null,
                'sessionTitle' => $session->title,
            ]);
        }

        try {
            DB::transaction(function () use ($session, $visitorKey, $request): void {
                Confirmation::query()->create([
                    'confirmation_session_id' => $session->id,
                    'visitor_key' => $visitorKey,
                    'mode' => Confirmation::MODE_SESSION,
                    'confirmed_at' => now(),
                    'ip_address' => $request->ip(),
                ]);
            });
        } catch (\Illuminate\Database\QueryException) {
            return view('confirm.already-confirmed', [
                'name' => null,
                'sessionTitle' => $session->title,
            ]);
        }

        return view('confirm.confirmed', [
            'name' => null,
            'sessionTitle' => $session->title,
        ]);
    }
}
