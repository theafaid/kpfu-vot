<?php

namespace App\Http\Controllers;

use App\Http\Requests\Groups\GroupStoreRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Group;
use App\Models\Language;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class GroupController extends Controller
{
    public function index()
    {
        return Inertia::render('Groups/Index', [
            'groups' => Group::forUser(auth()->user())->get(),
            'languages' => Language::fetch(),
        ]);
    }

    public function store(GroupStoreRequest $request)
    {
        $group = auth()->user()->groups()->create([
            'name' => $request->name,
            'uid' => Str::slug($request->name) . time(),
            'description' => $request->description,
        ]);

        $group->languages()->attach($request->languages);

        return Redirect::route('groups.index');
    }

    public function show(Group $group)
    {
        if (Gate::denies('update', $group)) {
            abort (403);
        }

        return Inertia::render('Groups/Show', [
            'group' => $group,
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
