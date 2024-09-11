<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SiteSettingController extends Controller
{
    public function siteSetting()
    {
        $siteSettings = SiteSetting::find(1);

        return view('admin.site.setting', compact('siteSettings'));
    }

    public function settingUpdate(Request $request)
    {
        $id = $request->id;

        if ($request->file('logo')) {

            $image = $request->file('logo');
            $image_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(140, 41)->save('application/public/upload/logo/' . $image_gen);
            $save_url = 'application/public/upload/logo/' . $image_gen;


            SiteSetting::find($id)->update([
                'phone'     => $request->phone,
                'email'     => $request->email,
                'address'   => $request->address,
                'facebook'  => $request->facebook,
                'twitter'   => $request->twitter,
                'copyright' => $request->copyright,
                'logo'      => $save_url,
            ]);

            $notification = array(
                'message'   => 'Site Settings Updated Succesfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            SiteSetting::find($id)->update([
                'phone'     => $request->phone,
                'email'     => $request->email,
                'address'   => $request->address,
                'facebook'  => $request->facebook,
                'twitter'   => $request->twitter,
                'copyright' => $request->copyright,
            ]);


            $notification = array(
                'message'   => 'Site Settings Updated without image Succesfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }
}
