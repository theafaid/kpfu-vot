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
            'groups' => Group::forUser(auth()->user())->latest()->get(),
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

        return back();
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
     * Update the user's profile information.
     */
    public function update(Group $group, GroupStoreRequest $request): RedirectResponse
    {
        if (Gate::denies('update', $group)) {
            abort (403);
        }

        $group->update([
            'name' => $request->name,
            'uid' => Str::slug($request->name) . time(),
            'description' => $request->description,
        ]);

        if (! empty($request->languages)) {
            $group->languages()->sync($request->languages);
        }

        return back();
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Group $group): RedirectResponse
    {
        if (Gate::denies('update', $group)) {
            abort (403);
        }

        $group->delete();

        return back();
    }
}
