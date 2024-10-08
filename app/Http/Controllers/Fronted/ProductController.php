<?php

namespace App\Http\Controllers\Fronted;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Product\IProductService;
use App\Services\Caregory\ICategoryService;
use App\Services\ProductReview\IProductReviewService;

class ProductController extends Controller
{

    protected $productService;
    protected $categoryService;
    protected $productReviewService;

    public function __construct(IProductService $productService, ICategoryService $categoryService, IProductReviewService $productReviewService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->productReviewService = $productReviewService;
    }


    public function productDetail($slug)
    {
        $productDetails = $this->productService->getProductBySlug($slug);
        $productCategory = $this->categoryService->getCategoryById($productDetails->cat_id);
        if ($productDetails->child_cat_id) {
            $productSubCategory = $this->categoryService->getCategoryById($productDetails->child_cat_id);
        }

        $relatedProducts = $this->productService->getProductsByCategoryId($productDetails->cat_id);
        $productReview = $this->productReviewService->getAllReviewByProductId($productDetails->id);

        return view('frontend.pages.product_detail')->with([
            'productDetails' => $productDetails,
            'productCategory' => $productCategory,
            'productSubCategory' => $productSubCategory,
            'relatedProducts' => $relatedProducts,
            'productReview' => $productReview
        ]);
    }

    public function productGrids()
    {
        $products = Product::query();

        $recent_products = Product::where('status', 'active')->orderBy('id', 'DESC')->limit(3)->get();
        $products = $products->where('status', 'active')->paginate(9);

        return view('frontend.pages.product-grids', [
            'products' => $products,
            'recent_products' => $recent_products
        ]);
    }

    public function productSearch(Request $request)
    {
        $recent_products = Product::where('status', 'active')->orderBy('id', 'DESC')->limit(3)->get();
        // $products = Product::where('title', 'like', '%' . $request->search . '%')
        //     ->orwhere('slug', 'like', '%' . $request->search . '%')
        //     ->orwhere('description', 'like', '%' . $request->search . '%')
        //     ->orwhere('summary', 'like', '%' . $request->search . '%')
        //     ->orwhere('price', 'like', '%' . $request->search . '%')
        //     ->orderBy('id', 'DESC')
        //     ->paginate('9');

        $searchTerm = '%' . $request->search . '%';
        dd($searchTerm);

        $products = Product::where(function ($query) use ($searchTerm) {
            $query->where('title', 'like', $searchTerm)
                ->orWhere('slug', 'like', $searchTerm)
                ->orWhere('description', 'like', $searchTerm)
                ->orWhere('summary', 'like', $searchTerm);
            // Optional: If you really need to search the price field as well
            if (is_numeric($searchTerm)) {
                $query->orWhere('price', 'like', $searchTerm);
            }
        })
            ->orderBy('id', 'DESC')
            ->paginate(9);
        dd($products);

        return view('frontend.pages.product-grids')->with('products', $products)->with('recent_products', $recent_products);
    }

