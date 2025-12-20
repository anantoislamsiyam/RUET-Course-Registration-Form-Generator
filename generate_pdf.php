<?php
// generate_pdf.php
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
require_once('tcpdf/tcpdf.php');

// Database setup
global $wpdb;
$table_name = $wpdb->prefix . 'ruet_registrations';
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

$charset_collate = $wpdb->get_charset_collate();
$sql = "CREATE TABLE IF NOT EXISTS {$table_name} (
    id INT NOT NULL AUTO_INCREMENT,
    department VARCHAR(255),
    roll VARCHAR(100),
    reg_no VARCHAR(255),
    name VARCHAR(255),
    session_sem VARCHAR(255),
    prev_credit VARCHAR(50),
    adviser_comment TEXT,
    course_data LONGTEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) {$charset_collate};";
dbDelta($sql);

/* -----------------------------
   If id provided -> load from DB
   ----------------------------- */
if (isset($_GET['id']) && intval($_GET['id']) > 0) {
    $id = intval($_GET['id']);
    $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$table_name} WHERE id = %d", $id));

    if (!$row) {
        wp_die('Record not found.');
    }

    $department      = $row->department;
    $roll            = $row->roll;
    $reg             = $row->reg_no;
    $name            = $row->name;
    $session_sem     = $row->session_sem;
    $prev_credit     = $row->prev_credit;
    $adviser_comment = $row->adviser_comment;
    $courses         = json_decode($row->course_data, true);
}

/* -----------------------------
   Else POST submission -> insert
   ----------------------------- */
else {
    $department      = isset($_POST['department']) ? sanitize_text_field($_POST['department']) : '';
    $roll            = isset($_POST['roll']) ? sanitize_text_field($_POST['roll']) : '';
    $reg             = isset($_POST['reg']) ? sanitize_text_field($_POST['reg']) : '';
    $name            = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
    $session_sem     = isset($_POST['session_sem']) ? sanitize_text_field($_POST['session_sem']) : '';
    $prev_credit     = isset($_POST['prev_credit']) ? sanitize_text_field($_POST['prev_credit']) : '';
    $adviser_comment = isset($_POST['adviser_comment']) ? sanitize_textarea_field($_POST['adviser_comment']) : '';

    $course_no       = isset($_POST['course_no']) && is_array($_POST['course_no']) ? $_POST['course_no'] : [];
    $course_title    = isset($_POST['course_title']) && is_array($_POST['course_title']) ? $_POST['course_title'] : [];
    $course_credit   = isset($_POST['course_credit']) && is_array($_POST['course_credit']) ? $_POST['course_credit'] : [];

    $courses = [
        'course_no'     => $course_no,
        'course_title'  => $course_title,
        'course_credit' => $course_credit
    ];

    $json = wp_json_encode($courses);

    // Insert into database
    $inserted = $wpdb->insert(
        $table_name,
        [
            'department'      => $department,
            'roll'            => $roll,
            'reg_no'          => $reg,
            'name'            => $name,
            'session_sem'     => $session_sem,
            'prev_credit'     => $prev_credit,
            'adviser_comment' => $adviser_comment,
            'course_data'     => $json
        ],
        ['%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s']
    );

    if ($inserted === false) {
        error_log("RUET insert error: " . $wpdb->last_error);
    }
}

/* -----------------------------
   Generate PDF (matching sample format)
   ----------------------------- */

$pdf = new TCPDF('P', 'mm', 'LEGAL');
$pdf->SetMargins(20, 15, 20);
$pdf->setPrintHeader(false); // disables TCPDF header
$pdf->setPrintFooter(false); // disables TCPDF footer
$pdf->AddPage();


// Add header text
$pdf->SetFont('times', '', 12);
$pdf->Cell(0, 9, 'Heaven\'s Light is Our Guide', 0, 1, 'C');


/// University title
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
// Process backlog courses text
$adviser_comment = html_entity_decode(sanitize_text_field($adviser_comment));

// Split by commas to get individual course numbers
$courses = array_filter(array_map('trim', explode(',', $adviser_comment)));
$course_count = count($courses);

