<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // Показать все отзывы
    public function index() {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->Paginate(6)
        ]);
    }

    //Показать отдельный отзыв
    public function show(Listing $listing) {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    // Показать форму создания отзыва
    public function create() {
        return view('listings.create');
    }

    // Данные о отзыве
    public function store(Request $request) {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        return redirect('/')->with('message', 'Отзыв успешно создан!');
    }

    // Показать форму редактирования
    public function edit(Listing $listing) {
        return view('listings.edit', ['listing' => $listing]);
    }

    // Обновление данных листинга
    public function update(Request $request, Listing $listing) {
        // Убедится, что вошедший пользователь является владельцем
        if($listing->user_id != auth()->id()) {
            abort(403, 'Неавторизованное действие');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return back()->with('message', 'Отзыв успешно обновлен!');
    }

    // Удалить отзыв
    public function destroy(Listing $listing) {
        // Убедится, что вошедший пользователь является владельцем
        if($listing->user_id != auth()->id()) {
            abort(403, 'Неавторизованное действие');
        }

        if($listing->logo && Storage::disk('public')->exists($listing->logo)) {
            Storage::disk('public')->delete($listing->logo);
        }
        $listing->delete();
        return redirect('/')->with('message', 'Отзыв успешно удален');
    }

    // Manage Listings
    public function manage() {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
