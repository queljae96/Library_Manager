<?php

    use Dompdf\Dompdf;

    require_once 'dompdf/autoload.inc.php';

    $dompdf = new Dompdf();

    $dompdf->loadHtml("

        <html>
        
            <body>

                <header class='h'><img src='http://localhost:8888/GITHUB/Library_Manager/img/barra-de-menu.png'></header>

                <main>
                
                    
                
                </main>
                
                <style>
                    header{
                        background-color: #284f82;
                    }

                    .logo{
                        width:50px;
                    }
                </style>
            
            </body>
        
        </html>
    
    ");

    $dompdf->set_option('dafaultFont','sans');

    $dompdf->setPaper('A4','portrait');

    $dompdf->render();

    $dompdf->stream();

?>