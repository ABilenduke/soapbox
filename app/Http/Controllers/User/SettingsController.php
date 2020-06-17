<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function index()
    {
        return response()->json(['settings' => request()->user()->settings], 200);
    }

    public function show($setting)
    {
        return response()->json(['settings' => request()->user->settings()->pluck($setting)], 200);
    }

    public function update()
    {
        $validator = Validator::make(request()->all(), [
            'dark_mode' => ['boolean'],
            'locale' => ['string', 'max:5'],
            'receive_notification_emails' => ['boolean'],
            'receive_promotional_emails' => ['boolean'],
            'account_is_public' => ['boolean'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'invalid_settings',
                'errors' => $validator->errors()
            ], 400);
        }

        request()->user()->settings()->update(request()->all());

        return response()->json(['message' => 'settings_updated'], 200);
    }
}
