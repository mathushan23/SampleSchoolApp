<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactModel;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserConfirmationMail;
use App\Mail\AdminNotificationMail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'fullName' => 'required|string|max:255',
                'isOldStudent' => 'boolean',
                'email' => 'required|email',
                'mobile' => 'nullable|string|max:20',
                'message' => 'required|string',
            ]);

            // Save to DB
            $contact = ContactModel::create([
                'full_name' => $validated['fullName'],
                'is_old_student' => $validated['isOldStudent'] ?? false,
                'email' => $validated['email'],
                'mobile' => $validated['mobile'] ?? null,
                'message' => $validated['message'],
                'is_read' => false,
            ]);

            // Send email to user
            try {
                Mail::to($validated['email'])->send(new UserConfirmationMail($validated));
            } catch (\Exception $e) {
                \Log::error('User email sending failed: '.$e->getMessage());
            }

            // Send email to admin
            try {
                $adminEmail = config('mail.from.address'); // or put your admin email
                Mail::to($adminEmail)->send(new AdminNotificationMail($validated));
            } catch (\Exception $e) {
                \Log::error('Admin email sending failed: '.$e->getMessage());
            }

            return response()->json([
                'message' => 'Contact saved successfully!',
                'data' => $contact
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
