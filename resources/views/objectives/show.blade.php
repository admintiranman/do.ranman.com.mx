<html>
    <head>
        <title>{{$objective->job}} Objetivos {{$objective->year}}</title>
        <style>
            iframe {
                width: 100%;
                height: 100%;
            }
        </style>
    </head>
    <body>
        
        <iframe src="{{route('objective.pdf', [$objective, $txt])}}" frameborder="0"></iframe>
    </body>
    
</html>