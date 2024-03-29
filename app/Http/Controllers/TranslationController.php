<?php

namespace App\Http\Controllers;

use App\Http\Requests\Groups\GroupStoreRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Group;
use App\Models\History;
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

class TranslationController extends Controller
{
    public function index()
    {
        $destinations = request('languages');

       $result = [];

       foreach ($destinations as $destination) {
           $result[$destination] = cloudTranslate(request('text'), 'ru', $destination);
       }

       History::record(auth()->user()->id, request('group_id'), request('text'));

       return response([
           'result' => $result,
       ]);
    }
}