if ($course_count > 7) {
    // Calculate how many lines we need (7 courses per line)
    $line_count = ceil($course_count / 7);
    $cell_height = max(15, 15 * $line_count); // Minimum 15mm
    
    // Break into lines after every 7 courses
    $lines = [];
    $current_line = [];
    
    foreach ($courses as $index => $course) {
        $current_line[] = $course;
        
        // If we have 7 courses or this is the last course
        if (count($current_line) == 7 || $index == $course_count - 1) {
            $lines[] = implode(', ', $current_line);
            $current_line = [];
        }
    }
    
    $formatted_text = implode(",\n", $lines);
    
    // Left cell - "Course No. of Backlog Courses" with dynamic height
    $pdf->SetFont('times', '', 13);
    $pdf->MultiCell(35, $cell_height/2.6, "Course No. of\nBacklog Courses", 1, 'C', 0, 0, '', '', true);
    
    // Right cell - Course numbers with dynamic height
    $pdf->SetFont('times', '', 13); // Slightly smaller font
    
    // Calculate line height for right cell (15mm per line minimum)
    $line_height = max(7.5, 15 / $line_count); // Distribute height evenly
    
    $pdf->MultiCell(0, $line_height, $formatted_text, 1, 'C', 0, 1, '', '', true);
    
} else {
    // Normal single line (15mm height)
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

// Check if we have any courses
$has_courses = !empty($course_no) || !empty($course_title) || !empty($course_credit);

if ($has_courses) {
    $max_rows = max(count($course_no), count($course_title), count($course_credit));
    
    for ($i = 0; $i < $max_rows; $i++) {
        $r_no = isset($course_no[$i]) ? sanitize_text_field($course_no[$i]) : '';
        $r_title = isset($course_title[$i]) ? html_entity_decode(sanitize_text_field($course_title[$i])) : '';
        $r_credit = isset($course_credit[$i]) ? sanitize_text_field($course_credit[$i]) : '';
        
        // Calculate total credits
        if (is_numeric($r_credit)) {
            $total_credit += floatval($r_credit);
        }
        
        // Check if course title is long (more than 5 words)
        $word_count = str_word_count($r_title);
        
        if ($word_count > 10) {
            // For long titles, wrap text after 4 words
            $words = explode(' ', $r_title);
            $first_line = implode(' ', array_slice($words, 0, 5));
            $second_line = implode(' ', array_slice($words, 5, 5));
            $third_line = implode(' ', array_slice($words, 10));
            $r_title = $first_line . "\n" . $second_line . "\n" . $third_line;
            
            // Calculate height: 9 for first line, 9 for second line
            $cell_height = 19;
            
            // Add table row with increased height
            $pdf->Cell(35, $cell_height, $r_no, 1, 0, 'C');
            $pdf->MultiCell(116, 19, $r_title, 1, 'L', 0, 0); // Use MultiCell for wrapping
            $pdf->Cell(25, $cell_height, $r_credit, 1, 1, 'C');
            
        } elseif ($word_count > 5) {
            // For long titles, wrap text after 4 words
            $words = explode(' ', $r_title);
            $first_line = implode(' ', array_slice($words, 0, 5));
            $second_line = implode(' ', array_slice($words, 5));
            $r_title = $first_line . "\n" . $second_line;
            
            // Calculate height: 9 for first line, 9 for second line
            $cell_height = 13;
            
            // Add table row with increased height
            $pdf->Cell(35, $cell_height, $r_no, 1, 0, 'C');
            $pdf->MultiCell(116, 13, $r_title, 1, 'L', 0, 0); // Use MultiCell for wrapping
            $pdf->Cell(25, $cell_height, $r_credit, 1, 1, 'C');
            
        } else {
            // Normal height for short titles
            $pdf->Cell(35, 9, $r_no, 1, 0, 'C');
            $pdf->Cell(116, 9, $r_title, 1, 0, 'L');
            $pdf->Cell(25, 9, $r_credit, 1, 1, 'C');
        }
    }
    
    // Fill remaining rows if less than 10
    $filled_rows = $max_rows;
    while ($filled_rows < 10) {
        $pdf->Cell(35, 9, '', 1, 0, 'C');
        $pdf->Cell(116, 9, '', 1, 0, 'L');
        $pdf->Cell(25, 9, '', 1, 1, 'C');
        $filled_rows++;
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

// Output for download
$filename = "RUET_Course_Registration_" . ($roll ? preg_replace('/[^A-Za-z0-9_-]/', '_', $roll) : time()) . ".pdf";
$pdf->Output($filename, "D");
exit;
?>