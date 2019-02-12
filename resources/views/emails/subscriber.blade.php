@extends('emails.layouts.subscriber_layout')

@section('content')
    <!-- Top Content -->
    <tr>
        <td>
            <table border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#fff" width="620" style="font-size:13px; color:#555; padding:20px;line-height:2em;">
                <tbody>
                <tr>
                    <td>
                        <p style="margin:0px 0px 10px 0px;">
                            Chào <span style="color:#00aeef; font-weight:bold">{{ $subscriber->email }},</span>
                        </p>
                        <p style="margin:0px 0px 10px 0px;">
                            Bạn đã đăng ký thành công bản tin cập nhật qua email. Chúng tôi sẽ gửi những bài viết hấp dẫn nhất tại <span style="color:#00aeef; font-weight:bold">fsd14.com</span> vào email này.
                        </p>
                        <p style="margin:0px">
                            Chúc bạn có những giây phút bổ ích với FSD14!
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="margin:5px 0px 5px 0px;">
                            Cảm ơn,
                        </p>
                        <p style="margin:0px 0px 0px 0px;">
                            <span style="color:#00aeef;font-weight:bold">FSD14</span>
                        </p>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
@endsection
