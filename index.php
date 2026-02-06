<!DOCTYPE html>
<html>
<head>
    <title>RUET Course Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <style>
        :root {
            --bg-primary: #fff;
            --bg-secondary: #f8f9fa;
            --bg-glass: rgba(255, 255, 255, 0.95);
            --text-primary: #2c3e50;
            --text-secondary: #adb5bd;
            --border-color: rgba(0,0,0,0.1);
            --shadow-color: rgba(0,0,0,0.1);
            --card-bg: rgba(240, 240, 240, 0.3);
            --table-hover: rgba(52, 152, 219, 0.05);
            --input-bg: #fff;
            --input-border: #ced4da;
        }

        [data-theme="dark"] {
            --bg-primary: #121212;
            --bg-secondary: #1e1e1e;
            --bg-glass: rgba(30, 30, 30, 0.95);
            --text-primary: #f8f9fa;
            --text-secondary: #686e73;
            --border-color: rgba(255,255,255,0.1);
            --shadow-color: rgba(0,0,0,0.3);
            --card-bg: rgba(50, 50, 50, 0.3);
            --table-hover: rgba(52, 152, 219, 0.1);
            --input-bg: #2d2d2d;
            --input-border: #495057;
        }

        body { 
            background: var(--bg-primary);
            color: var(--text-primary);
            min-height: 100vh;
            padding: 20px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        @media (max-width: 768px) {
            body{
                padding: 20px 0px 0px 0px;
            }
        }
        .glass-box {
            background: var(--bg-glass);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 20px 40px var(--shadow-color);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            position: relative;
        }
        @media (max-width: 768px) {
            .glass-box {
                padding: 15px;
                border-radius: 10px;
            }
        }
        .form-section {
            background: var(--card-bg);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }
        iframe {
            width: 100%;
            height: 900px;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            background: white;
            box-shadow: 0 5px 15px var(--shadow-color);
        }
        .header-title {
            color: var(--text-primary);
            border-bottom: 3px solid #3498db;
            padding-bottom: 15px;
            margin-bottom: 30px;
            font-weight: 700;
        }
        .text-muted {
            color: var(--text-primary) !important;
        }
        @media (max-width: 768px) {
            .header-title {
                font-size: 22px;
                padding-top: 10px;
            }
            .text-muted{
                margin: -10px 0px;
            }
            .form-section {
                padding: 20px 10px;
            }
        }
        
        .btn-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            transition: all 0.3s;
        }
        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        .course-row {
            transition: all 0.3s;
        }
        .course-row:hover {
            background-color: var(--table-hover);
        }
        .ruet-logo {
            max-width: 150px;
            height: auto;
            margin-bottom: 15px;
        }
        .course-search-input {
            position: relative;
        }
        .autocomplete-suggestions {
            position: fixed;
            z-index: 9999;
            max-height: 350px;
            overflow-y: auto;
            background: var(--bg-primary);
            color: var(--text-primary);
            border: 1px solid var(--border-color);
            border-radius: 0 0 4px 4px;
            box-shadow: 0 6px 12px var(--shadow-color);
            display: none;
        }
        .autocomplete-suggestion {
            padding: 8px 12px;
            cursor: pointer;
            border-bottom: 1px solid var(--border-color);
            transition: background-color 0.2s;
        }
        .autocomplete-suggestion:last-child {
            border-bottom: none;
        }
        .autocomplete-suggestion:hover {
            background-color: var(--table-hover);
        }
        .autocomplete-selected {
            background-color: rgba(52, 152, 219, 0.2);
        }
        .course-info {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .course-code {
            font-weight: bold;
            color: var(--text-primary);
        }
        .course-credit-badge {
            background-color: #6c757d;
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 0.85em;
            white-space: nowrap;
        }
        .course-title {
            color: var(--text-secondary);
            font-size: 0.9em;
            margin-top: 2px;
            line-height: 1.3;
        }
        .search-hint {
            font-size: 0.8em;
            color: var(--text-secondary);
            margin-top: 5px;
            font-style: italic;
        }
        
        /* Theme and Info Buttons Container */
        .top-controls-container {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-bottom: 20px;
            padding: 0 15px;
        }
        
        @media (max-width: 576px) {
            .top-controls-container {
                justify-content: center;
                margin-bottom: 15px;
                flex-wrap: wrap;
            }
        }
        
        /* Theme Switch */
        .theme-switch-wrapper {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--card-bg);
            padding: 8px 15px;
            border-radius: 25px;
            border: 1px solid var(--border-color);
            box-shadow: 0 2px 8px var(--shadow-color);
            transition: all 0.3s ease;
        }
        
        .theme-switch-wrapper:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px var(--shadow-color);
        }
        
        .theme-switch {
            display: inline-block;
            height: 24px;
            position: relative;
            width: 48px;
        }
        .theme-switch input {
            display: none;
        }
        .slider {
            background-color: #ccc;
            bottom: 0;
            cursor: pointer;
            left: 0;
            position: absolute;
            right: 0;
            top: 0;
            transition: .4s;
        }
        .slider:before {
            background-color: #fff;
            bottom: 2px;
            content: "";
            height: 20px;
            left: 2px;
            position: absolute;
            transition: .4s;
            width: 20px;
        }
        input:checked + .slider {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        input:checked + .slider:before {
            transform: translateX(24px);
        }
        .slider.round {
            border-radius: 34px;
        }
        .slider.round:before {
            border-radius: 50%;
        }
        .theme-label {
            font-size: 14px;
            color: var(--text-primary);
            font-weight: 500;
            min-width: 60px;
            text-align: center;
        }
        
        /* Info Button */
        .info-btn-wrapper {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--card-bg);
            padding: 8px 15px;
            border-radius: 25px;
            border: 1px solid var(--border-color);
            box-shadow: 0 2px 8px var(--shadow-color);
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .info-btn-wrapper:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px var(--shadow-color);
            background: rgba(52, 152, 219, 0.1);
        }
        
        .info-icon {
            font-size: 20px;
            color: var(--text-primary);
        }
        
        .info-label {
            font-size: 14px;
            color: var(--text-primary);
            font-weight: 500;
        }
        
        /* Modal Custom Styling */
        .modal-content {
            background: var(--bg-glass);
            border: 1px solid var(--border-color);
            box-shadow: 0 20px 40px var(--shadow-color);
        }
        
        .modal-header {
            border-bottom: 1px solid var(--border-color);
            background: var(--card-bg);
        }
        
        .modal-title {
            color: var(--text-primary);
            font-weight: 600;
        }
        
        .modal-body {
            color: var(--text-primary);
        }
        
        .modal-footer {
            border-top: 1px solid var(--border-color);
            background: var(--card-bg);
        }
        
        .info-section {
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border-color);
        }
        
        .info-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .info-section h5 {
            color: #3498db;
            margin-bottom: 15px;
            font-weight: 600;
        }
        
        .info-section ul {
            padding-left: 20px;
        }
        
        .info-section li {
            margin-bottom: 8px;
            color: var(--text-primary);
        }
        
        .developer-info {
            background: rgba(52, 152, 219, 0.1);
            padding: 15px;
            border-radius: 10px;
            border-left: 4px solid #3498db;
        }
        
        .developer-info p {
            margin-bottom: 5px;
            color: var(--text-primary);
        }
        
        .footer-note {
            text-align: center;
            margin-top: 25px;
            padding-top: 15px;
            border-top: 2px solid var(--border-color);
        }
        
        .ruet-link {
            color: #e74c3c;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .ruet-link:hover {
            color: #c0392b;
            text-decoration: underline;
        }
        
        /* Form controls styling for dark mode */
        .form-control {
            background-color: var(--input-bg);
            color: var(--text-primary);
            border: 1px solid var(--input-border);
            transition: all 0.3s ease;
            border-radius: 8px;
        }
        .form-control:focus {
            background-color: var(--input-bg);
            color: var(--text-primary);
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        .form-control::placeholder {
            color: var(--text-secondary);
        }
        
        /* Table styling for dark mode */
        .table {
            color: var(--text-primary);
            border-radius: 10px;
            overflow: hidden;
        }
        
        .table thead th {
            color: var(--text-primary);
            border-top: none;
            background: var(--card-bg);
        }
        
        .table-light {
            background-color: var(--card-bg);
            color: var(--text-primary);
        }
        .table-hover tbody tr:hover {
            color: var(--text-primary);
        }
        
        /* Badge styling */
        mark {
            background-color: #fff3cd;
            color: #856404;
        }
        [data-theme="dark"] mark {
            background-color: #856404;
            color: #fff3cd;
        }
        
        /* Header wrapper to handle spacing */
        .header-wrapper {
            position: relative;
            padding-top: 10px;
        }
        
        /* Make sure controls don't overlap on tablets */
        @media (min-width: 577px) and (max-width: 992px) {
            .header-title {
                padding-right: 220px;
            }
            .top-controls-container {
                position: absolute;
                top: 0;
                right: 15px;
                margin-bottom: 0;
                padding: 0;
            }
        }
        
        /* For very small screens */
        @media (max-width: 400px) {
            .theme-switch-wrapper,
            .info-btn-wrapper {
                padding: 6px 12px;
            }
            .theme-switch {
                width: 42px;
                height: 22px;
            }
            .slider:before {
                height: 18px;
                width: 18px;
            }
            input:checked + .slider:before {
                transform: translateX(20px);
            }
            .theme-label,
            .info-label {
                font-size: 13px;
            }
            .info-icon {
                font-size: 18px;
            }
        }
        
        /* RESPONSIVE COURSE ENTRY STYLING */
        .course-entry-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        
        .course-entry-card {
            background: var(--bg-primary);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 12px var(--shadow-color);
            transition: all 0.3s ease;
            position: relative;
        }
        
        .course-entry-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px var(--shadow-color);
        }
        
        .course-entry-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--card-bg);
        }
        
        .course-entry-number {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 16px;
        }
        
        .remove-course-btn {
            background: #dc3545;
            color: white;
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .remove-course-btn:hover {
            background: #c82333;
            transform: scale(1.1);
        }
        
        .remove-course-btn:disabled {
            background: #6c757d;
            cursor: not-allowed;
            transform: none;
        }
        
        .course-fields-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 15px;
        }
        
        .field-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        
        .field-group label {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0;
        }
        
        /* Mobile Responsive Layout */
        @media (max-width: 768px) {
            .course-fields-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }
            
            .course-entry-header {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }
            
            .course-entry-number {
                margin-bottom: 5px;
            }
            
            .remove-course-btn {
                position: absolute;
                top: 10px;
                right: 10px;
                width: 32px;
                height: 32px;
            }
        }
        
        /* Desktop specific adjustments */
        @media (min-width: 769px) {
            .course-fields-grid {
                grid-template-columns: 1fr 2fr 1fr;
            }
        }
        
        /* Hide table on mobile, show cards */
        .courses-table-container {
            display: block;
        }
        
        .courses-cards-container {
            display: none;
        }
        
        @media (max-width: 768px) {
            .courses-table-container {
                display: none;
            }
            
            .courses-cards-container {
                display: block;
            }
            
            .table-responsive {
                display: none;
            }
        }
        
        /* Add course button styling */
        .add-course-btn {
            background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            margin: 0;
        }
        
        .add-course-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(46, 204, 113, 0.3);
        }
        
        /* Total credit display */
        .total-credit-display {
            background: var(--card-bg);
            padding: 15px;
            border-radius: 10px;
            border: 2px solid var(--border-color);
            text-align: center;
            margin-top: 20px;
        }
        
        .total-credit-value {
            font-size: 24px;
            font-weight: bold;
            color: #2ecc71;
            margin-left: 5px;
        }
    </style>
</head>

<body>

<div class="container">
    <div class="glass-box">
        <!-- Theme and Info Buttons Container -->
        <div class="top-controls-container">
            <!-- Info Button -->
            <div class="info-btn-wrapper" data-bs-toggle="modal" data-bs-target="#infoModal">
                <i class="bi bi-info-circle info-icon"></i>
                <span class="info-label">Info</span>
            </div>
            
            <!-- Theme Switch -->
            <div class="theme-switch-wrapper">
                <div class="theme-switch">
                    <input type="checkbox" id="theme-toggle">
                    <label for="theme-toggle" class="slider round"></label>
                </div>
                <span class="theme-label" id="theme-label">System</span>
            </div>
        </div>

        <!-- Header -->
        <div class="header-wrapper">
            <div class="text-center mb-4">
                <h1 class="header-title">
                    <i class="bi bi-file-earmark-text"></i> RUET Course Registration Form Generator
                </h1>
                <p class="text-muted">Generate your course registration form in the official format of RUET</p>
            </div>
        </div>

        <!-- Main Form -->
        <form id="regForm" action="generate_pdf.php" method="POST" target="_blank">
            
            <!-- Student Information -->
            <div class="form-section">
                <h4><i class="bi bi-person-badge"></i> Student Information</h4>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Department</label>
                        <div class="course-search-input">
                            <input type="text" name="department" id="departmentInput" class="form-control" 
                                   placeholder="e.g., Mechanical Engineering"
                                   autocomplete="off"
                                   oninput="searchDepartment(this)"
                                   onfocus="showDepartmentSuggestions(this)">
                            <div class="autocomplete-suggestions" id="department-suggestions"></div>
                        </div>
                        <input type="hidden" name="dept_code" id="deptCodeInput" value="">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Roll No</label>
                        <input type="text" name="roll" class="form-control" placeholder="e.g., 2302001">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Registration No. with Session</label>
                        <input type="text" name="reg" class="form-control" placeholder="e.g., 301/2023-2024">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Your full name">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Academic session with semester</label>
                        <input type="text" name="session_sem" class="form-control" placeholder="e.g., 1st Year Odd">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Previously earned credit</label>
                        <input type="text" name="prev_credit" class="form-control" placeholder="e.g., 39.50">
                    </div>
                </div>
            </div>

            <!-- Courses Section -->
            <div class="form-section">
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                    <h4 class="mb-0"><i class="bi bi-book"></i> Courses to Register</h4>
                    <button type="button" onclick="addCourse()" class="btn add-course-btn mt-2 mt-md-0">
                        <i class="bi bi-plus-circle"></i> Add Course
                    </button>
                </div>
                
                <!-- Desktop: Table View -->
                <div class="courses-table-container">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th width="20%">Course No.</th>
                                    <th width="55%">Course Title</th>
                                    <th width="15%">Credit</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody id="rows">
                                <tr class="course-row" data-course-id="0">
                                    <td>
                                        <div class="course-search-input">
                                            <input type="text" name="course_no[]" class="form-control course-no-input" 
                                                   placeholder="Hum 2121"
                                                   autocomplete="off"
                                                   oninput="searchCourseByCode(this)"
                                                   onfocus="showCodeSuggestions(this)">
                                            <div class="autocomplete-suggestions" id="code-suggestions-0"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="course-search-input">
                                            <input type="text" name="course_title[]" class="form-control course-title-input" 
                                                   placeholder="Accounting, Ethics & Industrial Law"
                                                   autocomplete="off"
                                                   oninput="searchCourseByTitle(this)"
                                                   onfocus="showTitleSuggestions(this)">
                                            <div class="autocomplete-suggestions" id="title-suggestions-0"></div>
                                        </div>
                                    </td>
                                    <td><input type="text" name="course_credit[]" class="form-control course-credit-input" 
                                               placeholder="3.00" oninput="calculateTotalCredit()"></td>
                                    <td>
                                        <button type="button" onclick="removeCourse(0)" class="btn btn-danger btn-sm" disabled>
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Mobile: Card View -->
                <div class="courses-cards-container">
                    <div class="course-entry-container" id="course-cards">
                        <div class="course-entry-card" data-course-id="0">
                            <div class="course-entry-header">
                                <div class="course-entry-number">1</div>
                                <h6 class="mb-0">Course Details</h6>
                                <button type="button" onclick="removeCourse(0)" class="remove-course-btn" disabled>
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                            <div class="course-fields-grid">
                                <div class="field-group">
                                    <label>Course No.</label>
                                    <div class="course-search-input">
                                        <input type="text" name="course_no_mobile[]" class="form-control course-no-input-mobile" 
                                               placeholder="Hum 2121"
                                               autocomplete="off"
                                               oninput="searchCourseByCodeMobile(this)"
                                               onfocus="showCodeSuggestionsMobile(this)">
                                        <div class="autocomplete-suggestions" id="code-suggestions-mobile-0"></div>
                                    </div>
                                </div>
                                <div class="field-group">
                                    <label>Course Title</label>
                                    <div class="course-search-input">
                                        <input type="text" name="course_title_mobile[]" class="form-control course-title-input-mobile" 
                                               placeholder="Accounting, Ethics & Industrial Law"
                                               autocomplete="off"
                                               oninput="searchCourseByTitleMobile(this)"
                                               onfocus="showTitleSuggestionsMobile(this)">
                                        <div class="autocomplete-suggestions" id="title-suggestions-mobile-0"></div>
                                    </div>
                                </div>
                                <div class="field-group">
                                    <label>Credit</label>
                                    <input type="text" name="course_credit_mobile[]" class="form-control course-credit-input-mobile" 
                                            placeholder="3.00" oninput="updateCreditFromMobile(this)">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Total Credit Display -->
                <div class="total-credit-display">
                    <h5 class="mb-0">Total Credit: <span class="total-credit-value" id="totalCredit">0.00</span></h5>
                </div>
            </div>

            <!-- Adviser Comment -->
            <div class="form-section">
                <h4><i class="bi bi-exclamation-triangle"></i> Backlog Courses</h4>
                <div class="row">
                    <div class="col-12">
                        <label class="form-label">Course No. of Backlog Courses (if any)</label>
                        <textarea name="adviser_comment" class="form-control" rows="3" placeholder="Math 1121, Chem 1121, Phy 1122"></textarea>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="text-center">
                <button type="button" onclick="previewPDF()" class="btn-custom">
                    <i class="bi bi-eye"></i> Preview PDF
                </button>
                <button type="submit" class="btn-custom" style="background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);">
                    <i class="bi bi-download"></i> Download
                </button>
            </div>
        </form>

        <!-- Preview Section - Hidden on Mobile/Tablet -->
        <div class="form-section mt-4 d-none d-lg-block">
            <h4><i class="bi bi-file-pdf"></i> Live Preview</h4>
            <iframe id="pdfFrame"></iframe>
        </div>
    </div>
</div>

<!-- Info Modal -->
<div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoModalLabel">
                    <i class="bi bi-info-circle me-2"></i>About RUET Course Registration Form Generator
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- About Section -->
                <div class="info-section">
                    <h5><i class="bi bi-file-earmark-text me-2"></i>About</h5>
                    <p>This is a specialized web application designed specifically for students of Rajshahi University of Engineering & Technology (RUET) to generate their course registration forms in the official university format.</p>
                    <p>The tool automates the process of creating registration forms, ensuring compliance with RUET's official formatting requirements while providing an intuitive and user-friendly interface.</p>
                </div>
                
                <!-- Features Section -->
                <div class="info-section">
                    <h5><i class="bi bi-star-fill me-2"></i>Features</h5>
                    <ul>
                        <li><strong>Smart Course Search:</strong> Quickly find courses by code or title with intelligent autocomplete suggestions</li>
                        <li><strong>Automated Calculations:</strong> Automatic total credit calculation as you add courses</li>
                        <li><strong>Real-time Preview:</strong> Instant PDF preview before downloading</li>
                        <li><strong>Easy Course Management:</strong> Add or remove courses with single clicks</li>
                        <li><strong>Backlog Course Tracking:</strong> Dedicated section for backlog courses</li>
                        <li><strong>Official Format:</strong> Generates PDF in RUET's official registration form format</li>
                        <li><strong>Course Database:</strong> Pre-loaded with courses from all Engineering Departments.</li>
                    </ul>
                </div>
                
                <!-- Developer Section -->
                <div class="info-section">
                    <h5><i class="bi bi-person-badge me-2"></i>Developer</h5>
                    <div class="developer-info">
                        <p><strong>Md. Ananto Islam Siyam</strong></p>
                        <p>23 Series, Department of Mechanical Engineering</p>
                        <p>Rajshahi University of Engineering & Technology (RUET)</p>
                    </div>
                </div>
                
                <!-- Footer Note -->
                <div class="footer-note">
                    <p><strong>Property of RUET MechaVerse</strong></p>
                    <p>A platform dedicated to Mechanical Engineering students of RUET</p>
                    <p>Visit: <a href="https://mechaverse.wealthdock.org/" target="_blank" class="ruet-link">RUET MechaVerse</a></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="https://mechaverse.wealthdock.org/" target="_blank" class="btn btn-primary">
                    <i class="bi bi-box-arrow-up-right me-2"></i>Visit MechaVerse
                </a>
            </div>
        </div>
    </div>
