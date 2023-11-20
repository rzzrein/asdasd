@extends('emails.heading')

@section('content')
<div style="background-color:transparent;">
    <div class="block-grid"
        style="Margin: 0 auto;  max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
        <div
            style="border-collapse: collapse;display: table;width: 100%;background-color:#eef8f7;background-size: cover">
            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
            <!--[if (mso)|(IE)]><td align="center" width="600" style="background-color:transparent;width:600px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 20px; padding-left: 20px; padding-top:10px; padding-bottom:10px;"><![endif]-->
            <div class="col num12"
                style=" max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
                <div style="width:100% !important;">
                    <!--[if (!mso)&(!IE)]><!-->
                    <div
                        style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:10px; padding-bottom:10px; padding-right: 20px; padding-left: 20px;">
                        <!--<![endif]-->
                        <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 40px; padding-left: 40px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, Verdana, sans-serif"><![endif]-->
                        <div
                            style="color:#171717;font-family:'Roboto Slab', Tahoma, Verdana, Segoe, sans-serif;line-height:1.2;padding-top:20px;padding-right:40px;padding-bottom:20px;padding-left:40px;">
                            <div
                                style="line-height: 1.4; font-size: 12px; color: #171717; font-family: 'Roboto Slab', Tahoma, Verdana, Segoe, sans-serif; mso-line-height-alt: 14px;">
                                <p
                                    style="text-align: center; line-height: 1.4; word-break: break-word; font-size: 28px; mso-line-height-alt: 34px; margin: 0;">
                                    <span style="font-size: 28px;"><strong>Your profile has been updated.</strong></span></p>
                            </div>
                        </div>
                        <!--[if mso]></td></tr></table><![endif]-->
                        <div
                            style="color:#555555;font-family:'Roboto Slab', Tahoma, Verdana, Segoe, sans-serif;line-height:1.2;padding-top:10px;padding-right:40px;padding-bottom:10px;padding-left:40px;">
                            <div
                                style="font-size: 14px; line-height: 1.4; color: #555555; font-family: 'Roboto Slab', Tahoma, Verdana, Segoe, sans-serif; mso-line-height-alt: 17px;">
                                <p
                                    style="font-size: 14px; line-height: 1.4; word-break: break-word; text-align: center; mso-line-height-alt: 17px; margin: 0;">
                                    Hi {{ $user->name ?? null}}!.<br>A change was recently made to your {{ config('app.name') }} account profile. The following fields were updated:</p>
                            </div>
                        </div>                        
                        <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 40px; padding-left: 40px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, Verdana, sans-serif"><![endif]-->
                        <div
                            style="color:#555555;font-family:'Roboto Slab', Tahoma, Verdana, Segoe, sans-serif;line-height:1.2;padding-top:10px;padding-right:40px;padding-bottom:10px;padding-left:40px;">
                            <div
                                style="font-size: 14px; line-height: 1.4; color: #555555; font-family: 'Roboto Slab', Tahoma, Verdana, Segoe, sans-serif; mso-line-height-alt: 17px;">
                                <p
                                    style="font-size: 14px; line-height: 1.4; word-break: break-word; text-align: center; mso-line-height-alt: 17px; margin: 0;">
                                    <ul>
                                        @forelse ($dirty as $field => $value)
                                        <li><b>{{ \Str::title($field) }}</b> : {{ $value }}</li>
                                        @empty
                                        @endforelse
                                    </ul>
                                </p>

                                <p
                                    style="font-size: 14px; line-height: 1.4; word-break: break-word; text-align: center; mso-line-height-alt: 17px; margin: 0;">
                                    If you initiate this, no further action is required.<br>
                                    If you did not initiate this, please contact your administrator.<br><br>
                                </p>
                                <p
                                    style="font-size: 14px; line-height: 1.4; word-break: break-word; text-align: center; mso-line-height-alt: 17px; margin: 0;">&nbsp;</p>
                                <p
                                    style="font-size: 14px; line-height: 1.4; word-break: break-word; text-align: center; mso-line-height-alt: 17px; margin: 0;">
                                    Thank you.</p>
                                <p
                                    style="font-size: 14px; line-height: 1.4; word-break: break-word; text-align: center; mso-line-height-alt: 17px; margin: 0;">&nbsp;</p>
                                <p
                                    style="font-size: 14px; line-height: 1.4; word-break: break-word; text-align: center; mso-line-height-alt: 17px; margin: 0;">
                                    {{ config('app.name') }}</p>
                                <!-- <p
                                    style="font-size: 14px; line-height: 1.4; word-break: break-word; text-align: center; mso-line-height-alt: 17px; margin: 0;">
                                    Chief Executive Officer</p> -->
                            </div>
                        </div>
                        <!--[if mso]></td></tr></table><![endif]-->
                        <!--[if (!mso)&(!IE)]><!-->
                    </div>
                    <!--<![endif]-->
                </div>
            </div>
            <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
            <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
        </div>
    </div>
</div>
@endsection