    public function productLists()
    {
        $products = Product::query();

        if (!empty($_GET['category'])) {
            $slug = explode(',', $_GET['category']);
            // dd($slug);
            $cat_ids = Category::select('id')->whereIn('slug', $slug)->pluck('id')->toArray();
            // dd($cat_ids);
            $products->whereIn('cat_id', $cat_ids)->paginate;
            // return $products;
        }
        if (!empty($_GET['brand'])) {
            $slugs = explode(',', $_GET['brand']);
            $brand_ids = Brand::select('id')->whereIn('slug', $slugs)->pluck('id')->toArray();
            return $brand_ids;
            $products->whereIn('brand_id', $brand_ids);
        }
        if (!empty($_GET['sortBy'])) {
            if ($_GET['sortBy'] == 'title') {
                $products = $products->where('status', 'active')->orderBy('title', 'ASC');
            }
            if ($_GET['sortBy'] == 'price') {
                $products = $products->orderBy('price', 'ASC');
            }
        }

        if (!empty($_GET['price'])) {
            $price = explode('-', $_GET['price']);
            // return $price;
            // if(isset($price[0]) && is_numeric($price[0])) $price[0]=floor(Helper::base_amount($price[0]));
            // if(isset($price[1]) && is_numeric($price[1])) $price[1]=ceil(Helper::base_amount($price[1]));

            $products->whereBetween('price', $price);
        }

        $recent_products = Product::where('status', 'active')->orderBy('id', 'DESC')->limit(3)->get();
        // Sort by number
        if (!empty($_GET['show'])) {
            $products = $products->where('status', 'active')->paginate($_GET['show']);
        } else {
            $products = $products->where('status', 'active')->paginate(6);
        }
        // Sort by name , price, category


        return view('frontend.pages.product-lists')->with('products', $products)->with('recent_products', $recent_products);
    }
    public function productFilter(Request $request)
    {
        $data = $request->all();
        // return $data;
        $showURL = "";
        if (!empty($data['show'])) {
            $showURL .= '&show=' . $data['show'];
        }

        $sortByURL = '';
        if (!empty($data['sortBy'])) {
            $sortByURL .= '&sortBy=' . $data['sortBy'];
        }

        $catURL = "";
        if (!empty($data['category'])) {
            foreach ($data['category'] as $category) {
                if (empty($catURL)) {
                    $catURL .= '&category=' . $category;
                } else {
                    $catURL .= ',' . $category;
                }
            }
        }

        $brandURL = "";
        if (!empty($data['brand'])) {
            foreach ($data['brand'] as $brand) {
                if (empty($brandURL)) {
                    $brandURL .= '&brand=' . $brand;
                } else {
                    $brandURL .= ',' . $brand;
                }
            }
        }
        // return $brandURL;

        $priceRangeURL = "";
        if (!empty($data['price_range'])) {
            $priceRangeURL .= '&price=' . $data['price_range'];
        }
        if (request()->is('e-shop.loc/product-grids')) {
            return redirect()->route('product-grids', $catURL . $brandURL . $priceRangeURL . $showURL . $sortByURL);
        } else {
            return redirect()->route('product-lists', $catURL . $brandURL . $priceRangeURL . $showURL . $sortByURL);
        }
    }

    public function productBrand(Request $request)
    {
        $products = Brand::getProductByBrand($request->slug);
        $recent_products = Product::where('status', 'active')->orderBy('id', 'DESC')->limit(3)->get();
        if (request()->is('e-shop.loc/product-grids')) {
            return view('frontend.pages.product-grids')->with('products', $products->products)->with('recent_products', $recent_products);
        } else {
            return view('frontend.pages.product-lists')->with('products', $products->products)->with('recent_products', $recent_products);
        }

    }
    public function productCat(Request $request)
    {
        $products = Category::getProductByCat($request->slug);
        // return $request->slug;
        $recent_products = Product::where('status', 'active')->orderBy('id', 'DESC')->limit(3)->get();

        if (request()->is('e-shop.loc/product-grids')) {
            return view('frontend.pages.product-grids')->with('products', $products->products)->with('recent_products', $recent_products);
        } else {
            return view('frontend.pages.product-lists')->with('products', $products->products)->with('recent_products', $recent_products);
        }

    }
    public function productSubCat(Request $request)
    {
        $products = Category::getProductBySubCat($request->sub_slug);
        // return $products;
        $recent_products = Product::where('status', 'active')->orderBy('id', 'DESC')->limit(3)->get();

        if (request()->is('e-shop.loc/product-grids')) {
            return view('frontend.pages.product-grids')->with('products', $products->sub_products)->with('recent_products', $recent_products);
        } else {
            return view('frontend.pages.product-lists')->with('products', $products->sub_products)->with('recent_products', $recent_products);
        }

    }
}
