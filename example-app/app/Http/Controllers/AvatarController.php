<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:20480',
        ]);
        $user = \Auth::user();

        if ($user->avatars) {
            Storage::disk('public')->delete($user->avatars->path);
            $user->avatars()->delete();
        }
        $path = $request->file('avatar')->store('avatars', 'public');

        Avatar::create([
            'path' => $path,'user_id' => $user->id]
        );

        return redirect()->back()->with('success', 'Аватар успешно обновлён.');
    }
}
