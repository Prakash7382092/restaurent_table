<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller as BaseController;

class AddressController extends BaseController
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Address::class, 'address');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $user = $request->user();

        $perPage = (int) $request->query('per_page', 25);
        $perPage = $perPage > 0 && $perPage <= 100 ? $perPage : 25;

        $allowedSorts = [
            'id',
            'created_at',
            'updated_at',
            'city',
            'state',
            'zip_code',
            'country',
            'is_default',
        ];

        $sortBy = $request->query('sort_by', 'created_at');
        if (! in_array($sortBy, $allowedSorts, true)) {
            $sortBy = 'created_at';
        }

        $sortDir = strtolower($request->query('sort_dir', 'desc')) === 'asc' ? 'asc' : 'desc';

        $addressesQuery = $user->addresses()->orderBy($sortBy, $sortDir);

        $addresses = $addressesQuery->paginate($perPage)->appends($request->query());

        return AddressResource::collection($addresses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddressRequest $request): JsonResponse
    {
        $user = $request->user();

        $payload = $request->validated();
        $payload['user_id'] = $user->id;

        if (! empty($payload['is_default'])) {
            $user->addresses()->where('is_default', true)->update(['is_default' => false]);
        }

        $address = Address::create($payload);

        $resource = new AddressResource($address);

        return $resource->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address, Request $request): AddressResource
    {
        return new AddressResource($address);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AddressRequest $request, Address $address): AddressResource
    {
        $payload = $request->validated();

        if (! empty($payload['is_default'])) {
            $address->user->addresses()->where('is_default', true)->update(['is_default' => false]);
        }

        $address->update($payload);

        return new AddressResource($address);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address): JsonResponse
    {
        $address->delete();

        return response()->json(['message' => 'Address deleted.']);
    }
}
