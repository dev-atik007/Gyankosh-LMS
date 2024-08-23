<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SmtpSetting;
use Illuminate\Http\Request;

class ManageEmailController extends Controller
{
    public function smtpSetting()
    {
        $smtp = SmtpSetting::find(1);

        return view('admin.email.smtp', compact('smtp'));
    }

    public function smtpSettingUpdate(Request $request)
    {
        $smtp_id = $request->id;

        // Data update
        $smtp = SmtpSetting::find($smtp_id); 
        $smtp->mailer = $request->mailer;
        $smtp->host = $request->host;
        $smtp->port = $request->port;
        $smtp->username = $request->username;
        $smtp->from_address = $request->from_address;
        $smtp->encryption = $request->encryption;
        $smtp->password = $request->password;
        $smtp->save();

        // Notification
        $notification = array(
            'message'   => 'Smtp Setting updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
