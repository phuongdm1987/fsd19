<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <title>Đăng ký bản tin theo dõi</title>
    <meta charset="utf-8">
</head>
<body style="padding:0px;margin:0px">
   <table style="font-family:arial; font-size:13px; color:#555; line-height:1.4em; background:#e4e4e4; padding:0px 20px;" border="0" cellspacing="0" cellpadding="0" width="100%" align="center">

     <tr>
         <td>
             <table border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#f4f4f4" width="620" style="font-family:arial; font-size:12px; line-height:1.4em;">
                 <tbody>
                     <!-- Header -->
                     <tr>
                         <td style="padding: 15px;">
                             <a href="{{ route('home') }}?utm_source=email_register_subs&utm_medium=cpc&utm_campaign=email_marketing" style="display:block">
                                 <img src="{{asset('img/medium_fsd_logo.png')}}" alt="fsd14.com" width="114px" height="40px">
                             </a>
                         </td>
                     </tr>
                     <!-- Banner Top -->
                    <tr>
                       <td>
                           <table border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#fff" width="620" style="font-family:arial; font-size:12px; line-height:1.4em;">
                               <tbody>
                                   <tr>
                                       <td>
                                           <a href="{{ route('home') }}?utm_source=email_register_subs&utm_medium=cpc&utm_campaign=email_marketing" title="Cộng đồng lập trình viên Việt Nam">
                                               <img src="{{asset('img/fsd_mail_header.jpg')}}" alt="Cộng đồng lập trình viên Việt Nam" width="620" style="display:block; width:100%;">
                                           </a>
                                       </td>
                                   </tr>
                               </tbody>
                           </table>
                       </td>
                    </tr>
                     @yield('content')
                     <!-- Footer -->
                     <tr>
                        <td>
                           <table border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#f4f4f4" width="620" style="font-family:arial; font-size:13px; color:#555; line-height:1.4em; padding:0px 20px 10px 20px;">
                              <tbody>
                                 <tr>
                                     <td>
                                         
                                     </td>
                                 </tr>
                                 <tr>
                                     <td style="padding:8px 0px; vertical-align:top; text-align:center;">
                                         Cập nhật những bài viết mới nhất, tin tức của FSD14 tại:
                                     </td>
                                 </tr>
                                 <tr>
                                     <td style="padding-bottom:8px; vertical-align:top; text-align:center;">
                                         <a href="https://www.facebook.com/vnfsd" style="text-decoration:none;margin:0px 5px">
                                             <img src="https://bit.ly/1CHRRlg" alt="FB" height="32" width="32">
                                         </a>
                                         <a href="https://plus.google.com/u/0/communities/103694226235937430493" style="text-decoration:none;margin:0px 5px">
                                             <img src="https://bit.ly/15itZJZ" alt="G+" height="32" width="32">
                                         </a>
                                         <a href="https://twitter.com/VNFsd14" style="text-decoration:none;margin:0px 5px">
                                             <img src="https://bit.ly/1yPNBzP" alt="Twitter" height="32" width="32">
                                         </a>
                                     </td>
                                 </tr>
                                 <tr>
                                     <td style="padding:8px 0px; vertical-align:top; text-align:center;">
                                         <strong>Viet Nam Full-stack developer © {{ date('Y') }}</strong>
                                     </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                     <!-- Click Me -->
                     <tr>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#e4e4e4" width="620" style="font-family:arial; font-size:11px; line-height:1.4em; padding:5px">
                                <tbody>
                                    <tr>
                                        <td style="padding:0px; vertical-align:top; text-align:center;">
                                            Nếu bạn không muốn nhận email, xin vui lòng <a style="color:#00aeef; text-decoration:none;" href="{{ route('unsubscribe', $subscriber->email) }}&utm_source=email_register_unsubs&utm_medium=cpc&utm_campaign=email_marketing">click vào đây.</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                     </tr>
                 </tbody>
             </table>
         </td>
     </tr>
   </table>
</body>
</html>
