<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Traits\ImageCompressionTrait;

class BannerController extends Controller
{
    use ImageCompressionTrait;

    public function index(Request $request)
    {
        $sliders = Banner::where('type','slider')->get();
        $mobile_sliders = Banner::where('type','mobile_slider')->get();
        $bigSell = Banner::where('type','bigsell')->first();
        $special_offer = Banner::where('type','special_offer')->get();
        $monthly_sell = Banner::where('type','monthlysell')->first();
        $instabanner = Banner::where('type','instabanner')->first();
        $shopbanner = Banner::where('type','shopbanner')->first();
        // dd($sliders);
        return view('backend.banner.index',compact('sliders','bigSell','special_offer','monthly_sell','instabanner','shopbanner','mobile_sliders'));
    }

    public function slider(Request $request)
    {
        // dd($request->all());
        if ($request->slider1_id && $request->slider2_id && $request->slider3_id) {
            $slider1 = Banner::find($request->slider1_id);
            $slider2 = Banner::find($request->slider2_id);
            $slider3 = Banner::find($request->slider3_id);
            #Slider 1
            if ($slider1) {
                $slider1->url = $request->link1;
                $slider1->save();
                if ($request->hasFile('slider1')) {
                    $uploadFile = $request->file('slider1');
                    $file_name = $uploadFile->hashName();
                    $path = $uploadFile->move(public_path('banner_images/slider'), $file_name);
                    // Compress the uploaded image
                    // $compressedPath = $this->compressImage($path);
                    $compressedPath = $path;
                    // Remove the old image
                    if ($slider1->image) {
                        $oldImagePath = public_path('banner_images/slider') . '/' . $slider1->image;
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                    $slider1['image'] = basename($compressedPath);
                    $slider1->name = 'image_1';
                    $slider1->type = 'slider';
                    $slider1->save();
                }
            }
            #Slider 2
            if ($slider2) {
                $slider2->url = $request->link2;
                $slider2->save();
                if ($request->slider2) {
                    $uploadFile = $request->file('slider2');
                    $file_name = $uploadFile->hashName();
                    $path = $uploadFile->move(public_path('banner_images/slider'), $file_name);
                    // Compress the uploaded image
                    // $compressedPath = $this->compressImage($path);
                    $compressedPath = $path;
                    // Remove the old image
                    if ($slider2->image) {
                        $oldImagePath = public_path('banner_images/slider') . '/' . $slider2->image;
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                    $slider2['image'] = basename($compressedPath);
                    $slider2->name = 'image_2';
                    $slider2->type = 'slider';
                    $slider2->save();
                }
            }
            #Slider 3
            if ($slider3) {
                $slider3->url = $request->link3;
                $slider3->save();
                if ($request->slider3) {
                    $uploadFile = $request->file('slider3');
                    $file_name = $uploadFile->hashName();
                    $path = $uploadFile->move(public_path('banner_images/slider'), $file_name);
                    // Compress the uploaded image
                    // $compressedPath = $this->compressImage($path);
                    $compressedPath = $path;
                     // Remove the old image
                    if ($slider3->image) {
                        $oldImagePath = public_path('banner_images/slider') . '/' . $slider3->image;
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                    $slider3['image'] = basename($compressedPath);
                    $slider3->name = 'image_3';
                    $slider3->type = 'slider';
                    $slider3->save();
                }
            }
        } else {
            #Slider 1
            if ($request->slider1) {
                $data = new Banner();
                $uploadFile = $request->file('slider1');
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('banner_images/slider'), $file_name);
                // Compress the uploaded image
                // $compressedPath = $this->compressImage($path);
                $compressedPath = $path;
                $data['image'] = basename($compressedPath);
                $data->name = 'image_1';
                $data->type = 'slider';
                $data->url = $request->link1;
                $data->save();
            }
            #Slider 2
            if ($request->slider2) {
                $data = new Banner();
                $uploadFile = $request->file('slider2');
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('banner_images/slider'), $file_name);
                // Compress the uploaded image
                // $compressedPath = $this->compressImage($path);
                $compressedPath = $path;
                $data['image'] = basename($compressedPath);
                $data->name = 'image_2';
                $data->type = 'slider';
                $data->url = $request->link2;
                $data->save();
            }
            #Slider 3
            if ($request->slider3) {
                $data = new Banner();
                $uploadFile = $request->file('slider3');
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('banner_images/slider'), $file_name);
                // Compress the uploaded image
                // $compressedPath = $this->compressImage($path);
                $compressedPath = $path;
                $data['image'] = basename($compressedPath);
                $data->name = 'image_3';
                $data->type = 'slider';
                $data->url = $request->link3;
                $data->save();
            }
        }

        return redirect()->route('adminBanner')->with('success', 'Slider created successfully');
    }

