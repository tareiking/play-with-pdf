<?php 

require( 'vendor/autoload.php' );

define('DOMPDF_ENABLE_AUTOLOAD', false);

require_once 'vendor/dompdf/dompdf/dompdf_config.inc.php';

// DOMPdf changes
// define("DOMPDF_ENABLE_REMOTE", true);
// define("DOMPDF_ENABLE_CSS_FLOAT", true);

// $response = Requests::post('http://localhost/pdf-requests/index.php/');
// var_dump($response->body);

$data = 
'<div class="wrapper">
	<h1>Convert HTML to PDF</h1>
	<form action="" method="post">
		<textarea name="html" id="html" cols="30" rows="10"></textarea>
		<input type="checkbox" name="view_in_browser" value="checked">View in Browser?
		<input type="submit">
	</form>
	<p>Uses DOMPDF and TORO micro-router</p>
</div>';

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
?> 

<html>
	<head>
		<title>HTML to PDF maker</title>
		<link href='http://fonts.googleapis.com/css?family=Titillium+Web:600' rel='stylesheet' type='text/css'>
		<style>
		.wrapper {
			width: 650px;
			margin: 0 auto;
			padding-top: 40px
		}

		body {
			font-family: 'Titillium Web', sans-serif;
		}

		textarea {
			border: 1px solid #dedede;
			width: 100%;
		}	

		input[type="submit"]{
			padding: 10px 30px !important;
			background-color: #409CB3;
			border: none;
			border-radius: 3px;
			color: white;
			float: right;
		}
		</style>
	</head>
	<body>
		<?php echo $data; ?>
	</body>
</html>
