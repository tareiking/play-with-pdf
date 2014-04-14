play-with-pdf
=============

Using DOMPDF + TORO requests for some basic HTML -> PDF playing around

## Usage

1. ``$ git clone https://github.com/tareiking/play-with-pdf.git my-project``

2. ``$ php composer.phar install``

3. *** IMPORTANT: Uncomment lines 13 & 14 in /vendor/dompdf/dompdf_config.custom.inc.php to allow remote image processing and CSS floats ***

4. Then navigate to ../my-project/index.php/ and fill in the form to get your PDF


## Roadmap

- Configure endpoints to process JSON requests and return a PDF
- Set DOMPDF constants from within project files
- Handle non-absolute image links (prefix URL to img/resources folders)