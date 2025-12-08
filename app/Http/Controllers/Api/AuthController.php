<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterCustomerRequest;
use App\Http\Requests\RegisterVendorRequest;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Register a new customer
     */
    public function registerCustomer(RegisterCustomerRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'customer',
            'status' => 'active',
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Customer registered successfully',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    /**
     * Register a new vendor (with vendor profile)
     */
    public function registerVendor(RegisterVendorRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'role' => 'vendor',
                'status' => 'pending_approval',
            ]);

            Vendor::create([
                'user_id' => $user->id,
                'store_name' => $request->store_name,
                'store_description' => $request->store_description,
                'store_location' => $request->store_location,
                'store_contact' => $request->store_contact,
            ]);

            DB::commit();

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Vendor registration submitted. Awaiting approval.',
                'user' => $user->load('vendor'),
                'token' => $token,
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Registration failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Login user (works for all roles)
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (! Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user = User::where('email', $request->email)->first();

        if ($user->status === 'blocked') {
            return response()->json([
                'message' => 'Your account has been blocked.',
            ], 403);
        }

        if ($user->role === 'vendor' && $user->status === 'pending_approval') {
            return response()->json([
                'message' => 'Your vendor account is pending approval.',
            ], 403);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'user' => $user->load($user->role === 'vendor' ? 'vendor' : []),
            'token' => $token,
        ]);
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully',
        ]);
    }

    /**
     * Get authenticated user
     */
    public function me(Request $request)
    {
        $user = $request->user();

        if ($user->role === 'vendor') {
            $user->load('vendor');
        }

        return response()->json($user);
    }

    /**
     * Forgot password
     */
    public function forgotPassword(Request $request) {}

    /**
     * Reset password
     */
    public function resetPassword(Request $request) {}
}
