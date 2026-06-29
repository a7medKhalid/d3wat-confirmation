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
            return $this->handleDirectShow($request);
        }

        return $this->handleSessionShow($request);
    }

    public function respond(Request $request)
    {
        $action = $request->input('action');

        if (! in_array($action, ['confirm', 'decline'], true)) {
            return view('confirm.invalid', [
                'message' => 'يرجى اختيار تأكيد الحضور أو الاعتذار',
            ]);
        }

        if ($request->filled('phone')) {
            return $this->handleDirectRespond($request, $action);
        }

        return $this->handleSessionRespond($request, $action);
    }

    private function handleDirectShow(Request $request)
    {
        [$phone, $error] = $this->phoneNormalizer->normalize($request->query('phone'));

        if ($error !== '') {
            return view('confirm.invalid', ['message' => $error]);
        }

        $name = trim((string) $request->query('name', ''));

        if ($name === '') {
            return view('confirm.invalid', ['message' => 'الاسم غير متوفر في الرابط']);
        }

        $confirmation = Confirmation::query()
            ->where('mode', Confirmation::MODE_DIRECT)
            ->where('phone', $phone)
            ->first();

        if (! $confirmation) {
            $confirmation = Confirmation::query()->create([
                'phone' => $phone,
                'name' => $name,
                'mode' => Confirmation::MODE_DIRECT,
                'status' => Confirmation::STATUS_VISITED,
                'visited_at' => now(),
                'ip_address' => $request->ip(),
            ]);
        }

        return $this->renderAfterVisit($confirmation, $name, null);
    }

    private function handleSessionShow(Request $request)
    {
        $session = ConfirmationSession::active();

        if (! $session) {
            return view('confirm.inactive');
        }

        $visitorKey = $this->visitorKey($request);

        $confirmation = Confirmation::query()
            ->where('confirmation_session_id', $session->id)
            ->where('visitor_key', $visitorKey)
            ->first();

        if (! $confirmation) {
            try {
                $confirmation = DB::transaction(function () use ($session, $visitorKey, $request) {
                    return Confirmation::query()->create([
                        'confirmation_session_id' => $session->id,
                        'visitor_key' => $visitorKey,
                        'mode' => Confirmation::MODE_SESSION,
                        'status' => Confirmation::STATUS_VISITED,
                        'visited_at' => now(),
                        'ip_address' => $request->ip(),
                    ]);
                });
            } catch (\Illuminate\Database\QueryException) {
                $confirmation = Confirmation::query()
                    ->where('confirmation_session_id', $session->id)
                    ->where('visitor_key', $visitorKey)
                    ->firstOrFail();
            }
        }

        return $this->renderAfterVisit($confirmation, null, $session->title);
    }

    private function handleDirectRespond(Request $request, string $action)
    {
        [$phone, $error] = $this->phoneNormalizer->normalize($request->input('phone'));

        if ($error !== '') {
            return view('confirm.invalid', ['message' => $error]);
        }

        $name = trim((string) $request->input('name', ''));

        if ($name === '') {
            return view('confirm.invalid', ['message' => 'الاسم غير متوفر']);
        }

        $confirmation = Confirmation::query()
            ->where('mode', Confirmation::MODE_DIRECT)
            ->where('phone', $phone)
            ->first();

        if (! $confirmation) {
            $confirmation = Confirmation::query()->create([
                'phone' => $phone,
                'name' => $name,
                'mode' => Confirmation::MODE_DIRECT,
                'status' => Confirmation::STATUS_VISITED,
                'visited_at' => now(),
                'ip_address' => $request->ip(),
            ]);
        }

        return $this->applyResponse($confirmation, $action, $name, null);
    }

    private function handleSessionRespond(Request $request, string $action)
    {
        $session = ConfirmationSession::active();

        if (! $session) {
            return view('confirm.inactive');
        }

        $visitorKey = $this->visitorKey($request);

        $confirmation = Confirmation::query()
            ->where('confirmation_session_id', $session->id)
            ->where('visitor_key', $visitorKey)
            ->first();

        if (! $confirmation) {
            $confirmation = Confirmation::query()->create([
                'confirmation_session_id' => $session->id,
                'visitor_key' => $visitorKey,
                'mode' => Confirmation::MODE_SESSION,
                'status' => Confirmation::STATUS_VISITED,
                'visited_at' => now(),
                'ip_address' => $request->ip(),
            ]);
        }

        return $this->applyResponse($confirmation, $action, null, $session->title);
    }

    private function renderAfterVisit(Confirmation $confirmation, ?string $name, ?string $sessionTitle)
    {
        if ($confirmation->status === Confirmation::STATUS_CONFIRMED) {
            return view('confirm.confirmed', [
                'name' => $name ?? $confirmation->name,
                'sessionTitle' => $sessionTitle,
            ]);
        }

        if ($confirmation->status === Confirmation::STATUS_DECLINED) {
            return view('confirm.declined', [
                'name' => $name ?? $confirmation->name,
                'sessionTitle' => $sessionTitle,
            ]);
        }

        return view('confirm.choose', [
            'name' => $name ?? $confirmation->name,
            'sessionTitle' => $sessionTitle,
            'phone' => $confirmation->phone,
            'isDirect' => $confirmation->mode === Confirmation::MODE_DIRECT,
        ]);
    }

    private function applyResponse(Confirmation $confirmation, string $action, ?string $name, ?string $sessionTitle)
    {
        if ($confirmation->hasResponded()) {
            return $this->renderAfterVisit($confirmation, $name ?? $confirmation->name, $sessionTitle);
        }

        $status = $action === 'confirm'
            ? Confirmation::STATUS_CONFIRMED
            : Confirmation::STATUS_DECLINED;

        $confirmation->update([
            'status' => $status,
            'name' => $name ?? $confirmation->name,
            'responded_at' => now(),
            'confirmed_at' => $status === Confirmation::STATUS_CONFIRMED ? now() : null,
            'ip_address' => request()->ip(),
        ]);

        return $this->renderAfterVisit($confirmation->fresh(), $name ?? $confirmation->name, $sessionTitle);
    }

    private function visitorKey(Request $request): string
    {
        return hash('sha256', $request->session()->getId());
    }
}