</div>

<script>
let rowCount = 1;
let currentSuggestions = null;
let currentInput = null;
let lastSearchType = null; // 'code' or 'title'
let selectedDepartment = null;

// Department Database
        const departmentDatabase = [{
                title: "Mechanical Engineering",
                code: "me",
                fullName: "Department of Mechanical Engineering"
            },
            {
                title: "Civil Engineering",
                code: "ce",
                fullName: "Department of Civil Engineering"
            },
            {
                title: "Urban and Regional Planning",
                code: "urp",
                fullName: "Department of Urban and Regional Planning"
            },
            {
                title: "Architecture",
                code: "arch",
                fullName: "Department of Architecture"
            },
            {
                title: "Building Engineering and Construction Management",
                code: "becm",
                fullName: "Department of Building Engineering and Construction Management"
            },
            {
                title: "Industrial and Production Engineering",
                code: "ipe",
                fullName: "Department of Industrial and Production Engineering"
            },
            {
                title: "Ceramics and Metallurgical Engineering",
                code: "cme",
                fullName: "Department of Ceramics and Metallurgical Engineering"
            },
            {
                title: "Mechatronics Engineering",
                code: "mte",
                fullName: "Department of Mechatronics Engineering"
            },
            {
                title: "Materials Science and Engineering",
                code: "mse",
                fullName: "Department of Materials Science and Engineering"
            },
            {
                title: "Chemical Engineering",
                code: "che",
                fullName: "Department of Chemical Engineering"
            },
            {
                title: "Electrical and Electronic Engineering",
                code: "eee",
                fullName: "Department of Electrical and Electronic Engineering"
            },
            {
                title: "Computer Science and Engineering",
                code: "cse",
                fullName: "Department of Computer Science and Engineering"
            },
            {
                title: "Electrical and Computer Engineering",
                code: "ece",
                fullName: "Department of Electrical and Computer Engineering"
            },
            {
                title: "Electronic and Telecommunication Engineering",
                code: "ete",
                fullName: "Department of Electronic and Telecommunication Engineering"
            }
        ];

