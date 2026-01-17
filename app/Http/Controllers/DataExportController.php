<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller;

class DataExportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Export all user data in JSON format (RODO/GDPR compliance)
     */
    public function exportUserData(Request $request)
    {
        $user = auth()->user();
        
        // Zbierz wszystkie dane użytkownika
        $userData = [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'interests' => $user->interests,
                'support_preferences' => $user->support_preferences,
                'specialization' => $user->specialization,
                'description' => $user->description,
                'is_suspended' => $user->is_suspended,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ],
            'facilities' => $user->facilities()->get()->map(function ($facility) {
                return [
                    'id' => $facility->id,
                    'name' => $facility->name,
                    'type' => $facility->type,
                    'address' => $facility->address,
                    'city' => $facility->city,
                    'province' => $facility->province,
                    'postal_code' => $facility->postal_code,
                    'phone' => $facility->phone,
                    'email' => $facility->email,
                    'website' => $facility->website,
                    'description' => $facility->description,
                    'created_at' => $facility->created_at,
                ];
            }),
            'reviews' => $user->reviews()->get()->map(function ($review) {
                return [
                    'id' => $review->id,
                    'facility_id' => $review->facility_id,
                    'rating' => $review->rating,
                    'comment' => $review->comment,
                    'created_at' => $review->created_at,
                ];
            }),
            'forum_topics' => $user->forumTopics()->get()->map(function ($topic) {
                return [
                    'id' => $topic->id,
                    'title' => $topic->title,
                    'forum_category_id' => $topic->forum_category_id,
                    'created_at' => $topic->created_at,
                ];
            }),
            'forum_posts' => $user->forumPosts()->get()->map(function ($post) {
                return [
                    'id' => $post->id,
                    'forum_topic_id' => $post->forum_topic_id,
                    'body' => $post->body,
                    'created_at' => $post->created_at,
                ];
            }),
            'sent_messages' => $user->sentMessages()->get()->map(function ($message) {
                return [
                    'id' => $message->id,
                    'receiver_id' => $message->receiver_id,
                    'content' => $message->content,
                    'created_at' => $message->created_at,
                ];
            }),
            'received_messages' => $user->receivedMessages()->get()->map(function ($message) {
                return [
                    'id' => $message->id,
                    'sender_id' => $message->sender_id,
                    'content' => $message->content,
                    'created_at' => $message->created_at,
                ];
            }),
        ];

        // Format eksportu
        $format = $request->input('format', 'json');

        if ($format === 'csv') {
            return $this->exportAsCsv($userData);
        }

        // Domyślnie JSON
        $filename = 'user_data_' . $user->id . '_' . now()->format('Y-m-d_H-i-s') . '.json';
        
        return response()->json($userData)
            ->header('Content-Type', 'application/json')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    /**
     * Export data as CSV (simplified version)
     */
    private function exportAsCsv(array $userData)
    {
        $csv = "Dane użytkownika\n\n";
        $csv .= "Sekcja,Pole,Wartość\n";
        
        // User data
        foreach ($userData['user'] as $key => $value) {
            $csv .= "Użytkownik,$key," . json_encode($value) . "\n";
        }
        
        // Facilities
        foreach ($userData['facilities'] as $index => $facility) {
            foreach ($facility as $key => $value) {
                $csv .= "Placówka " . ($index + 1) . ",$key," . json_encode($value) . "\n";
            }
        }
        
        // Reviews
        foreach ($userData['reviews'] as $index => $review) {
            foreach ($review as $key => $value) {
                $csv .= "Recenzja " . ($index + 1) . ",$key," . json_encode($value) . "\n";
            }
        }

        $filename = 'user_data_' . $userData['user']['id'] . '_' . now()->format('Y-m-d_H-i-s') . '.csv';
        
        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}
