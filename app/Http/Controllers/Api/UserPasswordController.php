<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Services\UserPasswordService;
use Illuminate\Http\Request;

class UserPasswordController extends Controller
{
    protected UserPasswordService $passwordService;

    public function __construct(UserPasswordService $passwordService)
    {
        $this->passwordService = $passwordService;
    }

    public function update(UpdatePasswordRequest $request)
    {
        $user = $request->user();
        $updated = $this->passwordService->updatePassword(
            $user,
            $request->input('current_password'),
            $request->input('new_password')
        );
        if (!$updated) {
            return response()->json(['message' => 'Mevcut şifre yanlış!'], 422);
        }
        return response()->json(['message' => 'Şifreniz başarıyla güncellendi!']);
    }
}