// Course Database - All RUET Engineering Courses
        const courseDatabase = [
            // 1st Year 1st Semester
            {
                code: "Chem 1121",
                title: "Chemistry",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "Phy 1121",
                title: "Physics",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "Hum 1121",
                title: "Economics and Sociology",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "Math 1121",
                title: "Differential Calculus & Geometry",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 1101",
                title: "Basic Mechanical Engineering",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "Chem 1122",
                title: "Chemistry Sessional",
                credit: "0.75",
                dept: "me"
            },
            {
                code: "Phy 1122",
                title: "Physics Sessional",
                credit: "0.75",
                dept: "me"
            },
            {
                code: "ME 1102",
                title: "Basic Mechanical Engineering Sessional",
                credit: "0.75",
                dept: "me"
            },
            {
                code: "ME 1100",
                title: "Mechanical Engineering Drawing",
                credit: "1.50",
                dept: "me"
            },
            {
                code: "MES 1108",
                title: "Shop Practice",
                credit: "1.50",
                dept: "me"
            },

            // 1st Year 2nd Semester
            {
                code: "Hum 1221",
                title: "Technical English",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "Math 1221",
                title: "Vector, Matrix & Integral Calculus",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "CSE 1281",
                title: "Computer and Programming Language",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "EEE 1281",
                title: "Electrical Circuits",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 1207",
                title: "Production Process",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "Hum 1222",
                title: "Technical English Sessional",
                credit: "1.00",
                dept: "me"
            },
            {
                code: "CSE 1282",
                title: "Computer and Programming Language Sessional",
                credit: "1.50",
                dept: "me"
            },
            {
                code: "EEE 1282",
                title: "Electrical Circuits Sessional",
                credit: "0.75",
                dept: "me"
            },
            {
                code: "ME 1208",
                title: "Production Process Sessional",
                credit: "1.50",
                dept: "me"
            },

            // 2nd Year 1st Semester
            {
                code: "Hum 2121",
                title: "Accounting, Ethics and Industrial Law",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "Math 2121",
                title: "Differential Equation, Complex Variable and Harmonic Analysis",
                credit: "4.00",
                dept: "me"
            },
            {
                code: "ME 2101",
                title: "Thermodynamics",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 2103",
                title: "Engineering Mechanics-I",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 2105",
                title: "Fluid Mechanics-I",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 2102",
                title: "Thermodynamics Sessional",
                credit: "1.50",
                dept: "me"
            },
            {
                code: "ME 2106",
                title: "Fluid Mechanics-I Sessional",
                credit: "1.50",
                dept: "me"
            },
            {
                code: "ME 2100",
                title: "Computer Aided Drawing",
                credit: "1.50",
                dept: "me"
            },

            // 2nd Year 2nd Semester
            {
                code: "Math 2221",
                title: "Numerical Analysis and Statistics",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "EEE 2281",
                title: "Electrical Machines and Electronics",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 2203",
                title: "Engineering Mechanics-II",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 2207",
                title: "Measurement, Quality Control & Materials Handling",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 2209",
                title: "Mechanics of Solids",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "EEE 2282",
                title: "Electrical Machines and Electronics Sessional",
                credit: "1.50",
                dept: "me"
            },
            {
                code: "Math 2222",
                title: "Numerical Analysis and Statistics Sessional",
                credit: "1.50",
                dept: "me"
            },
            {
                code: "ME 2204",
                title: "Engineering Mechanics Sessional",
                credit: "0.75",
                dept: "me"
            },
            {
                code: "ME 2208",
                title: "Measurement, Quality Control and Materials Handling Sessional",
                credit: "0.75",
                dept: "me"
            },
            {
                code: "ME 2210",
                title: "Mechanics of Solids Sessional",
                credit: "0.75",
                dept: "me"
            },

            // 3rd Year 1st Semester
            {
                code: "ME 3101",
                title: "Heat Transfer I",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 3105",
                title: "Fluid Mechanics II",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 3109",
                title: "Design of Machine Elements I",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 3115",
                title: "Instrumentation and Control",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 3119",
                title: "Engineering Materials and Metallurgy",
                credit: "4.00",
                dept: "me"
            },
            {
                code: "ME 3106",
                title: "Fluid Mechanics II Sessional",
                credit: "0.75",
                dept: "me"
            },
            {
                code: "ME 3110",
                title: "Design of Machine Elements I Sessional",
                credit: "0.75",
                dept: "me"
            },
            {
                code: "ME 3114",
                title: "CFD Sessional",
                credit: "0.75",
                dept: "me"
            },
            {
                code: "ME 3116",
                title: "Instrumentation and Control Sessional",
                credit: "0.75",
                dept: "me"
            },
            {
                code: "ME 3120",
                title: "Engineering Materials and Metallurgy Sessional",
                credit: "0.75",
                dept: "me"
            },

            // 3rd Year 2nd Semester
            {
                code: "ME 3201",
                title: "Heat Transfer II",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 3203",
                title: "Machine Dynamics and Vibration",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 3209",
                title: "Design of Machine Elements II",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 3213",
                title: "Optional I",
                credit: "3.00",
                dept: "me"
            },
            //{code: "ME 3221", title: "Energy Engineering and Technology", credit: "3.00", dept: "me"},
            {
                code: "ME 3215",
                title: "Basic Mechatronics Engineering",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 3202",
                title: "Heat Transfer II Sessional",
                credit: "1.50",
                dept: "me"
            },
            {
                code: "ME 3204",
                title: "Machine Dynamics and Vibration Sessional",
                credit: "0.75",
                dept: "me"
            },
            {
                code: "ME 3210",
                title: "Design of Machine Elements II Sessional",
                credit: "1.50",
                dept: "me"
            },
            {
                code: "ME 3200",
                title: "Case Study in Mechanical Engineering",
                credit: "1.00",
                dept: "me"
            },
            {
                code: "ME 3216",
                title: "Basic Mechatronics Engineering Sessional",
                credit: "0.75",
                dept: "me"
            },

            // 4th Year 1st Semester
            {
                code: "ME 4101",
                title: "Applied Thermodynamics I",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 4111",
                title: "Refrigeration and Mechanical Equipment in Buildings",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 4117",
                title: "Production Planning and Control",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 4121",
                title: "Power Plant Engineering",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 4113",
                title: "Optional II",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 4102",
                title: "Applied Thermodynamics I Sessional",
                credit: "0.75",
                dept: "me"
            },
            {
                code: "ME 4112",
                title: "Refrigeration and Mechanical Equipment in Buildings Sessional",
                credit: "0.75",
                dept: "me"
            },
            {
                code: "ME 4100",
                title: "Project and Thesis",
                credit: "1.50",
                dept: "me"
            },
            {
                code: "ME 4110",
                title: "Seminar",
                credit: "1.00",
                dept: "me"
            },
            {
                code: "ME 4120",
                title: "Industrial Training",
                credit: "1.00",
                dept: "me"
            },

            // 4th Year 2nd Semester
            {
                code: "ME 4201",
                title: "Applied Thermodynamics II",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 4205",
                title: "Fluid Machinery",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 4207",
                title: "Machine Tools and Tool Design",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 4217",
                title: "Industrial Management",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 4213",
                title: "Optional III",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 4206",
                title: "Fluid Machinery Sessional",
                credit: "0.75",
                dept: "me"
            },
            {
                code: "ME 4208",
                title: "Machine Tools and Tool Design Sessional",
                credit: "0.75",
                dept: "me"
            },
            {
                code: "ME 4200",
                title: "Project and Thesis",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 4210",
                title: "Seminar",
                credit: "1.00",
                dept: "me"
            },

            // Optional Courses
            {
                code: "ME 3213(a)",
                title: "Energy Engineering & Technology",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 3213(b)",
                title: "Mechanical Behavior of Materials",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 3213(c)",
                title: "Computational Fluid Dynamics (CFD)",
                credit: "3.00",
                dept: "me"
            },

            {
                code: "ME 4113(a)",
                title: "Computer Aided Design",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 4113(b)",
                title: "Energy Auditing",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 4113(c)",
                title: "Nuclear Engineering",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 4113(d)",
                title: "Polymer Processing",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 4113(e)",
                title: "Operation Research",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 4113(f)",
                title: "Robotics",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 4113(g)",
                title: "Biomechanics",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 4113(h)",
                title: "Tribology",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 4113(i)",
                title: "Bio Statistics",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 4113(j)",
                title: "Solar Energy",
                credit: "3.00",
                dept: "me"
            },

            {
                code: "ME 4213(a)",
                title: "Automobile Engineering",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 4213(b)",
                title: "Intelligent Control Engineering",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 4213(c)",
                title: "Aerodynamics",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 4213(d)",
                title: "Managerial Economics",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 4213(e)",
                title: "Noise and Vibration",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 4213(f)",
                title: "Bio Transport",
                credit: "3.00",
                dept: "me"
            },
            {
                code: "ME 4213(g)",
                title: "Railway Engineering",
                credit: "3.00",
                dept: "me"
            },


            // Industrial & Production Engineering Courses
            // 1st Year 1st Semester
            {
                code: "Chem 1123",
                title: "Inorganic and Physical Chemistry",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "Phy 1123",
                title: "Physics-I",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "Math 1123",
                title: "Engineering Mathematics-I",
                credit: "4.00",
                dept: "ipe"
            },
            {
                code: "Hum 1123",
                title: "Economics",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "EEE 1183",
                title: "Electrical Engineering-I",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "IPE 1100",
                title: "Engineering Graphics-I",
                credit: "1.50",
                dept: "ipe"
            },
            {
                code: "Chem 1124",
                title: "Chemistry Lab",
                credit: "0.75",
                dept: "ipe"
            },
            {
                code: "Phy 1124",
                title: "Physics-I Lab",
                credit: "0.75",
                dept: "ipe"
            },
            {
                code: "EEE 1184",
                title: "Electrical Engineering-I Lab",
                credit: "1.50",
                dept: "ipe"
            },

            // 1st Year 2nd Semester
            {
                code: "Chem 1223",
                title: "Industrial Chemistry",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "Phy 1223",
                title: "Physics-II",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "Math 1223",
                title: "Engineering Mathematics-II",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "ME 1251",
                title: "Thermodynamics and Heat Transfer",
                credit: "4.00",
                dept: "ipe"
            },
            {
                code: "EEE 1283",
                title: "Electrical Engineering-II",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "IPE 1200",
                title: "Engineering Graphics-II and CAD Lab",
                credit: "1.50",
                dept: "ipe"
            },
            {
                code: "IPES 1202",
                title: "Shop Practice-I",
                credit: "0.75",
                dept: "ipe"
            },
            {
                code: "Phy 1224",
                title: "Physics-II Lab",
                credit: "0.75",
                dept: "ipe"
            },
            {
                code: "EEE 1284",
                title: "Electrical Engineering-II Lab",
                credit: "1.50",
                dept: "ipe"
            },

            // 2nd Year 1st Semester
            {
                code: "IPE 2101",
                title: "Engineering Economy",
                credit: "2.00",
                dept: "ipe"
            },
            {
                code: "IPE 2113",
                title: "Engineering Materials and Metallurgy",
                credit: "4.00",
                dept: "ipe"
            },
            {
                code: "Math 2123",
                title: "Engineering Mathematics-III",
                credit: "4.00",
                dept: "ipe"
            },
            {
                code: "Hum 2123",
                title: "Technical English and Sociology",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "ME 2161",
                title: "Engineering Mechanics and Theory of Machines",
                credit: "4.00",
                dept: "ipe"
            },
            {
                code: "IPES 2102",
                title: "Shop Practice-II",
                credit: "0.75",
                dept: "ipe"
            },
            {
                code: "IPE 2114",
                title: "Engineering Materials and Metallurgy Lab",
                credit: "0.75",
                dept: "ipe"
            },
            {
                code: "ME 2152",
                title: "Thermodynamics and Heat Transfer Lab",
                credit: "1.50",
                dept: "ipe"
            },

            // 2nd Year 2nd Semester
            {
                code: "IPE 2201",
                title: "Organizational Behavior",
                credit: "2.00",
                dept: "ipe"
            },
            {
                code: "IPE 2203",
                title: "Probability and Statistics",
                credit: "4.00",
                dept: "ipe"
            },
            {
                code: "IPE 2211",
                title: "Production Process-I",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "ME 2251",
                title: "Mechanics of Solids",
                credit: "4.00",
                dept: "ipe"
            },
            {
                code: "CSE 2283",
                title: "Introduction to Computer Programming",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "IPE 2212",
                title: "Production Process-I Lab",
                credit: "0.75",
                dept: "ipe"
            },
            {
                code: "Hum 2224",
                title: "English Language Practice",
                credit: "0.75",
                dept: "ipe"
            },
            {
                code: "ME 2252",
                title: "Solid Mechanics Lab",
                credit: "0.75",
                dept: "ipe"
            },
            {
                code: "CSE 2284",
                title: "Introduction to Computer Programming Lab",
                credit: "1.00",
                dept: "ipe"
            },

            // 3rd Year 1st Semester
            {
                code: "IPE 3101",
                title: "Operations Management",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "IPE 3103",
                title: "Operations Research",
                credit: "4.00",
                dept: "ipe"
            },
            {
                code: "IPE 3105",
                title: "Product Design-I",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "IPE 3111",
                title: "Production Process-II",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "IPE 3121",
                title: "Management Information System and Programming",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "IPE 3106",
                title: "Product Design-I Lab",
                credit: "1.50",
                dept: "ipe"
            },
            {
                code: "IPE 3112",
                title: "Production Process-II Lab",
                credit: "0.75",
                dept: "ipe"
            },
            {
                code: "IPE 3122",
                title: "Management Information System and Programming Lab",
                credit: "0.75",
                dept: "ipe"
            },

            // 3rd Year 2nd Semester
            {
                code: "IPE 3201",
                title: "Quality Control and Management",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "IPE 3205",
                title: "Product Design-II",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "IPE 3211",
                title: "Machine Tools",
                credit: "4.00",
                dept: "ipe"
            },
            {
                code: "Math 3223",
                title: "Engineering Mathematics-IV",
                credit: "4.00",
                dept: "ipe"
            },
            {
                code: "ME 3251",
                title: "Fluid Mechanics and Machinery",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "IPE 3200",
                title: "IPE Case Study",
                credit: "1.00",
                dept: "ipe"
            },
            {
                code: "IPE 3206",
                title: "Product Design-II Lab",
                credit: "1.50",
                dept: "ipe"
            },
            {
                code: "IPE 3212",
                title: "Machine Tools Lab",
                credit: "0.75",
                dept: "ipe"
            },
            {
                code: "Math 3224",
                title: "Numerical Analysis Lab",
                credit: "0.75",
                dept: "ipe"
            },
            {
                code: "ME 3252",
                title: "Fluid Mechanics and Machinery Lab",
                credit: "0.75",
                dept: "ipe"
            },

            // 4th Year 1st Semester
            {
                code: "IPE 4100",
                title: "Project and Thesis",
                credit: "1.50",
                dept: "ipe"
            },
            {
                code: "IPE 4101",
                title: "Industrial & Business Management",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "IPE 4103",
                title: "Ergonomics and Safety Management",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "IPE 4121",
                title: "Measurement and Instrumentation",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "IPE 4123",
                title: "CAD/CAM",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "IPE 4131(+)",
                title: "Optional-I",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "IPE 4104",
                title: "Ergonomics and Safety Lab",
                credit: "0.75",
                dept: "ipe"
            },
            {
                code: "IPE 4122",
                title: "Measurement and Instrumentation Lab",
                credit: "0.75",
                dept: "ipe"
            },
            {
                code: "IPE 4124",
                title: "CAD/CAM Lab",
                credit: "0.75",
                dept: "ipe"
            },
            {
                code: "IPE 4128",
                title: "Industrial Simulation Lab",
                credit: "1.50",
                dept: "ipe"
            },

            // 4th Year 2nd Semester
            {
                code: "IPE 4200",
                title: "Project and Thesis",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "IPE 4201",
                title: "Project and Environmental Management",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "IPE 4203",
                title: "Materials Handling and Maintenance Management",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "IPE 4205",
                title: "Cost and Management Accounting",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "IPE 4221",
                title: "Control Theory and Automation",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "IPE 4231(+)",
                title: "Optional-II",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "IPE 4204",
                title: "Materials Handling Lab",
                credit: "0.75",
                dept: "ipe"
            },
            {
                code: "IPE 4222",
                title: "Control Theory and Automation Lab",
                credit: "0.75",
                dept: "ipe"
            },
            {
                code: "IPE 4240",
                title: "Industrial Practice",
                credit: "1.00",
                dept: "ipe"
            },
            {
                code: "IPE 4242",
                title: "Engineering Communication Seminar",
                credit: "1.00",
                dept: "ipe"
            },

            // Optional Courses (IPE 4131 - 4th Year 1st Semester)
            {
                code: "IPE 4131(a)",
                title: "Supply Chain Management",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "IPE 4131(b)",
                title: "Total Quality Management (TQM)",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "IPE 4131(c)",
                title: "Microprocessor Programming and Interfacing",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "IPE 4131(d)",
                title: "Intelligent Manufacturing",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "IPE 4131(e)",
                title: "Technology Management",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "IPE 4131(f)",
                title: "Micro-Manufacturing",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "IPE 4131(g)",
                title: "Entrepreneurship Development and Micro Industries",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "IPE 4131(h)",
                title: "Machine Vision and Image Processing",
                credit: "3.00",
                dept: "ipe"
            },

            // Optional Courses (IPE 4231 - 4th Year 2nd Semester)
            {
                code: "IPE 4231(a)",
                title: "CNC Machine Tools",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "IPE 4231(b)",
                title: "IT in Manufacturing",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "IPE 4231(c)",
                title: "AI and Neuro-Fuzzy Theory",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "IPE 4231(d)",
                title: "Energy Management",
                credit: "3.00",
                dept: "ipe"
            },
            {
                code: "IPE 4231(e)",
                title: "Computer Integrated Manufacturing (CIM)",
                credit: "3.00",
                dept: "ipe"
            },


            // Material Science & Engineering Courses
            // 1st Year 1st Semester
            {
                code: "Phy 1131",
                title: "Physics",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "Math 1131",
                title: "Calculus and Differential Equation",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "Hum 1131",
                title: "Industrial Economics and Fundamentals of Sociology",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "EEE 1191",
                title: "Electrical Circuits",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "MSE 1101",
                title: "Introduction to Material Science & Engineering",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "Phy 1132",
                title: "Physics Sessional",
                credit: "1.50",
                dept: "mse"
            },
            {
                code: "EEE 1192",
                title: "Electrical Circuits Sessional",
                credit: "1.50",
                dept: "mse"
            },
            {
                code: "ME 1150",
                title: "Engineering Graphics",
                credit: "1.50",
                dept: "mse"
            },
            {
                code: "MSE 1102",
                title: "Introduction to Material Science & Engineering Sessional",
                credit: "0.75",
                dept: "mse"
            },

            // 1st Year 2nd Semester
            {
                code: "Chem 1231",
                title: "Chemistry",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "Math 1231",
                title: "Vector Analysis and Matrices",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "CSE 1291",
                title: "Programming Language and Data Structure",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "Hum 1231",
                title: "Communication English",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "ME 1259",
                title: "Engineering Mechanics",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "Chem 1232",
                title: "Chemistry Sessional",
                credit: "1.50",
                dept: "mse"
            },
            {
                code: "CSE 1292",
                title: "Programming Language and Data Structure Sessional",
                credit: "0.75",
                dept: "mse"
            },
            {
                code: "Hum 1232",
                title: "Communication English Sessional",
                credit: "0.75",
                dept: "mse"
            },
            {
                code: "MSE 1200",
                title: "Computer Fundamentals and Ethics",
                credit: "0.75",
                dept: "mse"
            },
            {
                code: "ME 1250",
                title: "Computer Graphics",
                credit: "1.50",
                dept: "mse"
            },

            // 2nd Year 1st Semester
            {
                code: "Math 2131",
                title: "Statistics, Numerical and Power Series",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "MSE 2101",
                title: "Crystallography and Structure of Materials",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "MSE 2103",
                title: "Phase Transformation of Materials",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "ME 2169",
                title: "Basic Mechanical Engineering",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "ME 2179",
                title: "Fluid Mechanics and Machinery",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "MSE 2102",
                title: "Crystallography and Structure of Materials Sessional",
                credit: "1.50",
                dept: "mse"
            },
            {
                code: "MSE 2104",
                title: "Metallography Sessional",
                credit: "1.50",
                dept: "mse"
            },
            {
                code: "ME 2160",
                title: "Basic Mechanical Engineering Sessional",
                credit: "0.75",
                dept: "mse"
            },
            {
                code: "ME 2170",
                title: "Fluid Mechanics and Machinery Sessional",
                credit: "0.75",
                dept: "mse"
            },

            // 2nd Year 2nd Semester
            {
                code: "Hum 2231",
                title: "Industrial Law and Accounting",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "MSE 2211",
                title: "Crystal Defect, Deformation and Fracture",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "MSE 2221",
                title: "Strength of Materials",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "ME 2259",
                title: "Heat and Mass Transfer",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "EEE 2291",
                title: "Electrical Machines and Electronics",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "MSE 2220",
                title: "Materials & Metallurgical Analysis",
                credit: "1.50",
                dept: "mse"
            },
            {
                code: "MSE 2212",
                title: "Crystal Defect, Deformation and Fracture Sessional",
                credit: "1.50",
                dept: "mse"
            },
            {
                code: "MSE 2222",
                title: "Application to Computers in Strength of Materials",
                credit: "0.75",
                dept: "mse"
            },
            {
                code: "EEE 2292",
                title: "Electrical Machines and Electronics Sessional",
                credit: "0.75",
                dept: "mse"
            },

            // 3rd Year 1st Semester
            {
                code: "GCE 3189",
                title: "Glass and Ceramics Engineering",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "MSE 3131",
                title: "Surface Engineering of Materials",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "MSE 3133",
                title: "Refractories and Furnaces",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "MSE 3135",
                title: "Iron and Steel Making",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "MSE 3141",
                title: "Metal Extraction and Refining",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "GCE 3160",
                title: "Glass and Ceramics Engineering Sessional",
                credit: "1.50",
                dept: "mse"
            },
            {
                code: "MSE 3132",
                title: "Surface Engineering of Materials Sessional",
                credit: "0.75",
                dept: "mse"
            },
            {
                code: "MSE 3134",
                title: "Refractories and Furnaces Sessional",
                credit: "1.50",
                dept: "mse"
            },
            {
                code: "MSE 3142",
                title: "Metal Extraction and Refining Sessional",
                credit: "1.50",
                dept: "mse"
            },

            // 3rd Year 2nd Semester
            {
                code: "MSE 3213",
                title: "Corrosion and Degradation of Materials",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "MSE 3231",
                title: "Foundry Engineering",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "MSE 3235",
                title: "Metal Joining and Removing Technology",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "MSE 3241",
                title: "Polymer Science and Engineering",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "MSE 3243",
                title: "Ceramics for Advanced Application",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "MSE 3232",
                title: "Foundry Engineering Sessional",
                credit: "1.50",
                dept: "mse"
            },
            {
                code: "MSE 3236",
                title: "Metal Joining and Removing Technology Sessional",
                credit: "1.50",
                dept: "mse"
            },
            {
                code: "MSE 3242",
                title: "Polymers Sessional",
                credit: "0.75",
                dept: "mse"
            },
            {
                code: "MSE 3210",
                title: "Case Study in Material Science and Engineering",
                credit: "0.75",
                dept: "mse"
            },
            {
                code: "MSE 3200",
                title: "Industrial Training",
                credit: "1.00",
                dept: "mse"
            },

            // 4th Year 1st Semester
            {
                code: "IPE 4189",
                title: "Industrial Management",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "MSE 4131",
                title: "Physical Metallurgy and Heat Treatment",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "MSE 4111",
                title: "Physical Properties of Materials",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "MSE 4101",
                title: "Materials Characterization",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "MSE 4141",
                title: "Optional-I",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "MSE 4102",
                title: "Materials Characterization Sessional",
                credit: "1.50",
                dept: "mse"
            },
            {
                code: "MSE 4132",
                title: "Heat Treatment and Microstructure Sessional",
                credit: "1.50",
                dept: "mse"
            },
            {
                code: "MSE 4142",
                title: "Optional-I Sessional",
                credit: "0.75",
                dept: "mse"
            },
            {
                code: "MSE 4100",
                title: "Project and Thesis-I",
                credit: "1.50",
                dept: "mse"
            },

            // 4th Year 2nd Semester
            {
                code: "IPE 4289",
                title: "Production Planning and Control",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "MSE 4231",
                title: "Metallic Alloys and Material Selection",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "MSE 4233",
                title: "Industrial Metal Working Process",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "MSE 4243",
                title: "Powder Metallurgy and Nanotechnology",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "MSE 4241",
                title: "Optional-II",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "MSE 4232",
                title: "Failure of Materials and Artefact Study",
                credit: "1.50",
                dept: "mse"
            },
            {
                code: "MSE 4200",
                title: "Project and Thesis-II",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "MSE 4210",
                title: "Seminar",
                credit: "0.75",
                dept: "mse"
            },

            // Optional-I Courses (MSE 4141 – 4th Year 1st Semester)
            {
                code: "MSE 4141(a)",
                title: "Composite Materials",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "MSE 4141(b)",
                title: "Advanced Glass Engineering",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "MSE 4141(c)",
                title: "Materials for Energy Conversion and Storage",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "MSE 4141(d)",
                title: "Industrial Pollution and Control",
                credit: "3.00",
                dept: "mse"
            },

            // Optional-II Courses (MSE 4241 – 4th Year 2nd Semester)
            {
                code: "MSE 4241(a)",
                title: "Transport Phenomena in Metal Processing",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "MSE 4241(b)",
                title: "Advanced and Smart Materials",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "MSE 4241(c)",
                title: "Plastic, Fiber, and Rubber Technology",
                credit: "3.00",
                dept: "mse"
            },
            {
                code: "MSE 4241(d)",
                title: "Quality Control and Material Handling",
                credit: "3.00",
                dept: "mse"
            },


            // Mechatronics Engineering (MTE) Courses
            // 1st Year Odd Semester (1st Semester)
            {
                code: "MTE 1101",
                title: "Mechatronic Systems",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "Math 1127",
                title: "Calculus and Solid Geometry",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "Phy 1127",
                title: "Physics",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "Chem 1127",
                title: "Chemistry",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "Hum 1127",
                title: "Sociology and Engineering Ethics",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "ME 1130",
                title: "Engineering Graphics",
                credit: "1.50",
                dept: "mte"
            },
            {
                code: "MTE 1102",
                title: "Mechatronic Systems Sessional",
                credit: "0.75",
                dept: "mte"
            },
            {
                code: "Phy 1128",
                title: "Physics Sessional",
                credit: "0.75",
                dept: "mte"
            },
            {
                code: "Chem 1128",
                title: "Chemistry Sessional",
                credit: "0.75",
                dept: "mte"
            },

            // 1st Year Even Semester (2nd Semester)
            {
                code: "ME 1255",
                title: "Thermodynamics and Heat Transfer",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "EEE 1287",
                title: "Electrical Circuits",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "CSE 1287",
                title: "Computer Fundamentals & Programming",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "Math 1227",
                title: "Vector, Matrix and Ordinary Differential Equation",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "Hum 1227",
                title: "Technical English & Communication Skills",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "ME 1256",
                title: "Thermodynamics and Heat Transfer Sessional",
                credit: "0.75",
                dept: "mte"
            },
            {
                code: "EEE 1288",
                title: "Electrical Circuits Sessional",
                credit: "1.50",
                dept: "mte"
            },
            {
                code: "CSE 1288",
                title: "Computer Fundamentals & Programming Sessional",
                credit: "1.50",
                dept: "mte"
            },
            {
                code: "Hum 1228",
                title: "Technical English & Communication Skills Sessional",
                credit: "0.75",
                dept: "mte"
            },

            // 2nd Year Odd Semester (3rd Semester)
            {
                code: "ME 2155",
                title: "Engineering Mechanics",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "EEE 2187",
                title: "Electronics",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "CSE 2187",
                title: "Software Engineering",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "Math 2127",
                title: "Fourier Series, Laplace Transform and Partial Differential Equation",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "Hum 2127",
                title: "Engineering Economics & Accounting",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "ME 2130",
                title: "CAD Practice",
                credit: "1.50",
                dept: "mte"
            },
            {
                code: "ME 2156",
                title: "Engineering Mechanics Sessional",
                credit: "0.75",
                dept: "mte"
            },
            {
                code: "EEE 2188",
                title: "Electronics Sessional",
                credit: "1.50",
                dept: "mte"
            },
            {
                code: "CSE 2188",
                title: "Software Engineering Sessional",
                credit: "0.75",
                dept: "mte"
            },

            // 2nd Year Even Semester (4th Semester)
            {
                code: "MTE 2205",
                title: "Sensors and Instrumentations",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "ME 2255",
                title: "Manufacturing Processes",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "EEE 2297",
                title: "Signals and Linear Systems",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "EEE 2287",
                title: "Electro-Mechanical Systems and Drives",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "Math 2227",
                title: "Complex Variables and Harmonic Analysis",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "MTE 2206",
                title: "Sensors and Instrumentation Sessional",
                credit: "0.75",
                dept: "mte"
            },
            {
                code: "MTE 2210",
                title: "Modeling and Simulation Sessional",
                credit: "0.75",
                dept: "mte"
            },
            {
                code: "ME 2256",
                title: "Manufacturing Processes Sessional",
                credit: "1.50",
                dept: "mte"
            },
            {
                code: "EEE 2288",
                title: "Electro-Mechanical Systems and Drives Sessional",
                credit: "1.50",
                dept: "mte"
            },

            // 3rd Year Odd Semester (5th Semester)
            {
                code: "MTE 3101",
                title: "Control Systems",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "MTE 3103",
                title: "Microcontroller and Interfacing",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "MTE 3105",
                title: "Linear Integrated Circuits and Digital Systems",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "ME 3155",
                title: "Mechanics of Solids",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "Math 3127",
                title: "Numerical Analysis & Statistics",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "MTE 3100",
                title: "Industrial Training",
                credit: "1.00",
                dept: "mte"
            },
            {
                code: "MTE 3102",
                title: "Control Systems Sessional",
                credit: "1.50",
                dept: "mte"
            },
            {
                code: "MTE 3104",
                title: "Microcontroller and Interfacing Sessional",
                credit: "1.50",
                dept: "mte"
            },
            {
                code: "MTE 3106",
                title: "Linear Integrated Circuits and Digital Systems Sessional",
                credit: "0.75",
                dept: "mte"
            },
            {
                code: "ME 3156",
                title: "Mechanics of Solids Sessional",
                credit: "0.75",
                dept: "mte"
            },

            // 3rd Year Even Semester (6th Semester)
            {
                code: "MTE 3201",
                title: "Power Electronics and Drives",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "MTE 3205",
                title: "Hydraulic and Pneumatic Control",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "ME 3255",
                title: "Machine Dynamics and Vibrations",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "ME 3265",
                title: "Fluid Mechanics and Machinery",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "EEE 3287",
                title: "Network and Communication Systems",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "MTE 3200",
                title: "Mechatronics Case Study",
                credit: "1.00",
                dept: "mte"
            },
            {
                code: "MTE 3202",
                title: "Power Electronics and Drives Sessional",
                credit: "0.75",
                dept: "mte"
            },
            {
                code: "MTE 3206",
                title: "Hydraulic and Pneumatic Control Sessional",
                credit: "0.75",
                dept: "mte"
            },
            {
                code: "ME 3256",
                title: "Machine Dynamics and Vibrations Sessional",
                credit: "0.75",
                dept: "mte"
            },

            // 4th Year Odd Semester (7th Semester)
            {
                code: "MTE 4101",
                title: "Automation",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "MTE 4103",
                title: "Digital Signal Processing & Machine Vision",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "MTE 4107",
                title: "Design of Mechatronic Systems",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "IPE 4155",
                title: "Industrial Management",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "MTE 4105(*)",
                title: "Optional-I",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "MTE 4100",
                title: "Project and Thesis",
                credit: "1.50",
                dept: "mte"
            },
            {
                code: "MTE 4110",
                title: "Seminar",
                credit: "1.00",
                dept: "mte"
            },
            {
                code: "MTE 4102",
                title: "Automation Sessional",
                credit: "1.50",
                dept: "mte"
            },
            {
                code: "MTE 4104",
                title: "Digital Signal Processing & Machine Vision Sessional",
                credit: "1.50",
                dept: "mte"
            },
            {
                code: "MTE 4108",
                title: "Design of Mechatronic Systems Sessional",
                credit: "1.50",
                dept: "mte"
            },

            // 4th Year Even Semester (8th Semester)
            {
                code: "MTE 4203",
                title: "Embedded Systems",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "MTE 4205",
                title: "Robotics",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "MTE 4207",
                title: "Computer Integrated Manufacturing",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "CSE 4287",
                title: "Artificial Intelligence",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "MTE 4209(*)",
                title: "Optional-II",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "MTE 4200",
                title: "Project and Thesis",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "MTE 4204",
                title: "Embedded Systems Sessional",
                credit: "0.75",
                dept: "mte"
            },
            {
                code: "MTE 4206",
                title: "Robotics Sessional",
                credit: "1.50",
                dept: "mte"
            },
            {
                code: "CSE 4288",
                title: "Artificial Intelligence Sessional",
                credit: "0.75",
                dept: "mte"
            },
            {
                code: "MTE 4210",
                title: "Seminar",
                credit: "1.00",
                dept: "mte"
            },

            // Optional Courses for MTE 4105 (Optional-I)
            {
                code: "MTE 4105(a)",
                title: "Machine Learning Algorithms",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "MTE 4105(b)",
                title: "Micro-Nano Technology",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "MTE 4105(c)",
                title: "Aerodynamics and Avionics",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "MTE 4105(d)",
                title: "Finite Element Analysis",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "MTE 4105(e)",
                title: "Advanced Vehicle Technology",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "MTE 4105(f)",
                title: "Applied Materials Engineering",
                credit: "3.00",
                dept: "mte"
            },

            // Optional Courses for MTE 4209 (Optional-II)
            {
                code: "MTE 4209(a)",
                title: "Human-Robot Interaction",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "MTE 4209(b)",
                title: "Digital Speech Processing",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "MTE 4209(c)",
                title: "Biomedical Engineering",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "MTE 4209(d)",
                title: "Parallel and Distributed Processing",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "MTE 4209(e)",
                title: "Multimedia Systems and Applications",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "MTE 4209(f)",
                title: "Rapid Prototyping",
                credit: "3.00",
                dept: "mte"
            },
            {
                code: "MTE 4209(g)",
                title: "Advanced Control Theory and Applications",
                credit: "3.00",
                dept: "mte"
            },


            // Electrical and Electronic Engineering (EEE) Courses
            // 1st Year Odd Semester
            {
                code: "EEE 1101",
                title: "Electrical Circuits I",
                credit: "3.0",
                dept: "eee"
            },
            {
                code: "EEE 1102",
                title: "Electrical Circuits I Sessional",
                credit: "1.5",
                dept: "eee"
            },
            {
                code: "CSE 1111",
                title: "Computer Programming",
                credit: "3.0",
                dept: "eee"
            },
            {
                code: "CSE 1112",
                title: "Computer Programming Sessional",
                credit: "1.5",
                dept: "eee"
            },
            {
                code: "Math 1101",
                title: "Engg. Mathematics I",
                credit: "3.0",
                dept: "eee"
            },
            {
                code: "Phy 1111",
                title: "Physics",
                credit: "3.0",
                dept: "eee"
            },
            {
                code: "Phy 1112",
                title: "Physics Sessional",
                credit: "0.75",
                dept: "eee"
            },
            {
                code: "Hum 1111",
                title: "Technical English",
                credit: "3.0",
                dept: "eee"
            },
            {
                code: "Hum 1112",
                title: "Technical English Sessional",
                credit: "0.75",
                dept: "eee"
            },

            // 1st Year Even Semester
            {
                code: "EEE 1201",
                title: "Electrical Circuits II",
                credit: "3.0",
                dept: "eee"
            },
            {
                code: "EEE 1202",
                title: "Electrical Circuits II Sessional",
                credit: "0.75",
                dept: "eee"
            },
            {
                code: "EEE 1203",
                title: "Electronics I",
                credit: "3.0",
                dept: "eee"
            },
            {
                code: "EEE 1204",
                title: "Electronics I Sessional",
                credit: "1.5",
                dept: "eee"
            },
            {
                code: "Chem 1211",
                title: "Chemistry",
                credit: "3.0",
                dept: "eee"
            },
            {
                code: "Chem 1212",
                title: "Chemistry Sessional",
                credit: "0.75",
                dept: "eee"
            },
            {
                code: "Hum 1211",
                title: "Financial Account & Economic Analysis",
                credit: "3.0",
                dept: "eee"
            },
            {
                code: "Math 1201",
                title: "Engg. Mathematics II",
                credit: "3.0",
                dept: "eee"
            },
            {
                code: "ME 1200",
                title: "Engineering Drawing",
                credit: "1.5",
                dept: "eee"
            },

            // 2nd Year Odd Semester
            {
                code: "EEE 2100",
                title: "Electrical Shop Practice",
                credit: "1.5",
                dept: "eee"
            },
            {
                code: "EEE 2103",
                title: "Electronics II",
                credit: "3.0",
                dept: "eee"
            },
            {
                code: "EEE 2104",
                title: "Electronics II Sessional",
                credit: "1.5",
                dept: "eee"
            },
            {
                code: "EEE 2105",
                title: "Electrical Machine I",
                credit: "3.0",
                dept: "eee"
            },
            {
                code: "EEE 2106",
                title: "Electrical Machine I Sessional",
                credit: "1.5",
                dept: "eee"
            },
            {
                code: "Math 2101",
                title: "Engg. Mathematics III",
                credit: "3.0",
                dept: "eee"
            },
            {
                code: "ME 2101",
                title: "Basic Mechanical Engineering",
                credit: "3.0",
                dept: "eee"
            },
            {
                code: "ME 2102",
                title: "Basic Mechanical Engineering Sessional",
                credit: "0.75",
                dept: "eee"
            },
            {
                code: "IPE 2111",
                title: "Legal Issues and Management for Engineers",
                credit: "3.0",
                dept: "eee"
            },

            // 2nd Year Even Semester
            {
                code: "Math 2201",
                title: "Engg. Mathematics IV",
                credit: "3.0",
                dept: "eee"
            },
            {
                code: "EEE 2203",
                title: "Electronics III",
                credit: "3.0",
                dept: "eee"
            },
            {
                code: "EEE 2204",
                title: "Electronics III Sessional",
                credit: "1.5",
                dept: "eee"
            },
            {
                code: "EEE 2205",
                title: "Electrical Machine II",
                credit: "3.0",
                dept: "eee"
            },
            {
                code: "EEE 2206",
                title: "Electrical Machine II Sessional",
                credit: "1.5",
                dept: "eee"
            },
            {
                code: "EEE 2211",
                title: "Measurement & Instrumentation",
                credit: "3.0",
                dept: "eee"
            },
            {
                code: "EEE 2212",
                title: "Measurement & Instrumentation Sessional",
                credit: "1.5",
                dept: "eee"
            },
            {
                code: "EEE 2213",
                title: "Digital Electronics I",
                credit: "3.0",
                dept: "eee"
            },
            {
                code: "EEE 2214",
                title: "Digital Electronics I Sessional",
                credit: "0.75",
                dept: "eee"
            },

            // 3rd Year Odd Semester
            {
                code: "EEE 3100",
                title: "Electronic Shop Practice",
                credit: "1.5",
                dept: "eee"
            },
            {
                code: "EEE 3101",
                title: "Signals and Linear Systems",
                credit: "3.0",
                dept: "eee"
            },
            {
                code: "EEE 3105",
                title: "Control Systems",
                credit: "3.0",
                dept: "eee"
            },
            {
                code: "EEE 3106",
                title: "Control Systems Sessional",
                credit: "0.75",
                dept: "eee"
            },
            {
                code: "EEE 3107",
                title: "Electromagnetic Fields & Waves",
                credit: "3.0",
                dept: "eee"
            },
            {
                code: "EEE 3109",
                title: "Computational Methods in Electrical Engineering",
                credit: "3.0",
                dept: "eee"
            },
            {
                code: "EEE 3110",
                title: "Computational Methods in Electrical Engineering Sessional",
                credit: "1.5",
                dept: "eee"
            },
            {
                code: "EEE 3117",
                title: "Communication Engineering I",
                credit: "3.0",
                dept: "eee"
            },
            {
                code: "EEE 3118",
                title: "Communication Engineering I Sessional",
                credit: "0.75",
                dept: "eee"
            },

            // 3rd Year Even Semester
            {
                code: "EEE 3200",
                title: "Electrical and Electronic Circuit Simulation Sessional",
                credit: "1.5",
                dept: "eee"
            },
            {
                code: "EEE 3203",
                title: "Power Electronics",
                credit: "3.0",
                dept: "eee"
            },
            {
                code: "EEE 3204",
                title: "Power Electronics Sessional",
                credit: "0.75",
                dept: "eee"
            },
            {
                code: "EEE 3205",
                title: "Power Plant Engineering and Economy",
                credit: "3.0",
                dept: "eee"
            },
            {
                code: "EEE 3209",
                title: "Microprocessor, Interfacing and System design",
                credit: "3.0",
                dept: "eee"
            },
            {
                code: "EEE 3210",
                title: "Microprocessor, Interfacing and System design Sessional",
                credit: "1.5",
                dept: "eee"
            },
            {
                code: "EEE 3211",
                title: "Power System I",
                credit: "3.0",
                dept: "eee"
            },
            {
                code: "EEE 3212",
                title: "Power System I Sessional",
                credit: "1.5",
                dept: "eee"
            },
            {
                code: "EEE 3217",
                title: "Communication Engineering II",
                credit: "3.0",
                dept: "eee"
            },
            {
                code: "EEE 3218",
                title: "Communication Engineering II Sessional",
                credit: "0.75",
                dept: "eee"
            },

            // 4th Year Odd Semester (Core + Electives)
            {
                code: "EEE 4000",
                title: "Project & Thesis (Part 1)",
                credit: "1.5",
                dept: "eee"
            },
            {
                code: "EEE 4100",
                title: "Industrial Training",
                credit: "1.0",
                dept: "eee"
            },
            {
                code: "EEE 4107",
                title: "Digital Signal Processing",
                credit: "3.0",
                dept: "eee"
            },
            {
                code: "EEE 4108",
                title: "Digital Signal Processing Sessional",
                credit: "0.75",
                dept: "eee"
            },
            {
                code: "EEE 4117",
                title: "Radio and TV Engineering",
                credit: "3.0",
                dept: "eee"
            },
            {
                code: "EEE 4118",
                title: "Radio and TV Engineering Sessional",
                credit: "0.75",
                dept: "eee"
            },
            {
                code: "IPE 4111",
                title: "Project and Operations Management",
                credit: "2.0",
                dept: "eee"
            },
            // Elective I and its Sessional are chosen from specific tracks below

            // 4th Year Even Semester (Core + Electives)
            {
                code: "EEE 4000",
                title: "Project & Thesis (Part 2)",
                credit: "3.0",
                dept: "eee"
            },
            {
                code: "EEE 4200",
                title: "Seminar",
                credit: "1.0",
                dept: "eee"
            },
            {
                code: "EEE 4209",
                title: "Embedded System Design",
                credit: "3.0",
                dept: "eee"
            },
            {
                code: "EEE 4210",
                title: "Embedded System Design Sessional",
                credit: "0.75",
                dept: "eee"
            },
            {
                code: "EEE 4217",
                title: "Mobile Cellular Communication",
                credit: "3.0",
                dept: "eee"
            },
            // Elective III, IV, V are chosen from specific tracks below

            // Elective Courses by Track (Students choose one track: Power, Electronics, or Communication)
            // ========================================================================================

            // ***** POWER GROUP Electives *****
            // Elective I (4th Year Odd)
            {
                code: "EEE 4141",
                title: "Power System II",
                credit: "3.0",
                dept: "eee",
                track: "power"
            },
            {
                code: "EEE 4142",
                title: "Power System II Sessional",
                credit: "0.75",
                dept: "eee",
                track: "power"
            },

            // Elective II (4th Year Odd)
            {
                code: "EEE 4143",
                title: "High Voltage Engineering",
                credit: "3.0",
                dept: "eee",
                track: "power"
            },
            {
                code: "EEE 4144",
                title: "High Voltage Engineering Sessional",
                credit: "0.75",
                dept: "eee",
                track: "power"
            },

            // Elective III (4th Year Even)
            {
                code: "EEE 4241",
                title: "Power System Protection",
                credit: "3.0",
                dept: "eee",
                track: "power"
            },
            {
                code: "EEE 4242",
                title: "Power System Protection Sessional",
                credit: "0.75",
                dept: "eee",
                track: "power"
            },

            // Elective IV (4th Year Even)
            {
                code: "EEE 4243",
                title: "Power System Operation and Control",
                credit: "3.0",
                dept: "eee",
                track: "power"
            },

            // Elective V (4th Year Even) - Choose ONE
            {
                code: "EEE 4245",
                title: "Electrical Machine III",
                credit: "3.0",
                dept: "eee",
                track: "power"
            },
            {
                code: "EEE 4247",
                title: "Renewable Energy",
                credit: "3.0",
                dept: "eee",
                track: "power"
            },

            // ***** ELECTRONICS GROUP Electives *****
            // Elective I (4th Year Odd)
            {
                code: "EEE 4161",
                title: "Digital Electronics II",
                credit: "3.0",
                dept: "eee",
                track: "electronics"
            },
            {
                code: "EEE 4162",
                title: "Digital Electronics II Sessional",
                credit: "0.75",
                dept: "eee",
                track: "electronics"
            },
            // Note: Processing & Fabrication Tech also listed as Elective I option
            {
                code: "EEE 4165",
                title: "Processing & Fabrication Technology",
                credit: "3.0",
                dept: "eee",
                track: "electronics"
            },
            {
                code: "EEE 4166",
                title: "Processing & Fabrication Technology Sessional",
                credit: "0.75",
                dept: "eee",
                track: "electronics"
            },

            // Elective II (4th Year Odd)
            {
                code: "EEE 4163",
                title: "VLSI",
                credit: "3.0",
                dept: "eee",
                track: "electronics"
            },
            {
                code: "EEE 4164",
                title: "VLSI Sessional",
                credit: "0.75",
                dept: "eee",
                track: "electronics"
            },

            // Elective III (4th Year Even)
            {
                code: "EEE 4261",
                title: "Biomedical Engineering",
                credit: "3.0",
                dept: "eee",
                track: "electronics"
            },
            {
                code: "EEE 4262",
                title: "Biomedical Engineering Sessional",
                credit: "0.75",
                dept: "eee",
                track: "electronics"
            },
            {
                code: "EEE 4267",
                title: "Transducers and Instrumentation",
                credit: "3.0",
                dept: "eee",
                track: "electronics"
            },
            {
                code: "EEE 4268",
                title: "Transducers and Instrumentation Sessional",
                credit: "0.75",
                dept: "eee",
                track: "electronics"
            },

            // Elective IV (4th Year Even)
            {
                code: "EEE 4263",
                title: "Optoelectronics",
                credit: "3.0",
                dept: "eee",
                track: "electronics"
            },

            // Elective V (4th Year Even)
            {
                code: "EEE 4269",
                title: "Photovoltaic System",
                credit: "3.0",
                dept: "eee",
                track: "electronics"
            },

            // ***** COMMUNICATION GROUP Electives *****
            // Elective I (4th Year Odd)
            {
                code: "EEE 4181",
                title: "Microwave Engineering",
                credit: "3.0",
                dept: "eee",
                track: "communication"
            },
            {
                code: "EEE 4182",
                title: "Microwave Engineering Sessional",
                credit: "0.75",
                dept: "eee",
                track: "communication"
            },

            // Elective II (4th Year Odd)
            {
                code: "EEE 4183",
                title: "Digital Communication",
                credit: "3.0",
                dept: "eee",
                track: "communication"
            },
            {
                code: "EEE 4184",
                title: "Digital Communication Sessional",
                credit: "0.75",
                dept: "eee",
                track: "communication"
            },

            // Elective III (4th Year Even)
            {
                code: "EEE 4281",
                title: "Antennas and Propagation",
                credit: "3.0",
                dept: "eee",
                track: "communication"
            },
            {
                code: "EEE 4282",
                title: "Antennas and Propagation Sessional",
                credit: "0.75",
                dept: "eee",
                track: "communication"
            },

            // Elective IV (4th Year Even)
            {
                code: "EEE 4283",
                title: "Radar and Satellite Communication",
                credit: "3.0",
                dept: "eee",
                track: "communication"
            },

            // Elective V (4th Year Even)
            {
                code: "EEE 4285",
                title: "Optical Fiber Communication",
                credit: "3.0",
                dept: "eee",
                track: "communication"
            },


            // Computer Science & Engineering Courses
            // 1st Year Odd Semester
            {
                code: "CSE 1100",
                title: "Computer Fundamentals and Ethics Sessional",
                credit: "0.75",
                dept: "cse"
            },
            {
                code: "CSE 1101",
                title: "Structured Programming",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 1102",
                title: "Structured Programming Sessional",
                credit: "1.50",
                dept: "cse"
            },
            {
                code: "EEE 1151",
                title: "Basic Electrical Engineering",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "EEE 1152",
                title: "Basic Electrical Engineering Sessional",
                credit: "0.75",
                dept: "cse"
            },
            {
                code: "Math 1113",
                title: "Differential and Integral Calculus",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "Hum 1113",
                title: "Functional English",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "Hum 1114",
                title: "Functional English Sessional",
                credit: "0.75",
                dept: "cse"
            },
            {
                code: "Chem 1113",
                title: "Inorganic and Physical Chemistry",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "Chem 1114",
                title: "Inorganic and Physical Chemistry Sessional",
                credit: "0.75",
                dept: "cse"
            },

            // 1st Year Even Semester
            {
                code: "CSE 1200",
                title: "Competitive Programming Sessional",
                credit: "0.75",
                dept: "cse"
            },
            {
                code: "CSE 1201",
                title: "Data Structure",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 1202",
                title: "Data Structure Sessional",
                credit: "1.50",
                dept: "cse"
            },
            {
                code: "CSE 1203",
                title: "Object Oriented Programming",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 1204",
                title: "Object Oriented Programming Sessional",
                credit: "1.50",
                dept: "cse"
            },
            {
                code: "EEE 1251",
                title: "Electronic Devices and Circuits",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "EEE 1252",
                title: "Electronic Devices and Circuits Sessional",
                credit: "1.50",
                dept: "cse"
            },
            {
                code: "Math 1213",
                title: "Coordinate Geometry and Ordinary Differential Equation",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "Phy 1213",
                title: "Physics",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "Phy 1214",
                title: "Physics Sessional",
                credit: "0.75",
                dept: "cse"
            },

            // 2nd Year Odd Semester
            {
                code: "CSE 2100",
                title: "Software Development Project I",
                credit: "0.75",
                dept: "cse"
            },
            {
                code: "CSE 2101",
                title: "Discrete Mathematics",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 2102",
                title: "Discrete Mathematics Sessional",
                credit: "1.50",
                dept: "cse"
            },
            {
                code: "CSE 2103",
                title: "Digital Logic Design",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 2104",
                title: "Digital Logic Design Sessional",
                credit: "1.50",
                dept: "cse"
            },
            {
                code: "EEE 2151",
                title: "Electrical Drives and Instrumentations",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "EEE 2152",
                title: "Electrical Drives and Instrumentations Sessional",
                credit: "0.75",
                dept: "cse"
            },
            {
                code: "Math 2113",
                title: "Vector Analysis and Linear Algebra",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "Hum 2113",
                title: "Economics, Government and Sociology",
                credit: "3.00",
                dept: "cse"
            },

            // 2nd Year Even Semester
            {
                code: "CSE 2200",
                title: "Technical Writing and Presentation Sessional",
                credit: "0.75",
                dept: "cse"
            },
            {
                code: "CSE 2201",
                title: "Algorithm Analysis and Design",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 2202",
                title: "Algorithm Analysis and Design Sessional",
                credit: "1.50",
                dept: "cse"
            },
            {
                code: "CSE 2203",
                title: "Numerical Methods",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 2204",
                title: "Numerical Methods Sessional",
                credit: "0.75",
                dept: "cse"
            },
            {
                code: "CSE 2205",
                title: "Microprocessors, Microcontrollers and Assembly Language",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 2206",
                title: "Microprocessors, Microcontrollers and Assembly Language Sessional",
                credit: "1.50",
                dept: "cse"
            },
            {
                code: "Math 2213",
                title: "Complex Variable, Partial Differential Equation and Harmonic Analysis",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "Hum 2213",
                title: "Industrial Management and Accountancy",
                credit: "3.00",
                dept: "cse"
            },

            // 3rd Year Odd Semester
            {
                code: "CSE 3100",
                title: "Web Based Application Project",
                credit: "0.75",
                dept: "cse"
            },
            {
                code: "CSE 3101",
                title: "Database Systems",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 3102",
                title: "Database Systems Sessional",
                credit: "1.50",
                dept: "cse"
            },
            {
                code: "CSE 3103",
                title: "Theory of Computation",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 3105",
                title: "Computer Interfacing and Embedded System",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 3106",
                title: "Computer Interfacing and Embedded System Sessional",
                credit: "0.75",
                dept: "cse"
            },
            {
                code: "CSE 3107",
                title: "Computer Architecture",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 3108",
                title: "Computer Architecture Sessional",
                credit: "0.75",
                dept: "cse"
            },
            {
                code: "CSE 3109",
                title: "Applied Statistics and Queuing Theory",
                credit: "3.00",
                dept: "cse"
            },

            // 3rd Year Even Semester
            {
                code: "CSE 3200",
                title: "Software Development Project II",
                credit: "0.75",
                dept: "cse"
            },
            {
                code: "CSE 3201",
                title: "Operating Systems",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 3202",
                title: "Operating Systems Sessional",
                credit: "0.75",
                dept: "cse"
            },
            {
                code: "CSE 3203",
                title: "Data Communication",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 3204",
                title: "Data Communication Sessional",
                credit: "0.75",
                dept: "cse"
            },
            {
                code: "CSE 3205",
                title: "Software Engineering",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 3206",
                title: "Software Engineering Sessional",
                credit: "0.75",
                dept: "cse"
            },
            {
                code: "CSE 3207",
                title: "Artificial Intelligence",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 3208",
                title: "Artificial Intelligence Sessional",
                credit: "0.75",
                dept: "cse"
            },
            {
                code: "CSE 3209",
                title: "Digital Signal Processing",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 3210",
                title: "Digital Signal Processing Sessional",
                credit: "0.75",
                dept: "cse"
            },

            // 4th Year Odd Semester
            {
                code: "CSE 4000",
                title: "Project/Thesis I",
                credit: "1.00",
                dept: "cse"
            },
            {
                code: "CSE 4101",
                title: "Compiler Design",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 4102",
                title: "Compiler Design Sessional",
                credit: "0.75",
                dept: "cse"
            },
            {
                code: "CSE 4103",
                title: "Computer Networks",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 4104",
                title: "Computer Networks Sessional",
                credit: "1.50",
                dept: "cse"
            },
            {
                code: "CSE 4105",
                title: "Digital Image Processing",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 4106",
                title: "Digital Image Processing Sessional",
                credit: "0.75",
                dept: "cse"
            },
            {
                code: "CSE 4108",
                title: "Industrial Attachment",
                credit: "0.75",
                dept: "cse"
            },
            {
                code: "CSE *****",
                title: "Optional I",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE *****",
                title: "Optional I Sessional",
                credit: "0.75",
                dept: "cse"
            },
            {
                code: "CSE *****",
                title: "Optional II",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE *****",
                title: "Optional II Sessional",
                credit: "0.75",
                dept: "cse"
            },

            // Optional I/II List (select 2)
            {
                code: "CSE 4109",
                title: "Information Systems Analysis and Design",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 4110",
                title: "Information Systems Analysis and Design Sessional",
                credit: "0.75",
                dept: "cse"
            },
            {
                code: "CSE 4111",
                title: "Unix Programming",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 4112",
                title: "Unix Programming Sessional",
                credit: "0.75",
                dept: "cse"
            },
            {
                code: "CSE 4113",
                title: "Digital System Design",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 4114",
                title: "Digital System Design Sessional",
                credit: "0.75",
                dept: "cse"
            },
            {
                code: "CSE 4115",
                title: "Simulation and Modeling",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 4116",
                title: "Simulation and Modeling Sessional",
                credit: "0.75",
                dept: "cse"
            },
            {
                code: "CSE 4117",
                title: "Wireless Networks",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 4118",
                title: "Wireless Networks Sessional",
                credit: "0.75",
                dept: "cse"
            },
            {
                code: "CSE 4119",
                title: "Data Mining",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 4120",
                title: "Data Mining Sessional",
                credit: "0.75",
                dept: "cse"
            },
            {
                code: "CSE 4121",
                title: "Computer Vision",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 4122",
                title: "Computer Vision Sessional",
                credit: "0.75",
                dept: "cse"
            },
            {
                code: "CSE 4123",
                title: "Knowledge Engineering",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 4124",
                title: "Knowledge Engineering Sessional",
                credit: "0.75",
                dept: "cse"
            },

            // 4th Year Even Semester
            {
                code: "CSE 4000",
                title: "Project/Thesis II",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 4201",
                title: "Computer Graphics",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 4202",
                title: "Computer Graphics Sessional",
                credit: "0.75",
                dept: "cse"
            },
            {
                code: "CSE 4203",
                title: "Machine Learning",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 4204",
                title: "Machine Learning Sessional",
                credit: "0.75",
                dept: "cse"
            },
            {
                code: "CSE 4205",
                title: "Security and Privacy",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 4206",
                title: "Security and Privacy Sessional",
                credit: "0.75",
                dept: "cse"
            },
            {
                code: "CSE 4208",
                title: "Seminar",
                credit: "0.75",
                dept: "cse"
            },
            {
                code: "CSE ****",
                title: "Optional III",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE ****",
                title: "Optional IV",
                credit: "3.00",
                dept: "cse"
            },

            // Optional III/IV List (select 2)
            {
                code: "CSE 4209",
                title: "VLSI Design",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 4211",
                title: "Parallel and Distributed Processing",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 4213",
                title: "Impact of Computer on Society",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 4215",
                title: "Decision Support System",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 4217",
                title: "Network Planning",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 4219",
                title: "Human Computer Interaction",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 4221",
                title: "Switching Systems",
                credit: "3.00",
                dept: "cse"
            },
            {
                code: "CSE 4223",
                title: "Control System Engineering",
                credit: "3.00",
                dept: "cse"
            },


            // Electrical & Computer Engineering (ECE) Courses
            // 1st Year Odd Semester
            {
                "code": "ECE 1101",
                "title": "Circuits and Systems-I",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 1102",
                "title": "Circuits and Systems-I Sessional",
                "credit": "1.50",
                "dept": "ece"
            },
            {
                "code": "ECE 1103",
                "title": "Computer Programming",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 1104",
                "title": "Computer Programming Sessional",
                "credit": "1.50",
                "dept": "ece"
            },
            {
                "code": "Math 1117",
                "title": "Calculus and Ordinary Differential Equation",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "Phy 1117",
                "title": "Optics and Modern Physics",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "Phy 1118",
                "title": "Optics and Modern Physics Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "Hum 1117",
                "title": "Technical English",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "Hum 1118",
                "title": "Technical English Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ECE 1100",
                "title": "Introduction to Computer System",
                "credit": "0.75",
                "dept": "ece"
            },

            // 1st Year Even Semester
            {
                "code": "ECE 1201",
                "title": "Circuits and Systems-II",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 1202",
                "title": "Circuits and Systems-II Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ECE 1203",
                "title": "Object Oriented Programming",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 1204",
                "title": "Object Oriented Programming Sessional",
                "credit": "1.50",
                "dept": "ece"
            },
            {
                "code": "ECE 1205",
                "title": "Analog Electronic Circuits-I",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 1206",
                "title": "Analog Electronic Circuits-I Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "Math 1217",
                "title": "Transform Methods, Statistics & Complex Variable",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "Hum 1217",
                "title": "Government, Sociology, Environment Protection & History of Independence",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 1200",
                "title": "Engineering Ethics",
                "credit": "0.75",
                "dept": "ece"
            },

            // 2nd Year Odd Semester
            {
                "code": "ECE 2103",
                "title": "Data Structure & Algorithmic",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 2104",
                "title": "Data Structure & Algorithmic Sessional",
                "credit": "1.50",
                "dept": "ece"
            },
            {
                "code": "ECE 2105",
                "title": "Analog Electronic Circuits-II",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 2106",
                "title": "Analog Electronic Circuits-II Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ECE 2111",
                "title": "Digital Techniques",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 2112",
                "title": "Digital Techniques Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "Math 2117",
                "title": "Vector Analysis & Linear Algebra",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "Chem 2117",
                "title": "Inorganic and Physical Chemistry",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "Chem 2118",
                "title": "Inorganic and Physical Chemistry Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ECE 2100",
                "title": "Software Development Project-1",
                "credit": "0.75",
                "dept": "ece"
            },

            // 2nd Year Even Semester
            {
                "code": "ECE 2207",
                "title": "Electrical Machine-I",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 2208",
                "title": "Electrical Machine-I Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ECE 2213",
                "title": "Numerical Methods & Discrete Mathematics",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 2214",
                "title": "Numerical Methods & Discrete Mathematics Sessional",
                "credit": "1.50",
                "dept": "ece"
            },
            {
                "code": "ECE 2215",
                "title": "Data Base Systems",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 2216",
                "title": "Data Base Systems Sessional",
                "credit": "1.50",
                "dept": "ece"
            },
            {
                "code": "Math 2217",
                "title": "Co-ordinate Geometry & Partial Differential Equations",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "Hum 2217",
                "title": "Legal Issues, Industrial & Operational Management",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 2200",
                "title": "Electronic Shop Practice",
                "credit": "1.50",
                "dept": "ece"
            },

            // 3rd Year Odd Semester
            {
                "code": "ECE 3107",
                "title": "Electrical Machine-II",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 3108",
                "title": "Electrical Machine-II Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ECE 3111",
                "title": "Microprocessor, Assembly Language & Interfacing",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 3112",
                "title": "Microprocessor, Assembly Language & Interfacing Sessional",
                "credit": "1.50",
                "dept": "ece"
            },
            {
                "code": "ECE 3117",
                "title": "Software Engineering & Information System Design",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 3118",
                "title": "Software Engineering & Information System Design Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ECE 3119",
                "title": "Computer Architecture and Design",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 3121",
                "title": "Electromagnetic Fields & Waves",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "CE 3100",
                "title": "Civil Engineering Drawing",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ECE 3100",
                "title": "Software Development Project-II",
                "credit": "0.75",
                "dept": "ece"
            },

            // 3rd Year Even Semester
            {
                "code": "ECE 3205",
                "title": "Industrial Electronics",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 3206",
                "title": "Industrial Electronics Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ECE 3207",
                "title": "Communication Engineering",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 3208",
                "title": "Communication Engineering Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ECE 3221",
                "title": "Operating System",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 3222",
                "title": "Operating System Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ME 3219",
                "title": "Basic Mechanical Engineering",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ME 3220",
                "title": "Basic Mechanical Engineering Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "Hum 3217",
                "title": "Economics & Accountancy",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 3200",
                "title": "Electrical Services Design",
                "credit": "1.50",
                "dept": "ece"
            },

            // 4th Year Odd Semester - Core Courses
            {
                "code": "ECE 4109",
                "title": "Power System",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "MTE 4117",
                "title": "Control Systems & Robotics",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "MTE 4118",
                "title": "Control Systems & Robotics Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ECE 4123",
                "title": "Digital Signal Processing",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 4124",
                "title": "Digital Signal Processing Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ECE 4000",
                "title": "Thesis/Project-I",
                "credit": "1.00",
                "dept": "ece"
            },
            {
                "code": "ECE 4100",
                "title": "Industrial Training",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ECE 4122",
                "title": "Seminar",
                "credit": "0.75",
                "dept": "ece"
            },

            // 4th Year Odd Semester - Optional I Courses
            {
                "code": "ECE 4111",
                "title": "Digital Communication",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 4112",
                "title": "Digital Communication Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ECE 4115",
                "title": "Antennas & Propagations",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 4116",
                "title": "Antennas & Propagations Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ECE 4117",
                "title": "Radar & Satellite Communication",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 4118",
                "title": "Radar & Satellite Communication Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ECE 4125",
                "title": "Radio & TV Engineering",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 4126",
                "title": "Radio & TV Engineering Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ECE 4141",
                "title": "Fiber optic Communication",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 4142",
                "title": "Fiber optic Communication Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ECE 4143",
                "title": "Bio-medical Engineering",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 4144",
                "title": "Bio-medical Engineering Sessional",
                "credit": "0.75",
                "dept": "ece"
            },

            // 4th Year Odd Semester - Optional II Courses
            {
                "code": "ECE 4127",
                "title": "VLSI Design",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 4128",
                "title": "VLSI Design Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ECE 4129",
                "title": "Network Planning",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 4130",
                "title": "Network Planning Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ECE 4131",
                "title": "Wireless Networks",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 4132",
                "title": "Wireless Networks Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ECE 4133",
                "title": "Artificial Intelligence",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 4134",
                "title": "Artificial Intelligence Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ECE 4135",
                "title": "Human Computer Interaction",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 4136",
                "title": "Human Computer Interaction Sessional",
                "credit": "0.75",
                "dept": "ece"
            },

            // 4th Year Even Semester - Core Courses
            {
                "code": "ECE 4209",
                "title": "Power Station, Switchgear & Protection",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 4211",
                "title": "Computer Networks",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 4212",
                "title": "Computer Networks Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ECE 4223",
                "title": "Digital Image Processing",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 4224",
                "title": "Digital Image Processing Sessional",
                "credit": "1.50",
                "dept": "ece"
            },
            {
                "code": "ECE 4000",
                "title": "Thesis/Project-II",
                "credit": "3.00",
                "dept": "ece"
            },

            // 4th Year Even Semester - Optional III Courses
            {
                "code": "ECE 4221",
                "title": "Unix Programming",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 4222",
                "title": "Unix Programming Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ECE 4227",
                "title": "Network Security",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 4228",
                "title": "Network Security Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ECE 4237",
                "title": "Parallel & Distributed Processing",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 4238",
                "title": "Parallel & Distributed Processing Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ECE 4239",
                "title": "Computer Graphics & Simulations",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 4240",
                "title": "Computer Graphics & Simulations Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ECE 4241",
                "title": "Computer Vision",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 4242",
                "title": "Computer Vision Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ECE 4243",
                "title": "Data Mining",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 4244",
                "title": "Data Mining Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ECE 4245",
                "title": "Machine Learning",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 4246",
                "title": "Machine Learning Sessional",
                "credit": "0.75",
                "dept": "ece"
            },

            // 4th Year Even Semester - Optional IV Courses
            {
                "code": "ECE 4247",
                "title": "Computer Aided Instrumentation",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 4248",
                "title": "Computer Aided Instrumentation Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ECE 4249",
                "title": "Computer Aided Power System Design",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 4250",
                "title": "Computer Aided Power System Design Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ECE 4251",
                "title": "Renewable Energy",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 4252",
                "title": "Renewable Energy Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ECE 4253",
                "title": "Microwave Engineering",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 4254",
                "title": "Microwave Engineering Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ECE 4255",
                "title": "Power System Operation & Control",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 4256",
                "title": "Power System Operation & Control Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ECE 4257",
                "title": "High Voltage Engineering",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 4258",
                "title": "High Voltage Engineering Sessional",
                "credit": "0.75",
                "dept": "ece"
            },
            {
                "code": "ECE 4259",
                "title": "System Simulation & Modeling",
                "credit": "3.00",
                "dept": "ece"
            },
            {
                "code": "ECE 4260",
                "title": "System Simulation & Modeling Sessional",
                "credit": "0.75",
                "dept": "ece"
            },


            // Electronics and Telecommunication Engineering Courses
            // 1st Year 1st Semester
            {
                code: "ETE 101",
                title: "Introduction to Solid State Devices",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 102",
                title: "Sessional Based on ETE 101",
                credit: "0.75",
                dept: "ete"
            },
            {
                code: "EEE 107",
                title: "Electrical Circuit Theory",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "EEE 108",
                title: "Sessional Based on EEE 107",
                credit: "1.50",
                dept: "ete"
            },
            {
                code: "ETE 190",
                title: "Engineering Graphics",
                credit: "1.50",
                dept: "ete"
            },
            {
                code: "Phy 111",
                title: "Physics",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "Phy 112",
                title: "Sessional Based on Phy 111",
                credit: "0.75",
                dept: "ete"
            },
            {
                code: "Math 151",
                title: "Engg. Mathematics-I",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "Hum 111",
                title: "Technical English Communication & Report Writing",
                credit: "2.00",
                dept: "ete"
            },

            // 1st Year 2nd Semester
            {
                code: "ETE 103",
                title: "Analog Electronics-I",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 104",
                title: "Sessional Based on ETE 103",
                credit: "1.50",
                dept: "ete"
            },
            {
                code: "CSE 141",
                title: "Computer Fundamentals and Programming",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "CSE 142",
                title: "Sessional Based on CSE 141",
                credit: "1.50",
                dept: "ete"
            },
            {
                code: "EEE 109",
                title: "Network Analysis & Synthesis",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "Math 153",
                title: "Engg. Mathematics-II",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "Hum 113",
                title: "Financial Accounts & Economic Analysis",
                credit: "4.00",
                dept: "ete"
            },

            // 2nd Year 1st Semester
            {
                code: "ETE 200",
                title: "Electronic Circuit Design Lab.",
                credit: "1.50",
                dept: "ete"
            },
            {
                code: "ETE 201",
                title: "Digital Electronics",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 202",
                title: "Sessional Based on ETE 201",
                credit: "1.50",
                dept: "ete"
            },
            {
                code: "ETE 203",
                title: "Analog Electronics-II",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 204",
                title: "Sessional Based on ETE 203",
                credit: "0.75",
                dept: "ete"
            },
            {
                code: "CSE 241",
                title: "Data Structure and Algorithm",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "CSE 242",
                title: "Sessional Based on CSE 241",
                credit: "0.75",
                dept: "ete"
            },
            {
                code: "EEE 223",
                title: "Electrical Machines",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "Math 251",
                title: "Engg. Mathematics-III",
                credit: "3.00",
                dept: "ete"
            },

            // 2nd Year 2nd Semester
            {
                code: "EEE 224",
                title: "Sessional Based on EEE 223",
                credit: "0.75",
                dept: "ete"
            },
            {
                code: "ETE 209",
                title: "Design and Analysis of Signal and Systems using MATLAB",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 210",
                title: "Sessional Based on ETE 209",
                credit: "0.75",
                dept: "ete"
            },
            {
                code: "EEE 271",
                title: "Instrumentation",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "EEE 272",
                title: "Sessional Based on EEE 271",
                credit: "1.50",
                dept: "ete"
            },
            {
                code: "ETE 211",
                title: "Communication Theory",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 212",
                title: "Sessional Based on ETE 211",
                credit: "0.75",
                dept: "ete"
            },
            {
                code: "ETE 221",
                title: "EM Fields and Waves",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "Math 253",
                title: "Engg. Mathematics-IV",
                credit: "3.00",
                dept: "ete"
            },

            // 3rd Year 1st Semester
            {
                code: "EEE 301",
                title: "Control System",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "EEE 302",
                title: "Sessional Based on EEE 301",
                credit: "0.75",
                dept: "ete"
            },
            {
                code: "ETE 303",
                title: "VLSI Design",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 304",
                title: "Sessional Based on ETE 303",
                credit: "0.75",
                dept: "ete"
            },
            {
                code: "EEE 313",
                title: "Industrial Electronics",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "EEE 314",
                title: "Sessional Based on EEE 313",
                credit: "0.75",
                dept: "ete"
            },
            {
                code: "ETE 321",
                title: "Microwave Engineering",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 322",
                title: "Sessional Based on ETE 321",
                credit: "0.75",
                dept: "ete"
            },
            {
                code: "ETE 333",
                title: "Numerical Methods in Engineering",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 334",
                title: "Sessional Based on ETE 333",
                credit: "1.50",
                dept: "ete"
            },

            // 3rd Year 2nd Semester
            {
                code: "ETE 300",
                title: "Electronic Project Design and Development",
                credit: "1.50",
                dept: "ete"
            },
            {
                code: "ETE 315",
                title: "Information Theory",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 309",
                title: "Digital Signal Processing",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 310",
                title: "Sessional Based on ETE 309",
                credit: "0.75",
                dept: "ete"
            },
            {
                code: "ETE 311",
                title: "Digital Communication",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 312",
                title: "Sessional Based on ETE 311",
                credit: "0.75",
                dept: "ete"
            },
            {
                code: "ETE 323",
                title: "Antennas and Propagation",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 324",
                title: "Sessional Based on ETE 323",
                credit: "0.75",
                dept: "ete"
            },
            {
                code: "EEE 351",
                title: "Microprocessor and Microcomputer",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "EEE 352",
                title: "Sessional Based on EEE 351",
                credit: "1.50",
                dept: "ete"
            },

            // 4th Year 1st Semester
            {
                code: "ETE 400",
                title: "Project and Thesis",
                credit: "1.50",
                dept: "ete"
            },
            {
                code: "ETE 401",
                title: "Computer Network and Data Communication",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 402",
                title: "Sessional Based on ETE 401",
                credit: "0.75",
                dept: "ete"
            },
            {
                code: "Hum 411",
                title: "Project Planning Management & Engineering",
                credit: "2.00",
                dept: "ete"
            },
            {
                code: "ETE 411",
                title: "Wireless and Mobile Communication",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 412",
                title: "Sessional Based on ETE 411",
                credit: "0.75",
                dept: "ete"
            },
            {
                code: "ETE 413",
                title: "Telecommunication Engineering",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 414",
                title: "Sessional Based on ETE 413",
                credit: "0.75",
                dept: "ete"
            },

            // Elective-II Courses (choose one)
            {
                code: "ETE 421",
                title: "Microwave Devices",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 422",
                title: "Sessional Based on ETE 421",
                credit: "0.75",
                dept: "ete"
            },
            {
                code: "ETE 425",
                title: "Solid State Microwave Devices",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 426",
                title: "Sessional Based on ETE 425",
                credit: "0.75",
                dept: "ete"
            },
            {
                code: "ETE 433",
                title: "Numerical Techniques in Electromagnetics",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 434",
                title: "Sessional Based on ETE 433",
                credit: "0.75",
                dept: "ete"
            },
            {
                code: "ETE 443",
                title: "Multimedia Communication",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 444",
                title: "Sessional Based on ETE 443",
                credit: "0.75",
                dept: "ete"
            },
            {
                code: "ETE 445",
                title: "Digital Filter Design",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 446",
                title: "Sessional Based on ETE 445",
                credit: "0.75",
                dept: "ete"
            },
            {
                code: "ETE 447",
                title: "Digital Image Processing",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 448",
                title: "Sessional Based on ETE 447",
                credit: "0.75",
                dept: "ete"
            },
            {
                code: "ETE 449",
                title: "Digital Speech Processing",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 450",
                title: "Sessional Based on ETE 449",
                credit: "0.75",
                dept: "ete"
            },
            {
                code: "ETE 451",
                title: "Voice Communication Techniques",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 452",
                title: "Sessional Based on ETE 451",
                credit: "0.75",
                dept: "ete"
            },
            {
                code: "ETE 453",
                title: "Microprocessor Based System Design",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 454",
                title: "Sessional Based on ETE 453",
                credit: "0.75",
                dept: "ete"
            },
            {
                code: "ETE 455",
                title: "Industrial Drives",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 456",
                title: "Sessional Based on ETE 455",
                credit: "0.75",
                dept: "ete"
            },
            {
                code: "ETE 457",
                title: "Electronic Instrumentation",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 458",
                title: "Sessional Based on ETE 457",
                credit: "0.75",
                dept: "ete"
            },
            {
                code: "ETE 459",
                title: "Optoelectronics",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 460",
                title: "Sessional Based on ETE 459",
                credit: "0.75",
                dept: "ete"
            },

            // 4th Year 2nd Semester
            {
                code: "ETE 400",
                title: "Project and Thesis",
                credit: "1.50",
                dept: "ete"
            },
            {
                code: "ETE 415",
                title: "Radio and TV Engg.",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 416",
                title: "Sessional Based on ETE 415",
                credit: "0.75",
                dept: "ete"
            },
            {
                code: "ETE 417",
                title: "Fiber Optic Communication",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 418",
                title: "Sessional Based on ETE 417",
                credit: "0.75",
                dept: "ete"
            },
            {
                code: "ETE 419",
                title: "Satellite Communication and Radar",
                credit: "3.00",
                dept: "ete"
            },

            // Elective-I Courses (choose one)
            {
                code: "ETE 407",
                title: "Adaptive Filters",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 409",
                title: "Random Signal Processing",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 423",
                title: "Radio Wave Propagation",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 427",
                title: "Neural and Fuzzy Systems in Communications",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 429",
                title: "Spread Spectrum and CDMA Technology",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 435",
                title: "Discrete Mathematics",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 441",
                title: "Graph Theory",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 431",
                title: "Statistical Theory of Communication",
                credit: "3.00",
                dept: "ete"
            },

            // Elective-III Courses (choose one)
            {
                code: "ETE 453",
                title: "Microprocessor Based System Design",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 454",
                title: "Sessional Based on ETE 453",
                credit: "0.75",
                dept: "ete"
            },
            {
                code: "ETE 455",
                title: "Industrial Drives",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 456",
                title: "Sessional Based on ETE 455",
                credit: "0.75",
                dept: "ete"
            },
            {
                code: "ETE 457",
                title: "Electronic Instrumentation",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 458",
                title: "Sessional Based on ETE 457",
                credit: "0.75",
                dept: "ete"
            },
            {
                code: "ETE 459",
                title: "Optoelectronics",
                credit: "3.00",
                dept: "ete"
            },
            {
                code: "ETE 460",
                title: "Sessional Based on ETE 459",
                credit: "0.75",
                dept: "ete"
            },


            // Civil Engineering Courses
            // 1st Year 1st Semester
            {
                code: "CE 1101",
                title: "Surveying",
                credit: "4.00",
                dept: "ce"
            },
            {
                code: "Chem 1101",
                title: "Chemistry",
                credit: "3.00",
                dept: "ce"
            },
            {
                code: "Phy 1101",
                title: "Physics-I",
                credit: "3.00",
                dept: "ce"
            },
            {
                code: "Math 1101",
                title: "Mathematics-I",
                credit: "3.00",
                dept: "ce"
            },
            {
                code: "Hum 1101",
                title: "English",
                credit: "2.00",
                dept: "ce"
            },
            {
                code: "CE 1100",
                title: "Civil Engineering Drawing",
                credit: "1.50",
                dept: "ce"
            },
            {
                code: "MES 1132",
                title: "Mechanical Engineering Shops",
                credit: "1.50",
                dept: "ce"
            },
            {
                code: "Chem 1102",
                title: "Chemistry Sessional",
                credit: "1.50",
                dept: "ce"
            },
            {
                code: "Hum 1102",
                title: "Developing English Language Skills",
                credit: "1.50",
                dept: "ce"
            },

            // 1st Year 2nd Semester
            {
                code: "CE 1201",
                title: "Engineering Mechanics",
                credit: "4.00",
                dept: "ce"
            },
            {
                code: "EEE 1241",
                title: "Basic Electrical Engineering",
                credit: "3.00",
                dept: "ce"
            },
            {
                code: "Hum 1201",
                title: "Bangladesh Studies",
                credit: "2.00",
                dept: "ce"
            },
            {
                code: "Phy 1201",
                title: "Physics-II",
                credit: "3.00",
                dept: "ce"
            },
            {
                code: "Math 1201",
                title: "Mathematics-II",
                credit: "3.00",
                dept: "ce"
            },
            {
                code: "CE 1202",
                title: "Practical Surveying",
                credit: "1.50",
                dept: "ce"
            },
            {
                code: "CE 1200",
                title: "Computer Aided Drafting",
                credit: "1.50",
                dept: "ce"
            },
            {
                code: "Phy 1202",
                title: "Physics Sessional",
                credit: "1.50",
                dept: "ce"
            },

            // 2nd Year 1st Semester
            {
                code: "CE 2103",
                title: "Engineering Materials",
                credit: "4.00",
                dept: "ce"
            },
            {
                code: "CE 2111",
                title: "Mechanics of Materials-I",
                credit: "3.00",
                dept: "ce"
            },
            {
                code: "CE 2121",
                title: "Fluid Mechanics",
                credit: "4.00",
                dept: "ce"
            },
            {
                code: "Math 2101",
                title: "Mathematics-III",
                credit: "3.00",
                dept: "ce"
            },
            {
                code: "Hum 2101",
                title: "Sociology & Government",
                credit: "2.00",
                dept: "ce"
            },
            {
                code: "CE 2104",
                title: "Engineering Materials Sessional",
                credit: "1.50",
                dept: "ce"
            },
            {
                code: "CE 2110",
                title: "Details of Construction",
                credit: "1.50",
                dept: "ce"
            },
            {
                code: "CE 2122",
                title: "Fluid Mechanics Sessional",
                credit: "1.50",
                dept: "ce"
            },

            // 2nd Year 2nd Semester
            {
                code: "CE 2201",
                title: "Numerical Methods & Computer Programming",
                credit: "4.00",
                dept: "ce"
            },
            {
                code: "CE 2203",
                title: "Engineering Geology and Geomorphology",
                credit: "2.00",
                dept: "ce"
            },
            {
                code: "CE 2213",
                title: "Mechanics of Materials-II",
                credit: "3.00",
                dept: "ce"
            },
            {
                code: "Math 2201",
                title: "Mathematics-IV",
                credit: "3.00",
                dept: "ce"
            },
            // Note: Hum 2201 or Hum 2203 (select one)
            {
                code: "Hum 2201",
                title: "Accounting & Economics",
                credit: "2.00",
                dept: "ce"
            },
            {
                code: "Hum 2203",
                title: "Principles of Management",
                credit: "2.00",
                dept: "ce"
            },
            {
                code: "CE 2202",
                title: "Numerical Methods & Computer Programming Sessional",
                credit: "1.50",
                dept: "ce"
            },
            {
                code: "CE 2214",
                title: "Mechanics of Materials Sessional",
                credit: "1.50",
                dept: "ce"
            },
            {
                code: "CE 2220",
                title: "Details of Estimating",
                credit: "1.50",
                dept: "ce"
            },
            {
                code: "CE 2252",
                title: "Planning, Architecture and Engineering Systems",
                credit: "1.50",
                dept: "ce"
            },

            // 3rd Year 1st Semester
            {
                code: "CE 3111",
                title: "Structural Analysis & Design",
                credit: "4.00",
                dept: "ce"
            },
            {
                code: "CE 3115",
                title: "Reinforced Concrete-I",
                credit: "3.00",
                dept: "ce"
            },
            {
                code: "CE 3121",
                title: "Engineering Hydraulics",
                credit: "3.00",
                dept: "ce"
            },
            {
                code: "CE 3131",
                title: "Geotechnical Engineering-I",
                credit: "3.00",
                dept: "ce"
            },
            {
                code: "CE 3141",
                title: "Environmental Engineering-I",
                credit: "3.00",
                dept: "ce"
            },
            {
                code: "CE 3112",
                title: "Structural Analysis & Design Sessional-I",
                credit: "1.50",
                dept: "ce"
            },
            {
                code: "CE 3122",
                title: "Engineering Hydraulics Sessional",
                credit: "1.50",
                dept: "ce"
            },
            {
                code: "CE 3132",
                title: "Geotechnical Engineering Sessional-I",
                credit: "1.50",
                dept: "ce"
            },
            {
                code: "CE 3142",
                title: "Environmental Engineering Sessional-I",
                credit: "1.50",
                dept: "ce"
            },

            // 3rd Year 2nd Semester
            {
                code: "CE 3221",
                title: "Hydrology, Irrigation and Flood Control",
                credit: "3.00",
                dept: "ce"
            },
            {
                code: "CE 3213",
                title: "Design of Steel Structures",
                credit: "3.00",
                dept: "ce"
            },
            {
                code: "CE 3217",
                title: "Reinforced Concrete-II",
                credit: "3.00",
                dept: "ce"
            },
            {
                code: "CE 3233",
                title: "Geotechnical Engineering-II",
                credit: "3.00",
                dept: "ce"
            },
            {
                code: "CE 3205",
                title: "Transportation Planning and Traffic Engineering",
                credit: "3.00",
                dept: "ce"
            },
            {
                code: "CE 3218",
                title: "Reinforced Concrete Sessional-II",
                credit: "1.50",
                dept: "ce"
            },
            {
                code: "CE 3234",
                title: "Geotechnical Engineering Sessional-II",
                credit: "1.50",
                dept: "ce"
            },
            {
                code: "CE 3222",
                title: "Water Resources Engineering Sessional",
                credit: "1.50",
                dept: "ce"
            },

            // 4th Year 1st Semester
            {
                code: "CE 4111",
                title: "Analysis of Indeterminate Structures",
                credit: "3.00",
                dept: "ce"
            },
            {
                code: "CE 4101",
                title: "Professional Ethics and Practices",
                credit: "3.00",
                dept: "ce"
            },
            {
                code: "CE 4131",
                title: "Foundation Engineering",
                credit: "3.00",
                dept: "ce"
            },
            {
                code: "CE 4141",
                title: "Environmental Engineering-II",
                credit: "3.00",
                dept: "ce"
            },
            {
                code: "CE 4105",
                title: "Railway and Pavement Engineering",
                credit: "2.00",
                dept: "ce"
            },
            {
                code: "CE 4112",
                title: "Structural Analysis & Design Sessional-III",
                credit: "1.50",
                dept: "ce"
            },
            {
                code: "CE 4132",
                title: "Geotechnical Engineering Sessional-III",
                credit: "1.50",
                dept: "ce"
            },
            {
                code: "CE 4106",
                title: "Transportation Engineering Sessional",
                credit: "1.50",
                dept: "ce"
            },
            {
                code: "CE 4000",
                title: "Thesis",
                credit: "3.00",
                dept: "ce"
            }, // credit shown as "--" in table, assuming 3.00
            {
                code: "CE 4004",
                title: "Capstone Project & Internship/Industrial Attachment",
                credit: "1.50",
                dept: "ce"
            },

            // 4th Year 2nd Semester (Compulsory)
            {
                code: "CE 4201",
                title: "Project Planning & Construction Management",
                credit: "3.00",
                dept: "ce"
            },
            {
                code: "CE 4205",
                title: "Traffic Management",
                credit: "2.00",
                dept: "ce"
            },
            {
                code: "CE 4210",
                title: "Structural Analysis & Design Sessional-IV",
                credit: "1.50",
                dept: "ce"
            },
            {
                code: "CE 4240",
                title: "Environmental Engineering Sessional-II",
                credit: "1.50",
                dept: "ce"
            },
            {
                code: "CE 4000",
                title: "Thesis",
                credit: "1.50",
                dept: "ce"
            }, // second part of thesis
            {
                code: "CE 4004",
                title: "Capstone Project & Internship/Industrial Attachment",
                credit: "3.00",
                dept: "ce"
            },

            // 4th Year 2nd Semester (Optional - Group 01: Structural Engineering)
            {
                code: "CE 4213",
                title: "Pre-stressed Concrete",
                credit: "2.00",
                dept: "ce"
            },
            {
                code: "CE 4219",
                title: "Structural Dynamics",
                credit: "2.00",
                dept: "ce"
            },

            // 4th Year 2nd Semester (Optional - Group 02: Water Resource Engineering)
            {
                code: "CE 4221",
                title: "Integrated Water Resources Planning and Management",
                credit: "2.00",
                dept: "ce"
            },
            {
                code: "CE 4227",
                title: "Hydraulic Structures",
                credit: "2.00",
                dept: "ce"
            },

            // 4th Year 2nd Semester (Optional - Group 03: Geotechnical Engineering)
            {
                code: "CE 4235",
                title: "Soil Improvement Techniques",
                credit: "2.00",
                dept: "ce"
            },
            {
                code: "CE 4237",
                title: "Geotechnical Engineering-V",
                credit: "2.00",
                dept: "ce"
            },

            // 4th Year 2nd Semester (Optional - Group 04: Environmental Engineering)
            {
                code: "CE 4245",
                title: "Solid Waste Management",
                credit: "2.00",
                dept: "ce"
            },
            {
                code: "CE 4247",
                title: "Environmental Development Project",
                credit: "2.00",
                dept: "ce"
            },

            // 4th Year 2nd Semester (Optional - Group 05: Transportation Engineering)
            {
                code: "CE 4207",
                title: "Waterway and Airport Engineering",
                credit: "2.00",
                dept: "ce"
            },


            // Architecture Courses
            // 1st Year Odd Semester (ALL COMPULSORY)
            {
                code: "Arch 1102",
                title: "Design Studio - I",
                credit: "4.50",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Arch 1104",
                title: "Architectural Graphics - I",
                credit: "3.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Arch 1106",
                title: "Design Communication",
                credit: "1.50",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Arch 1101",
                title: "History of Architecture - I",
                credit: "2.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Arch 1103",
                title: "Aesthetics and Design - I",
                credit: "2.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Phy 1105",
                title: "Physics",
                credit: "3.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Hum 1107",
                title: "Communication Skills in English",
                credit: "2.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Hum 1109",
                title: "Human Psychology",
                credit: "2.00",
                dept: "arch",
                type: "compulsory"
            },

            // 1st Year Even Semester (ALL COMPULSORY)
            {
                code: "Arch 1202",
                title: "Design Studio - II",
                credit: "4.50",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Arch 1204",
                title: "Architectural Graphics - II",
                credit: "3.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Arch 1206",
                title: "Photography and Graphic Reproduction",
                credit: "1.50",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Arch 1201",
                title: "History of Architecture - II",
                credit: "2.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Arch 1203",
                title: "Aesthetics and Design - II",
                credit: "2.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Arch 1205",
                title: "Ecology",
                credit: "2.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Math 1205",
                title: "Mathematics",
                credit: "3.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Hum 1207",
                title: "Fundamentals of Sociology",
                credit: "3.00",
                dept: "arch",
                type: "compulsory"
            },

            // 2nd Year Odd Semester
            {
                code: "Arch 2102",
                title: "Design Studio - III",
                credit: "6.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Arch 2104",
                title: "Computer Applications - I",
                credit: "1.50",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Arch 2106",
                title: "Graphic Design and Sculpture",
                credit: "3.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Arch 2101",
                title: "History of Architecture - III",
                credit: "2.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Arch 2103",
                title: "Climate and Design - I",
                credit: "2.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "CE 2153",
                title: "Structure - I",
                credit: "2.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "URP 2151",
                title: "Physical Planning - I",
                credit: "2.00",
                dept: "arch",
                type: "compulsory"
            },
            // OPTIONAL COURSES (Choose ONE):
            {
                code: "Arch 2105",
                title: "Architectural Acoustics and Lighting",
                credit: "2.00",
                dept: "arch",
                type: "optional"
            },
            {
                code: "Hum 2107",
                title: "Logic and Philosophy",
                credit: "2.00",
                dept: "arch",
                type: "optional"
            },

            // 2nd Year Even Semester
            {
                code: "Arch 2202",
                title: "Design Studio - IV",
                credit: "6.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Arch 2204",
                title: "Computer Applications - II",
                credit: "1.50",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Arch 2206",
                title: "Digital Simulation",
                credit: "1.50",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Arch 2201",
                title: "History of Architecture - IV",
                credit: "2.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Arch 2203",
                title: "Climate and Design - II",
                credit: "2.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Arch 2205",
                title: "Construction Details",
                credit: "2.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "CE 2253",
                title: "Structure - II",
                credit: "2.00",
                dept: "arch",
                type: "compulsory"
            },
            // OPTIONAL COURSES (Choose ONE):
            {
                code: "Arch 2207",
                title: "Building and Finished Materials",
                credit: "2.00",
                dept: "arch",
                type: "optional"
            },
            {
                code: "Arch 2209",
                title: "Urban Anthropology",
                credit: "2.00",
                dept: "arch",
                type: "optional"
            },

            // 3rd Year Odd Semester
            {
                code: "Arch 3102",
                title: "Design Studio - V",
                credit: "9.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Arch 3104",
                title: "Building Materials and Construction",
                credit: "3.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Arch 3101",
                title: "Modern Architecture",
                credit: "2.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "CE 3153",
                title: "Structure - III",
                credit: "2.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "EEE 3165",
                title: "Electrical Equipment",
                credit: "2.00",
                dept: "arch",
                type: "compulsory"
            },
            // OPTIONAL COURSES (Choose ONE):
            {
                code: "CE 3155",
                title: "Estimation and Specifications",
                credit: "2.00",
                dept: "arch",
                type: "optional"
            },
            {
                code: "Arch 3103",
                title: "Vernacular Architecture and Settlements",
                credit: "2.00",
                dept: "arch",
                type: "optional"
            },

            // 3rd Year Even Semester
            {
                code: "Arch 3202",
                title: "Design Studio - VI",
                credit: "9.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Arch 3204",
                title: "Working Drawing",
                credit: "3.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Arch 3201",
                title: "Contemporary Architecture",
                credit: "2.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "CE 3253",
                title: "Structure - IV",
                credit: "2.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "ME 3275",
                title: "Mechanical Equipment",
                credit: "2.00",
                dept: "arch",
                type: "compulsory"
            },
            // OPTIONAL COURSES (Choose ONE):
            {
                code: "Arch 3203",
                title: "Disaster Resilient Buildings and Management",
                credit: "2.00",
                dept: "arch",
                type: "optional"
            },
            {
                code: "CE 3255",
                title: "Water Supply, Sanitation and Fire Safety",
                credit: "2.00",
                dept: "arch",
                type: "optional"
            },

            // 4th Year Odd Semester
            {
                code: "Arch 4102",
                title: "Design Studio - VII",
                credit: "9.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Arch 4104",
                title: "Interior Design",
                credit: "1.50",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Arch 4101",
                title: "Architecture of Bengal - I",
                credit: "2.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Arch 4103",
                title: "Urban Design",
                credit: "2.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "CE 4153",
                title: "Structure - V",
                credit: "2.00",
                dept: "arch",
                type: "compulsory"
            },
            // OPTIONAL COURSES (Choose ONE):
            {
                code: "Arch 4105",
                title: "Landscape Architecture",
                credit: "2.00",
                dept: "arch",
                type: "optional"
            },
            {
                code: "Arch 4109",
                title: "Sustainable Design and Technology",
                credit: "2.00",
                dept: "arch",
                type: "optional"
            },

            // 4th Year Even Semester
            {
                code: "Arch 4202",
                title: "Design Studio - VIII",
                credit: "9.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Arch 4204",
                title: "Landscape Design",
                credit: "1.50",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Arch 4201",
                title: "Architecture of Bengal - II",
                credit: "2.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Arch 4203",
                title: "Housing",
                credit: "2.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "CE 4253",
                title: "Structure - VI",
                credit: "2.00",
                dept: "arch",
                type: "compulsory"
            },
            // OPTIONAL COURSES (Choose ONE):
            {
                code: "Arch 4205",
                title: "Architectural Conservation",
                credit: "2.00",
                dept: "arch",
                type: "optional"
            },
            {
                code: "URP 4251",
                title: "Advanced Physical Planning",
                credit: "2.00",
                dept: "arch",
                type: "optional"
            },

            // 5th Year Odd Semester (ALL COMPULSORY)
            {
                code: "Arch 5102",
                title: "Design Studio - IX",
                credit: "10.50",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Arch 5104",
                title: "Seminar",
                credit: "1.50",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Arch 5101",
                title: "Research Methodology",
                credit: "2.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Arch 5153",
                title: "Survey Technique",
                credit: "2.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Hum 5107",
                title: "Project Economics",
                credit: "2.00",
                dept: "arch",
                type: "compulsory"
            },

            // 5th Year Even Semester (ALL COMPULSORY except Professional Training which is non-credit)
            {
                code: "Arch 5202",
                title: "Design Studio - X",
                credit: "10.50",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Arch 5204",
                title: "Dissertation",
                credit: "3.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Arch 5201",
                title: "Professional Practice",
                credit: "2.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Hum 5207",
                title: "Management and Accounting",
                credit: "2.00",
                dept: "arch",
                type: "compulsory"
            },
            {
                code: "Arch 5000",
                title: "Professional Training",
                credit: "0.00",
                dept: "arch",
                type: "non-credit"
            },


            // Urban and Regional Planning Courses
            // 1st Year Odd Semester
            {
                code: "URP 1101",
                title: "Human Settlements Development",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "Math 1103",
                title: "Mathematics - I",
                credit: "2.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "Chem 1103",
                title: "Basic Environmental Chemistry",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "Hum 1103",
                title: "Micro-Economics",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "Hum 1105",
                title: "English",
                credit: "2.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 1116",
                title: "Basic Design",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 1132",
                title: "Introduction to Computer Applications",
                credit: "1.5",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "Hum 1106",
                title: "Developing English Skills",
                credit: "1.5",
                dept: "urp",
                type: "compulsory"
            },

            // 1st Year Even Semester
            {
                code: "URP 1201",
                title: "Fundamentals of Planning",
                credit: "2.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 1221",
                title: "Surveying and Cartography",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 1253",
                title: "Elements of Architecture",
                credit: "2.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "Math 1203",
                title: "Mathematics - II",
                credit: "2.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "Hum 1203",
                title: "Macro-Economics",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 1220",
                title: "Graphics for Planners",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 1222",
                title: "Surveying and Cartography Workshop",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 1234",
                title: "Communication and Presentation Techniques Studio",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },

            // 2nd Year Odd Semester
            {
                code: "URP 2101",
                title: "Urban Planning Principles",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 2115",
                title: "Site and Area Planning",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 2141",
                title: "Statistics for Planners – I",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "CE 2151",
                title: "Construction Materials",
                credit: "2.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "Hum 2105",
                title: "Sociology for Planners",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 2110",
                title: "Social and Physical Surveys",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 2132",
                title: "Computer Applications in Planning",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },

            // 2nd Year Even Semester
            {
                code: "URP 2201",
                title: "Urban Planning Techniques",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "CE 2251",
                title: "Water Resources Planning",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 2223",
                title: "GIS and Remote Sensing",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 2241",
                title: "Statistics for Planners – II",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "Hum 2203",
                title: "Public Finance",
                credit: "2.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "Hum 2205",
                title: "Accounting",
                credit: "2.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 2216",
                title: "Site and Area Planning Studio",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 2224",
                title: "GIS and Remote Sensing Studio",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 2234",
                title: "Programming Techniques",
                credit: "2.0",
                dept: "urp",
                type: "compulsory"
            },

            // 3rd Year Odd Semester
            {
                code: "URP 3115",
                title: "Landscape Planning and Design",
                credit: "2.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 3127",
                title: "Transportation Study",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "CE 3151",
                title: "Elements of Solid Mechanics",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 3111",
                title: "Rural Development Planning I",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "Hum 3105",
                title: "Social Psychology",
                credit: "2.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 3145",
                title: "Land Economics",
                credit: "2.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 312",
                title: "Urban Planning Studio",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 3112",
                title: "Rural Planning Studio",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },

            // 3rd Year Even Semester
            {
                code: "URP 3213",
                title: "Regional Development Planning",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 3227",
                title: "Transportation Planning II",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "CE 3251",
                title: "Elements of Civil Engineering Structures",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "Hum 3203",
                title: "Political Science and Local Government",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 3207",
                title: "Neighborhood Planning and Community Development",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 3217",
                title: "Urban Design",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 3247",
                title: "Operations Research and Systems Analysis",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 3211",
                title: "Rural Development Planning II",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 3208",
                title: "Participatory Planning Studio",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 3216",
                title: "Landscape Planning Studio",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },

            // 4th Year Odd Semester
            {
                code: "URP 4000",
                title: "Project/Thesis",
                credit: "2.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 4105",
                title: "Housing and Real Estate Development",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 4137",
                title: "Project Evaluation and Management",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 4139",
                title: "Environmental Planning and Management",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 4115",
                title: "Planning of Tourism and Recreational Facilities",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "CE 4151",
                title: "Basic Environmental Engineering",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 4140",
                title: "Internship",
                credit: "0.0",
                dept: "urp",
                type: "non-credit"
            },
            {
                code: "URP 4114",
                title: "Regional Planning Studio",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 4128",
                title: "Transportation Planning Studio",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },

            // 4th Year Even Semester
            {
                code: "URP 4000",
                title: "Project/Thesis",
                credit: "4.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 4201",
                title: "Urban Management and Governance",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 4203",
                title: "Legal Basis of Planning",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 4207",
                title: "Development Planning",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 4209",
                title: "Planning of Utility and Municipal Services",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 4239",
                title: "Environmental and Resource Economics",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 4243",
                title: "Natural Hazards and Disaster Management",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 4245",
                title: "Urban and Regional Economics",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 4249",
                title: "Land Development and Management",
                credit: "3.0",
                dept: "urp",
                type: "compulsory"
            },
            {
                code: "URP 4238",
                title: "Project Evaluation and Management",
                credit: "2.0",
                dept: "urp",
                type: "compulsory"
            },
        ];