    public function mobileSlider(Request $request)
    {
        if ($request->slider1_id && $request->slider2_id && $request->slider3_id) {
            $slider1 = Banner::find($request->slider1_id);
            $slider2 = Banner::find($request->slider2_id);
            $slider3 = Banner::find($request->slider3_id);
            #Slider 1
            if ($slider1) {
                $slider1->url = $request->link1;
                $slider1->save();
                if ($request->hasFile('slider1')) {
                    $uploadFile = $request->file('slider1');
                    $file_name = $uploadFile->hashName();
                    $path = $uploadFile->move(public_path('banner_images/slider'), $file_name);
                    // Compress the uploaded image
                    $compressedPath = $path;
                    // Remove the old image
                    if ($slider1->image) {
                        $oldImagePath = public_path('banner_images/slider') . '/' . $slider1->image;
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                    $slider1['image'] = basename($compressedPath);
                    $slider1->name = 'image_1';
                    $slider1->type = 'mobile_slider';
                    $slider1->save();
                }
            }
            #Slider 2
            if ($slider2) {
                $slider2->url = $request->link2;
                $slider2->save();
                if ($request->slider2) {
                    $uploadFile = $request->file('slider2');
                    $file_name = $uploadFile->hashName();
                    $path = $uploadFile->move(public_path('banner_images/slider'), $file_name);
                    // Compress the uploaded image
                    $compressedPath = $path;
                    // Remove the old image
                    if ($slider2->image) {
                        $oldImagePath = public_path('banner_images/slider') . '/' . $slider2->image;
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                    $slider2['image'] = basename($compressedPath);
                    $slider2->name = 'image_2';
                    $slider2->type = 'mobile_slider';
                    $slider2->save();
                }
            }
            #Slider 3
            if ($slider3) {
                $slider3->url = $request->link3;
                $slider3->save();
                if ($request->slider3) {
                    $uploadFile = $request->file('slider3');
                    $file_name = $uploadFile->hashName();
                    $path = $uploadFile->move(public_path('banner_images/slider'), $file_name);
                    // Compress the uploaded image
                    $compressedPath = $path;
                     // Remove the old image
                    if ($slider3->image) {
                        $oldImagePath = public_path('banner_images/slider') . '/' . $slider3->image;
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                    $slider3['image'] = basename($compressedPath);
                    $slider3->name = 'image_3';
                    $slider3->type = 'mobile_slider';
                    $slider3->save();
                }
            }
        } else {
            #Slider 1
            if ($request->slider1) {
                $data = new Banner();
                $uploadFile = $request->file('slider1');
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('banner_images/slider'), $file_name);
                // Compress the uploaded image
                $compressedPath = $path;
                $data['image'] = basename($compressedPath);
                $data->name = 'image_1';
                $data->type = 'mobile_slider';
                $data->url = $request->link1;
                $data->save();
            }
            #Slider 2
            if ($request->slider2) {
                $data = new Banner();
                $uploadFile = $request->file('slider2');
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('banner_images/slider'), $file_name);
                // Compress the uploaded image
                $compressedPath = $path;
                $data['image'] = basename($compressedPath);
                $data->name = 'image_2';
                $data->type = 'mobile_slider';
                $data->url = $request->link2;
                $data->save();
            }
            #Slider 3
            if ($request->slider3) {
                $data = new Banner();
                $uploadFile = $request->file('slider3');
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('banner_images/slider'), $file_name);
                // Compress the uploaded image
                $compressedPath = $path;
                $data['image'] = basename($compressedPath);
                $data->name = 'image_3';
                $data->type = 'mobile_slider';
                $data->url = $request->link3;
                $data->save();
            }
        }

        return redirect()->route('adminBanner')->with('success', 'Slider created successfully');
    }

