<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use App\Models\ContactInformation;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use Illuminate\Validation\ValidationException;

class ContactInformationController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $contacts = ContactInformation::all();
        return response()->json($contacts);
    }

    /**
     * @param ContactRequest $request
     * @return JsonResponse
     */
    public function store(ContactRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $contact = ContactInformation::create($validatedData);

            return response()->json($contact, 201);
        } catch (ValidationException $e) {

            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    /**
     * @param ContactRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(ContactRequest $request, $id): JsonResponse
    {
        try {
            $contact = ContactInformation::findOrFail($id);
            $validatedData = $request->validated();
            $contact->update($validatedData);

            return response()->json($contact, 200);
        } catch (ValidationException $e) {

            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {

            return response()->json(['message' => 'Error updating contact'], 500);
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $contact = ContactInformation::find($id);

        if (!$contact) {
            return response()->json(['message' => 'Contact not found'], 404);
        }

        $contact->delete();

        return response()->json(['message' => 'Contact deleted successfully']);
    }
}
