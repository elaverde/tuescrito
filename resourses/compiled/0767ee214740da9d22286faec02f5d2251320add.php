<html>
    <head>
        <?php echo $__env->make('report.css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <style>
            @page  {
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
            <?php echo $html; ?>

        </div>  
    </body>
</html>