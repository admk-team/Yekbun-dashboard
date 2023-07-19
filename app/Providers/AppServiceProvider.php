<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    Schema::defaultStringLength(125);
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
 
public function boot()
{
    Validator::extend('max_image_dimensions', function ($attribute, $value, $parameters, $validator) {
        $maxWidth = $parameters[0] ?? null;
        $maxHeight = $parameters[1] ?? null;

        if (!$maxWidth || !$maxHeight) {
            throw new \Exception('Missing required parameters for max_image_dimensions validation rule.');
        }

        $image = getimagesize($value->getPathname());

        return $image[0] <= $maxWidth && $image[1] <= $maxHeight;
    });

    Validator::extend('max_emoji_dimensions' ,function($attribute ,$value , $parameters ,$validator){
      $maxWidth = $parameters[0] ?? null;
      $maxHeight = $parameters[0] ?? null;

      if(!$maxWidth || !$maxHeight){
        throw new \Exception('Missing required parameters for max_emoji_dimesions validation rules.');
      }

      $emoji = getimagesize($value->getPathname());

      return $emoji[0] <= $maxWidth && $emoji[1] <= $maxHeight;
      
    });
}
}