// ==========================
// FORM SYNC FUNCTIONS
// ==========================

function syncMobileToDesktop() {
    const mobileCards = document.querySelectorAll('.course-entry-card');
    
    mobileCards.forEach((card, index) => {
        const courseId = card.getAttribute('data-course-id');
        const mobileCodeInput = card.querySelector('.course-no-input-mobile');
        const mobileTitleInput = card.querySelector('.course-title-input-mobile');
        const mobileCreditInput = card.querySelector('.course-credit-input-mobile');
        
        // Find corresponding desktop row
        const desktopRow = document.querySelector(`tr[data-course-id="${courseId}"]`);
        if (desktopRow) {
            const desktopCodeInput = desktopRow.querySelector('.course-no-input');
            const desktopTitleInput = desktopRow.querySelector('.course-title-input');
            const desktopCreditInput = desktopRow.querySelector('.course-credit-input');
            
            // Sync values from mobile to desktop
            if (desktopCodeInput && mobileCodeInput) desktopCodeInput.value = mobileCodeInput.value;
            if (desktopTitleInput && mobileTitleInput) desktopTitleInput.value = mobileTitleInput.value;
            if (desktopCreditInput && mobileCreditInput) desktopCreditInput.value = mobileCreditInput.value;
        }
    });
}

function syncDesktopToMobile() {
    const desktopRows = document.querySelectorAll('#rows tr');
    
    desktopRows.forEach((row, index) => {
        const courseId = row.getAttribute('data-course-id');
        const desktopCodeInput = row.querySelector('.course-no-input');
        const desktopTitleInput = row.querySelector('.course-title-input');
        const desktopCreditInput = row.querySelector('.course-credit-input');
        
        // Find corresponding mobile card
        const mobileCard = document.querySelector(`.course-entry-card[data-course-id="${courseId}"]`);
        if (mobileCard) {
            const mobileCodeInput = mobileCard.querySelector('.course-no-input-mobile');
            const mobileTitleInput = mobileCard.querySelector('.course-title-input-mobile');
            const mobileCreditInput = mobileCard.querySelector('.course-credit-input-mobile');
            
            // Sync values from desktop to mobile
            if (mobileCodeInput && desktopCodeInput) mobileCodeInput.value = desktopCodeInput.value;
            if (mobileTitleInput && desktopTitleInput) mobileTitleInput.value = desktopTitleInput.value;
            if (mobileCreditInput && desktopCreditInput) mobileCreditInput.value = desktopCreditInput.value;
        }
    });
}

