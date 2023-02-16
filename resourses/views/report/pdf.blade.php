<html>
    <head>
        @include('report.css')
        <style>
            @page {
                size: 800px 950px;
                margin: 50px 50px 50px 50px;
            }
            body {
                margin: 0;
                padding: 0;
            }
            .page {
                width: 700px;
                height: 800px;
                background-color: aqua;
                border-collapse: collapse;
                
            }
            div{
                padding: 0;
                margin: 0;
            }
        </style>
    </head>
    <body>
        <div class="ql-editor" style="width: 100%;">
            {!! $html !!}
        </div>  
    </body>
</html>