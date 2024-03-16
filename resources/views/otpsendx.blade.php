<!DOCTYPE html>
<html>
<body>
    @if (!$details['title'])

    @else
    <h1>{{$details['title']}}</h1>
    @endif
    <p>{!! nl2br(e($details['body'])) !!}</p>
</body>
</html>
