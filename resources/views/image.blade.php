<image:image>
            <image:loc>{{ $image->loc }}</image:loc>
@if(!empty($image->caption))
            <image:caption>{{ $image->caption }}</image:caption>
@endif
@if(!empty($image->geo_location))
            <image:geo_location>{{ $image->geo_location }}</image:geo_location>
@endif
@if(!empty($image->title))
            <image:title>{{ $image->title }}</image:title>
@endif
@if(!empty($image->license))
            <image:license>{{ $image->licence }}</image:license>
@endif
        </image:image>
