<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactModel;

class ContactAdminController extends Controller
{
    // Show all messages (unread first, then by time)
    public function index()
    {
        $messages = ContactModel::orderBy('is_read')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($messages);
    }

    // Mark a single message as read
    public function markAsRead($id)
    {
        $message = ContactModel::findOrFail($id);

        if (!$message->is_read) {
            $message->is_read = true;
            $message->save();
        }

        return response()->json([
            'ok' => true,
            'message' => 'Message marked as read.',
            'data' => $message
        ]);
    }
}
