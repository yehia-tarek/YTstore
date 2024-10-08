<?php

namespace App\Providers;

use App\Services\Post\PostService;
use App\Services\User\UserService;
use App\Services\Post\IPostService;
use App\Services\User\IUserService;
use App\Services\Brand\BrandService;
use App\Services\Order\OrderService;
use App\Services\Brand\IBrandService;
use App\Services\Order\IOrderService;
use App\Services\Banner\BannerService;
use App\Services\Coupon\CouponService;
use App\Services\Banner\IBannerService;
use App\Services\Coupon\ICouponService;
use Illuminate\Support\ServiceProvider;
use App\Services\Message\MessageService;
use App\Services\PostTag\PostTagService;
use App\Services\Product\ProductService;
use App\Services\Profile\ProfileService;
use App\Services\Setting\SettingService;
use App\Services\Message\IMessageService;
use App\Services\PostTag\IPostTagService;
use App\Services\Product\IProductService;
use App\Services\Profile\IProfileService;
use App\Services\Setting\ISettingService;
use App\Services\Caregory\CategoryService;
use App\Services\Shipping\ShippingService;
use App\Services\Caregory\ICategoryService;
use App\Services\Shipping\IShippingService;
use App\Services\PostComment\PostCommentService;
use App\Services\PostComment\IPostCommentService;
use App\Services\Notification\NotificationService;
use App\Services\PostCategory\PostCategoryService;
use App\Services\Notification\INotificationService;
use App\Services\PostCategory\IPostCategoryService;
use App\Services\ProductReview\ProductReviewService;
use App\Services\ProductReview\IProductReviewService;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IProfileService::class, ProfileService::class);
        $this->app->bind(IOrderService::class, OrderService::class);
        $this->app->bind(IProductReviewService::class, ProductReviewService::class);
        $this->app->bind(IPostCommentService::class, PostCommentService::class);
        $this->app->bind(ISettingService::class, SettingService::class);
        $this->app->bind(IBannerService::class, BannerService::class);
        $this->app->bind(IProductService::class, ProductService::class);
        $this->app->bind(IBrandService::class, BrandService::class);
        $this->app->bind(ICategoryService::class, CategoryService::class);
        $this->app->bind(IShippingService::class, ShippingService::class);
        $this->app->bind(ICouponService::class, CouponService::class);
        $this->app->bind(IPostService::class, PostService::class);
        $this->app->bind(IPostCategoryService::class, PostCategoryService::class);
        $this->app->bind(IPostTagService::class, PostTagService::class);
        $this->app->bind(IUserService::class, UserService::class);
        $this->app->bind(IMessageService::class, MessageService::class);
        $this->app->bind(INotificationService::class, NotificationService::class);
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
