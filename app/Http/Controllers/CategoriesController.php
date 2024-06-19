<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, string $category_id)
    {
        $user = User::findOrFail($id);
        if(\Auth::id() === $user->id){
            $category=$user->categories()->where('id',$category_id)->firstOrFail();
            return view('categories.edit',['user'=>$user,'category' => $category]);
        } 
        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,string $id, string $category_id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'color' => 'required|string|max:7' // 例: #FFFFFF
        ]);
        $user = User::findOrFail($id);
        if (\Auth::id() === $user->id) {
            $category = $user->categories()->where('id', $category_id)->firstOrFail();
            $category->name = $request->input('name');
            $category->color = $request->input('color');
            $category->save();
        }

        return redirect()->route('users.show', ['id' => $user->id,'category_id' => $category_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
