<?php


define('DOT', '.');
require_once DOT . "/bootstrap.php";

//Home page//
$Route->add('/', function () {
    $Template = new Apps\Template;
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $Template->assign("title", "ESUT Portal - iTranscript");
    $Template->render("home");
}, 'GET');
//Home page//

include './_public/my.php';
include './_public/admin.php';
include './_public/print.php';
include './_public/forms.php';
include './_public/payments.php';
include './_public/vc.php';
include './_public/bursary.php';
include './_public/updater.php';
include './_public/api.php';
include './_public/cron.php';

$Route->add(
    '/help/support',
    function () {
        $Template = new Apps\Template;
        $Template->redirect("https://esutitranscript.tawk.help/");
    },
    'GET'
);


// $Route->add(
//     '/payment/{invoiceid}/makepdf',
//     function ($invoiceid) {
//         $Template = new Apps\Template;

//         $url = urldecode($_REQUEST['url']);

//         // To prevent anyone else using your script to create their PDF files
//         //if (!preg_match('@^https?://www\.golojan\.com/@', $url)) {
//             //$Template->redirect($url);
//         //}

//         // For $_POST i.e. forms with fields
//         if (count($_POST) > 0) {

//             $ch = curl_init($url);
//             curl_setopt($ch, CURLOPT_HEADER, 0);
//             curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//             foreach ($_POST as $name => $post) {
//                 $formvars = array($name => $post . " \n");
//             }

//             curl_setopt($ch, CURLOPT_POSTFIELDS, $formvars);
//             $html = curl_exec($ch);
//             curl_close($ch);

//         } elseif (ini_get('allow_url_fopen')) {
//             $html = file_get_contents($url);
//         } else {
//             $ch = curl_init($url);
//             curl_setopt($ch, CURLOPT_HEADER, 0);
//             curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//             $html = curl_exec($ch);
//             curl_close($ch);
//         }

//         $mpdf = new \Mpdf\Mpdf();

//         $mpdf->useSubstitutions = true; // optional - just as an example
//         $mpdf->SetHeader( "iTranscript #{$invoiceid}: \n\n" . ' Page {PAGENO}');  // optional - just as an example
//         $mpdf->CSSselectMedia = "iTranscript-{$invoiceid}"; // assuming you used this in the document header
//         $mpdf->setBasePath($url);
//         $mpdf->WriteHTML($html);

//         $mpdf->Output();

//     },
//     'GET'
// );

//Logout Sessions//
$Route->add(
    '/auth/logout',
    function () {
        $Template = new Apps\Template;
        $Template->expire();
        $Template->cleanAll(1440);
        $Template->redirect("/my/login");
    },
    'GET'
);
//Logout Sessions//

$Route->run('/');