    public function Bigsell(Request $request)
    {
        // dd($request->all());
        if ($request->bigsell_id) {
            $bigSell = Banner::find($request->bigsell_id);
            $bigSell->url = $request->banner_link;
            $bigSell->save();
            if ($request->banner2) {
                $uploadFile = $request->file('banner2');
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('banner_images/banner2'), $file_name);
                // Compress the uploaded image
                $compressedPath = $this->compressImage($path);
                 // Remove the old image
                if ($bigSell->image) {
                    $oldImagePath = public_path('banner_images/banner2') . '/' . $bigSell->image;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $bigSell['image'] = basename($compressedPath);
                $bigSell->name = 'banner2';
                $bigSell->type = 'bigsell';
                $bigSell->save();
            }
        } else {
            if ($request->banner2) {
                $data = new Banner();
                $uploadFile = $request->file('banner2');
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('banner_images/banner2'), $file_name);
                // Compress the uploaded image
                $compressedPath = $this->compressImage($path);
                $data['image'] = basename($compressedPath);
                $data->name = 'banner2';
                $data->type = 'bigsell';
                $data->url = $request->banner_link;
                $data->save();
            }
        }
        return redirect()->route('adminBanner')->with('success', 'Banner 2 created successfully');
    }

    public function specialOffer(Request $request)
    {
        // dd($request->all());
        if ($request->specialoffer1_id && $request->specialoffer2_id && $request->specialoffer3_id) {
            $specialoffer1 = Banner::find($request->specialoffer1_id);
            $specialoffer2 = Banner::find($request->specialoffer2_id);
            $specialoffer3 = Banner::find($request->specialoffer3_id);
            #specialOffer 1
            if ($specialoffer1) {
                $specialoffer1->url = $request->special_link1;
                $specialoffer1->save();
                if ($request->special_offer1) {
                    $uploadFile = $request->file('special_offer1');
                    $file_name = $uploadFile->hashName();
                    $path = $uploadFile->move(public_path('banner_images/banner3'), $file_name);
                    // Compress the uploaded image
                    $compressedPath = $this->compressImage($path);
                    if ($specialoffer1->image) {
                        $oldImagePath = public_path('banner_images/banner3') . '/' . $specialoffer1->image;
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                    $specialoffer1['image'] = basename($compressedPath);
                    $specialoffer1->name = 'image_1';
                    $specialoffer1->type = 'special_offer';
                    $specialoffer1->save();
                }
            }
            #specialOffer 2
            if ($specialoffer2) {
                # code...
                $specialoffer2->url = $request->special_link2;
                $specialoffer2->save();
                if ($request->special_offer2) {
                    $uploadFile = $request->file('special_offer2');
                    $file_name = $uploadFile->hashName();
                    $path = $uploadFile->move(public_path('banner_images/banner3'), $file_name);
                    // Compress the uploaded image
                    $compressedPath = $this->compressImage($path);
                    if ($specialoffer2->image) {
                        $oldImagePath = public_path('banner_images/banner3') . '/' . $specialoffer2->image;
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                    $specialoffer2['image'] = basename($compressedPath);
                    $specialoffer2->name = 'image_2';
                    $specialoffer2->type = 'special_offer';
                    $specialoffer2->save();
                }
            }
            #specialOffer 3
            if ($specialoffer3) {
                # code...
                $specialoffer3->url = $request->special_link3;
                $specialoffer3->save();
                if ($request->special_offer3) {
                    $uploadFile = $request->file('special_offer3');
                    $file_name = $uploadFile->hashName();
                    $path = $uploadFile->move(public_path('banner_images/banner3'), $file_name);
                    // Compress the uploaded image
                    $compressedPath = $this->compressImage($path);
                    if ($specialoffer3->image) {
                        $oldImagePath = public_path('banner_images/banner3') . '/' . $specialoffer3->image;
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                    $specialoffer3['image'] = basename($compressedPath);
                    $specialoffer3->name = 'image_3';
                    $specialoffer3->type = 'special_offer';
                    $specialoffer3->save();
                }
            }
        } else {
            #specialOffer 1
            if ($request->special_offer1) {
                $data = new Banner();
                $uploadFile = $request->file('special_offer1');
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('banner_images/banner3'), $file_name);
                // Compress the uploaded image
                $compressedPath = $this->compressImage($path);
                $data['image'] = basename($compressedPath);
                $data->name = 'image_1';
                $data->type = 'special_offer';
                $data->url = $request->special_link1;
                $data->save();
            }
            #specialOffer 2
            if ($request->special_offer2) {
                $data = new Banner();
                $uploadFile = $request->file('special_offer2');
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('banner_images/banner3'), $file_name);
                // Compress the uploaded image
                $compressedPath = $this->compressImage($path);
                $data['image'] = basename($compressedPath);
                $data->name = 'image_2';
                $data->type = 'special_offer';
                $data->url = $request->special_link2;
                $data->save();
            }
            #specialOffer 3
            if ($request->special_offer3) {
                $data = new Banner();
                $uploadFile = $request->file('special_offer3');
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('banner_images/banner3'), $file_name);
                // Compress the uploaded image
                $compressedPath = $this->compressImage($path);
                $data['image'] = basename($compressedPath);
                $data->name = 'image_3';
                $data->type = 'special_offer';
                $data->url = $request->special_link3;
                $data->save();
            }
        }
        return redirect()->route('adminBanner')->with('success', 'Banner 3 created successfully');

    }

    public function Montlysell(Request $request)
    {
        if ($request->monthlysell_id) {
            $monthly_sell = Banner::find($request->monthlysell_id);
            $monthly_sell->url = $request->banner_link4;
            $monthly_sell->save();
            if ($request->banner4) {
                $uploadFile = $request->file('banner4');
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('banner_images/banner4'), $file_name);
                // Compress the uploaded image
                $compressedPath = $this->compressImage($path);
                if ($monthly_sell->image) {
                    $oldImagePath = public_path('banner_images/banner4') . '/' . $monthly_sell->image;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $monthly_sell['image'] = basename($compressedPath);
                $monthly_sell->name = 'banner4';
                $monthly_sell->type = 'monthlysell';
                $monthly_sell->save();
            }
        } else {
            # code...
            if ($request->banner4) {
                $data = new Banner();
                $uploadFile = $request->file('banner4');
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('banner_images/banner4'), $file_name);
                // Compress the uploaded image
                $compressedPath = $this->compressImage($path);
                $data['image'] = basename($compressedPath);
                $data->name = 'banner4';
                $data->type = 'monthlysell';
                $data->url = $request->banner_link4;
                $data->save();
            }
        }
        return redirect()->route('adminBanner')->with('success', 'Banner 4 created successfully');

    }

    public function instabanner(Request $request)
    {
        if ($request->instavisit_id) {
            $instabanner = Banner::find($request->instavisit_id);
            $instabanner->url = $request->banner_link5;
            $instabanner->save();
            if ($request->banner5) {
                $uploadFile = $request->file('banner5');
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('banner_images/banner5'), $file_name);
                // Compress the uploaded image
                $compressedPath = $this->compressImage($path);
                if ($instabanner->image) {
                    $oldImagePath = public_path('banner_images/banner5') . '/' . $instabanner->image;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $instabanner['image'] = basename($compressedPath);
                $instabanner->name = 'banner5';
                $instabanner->type = 'instabanner';
                $instabanner->save();
            }
        } else {
            if ($request->banner5) {
                $data = new Banner();
                $uploadFile = $request->file('banner5');
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('banner_images/banner5'), $file_name);
                // Compress the uploaded image
                $compressedPath = $this->compressImage($path);
                $data['image'] = basename($compressedPath);
                $data->name = 'banner5';
                $data->type = 'instabanner';
                $data->url = $request->banner_link5;
                $data->save();
            }
        }
        return redirect()->route('adminBanner')->with('success', 'Banner 5 created successfully');
    }

    public function shopbanner(Request $request)
    {
        if ($request->shopedit_id) {
            $shopbanner = Banner::find($request->shopedit_id);
            $shopbanner->url = $request->shop_link;
            $shopbanner->save();
            if ($request->shop_image) {
                $uploadFile = $request->file('shop_image');
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('banner_images/shop'), $file_name);
                // Compress the uploaded image
                $compressedPath = $this->compressImage($path);
                if ($shopbanner->image) {
                    $oldImagePath = public_path('banner_images/shop') . '/' . $shopbanner->image;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $shopbanner['image'] = basename($compressedPath);
                $shopbanner->name = 'shop';
                $shopbanner->type = 'shopbanner';
                $shopbanner->save();
            }
        } else {
            if ($request->shop_image) {
                $data = new Banner();
                $uploadFile = $request->file('shop_image');
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('banner_images/shop'), $file_name);
                // Compress the uploaded image
                $compressedPath = $this->compressImage($path);
                $data['image'] = basename($compressedPath);
                $data->name = 'shop';
                $data->type = 'shopbanner';
                $data->url = $request->shop_link;
                $data->save();
            }
        }
        return redirect()->route('adminBanner')->with('success', 'Shop Banner created successfully');
    }
}
