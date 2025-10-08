<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class AuthenticatedUserController extends Controller
{
    /**
     * Return the currently authenticated user.
     */
    public function me(Request $request)
    {
        return new UserResource($request->user());
    }

    /**
     * Revoke the current access token (logout from this device/session).
     */
    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken();
        if ($token) {
            $token->delete();
        }
        return response()->json(['message' => 'Logged out']);
    }

    /**
     * Revoke all access tokens for the user (logout from all devices).
     */
    public function logoutAll(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out from all devices']);
    }
}