// ==========================
// THEME MANAGEMENT
// ==========================

const themeToggle = document.getElementById('theme-toggle');
const themeLabel = document.getElementById('theme-label');

// Check for saved theme preference or default to system
function getThemePreference() {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        return savedTheme;
    }
    return 'system';
}

// Apply theme based on preference
function applyTheme(theme) {
    const html = document.documentElement;
    
    if (theme === 'dark' || (theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        html.setAttribute('data-theme', 'dark');
        themeToggle.checked = true;
        themeLabel.textContent = theme === 'system' ? 'System' : 'Dark';
    } else {
        html.removeAttribute('data-theme');
        themeToggle.checked = false;
        themeLabel.textContent = theme === 'system' ? 'System' : 'Light';
    }
}

// Initialize theme
applyTheme(getThemePreference());

// Theme toggle event
themeToggle.addEventListener('change', function() {
    const currentTheme = getThemePreference();
    let newTheme;
    
    if (currentTheme === 'system') {
        // If system mode, check what we're actually showing
        if (themeToggle.checked) {
            newTheme = 'dark';
        } else {
            newTheme = 'light';
        }
    } else {
        // Toggle between light and dark
        newTheme = currentTheme === 'light' ? 'dark' : 'light';
    }
    
    localStorage.setItem('theme', newTheme);
    applyTheme(newTheme);
});

// Listen for system theme changes
window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
    const currentTheme = getThemePreference();
    if (currentTheme === 'system') {
        applyTheme('system');
    }
});

