<?php 

require( 'vendor/autoload.php' );

define('DOMPDF_ENABLE_AUTOLOAD', false);

require_once 'vendor/dompdf/dompdf/dompdf_config.inc.php';

// $response = Requests::post('http://localhost/pdf-requests/index.php/');
// var_dump($response->body);

function make_pdf( $html, $view_in_browser = false ){
	if ( ! $html ) {
		echo 'no content in $html';
		return;
	}

	$dompdf = new DOMPDF();
	$dompdf->load_html($html);
	$dompdf->render();

	if ( $view_in_browser ) {
		$dompdf->stream("welcome.pdf", array("Attachment" => 0)); 
		return;
	}

	$dompdf->stream("sample.pdf");	
}

class PDFHandler {
    function get() {
    	$form = 
		'<form action="" method="post">
			<textarea name="html" id="html" cols="30" rows="10"></textarea>
			<input type="checkbox" name="view_in_browser" value="checked">View in Browser?
			<input type="submit">
		</form>';

		echo $form;
    }

    function post(){
    	$html = $_POST['html'];    	

    	if ( isset( $_POST['view_in_browser'] ) && $_POST[ 'view_in_browser' ] == "checked") {
    		make_pdf( $html, true );
    	}
    	else { make_pdf( $html ); }
    }
}

Toro::serve(array(
    "/" => "PDFHandler"
));