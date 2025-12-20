<?php
// Load WordPress core
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
require_once("tcpdf/tcpdf.php");

/* ----------------------------------
   READ FORM DATA
----------------------------------- */

$department   = isset($_POST['department']) ? sanitize_text_field($_POST['department']) : '';
$roll         = isset($_POST['roll']) ? sanitize_text_field($_POST['roll']) : '';
$reg          = isset($_POST['reg']) ? sanitize_text_field($_POST['reg']) : '';
$name         = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
$session_sem  = isset($_POST['session_sem']) ? sanitize_text_field($_POST['session_sem']) : '';
$prev_credit  = isset($_POST['prev_credit']) ? sanitize_text_field($_POST['prev_credit']) : '';
$adviser_comment = isset($_POST['adviser_comment']) ? sanitize_text_field($_POST['adviser_comment']) : '';

$c_no     = isset($_POST['course_no']) ? $_POST['course_no'] : [];
$c_title  = isset($_POST['course_title']) ? $_POST['course_title'] : [];
$c_credit = isset($_POST['course_credit']) ? $_POST['course_credit'] : [];

/* ----------------------------------
   GENERATE PDF
----------------------------------- */

$pdf = new TCPDF('P', 'mm', 'LEGAL');
$pdf->SetMargins(20, 15, 20);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->AddPage();

// Add header text
$pdf->SetFont('times', '', 12);
$pdf->Cell(0, 9, 'Heaven\'s Light is Our Guide', 0, 1, 'C');

// University title
$pdf->SetFont('times', '', 15);
$pdf->setFontSpacing(-0.15);
$pdf->Cell(0, 9, 'RAJSHAHI UNIVERSITY OF ENGINEERING & TECHNOLOGY, BANGLADESH', 0, 1, 'C');
$pdf->SetX(52.5);
$pdf->SetFont('times', '', 18);
$pdf->Cell(111, 9, 'Course Registration/Course Adjustment Form', 'B', 1, 'C');

// Department line with underline
$pdf->SetFont('times', 'B', 20);
$pdf->Cell(0, 12, $department . ' Department', 0, 1, 'C');
$pdf->Ln(6);

// Two-column layout for Roll No and Registration No
$pdf->SetFont('times', '', 13);
$pdf->Cell(17, 5, 'Roll No.:', 0, 0, 'L');
$pdf->SetFont('times', '', 13);
$pdf->Cell(40, 5, $roll, 'B', 0, 'C');

$pdf->SetFont('times', '', 13);
$pdf->Cell(53, 5, 'Registration No. with Session:', 0, 0, 'L');
$pdf->SetFont('times', '', 13);
$pdf->Cell(0, 5, $reg, 'B', 1, 'C');
$pdf->Ln(3);

// Name
$pdf->SetFont('times', '', 13);
$pdf->Cell(13, 5, 'Name:', 0, 0, 'L');
$pdf->SetFont('times', '', 13);
$pdf->Cell(0, 5, $name, 'B', 1, 'L');
$pdf->Ln(3);

// Academic session with Previous Credit
$pdf->SetFont('times', '', 13);
$pdf->Cell(58, 5, 'Academic session with Semester:', 0, 0, 'L');
$pdf->SetFont('times', '', 13);
$pdf->Cell(60, 5, $session_sem, 'B', 0, 'L');
$pdf->SetFont('times', '', 13);
$pdf->Cell(44, 5, 'Previously earned credit:', 0, 0, 'L');
$pdf->SetFont('times', '', 13);
$pdf->Cell(0, 5, $prev_credit, 'B', 1, 'L');
$pdf->Ln(5);

// Backlog Courses Table
$adviser_comment = html_entity_decode(sanitize_text_field($adviser_comment));
$courses = array_filter(array_map('trim', explode(',', $adviser_comment)));
$course_count = count($courses);

if ($course_count > 7) {
    $line_count = ceil($course_count / 7);
    $cell_height = max(15, 15 * $line_count);
    
    $lines = [];
    $current_line = [];
    
    foreach ($courses as $index => $course) {
        $current_line[] = $course;
        
        if (count($current_line) == 7 || $index == $course_count - 1) {
            $lines[] = implode(', ', $current_line);
            $current_line = [];
        }
    }
    
    $formatted_text = implode(",\n", $lines);
    
    $pdf->SetFont('times', '', 13);
    $pdf->MultiCell(35, $cell_height/2.6, "Course No. of\nBacklog Courses", 1, 'C', 0, 0, '', '', true);
    
    $pdf->SetFont('times', '', 13);
    $line_height = max(7.5, 15 / $line_count);
    $pdf->MultiCell(0, $line_height, $formatted_text, 1, 'C', 0, 1, '', '', true);
    
} else {
    $pdf->SetFont('times', '', 13);
    $pdf->MultiCell(35, 15, "Course No. of\nBacklog Courses", 1, 'C', 0, 0, '', '', true);
    
    $pdf->SetFont('times', '', 13);
    $pdf->Cell(0, 15, $adviser_comment, 1, 1, 'C');
}
$pdf->Ln(3);

// Courses to be registered title
$pdf->SetFont('times', '', 13);
$pdf->Cell(0, 5, 'Courses to be registered in this semester:', 0, 1, 'L');
$pdf->Ln(3);

// Table header
$pdf->SetFillColor(255, 255, 255);
$pdf->SetFont('times', '', 13);
$pdf->Cell(35, 8, 'Course No.', 1, 0, 'C', 1);
$pdf->Cell(116, 8, 'Course Title', 1, 0, 'C', 1);
$pdf->Cell(25, 8, 'Credit', 1, 1, 'C', 1);

