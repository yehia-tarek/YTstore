<?php

namespace App\Http\Controllers\Backend;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Services\Caregory\ICategoryService;

class CategoryController extends Controller
{
    protected $categoryService;


    public function __construct(ICategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->categoryService->getAllCategoriesWithParent();

        return view('backend.category.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $parentCategories = $this->categoryService->getParentCategories(null, 'title', 'ASC');

        return view('backend.category.create', [
            'parent_cats' => $parentCategories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param   \App\Http\Requests\CategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $status = $this->categoryService->store($request->validated());

        if ($status) {
            request()->session()->flash('success', 'Category successfully added');
        } else {
            request()->session()->flash('error', 'Error occurred, Please try again!');
        }

        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $parentCategories = $this->categoryService->getParentCategories($id, 'title', 'ASC');
        $category = $this->categoryService->getCategoryById($id);

        return view('backend.category.edit', [
            'category' => $category,
            'parent_cats' => $parentCategories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $status = $this->categoryService->update($request->validated(), $id);

        if ($status) {
            request()->session()->flash('success', 'Category successfully updated');
        } else {
            request()->session()->flash('error', 'No Update Done');
        }

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = $this->categoryService->destroy($id);

        if ($status) {
            request()->session()->flash('success', 'Category successfully deleted');
        } else {
            request()->session()->flash('error', 'Error while deleting category , Check if category has products');
        }

        return redirect()->route('category.index');
    }

    public function getChildByParent(Request $request)
    {
        $childCategories = $this->categoryService->getChildByParentID($request->id);

        if (count($childCategories) <= 0) {
            return response()->json(['status' => false, 'msg' => '', 'data' => null]);
        } else {
            return response()->json(['status' => true, 'msg' => '', 'data' => $childCategories]);
        }
    }
}
