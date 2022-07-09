<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdsController extends Controller
{

    public function index()
    {
        $ad = Ad::paginate(5);

        return view('ads.index', compact('ad'));
    }

    public function view(int $id)
    {
        $ad = Ad::query()->find($id);

        return view('ads.view', compact('ad'));
    }

    public function create()
    {
        return view('ads.create');
    }

    public function edit(int $id)
    {
        $ad = Ad::query()->find($id);

        return view('ads.edit', compact('ad'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => ['required', 'min:3', 'max:255'],
            'title' => ['required', 'min:3', 'max:255'],
        ]);

        Auth::user()->ads()->create([
            'title' => $request->title,
            'description' => $request->description,
            'author_name' => $request->user()]);

        return redirect()->route('ads.index');
    }

    public function update(Ad $ad, Request $request)
    {
        $this->authorize('update', $ad);

        $request->validate([
            'description' => ['required', 'min:3', 'max:255'],
            'title' => ['required', 'min:3', 'max:255'],
        ]);
        var_dump($request->ad->id);
        $ad = Ad::query()->find($request->ad);
        $ad->update($request->all());

        return redirect()->route('ads.index');
    }

    public function destroy($id)
    {
        $ad = Ad::find($id);
        $ad->delete();
        return redirect()->route('ads.index');
    }

}