// Table rows
$pdf->SetFont('times', '', 13);
$total_credit = 0;

$has_courses = !empty($c_no) || !empty($c_title) || !empty($c_credit);

if ($has_courses) {
    $max_rows = max(count($c_no), count($c_title), count($c_credit));
    
    for ($i = 0; $i < $max_rows; $i++) {
        $course_no = isset($c_no[$i]) ? sanitize_text_field($c_no[$i]) : '';
        $course_title = isset($c_title[$i]) ? sanitize_text_field($c_title[$i]) : '';
        $course_credit = isset($c_credit[$i]) ? sanitize_text_field($c_credit[$i]) : '';
        
        if (is_numeric($course_credit)) {
            $total_credit += floatval($course_credit);
        }
        
        $word_count = str_word_count($course_title);
        
        if ($word_count > 10) {
            $words = explode(' ', $course_title);
            $first_line = implode(' ', array_slice($words, 0, 5));
            $second_line = implode(' ', array_slice($words, 5, 5));
            $third_line = implode(' ', array_slice($words, 10));
            $course_title = $first_line . "\n" . $second_line . "\n" . $third_line;
            
            $cell_height = 19;
            
            $pdf->Cell(35, $cell_height, $course_no, 1, 0, 'C');
            $pdf->MultiCell(116, 19, $course_title, 1, 'L', 0, 0);
            $pdf->Cell(25, $cell_height, $course_credit, 1, 1, 'C');
            
        }elseif ($word_count > 5) {
            $words = explode(' ', $course_title);
            $first_line = implode(' ', array_slice($words, 0, 5));
            $second_line = implode(' ', array_slice($words, 5));
            $course_title = $first_line . "\n" . $second_line;
            
            $cell_height = 13;
            
            $pdf->Cell(35, $cell_height, $course_no, 1, 0, 'C');
            $pdf->MultiCell(116, 13, $course_title, 1, 'L', 0, 0);
            $pdf->Cell(25, $cell_height, $course_credit, 1, 1, 'C');
            
        } else {
            $pdf->Cell(35, 9, $course_no, 1, 0, 'C');
            $pdf->Cell(116, 9, $course_title, 1, 0, 'L');
            $pdf->Cell(25, 9, $course_credit, 1, 1, 'C');
        }
    }
} else {
    for ($i = 0; $i < 10; $i++) {
        $pdf->Cell(35, 9, '', 1, 0, 'C');
        $pdf->Cell(116, 9, '', 1, 0, 'L');
        $pdf->Cell(25, 9, '', 1, 1, 'C');
    }
}

// Total Credit row
$pdf->SetFont('times', '', 13);
$pdf->Cell(35, 9, '', 0, 0, 'C');
$pdf->Cell(116, 9, 'Total Credit of this Semester', 1, 0, 'R');
$pdf->Cell(25, 9, number_format($total_credit, 2), 1, 1, 'C');
$pdf->Ln(8);

// Adviser's Comment
$pdf->SetFont('times', '', 13);
$pdf->Cell(50, 10, 'Adviser\'s Comment (if any)___________________________________________________________', 0, 1, 'L');
$pdf->SetFont('times', '', 13);
$pdf->Cell(0, 14, '_________________________________________________________________________________', 0, 1, 'L');
$pdf->Ln(10);

// Signatures area
$signature_y = $pdf->GetY();
$pdf->SetFont('times', '', 13);
$pdf->Cell(43, 5, 'Signature of the Student', 'B', 0, 'L');
$pdf->Cell(22, 5, '', 0, 0, 'L');
$pdf->Cell(44, 5, 'Signature of the Adviser', 'B', 0, 'C');
$pdf->Cell(22, 5, '', 0, 0, 'L');
$pdf->Cell(47, 5, 'Signature of the Controller', 'B', 1, 'R');
$pdf->Ln(10);
// Date
$pdf->Cell(30, 5, 'Date:', 0, 0, 'L');
$pdf->Ln(10);

// Footer note
$pdf->Cell(90, 5, 'Students are asked to cross out the irrelevant Terms.', 'T', 1, 'L');

/* ----------------------------------
   OUTPUT PDF BASED ON DEVICE TYPE
----------------------------------- */

// Generate PDF content
$pdf_content = $pdf->Output("preview.pdf", "S");
$pdf_base64 = base64_encode($pdf_content);

// Check if it's a mobile device
function isMobileDevice() {
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $mobileKeywords = [
        'Android', 'webOS', 'iPhone', 'iPad', 'iPod', 
        'BlackBerry', 'Windows Phone', 'Mobile', 'Opera Mini', 
        'IEMobile', 'Symbian', 'Kindle', 'Silk', 'Mobi'
    ];
    
    foreach ($mobileKeywords as $keyword) {
        if (stripos($userAgent, $keyword) !== false) {
            return true;
        }
    }
    return false;
}

// If mobile device detected
if (isMobileDevice()) {
    // For mobile: Serve PDF directly
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="RUET_Course_Registration.pdf"');
    header('Content-Length: ' . strlen($pdf_content));
    echo $pdf_content;
    exit;
}

// For desktop: Return HTML with embedded PDF (as before)
echo '<!DOCTYPE html>
<html>
<head>
    <title>PDF Preview</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { 
            margin: 0; 
            padding: 0px; 
            background: #f5f5f5;
            font-family: Arial, sans-serif;
        }
        iframe { 
            width: 100%; 
            height: 100vh; 
            border: 2px solid #ddd;
            border-radius: 5px;
        }
    </style>
</head>
<body>
        <iframe src="data:application/pdf;base64,' . $pdf_base64 . '"></iframe>
</body>
</html>';
exit;
?>