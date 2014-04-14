<?php 

require( 'vendor/autoload.php' );

define('DOMPDF_ENABLE_AUTOLOAD', false);

require_once 'vendor/dompdf/dompdf/dompdf_config.inc.php';

// $html =  '<html><body>'.
// 		 '<p>Put your html here, or generate it with your favourite '.
// 		 'templating system.</p>'.
// 		 '</body></html>';

// DomPDF
// $dompdf = new DOMPDF();
// $dompdf->load_html($html);
// $dompdf->render();
// $dompdf->stream("sample.pdf");

// $response = Requests::post('http://localhost/pdf-requests/index.php/');
// var_dump($response->body);

function make_pdf( $html ){
	if ( ! $html ) {
		echo 'no content in $html';
		return;
	}

	$dompdf = new DOMPDF();
	$dompdf->load_html($html);
	$dompdf->render();
	$dompdf->stream("sample.pdf");	
}

class MainHandler {
    function get() {
    	$form = 
		'<form action="" method="post">
			<textarea name="html" id="html" cols="30" rows="10"></textarea>
			<input type="submit">
		</form>';

		echo $form;
    }

    function post(){
    	$html = $_POST['html'];    	
    	
    	if ( make_pdf( $html ) );
    }
}

Toro::serve(array(
    "/" => "MainHandler"
));