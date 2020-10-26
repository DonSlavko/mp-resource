<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $categories = Category::all()->toArray();

        return response(['data' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            $data = $request->all();

            Category::create($data);
            // this.$toasted.show('Hello, I am from ItSolutionStuff.com');
            return response(['Neue Kategorie wurde hinzugefügt']);
        } catch (\Exception $exception) {
            return response(['message' => 'Es gab einen Fehler'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category) {
        try {
            $data = [
                'name' => $request->get('name'),
                'description' => $request->get('description'),
            ];

            $category->update($data);


            return response(['Kategorie wurde aktualisiert']);
        } catch (\Exception $exception) {
            return response(['message' => 'Es gab einen Fehler'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category) {
        try {
            $category->delete();

            return response(['Kategorie wurde gelöscht']);
        } catch (\Exception $exception) {
            return response(['message' => 'Es gab einen Fehler'], 500);
        }
    }
}