// ==========================
// DEPARTMENT SEARCH FUNCTIONS
// ==========================

function searchDepartment(inputElement) {
    const searchTerm = inputElement.value.toLowerCase().trim();
    const suggestionsDiv = document.getElementById('department-suggestions');
    
    if (!suggestionsDiv) return;
    
    if (searchTerm.length < 2) {
        suggestionsDiv.style.display = 'none';
        return;
    }
    
    // Filter departments based on search term
    const filteredDepartments = departmentDatabase.filter(dept => 
        dept.title.toLowerCase().includes(searchTerm) || 
        dept.fullName.toLowerCase().includes(searchTerm) ||
        dept.code.toLowerCase().includes(searchTerm)
    ).slice(0, 10);
    
    displayDepartmentSuggestions(suggestionsDiv, filteredDepartments, inputElement);
}

function displayDepartmentSuggestions(suggestionsDiv, filteredDepartments, inputElement) {
    suggestionsDiv.innerHTML = '';
    
    if (filteredDepartments.length === 0) {
        const noResults = document.createElement('div');
        noResults.className = 'autocomplete-suggestion';
        noResults.innerHTML = `<div class="text-muted">No departments found. You can enter manually.</div>`;
        suggestionsDiv.appendChild(noResults);
        suggestionsDiv.style.display = 'block';
    } else {
        filteredDepartments.forEach(dept => {
            const suggestion = document.createElement('div');
            suggestion.className = 'autocomplete-suggestion';
            
            suggestion.innerHTML = `
                <div class="course-info">
                    <div style="flex: 1;">
                        <div class="course-code">${dept.title}</div>
                        <div class="course-title">${dept.fullName} (${dept.code.toUpperCase()})</div>
                    </div>
                </div>
            `;
            suggestion.onclick = () => {
                selectDepartment(inputElement, dept);
                suggestionsDiv.style.display = 'none';
            };
            suggestion.onmouseenter = () => {
                suggestion.classList.add('autocomplete-selected');
            };
            suggestion.onmouseleave = () => {
                suggestion.classList.remove('autocomplete-selected');
            };
            suggestionsDiv.appendChild(suggestion);
        });
        
        suggestionsDiv.style.display = 'block';
    }
}

