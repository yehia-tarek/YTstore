<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Post\PostRepository;
use App\Repositories\Post\IPostRepository;
use App\Repositories\Brand\BrandRepository;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Brand\IBrandRepository;
use App\Repositories\Order\IOrderRepository;
use App\Repositories\Banner\BannerRepository;
use App\Repositories\Coupon\CouponRepository;
use App\Repositories\Banner\IBannerRepository;
use App\Repositories\Coupon\ICouponRepository;
use App\Repositories\PostTag\PostTagRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Profile\ProfileRepository;
use App\Repositories\Setting\SettingRepository;
use App\Repositories\PostTag\IPostTagRepository;
use App\Repositories\Product\IProductRepository;
use App\Repositories\Profile\IProfileRepository;
use App\Repositories\Setting\ISettingRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Shipping\ShippingRepository;
use App\Repositories\Category\ICategoryRepository;
use App\Repositories\Shipping\IShippingRepository;
use App\Repositories\PostComment\PostCommentRepository;
use App\Repositories\PostComment\IPostCommentRepository;
use App\Repositories\PostCategory\PostCategoryRepository;
use App\Repositories\PostCategory\IPostCategoryRepository;
use App\Repositories\ProductReview\ProductReviewRepository;
use App\Repositories\ProductReview\IProductReviewRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IProfileRepository::class, ProfileRepository::class);
        $this->app->bind(IOrderRepository::class, OrderRepository::class);
        $this->app->bind(IProductReviewRepository::class, ProductReviewRepository::class);
        $this->app->bind(IPostCommentRepository::class, PostCommentRepository::class);
        $this->app->bind(ISettingRepository::class, SettingRepository::class);
        $this->app->bind(IBannerRepository::class, BannerRepository::class);
        $this->app->bind(IProductRepository::class, ProductRepository::class);
        $this->app->bind(IBrandRepository::class, BrandRepository::class);
        $this->app->bind(ICategoryRepository::class, CategoryRepository::class);
        $this->app->bind(IShippingRepository::class, ShippingRepository::class);
        $this->app->bind(ICouponRepository::class, CouponRepository::class);
        $this->app->bind(IPostRepository::class, PostRepository::class);
        $this->app->bind(IPostCategoryRepository::class, PostCategoryRepository::class);
        $this->app->bind(IPostTagRepository::class, PostTagRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
