<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\ContactInformation;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class ContactInformationController extends Controller
{
    public function index(): JsonResponse
    {
        $contacts = ContactInformation::all();
        return response()->json($contacts);
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:contact_information',
                'phone_number' => 'nullable|numeric',
            ]);

            $contact = ContactInformation::create($validatedData);

            return response()->json($contact, 201);
        } catch (ValidationException $e) {

            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:contact_information,email,' . $id,
                'phone_number' => 'nullable|numeric',
            ]);

            $contact = ContactInformation::findOrFail($id);
            $contact->update($validatedData);

            return response()->json($contact, 200);
        } catch (ValidationException $e) {

            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {

            return response()->json(['message' => 'Error updating contact'], 500);
        }
    }

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