function selectDepartment(inputElement, department) {
    inputElement.value = department.title;
    document.getElementById('deptCodeInput').value = department.code;
    selectedDepartment = department.code;
    
    // Clear all course inputs when department changes
    clearAllCourseInputs();
}

function showDepartmentSuggestions(inputElement) {
    const searchTerm = inputElement.value.toLowerCase().trim();
    if (searchTerm.length >= 2) {
        searchDepartment(inputElement);
    }
}

function clearAllCourseInputs() {
    // Clear all course inputs when department changes
    const courseNoInputs = document.querySelectorAll('.course-no-input, .course-no-input-mobile');
    const courseTitleInputs = document.querySelectorAll('.course-title-input, .course-title-input-mobile');
    const courseCreditInputs = document.querySelectorAll('.course-credit-input, .course-credit-input-mobile');
    
    courseNoInputs.forEach(input => input.value = '');
    courseTitleInputs.forEach(input => input.value = '');
    courseCreditInputs.forEach(input => input.value = '');
    
    // Clear all suggestion boxes
    document.querySelectorAll('.autocomplete-suggestions').forEach(div => {
        div.style.display = 'none';
        div.innerHTML = '';
    });
    
    // Reset total credit
    calculateTotalCredit();
}

// ==========================
// COURSE MANAGEMENT FUNCTIONS
// ==========================

function addCourse() {
    const newCourseId = rowCount;
    rowCount++;
    
    // Add desktop row
    const desktopRow = `
        <tr class="course-row" data-course-id="${newCourseId}">
            <td>
                <div class="course-search-input">
                    <input type="text" name="course_no[]" class="form-control course-no-input" 
                           placeholder="Math 1221"
                           autocomplete="off"
                           oninput="searchCourseByCode(this)"
                           onfocus="showCodeSuggestions(this)">
                    <div class="autocomplete-suggestions" id="code-suggestions-${newCourseId}"></div>
                </div>
            </td>
            <td>
                <div class="course-search-input">
                    <input type="text" name="course_title[]" class="form-control course-title-input" 
                           placeholder="Mathematics-I"
                           autocomplete="off"
                           oninput="searchCourseByTitle(this)"
                           onfocus="showTitleSuggestions(this)">
                    <div class="autocomplete-suggestions" id="title-suggestions-${newCourseId}"></div>
                </div>
            </td>
            <td><input type="text" name="course_credit[]" class="form-control course-credit-input" 
                       placeholder="3.00" oninput="calculateTotalCredit(); syncDesktopToMobile();"></td>
            <td>
                <button type="button" onclick="removeCourse(${newCourseId})" class="btn btn-danger btn-sm">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        </tr>`;
    document.getElementById("rows").insertAdjacentHTML('beforeend', desktopRow);
    
    // Add mobile card
    const mobileCard = `
        <div class="course-entry-card" data-course-id="${newCourseId}">
            <div class="course-entry-header">
                <div class="course-entry-number">${rowCount}</div>
                <h6 class="mb-0">Course Details</h6>
                <button type="button" onclick="removeCourse(${newCourseId})" class="remove-course-btn">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
            <div class="course-fields-grid">
                <div class="field-group">
                    <label>Course No.</label>
                    <div class="course-search-input">
                        <input type="text" name="course_no_mobile[]" class="form-control course-no-input-mobile" 
                               placeholder="ME 2103"
                               autocomplete="off"
                               oninput="searchCourseByCodeMobile(this)"
                               onfocus="showCodeSuggestionsMobile(this)">
                        <div class="autocomplete-suggestions" id="code-suggestions-mobile-${newCourseId}"></div>
                    </div>
                </div>
                <div class="field-group">
                    <label>Course Title</label>
                    <div class="course-search-input">
                        <input type="text" name="course_title_mobile[]" class="form-control course-title-input-mobile" 
                               placeholder="Engineering Mechanics"
                               autocomplete="off"
                               oninput="searchCourseByTitleMobile(this)"
                               onfocus="showTitleSuggestionsMobile(this)">
                        <div class="autocomplete-suggestions" id="title-suggestions-mobile-${newCourseId}"></div>
                    </div>
                </div>
                <div class="field-group">
                    <label>Credit</label>
                    <input type="text" name="course_credit_mobile[]" class="form-control course-credit-input-mobile" 
                            placeholder="3.00" oninput="updateCreditFromMobile(this)">
                </div>
            </div>
        </div>`;
    document.getElementById("course-cards").insertAdjacentHTML('beforeend', mobileCard);
    
    // Enable delete button for the first row if there are now multiple rows
    if (rowCount > 1) {
        const firstDeleteBtn = document.querySelector('tr[data-course-id="0"] .btn-danger');
        const firstMobileDeleteBtn = document.querySelector('.course-entry-card[data-course-id="0"] .remove-course-btn');
        if (firstDeleteBtn) firstDeleteBtn.disabled = false;
        if (firstMobileDeleteBtn) firstMobileDeleteBtn.disabled = false;
    }
    
    // Reorder mobile card numbers
    reorderMobileCards();
    calculateTotalCredit();
}

function removeCourse(courseId) {
    if (rowCount <= 1) return; // Don't remove the last row
    
    // Remove desktop row
    const desktopRow = document.querySelector(`tr[data-course-id="${courseId}"]`);
    if (desktopRow) desktopRow.remove();
    
    // Remove mobile card
    const mobileCard = document.querySelector(`.course-entry-card[data-course-id="${courseId}"]`);
    if (mobileCard) mobileCard.remove();
    
    rowCount--;
    
    // Reassign course IDs for remaining items
    reorderAllCourses();
    
    // Disable delete button if only one row left
    if (rowCount === 1) {
        const firstDeleteBtn = document.querySelector('tr[data-course-id="0"] .btn-danger');
        const firstMobileDeleteBtn = document.querySelector('.course-entry-card[data-course-id="0"] .remove-course-btn');
        if (firstDeleteBtn) firstDeleteBtn.disabled = true;
        if (firstMobileDeleteBtn) firstMobileDeleteBtn.disabled = true;
    }
    
    calculateTotalCredit();
}

function reorderAllCourses() {
    const desktopRows = document.querySelectorAll('#rows tr');
    const mobileCards = document.querySelectorAll('.course-entry-card');
    
    // Reorder desktop rows
    desktopRows.forEach((row, index) => {
        row.setAttribute('data-course-id', index);
        
        // Update suggestion IDs
        const codeSuggestions = row.querySelector(`[id^="code-suggestions-"]`);
        const titleSuggestions = row.querySelector(`[id^="title-suggestions-"]`);
        if (codeSuggestions) codeSuggestions.id = `code-suggestions-${index}`;
        if (titleSuggestions) titleSuggestions.id = `title-suggestions-${index}`;
        
        // Update delete button
        const deleteBtn = row.querySelector('.btn-danger');
        if (deleteBtn) deleteBtn.setAttribute('onclick', `removeCourse(${index})`);
    });
    
    // Reorder mobile cards
    mobileCards.forEach((card, index) => {
        card.setAttribute('data-course-id', index);
        
        // Update suggestion IDs
        const codeSuggestions = card.querySelector(`[id^="code-suggestions-mobile-"]`);
        const titleSuggestions = card.querySelector(`[id^="title-suggestions-mobile-"]`);
        if (codeSuggestions) codeSuggestions.id = `code-suggestions-mobile-${index}`;
        if (titleSuggestions) titleSuggestions.id = `title-suggestions-mobile-${index}`;
        
        // Update delete button
        const deleteBtn = card.querySelector('.remove-course-btn');
        if (deleteBtn) deleteBtn.setAttribute('onclick', `removeCourse(${index})`);
    });
    
    // Reorder mobile card numbers
    reorderMobileCards();
}

function reorderMobileCards() {
    const mobileCards = document.querySelectorAll('.course-entry-card');
    mobileCards.forEach((card, index) => {
        const numberDiv = card.querySelector('.course-entry-number');
        if (numberDiv) {
            numberDiv.textContent = index + 1;
        }
    });
}

// ==========================
// COURSE SEARCH FUNCTIONS - DESKTOP
// ==========================

function getRowIndex(inputElement) {
    const row = inputElement.closest('tr');
    const courseId = row.getAttribute('data-course-id');
    return parseInt(courseId) || 0;
}

function searchCourseByCode(inputElement) {
    const searchTerm = inputElement.value.toLowerCase().trim();
    const courseId = inputElement.closest('tr').getAttribute('data-course-id');
    const suggestionsId = `code-suggestions-${courseId}`;
    const suggestionsDiv = document.getElementById(suggestionsId);
    
    if (!suggestionsDiv) return;
    
    if (searchTerm.length < 2) {
        suggestionsDiv.style.display = 'none';
        currentSuggestions = null;
        currentInput = null;
        lastSearchType = null;
        return;
    }
    
    // Filter courses based on course code search AND department
    let filteredCourses = courseDatabase;
    
    // If a department is selected, filter by department
    if (selectedDepartment) {
        filteredCourses = filteredCourses.filter(course => 
            course.dept === selectedDepartment
        );
    }
    
    // Then filter by course code
    filteredCourses = filteredCourses.filter(course => 
        course.code.toLowerCase().includes(searchTerm)
    ).slice(0, 15);
    
    displaySuggestions(suggestionsDiv, filteredCourses, inputElement, 'code');
    lastSearchType = 'code';
}

