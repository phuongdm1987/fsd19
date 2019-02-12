<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <atom:link href="{{route('home')}}" rel="self" type="application/rss+xml" />
        <title>Việt Nam Full Stack Developers</title>
        <link>{{env('APP_URL')}}</link>
        <description>Trang thông tin tổng hợp dành cho cộng động lập trình viên Việt Nam</description>
        <language></language>
        <managingEditor></managingEditor>
        <webMaster></webMaster>
        <generator></generator>
        <image>
            <url>https://files.slack.com/files-pri/T032SJDL8-F04DGPK3R/fsd_mail_header.jpg</url>
            <title>Việt Nam Full Stack Developers</title>
            <link>http://fsd19.com</link>
            <width>170</width>
            <height>170</height>
        </image>
        @foreach($posts as $post)
            <item>
                <title>{{$post->title}}</title>
                <description>{{str_limit(strip_tags($post->content), 60)}}</description>
                <link>{{$post->url()}}</link>
                <pubDate>{{$post->created_at->format('d/m/Y')}}</pubDate>
            </item>
        @endforeach
    </channel>
</rss>