function searchCourseByTitle(inputElement) {
    const searchTerm = inputElement.value.toLowerCase().trim();
    const courseId = inputElement.closest('tr').getAttribute('data-course-id');
    const suggestionsId = `title-suggestions-${courseId}`;
    const suggestionsDiv = document.getElementById(suggestionsId);
    
    if (!suggestionsDiv) return;
    
    if (searchTerm.length < 2) {
        suggestionsDiv.style.display = 'none';
        currentSuggestions = null;
        currentInput = null;
        lastSearchType = null;
        return;
    }
    
    // Filter courses based on course title search AND department
    let filteredCourses = courseDatabase;
    
    // If a department is selected, filter by department
    if (selectedDepartment) {
        filteredCourses = filteredCourses.filter(course => 
            course.dept === selectedDepartment
        );
    }
    
    // Then filter by course title
    filteredCourses = filteredCourses.filter(course => 
        course.title.toLowerCase().includes(searchTerm)
    ).slice(0, 15);
    
    displaySuggestions(suggestionsDiv, filteredCourses, inputElement, 'title');
    lastSearchType = 'title';
}

// ==========================
// COURSE SEARCH FUNCTIONS - MOBILE
// ==========================

function searchCourseByCodeMobile(inputElement) {
    const searchTerm = inputElement.value.toLowerCase().trim();
    const card = inputElement.closest('.course-entry-card');
    const courseId = card.getAttribute('data-course-id');
    const suggestionsId = `code-suggestions-mobile-${courseId}`;
    const suggestionsDiv = document.getElementById(suggestionsId);
    
    if (!suggestionsDiv) return;
    
    if (searchTerm.length < 2) {
        suggestionsDiv.style.display = 'none';
        currentSuggestions = null;
        currentInput = null;
        lastSearchType = null;
        return;
    }
    
    // Filter courses based on course code search AND department
    let filteredCourses = courseDatabase;
    
    // If a department is selected, filter by department
    if (selectedDepartment) {
        filteredCourses = filteredCourses.filter(course => 
            course.dept === selectedDepartment
        );
    }
    
    // Then filter by course code
    filteredCourses = filteredCourses.filter(course => 
        course.code.toLowerCase().includes(searchTerm)
    ).slice(0, 15);
    
    displaySuggestionsMobile(suggestionsDiv, filteredCourses, inputElement, 'code');
    lastSearchType = 'code';
}

function searchCourseByTitleMobile(inputElement) {
    const searchTerm = inputElement.value.toLowerCase().trim();
    const card = inputElement.closest('.course-entry-card');
    const courseId = card.getAttribute('data-course-id');
    const suggestionsId = `title-suggestions-mobile-${courseId}`;
    const suggestionsDiv = document.getElementById(suggestionsId);
    
    if (!suggestionsDiv) return;
    
    if (searchTerm.length < 2) {
        suggestionsDiv.style.display = 'none';
        currentSuggestions = null;
        currentInput = null;
        lastSearchType = null;
        return;
    }
    
    // Filter courses based on course title search AND department
    let filteredCourses = courseDatabase;
    
    // If a department is selected, filter by department
    if (selectedDepartment) {
        filteredCourses = filteredCourses.filter(course => 
            course.dept === selectedDepartment
        );
    }
    
    // Then filter by course title
    filteredCourses = filteredCourses.filter(course => 
        course.title.toLowerCase().includes(searchTerm)
    ).slice(0, 15);
    
    displaySuggestionsMobile(suggestionsDiv, filteredCourses, inputElement, 'title');
    lastSearchType = 'title';
}

// ==========================
// DISPLAY SUGGESTIONS FUNCTIONS
// ==========================

function displaySuggestions(suggestionsDiv, filteredCourses, inputElement, searchType) {
    suggestionsDiv.innerHTML = '';
    
    if (filteredCourses.length === 0) {
        const noResults = document.createElement('div');
        noResults.className = 'autocomplete-suggestion';
        noResults.innerHTML = `<div class="text-muted">No courses found. You can enter manually.</div>`;
        suggestionsDiv.appendChild(noResults);
        suggestionsDiv.style.display = 'block';
    } else {
        filteredCourses.forEach(course => {
            const suggestion = document.createElement('div');
            suggestion.className = 'autocomplete-suggestion';
            
            // Highlight based on search type
            let codeHtml, titleHtml;
            if (searchType === 'code') {
                const searchTerm = inputElement.value.toLowerCase().trim();
                codeHtml = highlightMatch(course.code, searchTerm);
                titleHtml = course.title;
            } else {
                const searchTerm = inputElement.value.toLowerCase().trim();
                codeHtml = course.code;
                titleHtml = highlightMatch(course.title, searchTerm);
            }
            
            // Add department badge if not filtering by department
            let deptBadge = '';
            if (!selectedDepartment) {
                deptBadge = `<span class="badge bg-secondary ms-2" style="font-size: 0.7em;">${course.dept.toUpperCase()}</span>`;
            }
            
            suggestion.innerHTML = `
                <div class="course-info">
                    <div style="flex: 1;">
                        <div class="course-code">${codeHtml} ${deptBadge}</div>
                        <div class="course-title">${titleHtml}</div>
                    </div>
                    <div class="course-credit-badge">${course.credit}</div>
                </div>
            `;
            suggestion.onclick = () => {
                selectCourse(inputElement, course, searchType, 'desktop');
                suggestionsDiv.style.display = 'none';
            };
            suggestion.onmouseenter = () => {
                suggestion.classList.add('autocomplete-selected');
            };
            suggestion.onmouseleave = () => {
                suggestion.classList.remove('autocomplete-selected');
            };
            suggestionsDiv.appendChild(suggestion);
        });
        
        // Add search hint with department info
        const hint = document.createElement('div');
        hint.className = 'autocomplete-suggestion search-hint';
        let hintText = `${filteredCourses.length} course(s) found.`;
        if (selectedDepartment) {
            const deptName = departmentDatabase.find(d => d.code === selectedDepartment)?.title || selectedDepartment;
            hintText += ` (Filtered for ${deptName})`;
        }
        hint.innerHTML = `<div>${hintText} Click to select.</div>`;
        hint.style.pointerEvents = 'none';
        hint.style.backgroundColor = 'var(--card-bg)';
        suggestionsDiv.appendChild(hint);
        
        suggestionsDiv.style.display = 'block';
        currentSuggestions = suggestionsDiv;
        currentInput = inputElement;
        
        // Auto-select first suggestion
        setTimeout(() => {
            const firstSuggestion = suggestionsDiv.querySelector('.autocomplete-suggestion:first-child');
            if (firstSuggestion && !firstSuggestion.classList.contains('search-hint')) {
                firstSuggestion.classList.add('autocomplete-selected');
            }
        }, 10);
    }
}

function displaySuggestionsMobile(suggestionsDiv, filteredCourses, inputElement, searchType) {
    suggestionsDiv.innerHTML = '';
    
    if (filteredCourses.length === 0) {
        const noResults = document.createElement('div');
        noResults.className = 'autocomplete-suggestion';
        noResults.innerHTML = `<div class="text-muted">No courses found. You can enter manually.</div>`;
        suggestionsDiv.appendChild(noResults);
        suggestionsDiv.style.display = 'block';
    } else {
        filteredCourses.forEach(course => {
            const suggestion = document.createElement('div');
            suggestion.className = 'autocomplete-suggestion';
            
            // Highlight based on search type
            let codeHtml, titleHtml;
            if (searchType === 'code') {
                const searchTerm = inputElement.value.toLowerCase().trim();
                codeHtml = highlightMatch(course.code, searchTerm);
                titleHtml = course.title;
            } else {
                const searchTerm = inputElement.value.toLowerCase().trim();
                codeHtml = course.code;
                titleHtml = highlightMatch(course.title, searchTerm);
            }
            
            // Add department badge if not filtering by department
            let deptBadge = '';
            if (!selectedDepartment) {
                deptBadge = `<span class="badge bg-secondary ms-2" style="font-size: 0.7em;">${course.dept.toUpperCase()}</span>`;
            }
            
            suggestion.innerHTML = `
                <div class="course-info">
                    <div style="flex: 1;">
                        <div class="course-code">${codeHtml} ${deptBadge}</div>
                        <div class="course-title">${titleHtml}</div>
                    </div>
                    <div class="course-credit-badge">${course.credit}</div>
                </div>
            `;
            suggestion.onclick = () => {
                selectCourse(inputElement, course, searchType, 'mobile');
                suggestionsDiv.style.display = 'none';
            };
            suggestion.onmouseenter = () => {
                suggestion.classList.add('autocomplete-selected');
            };
            suggestion.onmouseleave = () => {
                suggestion.classList.remove('autocomplete-selected');
            };
            suggestionsDiv.appendChild(suggestion);
        });
        
        // Add search hint with department info
        const hint = document.createElement('div');
        hint.className = 'autocomplete-suggestion search-hint';
        let hintText = `${filteredCourses.length} course(s) found.`;
        if (selectedDepartment) {
            const deptName = departmentDatabase.find(d => d.code === selectedDepartment)?.title || selectedDepartment;
            hintText += ` (Filtered for ${deptName})`;
        }
        hint.innerHTML = `<div>${hintText} Click to select.</div>`;
        hint.style.pointerEvents = 'none';
        hint.style.backgroundColor = 'var(--card-bg)';
        suggestionsDiv.appendChild(hint);
        
        suggestionsDiv.style.display = 'block';
        currentSuggestions = suggestionsDiv;
        currentInput = inputElement;
        
        // Auto-select first suggestion
        setTimeout(() => {
            const firstSuggestion = suggestionsDiv.querySelector('.autocomplete-suggestion:first-child');
            if (firstSuggestion && !firstSuggestion.classList.contains('search-hint')) {
                firstSuggestion.classList.add('autocomplete-selected');
            }
        }, 10);
    }
}

function highlightMatch(text, searchTerm) {
    if (!searchTerm) return text;
    
    const regex = new RegExp(`(${searchTerm})`, 'gi');
    return text.replace(regex, '<mark>$1</mark>');
}

function selectCourse(inputElement, course, searchType, viewType) {
    if (viewType === 'desktop') {
        const row = inputElement.closest('tr');
        const courseId = row.getAttribute('data-course-id');
        
        if (searchType === 'code') {
            inputElement.value = course.code;
            const titleInput = row.querySelector('.course-title-input');
            const creditInput = row.querySelector('.course-credit-input');
            titleInput.value = course.title;
            creditInput.value = course.credit;
        } else if (searchType === 'title') {
            inputElement.value = course.title;
            const codeInput = row.querySelector('.course-no-input');
            const creditInput = row.querySelector('.course-credit-input');
            codeInput.value = course.code;
            creditInput.value = course.credit;
        }
        
        // Sync to mobile
        const mobileCard = document.querySelector(`.course-entry-card[data-course-id="${courseId}"]`);
        if (mobileCard) {
            const mobileCodeInput = mobileCard.querySelector('.course-no-input-mobile');
            const mobileTitleInput = mobileCard.querySelector('.course-title-input-mobile');
            const mobileCreditInput = mobileCard.querySelector('.course-credit-input-mobile');
            
            if (mobileCodeInput) mobileCodeInput.value = course.code;
            if (mobileTitleInput) mobileTitleInput.value = course.title;
            if (mobileCreditInput) mobileCreditInput.value = course.credit;
        }
    } else {
        // Mobile view
        const card = inputElement.closest('.course-entry-card');
        const courseId = card.getAttribute('data-course-id');
        
        if (searchType === 'code') {
            inputElement.value = course.code;
            const titleInput = card.querySelector('.course-title-input-mobile');
            const creditInput = card.querySelector('.course-credit-input-mobile');
            if (titleInput) titleInput.value = course.title;
            if (creditInput) creditInput.value = course.credit;
        } else if (searchType === 'title') {
            inputElement.value = course.title;
            const codeInput = card.querySelector('.course-no-input-mobile');
            const creditInput = card.querySelector('.course-credit-input-mobile');
            if (codeInput) codeInput.value = course.code;
            if (creditInput) creditInput.value = course.credit;
        }
        
        // Sync to desktop
        const desktopRow = document.querySelector(`tr[data-course-id="${courseId}"]`);
        if (desktopRow) {
            const desktopCodeInput = desktopRow.querySelector('.course-no-input');
            const desktopTitleInput = desktopRow.querySelector('.course-title-input');
            const desktopCreditInput = desktopRow.querySelector('.course-credit-input');
            
            if (desktopCodeInput) desktopCodeInput.value = course.code;
            if (desktopTitleInput) desktopTitleInput.value = course.title;
            if (desktopCreditInput) desktopCreditInput.value = course.credit;
        }
    }
    
    calculateTotalCredit();
    
    // Clear suggestion boxes
    if (viewType === 'desktop') {
        const courseId = inputElement.closest('tr').getAttribute('data-course-id');
        const codeSuggestions = document.getElementById(`code-suggestions-${courseId}`);
        const titleSuggestions = document.getElementById(`title-suggestions-${courseId}`);
        if (codeSuggestions) codeSuggestions.style.display = 'none';
        if (titleSuggestions) titleSuggestions.style.display = 'none';
    } else {
        const courseId = inputElement.closest('.course-entry-card').getAttribute('data-course-id');
        const codeSuggestions = document.getElementById(`code-suggestions-mobile-${courseId}`);
        const titleSuggestions = document.getElementById(`title-suggestions-mobile-${courseId}`);
        if (codeSuggestions) codeSuggestions.style.display = 'none';
        if (titleSuggestions) titleSuggestions.style.display = 'none';
    }
}

function showCodeSuggestions(inputElement) {
    const searchTerm = inputElement.value.toLowerCase().trim();
    if (searchTerm.length >= 2) {
        searchCourseByCode(inputElement);
    }
}

function showTitleSuggestions(inputElement) {
    const searchTerm = inputElement.value.toLowerCase().trim();
    if (searchTerm.length >= 2) {
        searchCourseByTitle(inputElement);
    }
}

function showCodeSuggestionsMobile(inputElement) {
    const searchTerm = inputElement.value.toLowerCase().trim();
    if (searchTerm.length >= 2) {
        searchCourseByCodeMobile(inputElement);
    }
}

function showTitleSuggestionsMobile(inputElement) {
    const searchTerm = inputElement.value.toLowerCase().trim();
    if (searchTerm.length >= 2) {
        searchCourseByTitleMobile(inputElement);
    }
}

// ==========================
// FORM SUBMISSION AND PREVIEW
// ==========================

function calculateTotalCredit() {
    let total = 0;
    
    // Only count credits from ONE source - desktop inputs
    let creditInputs = document.querySelectorAll('.course-credit-input');
    creditInputs.forEach(input => {
        let value = parseFloat(input.value);
        if (!isNaN(value)) {
            total += value;
        }
    });
    
    document.getElementById('totalCredit').textContent = total.toFixed(2);
    return total;
}

function prepareFormData() {
    // Sync all inputs before form submission
    if (window.innerWidth <= 768) {
        // If on mobile, sync mobile to desktop
        syncMobileToDesktop();
    } else {
        // If on desktop, sync desktop to mobile
        syncDesktopToMobile();
    }
}

function previewPDF() {
    prepareFormData();
    
    let formData = new FormData(document.getElementById('regForm'));
    
    // Show loading indicator
    let iframe = document.getElementById('pdfFrame');
    iframe.src = 'about:blank';
    iframe.style.opacity = '0.5';

    fetch('preview_pdf.php', {
        method: 'POST',
        body: formData
    })
    .then(res => {
        if (!res.ok) throw new Error('Network response was not ok');
        return res.blob();
    })
    .then(blob => {
        // Check if mobile device
        const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        
        if (isMobile) {
            // For mobile: Open PDF directly
            const url = URL.createObjectURL(blob);
            window.open(url, '_blank');
        } else {
            // For desktop: Show in iframe as before
            iframe.src = URL.createObjectURL(blob);
            iframe.style.opacity = '1';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error generating preview. Please check your inputs.');
        iframe.style.opacity = '1';
    });
}

// Override form submission to ensure data is synced
document.getElementById('regForm').addEventListener('submit', function(e) {
    prepareFormData();
});
// Hide suggestion boxes when input loses focus
document.querySelectorAll('.course-search-input input').forEach(input => {
    input.addEventListener('blur', function(e) {
        // Small delay to allow click events to register first
        setTimeout(() => {
            const suggestions = this.parentElement.querySelector('.autocomplete-suggestions');
            if (suggestions) {
                suggestions.style.display = 'none';
                suggestions.innerHTML = '';
            }
        }, 200);
    });
});

// ==========================
// EVENT LISTENERS
// ==========================

// Close suggestions when clicking outside
// ==========================
// FIX FOR HIDING SUGGESTION BOXES
// ==========================
// Method 1: Hide when clicking anywhere on page (except the input or suggestions)
document.addEventListener('click', function(e) {
    // Don't hide if user clicks on input field or suggestion box
    if (e.target.closest('.course-search-input') || e.target.closest('.autocomplete-suggestions')) {
        return;
    }
    
    // Hide ALL suggestion boxes
    document.querySelectorAll('.autocomplete-suggestions').forEach(box => {
        box.style.display = 'none';
        box.innerHTML = '';
    });
    
    currentSuggestions = null;
    currentInput = null;
    lastSearchType = null;
});

// Method 2: Hide when user tabs away from input field
// This works for ALL inputs (old and new)
document.addEventListener('focusout', function(e) {
    // Check if the element losing focus is one of our search inputs
    if (e.target.matches('.course-no-input, .course-title-input, .course-no-input-mobile, .course-title-input-mobile')) {
        setTimeout(() => {
            // Find the suggestion box for this input and hide it
            const searchInput = e.target.closest('.course-search-input');
            if (searchInput) {
                const suggestions = searchInput.querySelector('.autocomplete-suggestions');
                if (suggestions) {
                    suggestions.style.display = 'none';
                    suggestions.innerHTML = '';
                }
            }
        }, 150);
    }
}, true);
// Also add click handler to inputs to prevent immediate closing
document.querySelectorAll('.course-search-input input').forEach(input => {
    input.addEventListener('click', function(e) {
        e.stopPropagation();
    });
});

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    if (!currentSuggestions || currentSuggestions.style.display !== 'block') return;
    
    const suggestions = currentSuggestions.querySelectorAll('.autocomplete-suggestion:not(.search-hint)');
    if (suggestions.length === 0) return;
    
    let selectedIndex = -1;
    suggestions.forEach((suggestion, index) => {
        if (suggestion.classList.contains('autocomplete-selected')) {
            selectedIndex = index;
        }
    });
    
    if (e.key === 'ArrowDown') {
        e.preventDefault();
        suggestions.forEach(s => s.classList.remove('autocomplete-selected'));
        const nextIndex = (selectedIndex + 1) % suggestions.length;
        suggestions[nextIndex].classList.add('autocomplete-selected');
        suggestions[nextIndex].scrollIntoView({ block: 'nearest' });
    } else if (e.key === 'ArrowUp') {
        e.preventDefault();
        suggestions.forEach(s => s.classList.remove('autocomplete-selected'));
        const prevIndex = selectedIndex <= 0 ? suggestions.length - 1 : selectedIndex - 1;
        suggestions[prevIndex].classList.add('autocomplete-selected');
        suggestions[prevIndex].scrollIntoView({ block: 'nearest' });
    } else if (e.key === 'Enter') {
        e.preventDefault();
        if (selectedIndex >= 0) {
            suggestions[selectedIndex].click();
        } else if (suggestions.length > 0) {
            suggestions[0].click();
        }
    } else if (e.key === 'Escape') {
        currentSuggestions.style.display = 'none';
        currentSuggestions = null;
        currentInput = null;
        lastSearchType = null;
    }
});

// Initialize
calculateTotalCredit();

function updateCreditFromMobile(inputElement) {
    // Update the corresponding desktop credit input
    const card = inputElement.closest('.course-entry-card');
    const courseId = card.getAttribute('data-course-id');
    const desktopRow = document.querySelector(`tr[data-course-id="${courseId}"]`);
    
    if (desktopRow) {
        const desktopCreditInput = desktopRow.querySelector('.course-credit-input');
        if (desktopCreditInput) {
            desktopCreditInput.value = inputElement.value;
        }
    }
    
    // Calculate total credit
    calculateTotalCredit();
}
</script>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
