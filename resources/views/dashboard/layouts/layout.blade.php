<!DOCTYPE html>
<html style="min-height: 100vh;" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!-- Bootstrap Datepicker CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css"
        rel="stylesheet">

    <!-- Bootstrap Datepicker JS -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"></script>
    <!-- Local Sytles -->
    <link rel="stylesheet" href="{{ asset('assets/styles/base.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/styles/dashboard.css') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Noto+Sans+Lao:wght@100..900&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
</head>
<style>

/* ===========================
   Sidebar Design (Abdu Dashboard)
   =========================== */

aside {
    background: #ffffff;
    border-right: 1px solid #e6e9f0;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 1rem;
    box-shadow: 2px 0 8px rgba(0, 0, 0, 0.04);
}

/* قائمة الروابط */
aside .nav-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

aside .nav-item {
    margin-bottom: 6px;
}

/* الروابط */
aside .nav-link {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #2d3748;
    text-decoration: none;
    font-weight: 500;
    font-size: 14px;
    padding: 10px 12px;
    border-radius: 8px;
    transition: all 0.3s ease;
}

/* الحالة النشطة */
aside .nav-link:hover,
aside .nav-link.active {
    background-color: #e9f2fb;
    color: #347fc2;
}

/* الأيقونات */
aside .nav-link svg {
    fill: #347fc2;
    min-width: 16px;
    height: 16px;
}

aside .box-icon {
    display: flex;
    align-items: center;
    justify-content: center;
}

/* زر تسجيل الخروج */
aside .nav-link.logout {
    color: #e53e3e;
}

aside .nav-link.logout:hover {
    background-color: #ffe5e5;
}

/* ======= Responsiveness ======= */
@media (max-width: 991px) {
    aside {
        position: fixed;
        left: -250px;
        top: 0;
        width: 250px;
        z-index: 1050;
        transition: all 0.4s ease;
    }

    aside.active {
        left: 0;
    }
}




    .cke_notifications_area{
        display: none;
}
.cke_notifications_area *{
    display: none;
}
    .sq-btn{
        display: flex !important;
  align-items: center !important;
  padding: 0px !important;
  justify-content: center !important;
    }
    /* Nav */
/* nav {
    position: fixed;
    top: 0;
    height: 10vh;
} */

/* main content */
.main-content {
    height: 90vh;
    /* overflow: hidden; */
    margin: 0;
    padding: 0;

}

.text-1 {
    font-family: 'Noto Sans Lao';
    font-weight: 400;
    font-style: normal;
    font-size: 32px;
    line-height: 100%;
    letter-spacing: 0%;
    color: #000000;
}

.text-2 {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 400;
    font-size: 14px;
    line-height: 20px;
    color: #6D6D6D;
}

.text-3 {
    font-family: 'Open Sans';
    font-weight: 600;
    font-size: 10.51px;
    line-height: 18.02px;
    letter-spacing: -2%;
}

.text-4 {
    font-family: 'Open Sans';
    font-style: normal;
    font-weight: 400;
    font-size: 12px;
    line-height: 16px;
    color: #003049;
}

.text-dark {
    color: #003049 !important;
}

.header-page-1 {
    font-family: 'Open Sans';
    font-style: normal;
    font-weight: 700;
    font-size: 32px;
    line-height: 40px;
    letter-spacing: -0.8px;
    color: #003049;
}

.header-1 {
    font-family: 'Roboto';
    font-style: normal;
    font-weight: 600;
    font-size: 22px;
    line-height: 26px;
}

.box-1 {
    box-sizing: border-box;
    border: 1px solid #F0F0F2;
    background-color: #FAFAFA;
    border-radius: 12px;

}

.dashboard-content .box {
    padding: 1rem;
    height: 300px;
    border-radius: 12px;
    box-shadow: 4px 4px 20px 0px #0000001A;
    border: 1px solid #F0F0F2;
    background-color: #FAFAFA;

}

.dashboard-content .box .overflow {
    overflow: auto;
}

.dashboard-content .box .header {
    color: #011632;
    /* font-family: 'Poppins'; */
    font-weight: 700;
    font-size: 18px;
    line-height: 100%;
    letter-spacing: 0%;

}

.gradient-box {
    background: linear-gradient(270deg, #71DDB1 -9.55%, #3882C3 50%);
    border-radius: 10px;
}

.gradient-link {
    color: #71DDB1;
    font-weight: 700;
    text-decoration: none;
}

.notification-box {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background-color: white;
    border-radius: 5px;
    padding: 0.5rem;
}

.notification-box .noti-text {
    /* font-family: Inter; */
    font-weight: 300;
    font-style: normal;
    font-size: 1em;
    line-height: 100%;
    letter-spacing: 0%;

}

.header-page {
    font-family: 'Ubuntu';
    font-style: normal;
    font-weight: 500;
    font-size: 21px;
    line-height: 120%;
    color: #060B1E;

}

.reset-filter-btn {
    color: #EA0234;
}

.filter-box {
    background-color: #fff;
    border: 1px solid #D4D4D4;
    color: #A4ADB6;
}


.dashboard-table thead tr {
    background: #b4bbc5;
}

.dashboard-table thead tr th {
    /* font-family: 'Ubuntu'; */
    font-weight: 400;
    font-style: normal;
    font-size: 12px;
    line-height: 160%;
    letter-spacing: 0%;
    text-transform: uppercase;
    color: #86929E
}

.dashboard-table tbody tr td {
    font-size: 14px;
    font-weight: 400;
    line-height: 160%;
    letter-spacing: 0;
    color: #464748;
}

.pagination-box .pagination-text {
    /* font-family: 'Nunito Sans'; */
    font-style: normal;
    font-weight: 600;
    font-size: 14px;
    line-height: 19px;
    color: #202224;
    opacity: 0.6;
}

.file-name {
    /* font-family: 'Hind'; */
    font-style: normal;
    font-weight: 500;
    font-size: 14px;
    line-height: 20px;
    color: #353535;

}

.file-size {
    /* font-family: 'Poppins'; */
    font-style: normal;
    font-weight: 400;
    font-size: 12px;
    line-height: 20px;
    color: #989692;
}

a.file-link {
    /* font-family: 'Hind'; */
    font-style: normal;
    font-weight: 600;
    font-size: 14px;
    line-height: 20px;
    color: var(--bs-primary);
    text-decoration: none;
}

.docs-container {
    height: 250px;
    overflow: auto;
}

.heading-2 {

    font-family: 'Inter';
    font-weight: 600;
    font-size: 14px;
    line-height: 17px;
    color: #000000;

}

.heading-3 {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 500;
    font-size: 15px;
    line-height: 18px;
    color: #1A1A1B
}

.heading-4 {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 15px;
    color: #1A1A1B;
}


.help-text {
    /* font-family: 'Inter'; */
    font-style: normal;
    font-weight: 400;
    font-size: 14px;
    line-height: 14px;
    color: #AFB8CF;
}

.shareDocModal .modal-title {
    /* font-family: Inter; */
    font-weight: 700;
    font-size: 18px;
    line-height: 28px;
    letter-spacing: 0px;
}

.shareDocModal .modal-title-helptxt {
    /* font-family: Inter; */
    font-weight: 400;
    font-size: 13px;
    line-height: 20px;
    letter-spacing: 0px;

}

.shareDocModal .file-name {
    /* font-family: Inter; */
    font-weight: 700;
    font-size: 16px;
    line-height: 24px;
    letter-spacing: 0px;
    color: #40454A;

}

.shareDocModal input {
    box-sizing: border-box;
    width: 472px;
    height: 48px;

    /* Neutral 25 */
    background: #FCFCFD;
    /* Primary 300 */
    border: 1px solid #96A7FF;
    /* Focus Ring/Blue */
    box-shadow: 0px 0px 0px 3px #D0D8FF;
    border-radius: 10px;
}

.shareDocModal .btn-done {
    border-radius: 8px;
    background: #FFFFFF;
    border: 1px solid #4A68FF;
    color: #4A68FF;

}

.shareDocModal .btn-cancel {
    border-radius: 8px;
    background: #FFFFFF;
    border: 1px solid #E0E3E6;
    color: 1px solid #E0E3E6;
}

.chat {
    max-height: 90vh !important;
}

.chat .people {
    height: 850px;
    overflow-y: auto;
}

.chat input {
    padding: 8px 16px;
    height: 40px;
    background: #F8F9FD;
    border: 1px solid #F8F9FD;
    border-radius: 8px;
}


.chat .people .username {
    /* font-family: 'Inter'; */
    font-weight: 500;
    font-size: 15px;
    line-height: 18px;
    color: #000000;
}

.chat .people .text-msg {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 400;
    font-size: 12px;
    line-height: 15px;
    color: #636363;
}

.timing {
    /* font-family: 'Inter'; */
    font-style: normal;
    font-weight: 400;
    font-size: 11px;
    line-height: 13px;
    color: #9FA7BE;
}

.chat .user-name {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 600;
    font-size: 16px;
    line-height: 17px;
    color: #636363;
}

.msg-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
    padding: 10px;
    height: 80%;
    overflow-y: auto;
}

.msg-box {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.msg-container .msg {
    padding: 16px 24px;
    border-radius: 32px 32px 32px 0px;
    width: fit-content;
    background: #DCE6FF;
    color: #1A1A1B;
}

.msg-container .msg.from-other {
    padding: 16px 24px;
    border-radius: 32px 32px 0px 32px;
    width: fit-content;
    background: #3D64FD;
    color: #F8F9FD;
}

#input-msg {
    padding: 8px 8px 8px 16px;
    width: 411px;
    height: 40px;
    background: #F8F9FD;
    border-radius: 24px;

}

fieldset {
    display: flex;
    flex-direction: column;
}

.tf-label {
    font-family: 'Roboto';
    font-style: normal;
    font-weight: 600;
    font-size: 14px;
    line-height: 22px;
    color: rgba(0, 0, 0, 0.9);
}

.accordion-shadow {
    box-shadow: 0px 4px 10px 0px #675DFF14;

}

#feedback-history {
    max-height: 670px;
    overflow-y: scroll;
    overflow-x: clip;
}

#feedback-history .username {
    /* font-family: 'Poppins'; */
    font-style: normal;
    font-weight: 500;
    font-size: 14px;
    line-height: 18px;
    text-align: center;
    color: #0D0C22;

}

#feedback-history .user-role {
    /* font-family: 'Poppins'; */
    font-style: normal;
    font-weight: 500;
    font-size: 14px;
    line-height: 18px;
    color: #858585;

}

#feedback-history .feedback-txt {
    /* font-family: 'Poppins'; */
    font-style: normal;
    font-weight: 400;
    font-size: 14px;
    line-height: 18px;
    color: #0D0C22;
}

#feedback button {
    color: #AAB2C8;
}

#feedback button.active {
    color: #000;
    border-bottom: 2px solid #3882C3;
}

.invoice .inv-head {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 600;
    font-size: 14px;
    line-height: 140%;
    letter-spacing: 0.005em;
    color: #333843;
}

.invoice .text {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 400;
    font-size: 12px;
    line-height: 132%;
    letter-spacing: 0.005em;
    color: #667085;
}

.invoice .text-1 {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 600;
    font-size: 12px;
    line-height: 132%;
    letter-spacing: 0.005em;
    color: #667085;
}

.invoice .amount {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 700;
    font-size: 20px;
    line-height: 24px;
    text-align: right;
    letter-spacing: 0.005em;
    color: #333843;
}

.invoice .note {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 500;
    font-size: 12px;
    line-height: 132%;
    letter-spacing: 0.005em;
    color: #333843;
}

.download-txt {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 600;
    font-size: 16px;
    line-height: 140%;
    text-align: center;
    letter-spacing: 0.005em;
    color: #333843;

}

.nav-profile .nav-link.active {
    background-color: var(--bs-purple);
}

/* Add bottom border to active tab */
.nav-tabs .nav-link.active {
    border-bottom: 3px solid #0d6efd !important;
    border: 0;
}

/* Optional: Remove default bottom border from inactive tabs */
.nav-tabs .nav-link {
    border-bottom: 1px solid transparent !important;
    border: 0;
}

/* SideBar */
aside {
    min-height: 90vh;
    background-color: #fff;
}

aside ul {
    list-style: none;
}

aside .nav-links {
    height: fit-content !important;
}

aside .nav-links li {
    padding: .5rem .25rem;
    border-radius: 0.5rem;
}

aside .nav-links li a {
    font-family: 'Roboto';
    color: #A0AEC0;
    text-decoration: none;
    font-weight: 700;
    font-size: 12px;
    line-height: 150%;
    letter-spacing: 0%;
}

aside .nav-links li a svg {
    fill: var(--bs-primary);
}

aside .nav-links li a .box-icon {
    background-color: #fff;
    border-radius: 8px;
    padding: 0.5rem;
}

aside .nav-links li a.active {
    color: #2d3748;
}

aside .nav-links li a.active svg {
    fill: #fff;
}

aside .nav-links li a.active .box-icon {
    background-color: var(--bs-primary);
    border-radius: 8px;
    padding: 0.5rem;
}

aside .nav-links li:hover {
    background-color: #f5f5f5;
}



/* Modal */
.tf-dialog {
    border-radius: 20px;
    background: rgba(255, 255, 255, 0.59);
    backdrop-filter: blur(50.4486px);
    -webkit-backdrop-filter: blur(50.4486px);
}

.tf-dialog .dialog-head {
    font-weight: 400;
    font-size: 27.15px;
    line-height: 50.15px;
    letter-spacing: 0%;
}

.tf-dialog .txt-sm {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 400;
    font-size: 18.44px;
    line-height: 24px;
    color: #8A8A8A;
}

.tf-dialog fieldset {
    display: flex;
    flex-direction: column;
    margin: 1rem 0;
}

.tf-dialog fieldset label {
    font-weight: 500;
    font-size: 20px;
    line-height: 185%;
    letter-spacing: 0%;
    color: #404D61;
}

.tf-dialog fieldset input,
select {
    box-sizing: border-box;
    width: 229px;
    height: 36px;
    background: #FFFFFF;
    border: 1.09px solid #E1E3E6;
    color: #757D8A;
    border-radius: 7px;
    padding-left: 12px;
}

.tf-dialog .box-upload .upload-btn {
    box-sizing: border-box;
    padding: .5em;
    background: #FFFFFF;
    border: 1px solid #1849D6;
    border-radius: 8px;
    color: #1849D6;
    font-weight: 600;
}

.tf-dialog .current-step {
    background-color: var(--bs-primary);
    color: #fff;
    text-align: center;
    width: 25px;
    height: 25px;
    border-radius: 50%;
}

.tf-dialog .next-step {
    background-color: #fff;
    color: rgb(151, 151, 151);
    text-align: center;
    width: 25px;
    height: 25px;
    border-radius: 50%;
}

.tf-dialog .progress {
    width: 20%;
    height: 5px;
}

.tf-dialog .progress-bar {
    background-color: var(--bs-primary);
}

.tf-dialog .modal-header {
    justify-content: center;
}


.transaction-table thead tr th {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    line-height: 19px;
    color: #718EBF;
    border-bottom: 1px solid #E6EFF5;
}

.transaction-table tbody tr td {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 19px;
    color: #232323;
    vertical-align: middle;
}

/* faqAccordion */
#faqAccordion .accordion-body {
    background-color: var(--bs-primary);
    color: #fff;
}

#faqAccordion .accordion-button:not(.collapsed)::after {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff' viewBox='0 0 16 16'%3E%3Cpath d='M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zM8 16A8 8 0 1 1 8 0a8 8 0 0 1 0 16z'/%3E%3Cpath d='M5 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5A.5.5 0 0 1 5 8z'/%3E%3C/svg%3E");
}

#faqAccordion .accordion-button:is(.collapsed)::after {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23000' viewBox='0 0 16 16'%3E%3Cpath d='M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z'/%3E%3Cpath d='M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z'/%3E%3C/svg%3E");
}

#faqAccordion .accordion-item {
    border: 0 !important;
    border-radius: 10px !important;
    margin: 1rem 0;
    overflow: hidden;
}

#faqAccordion .accordion-button:not(.collapsed) {
    background-color: var(--bs-primary);
    color: #fff;
}
:root {
    --bs-primary: #347FC2FA;
    --bs-secondary: #b9cada;
    /* --bs-success: #28a745; */
    --bs-success: #31A91D;
    --bs-success-light: #4EEA7A;
    --bs-danger: #dc3545;
    --bs-info: #17a2b8;
    --bs-warning: #ffc107;
    --bs-darkblue: #011632;
    --bs-purple: #6194FA;
}

html {
    scrollbar-width: thin;
    /* "auto", "thin", or "none" */
    scrollbar-color: #888 #f1f1f1;
    /* thumb color, track color */
}

body {
    scrollbar-width: thin;
    scrollbar-color: #888 #f1f1f1;
    width: 100vw;
    height: 100vh;
    overflow-x: hidden;
}

/* Entire scrollbar */
::-webkit-scrollbar {
    width: 10px;
    height: 10px;
}

/* Track (background) */
::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

/* Handle (thumb) */
::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 10px;
}

/* On hover */
::-webkit-scrollbar-thumb:hover {
    background: #555;
}


body {
    min-height: 100vh;
    background-color: #F5F9FA;
}


.btn-primary {
    background-color: var(--bs-primary) !important;
    border-color: var(--bs-primary) !important;
}

.btn-outline-primary {
  color: var(--bs-primary);
  border-color: var(--bs-primary);
}
.btn-outline-primary:hover {
  color: #fff;
  background-color: var(--bs-primary);
  border-color: var(--bs-primary);
}

.btn-purple {
    background-color: var(--bs-purple) !important;
    border-color: var(--bs-purple) !important;
}

.bg-purple{
    background-color: var(--bs-purple) !important;
}
.border-purple{
    border: 1px solid var(--bs-purple) !important;
}

.text-primary {
    color: var(--bs-primary) !important;
}
.text-success{
    color: var(--bs-success) !important;
}
.text-success-light{
    color: var(--bs-success-light) !important;
}

.text-head {
    font-family: 'Open Sans';
    font-style: normal;
    font-weight: 400;
    font-size: 36px;
    line-height: 49px;
    color: #003049 !important;

}

.bg-primary {
    background-color: var(--bs-primary) !important;
}

.bg-gray{
    background-color: #F5EFE5 !important;
}

.btn-gray {
    border: 1px solid #1B1C3140;
    color: #6F767ECC;
    /* font-family: 'Poppins'; */
    font-weight: 500;
    font-size: 12px;
    line-height: 100%;
    letter-spacing: 0%;
    padding: 1em;
}

.info-badge {
    /* font-family: 'Poppins'; */
    padding: 6px;
    border-radius: 6px;
    font-size: 10px;
    font-weight: 600;
    background-color: #377DFF33;
    color: #377DFF;
}

.success-badge {
    /* font-family: 'Poppins'; */
    padding: 6px;
    border-radius: 6px;
    font-size: 10px;
    font-weight: 600;
    background-color: #38CB8933;
    color: #38CB89;
}

.tf-date {
    /* font-family: Inter; */
    font-weight: 400;
    font-style: normal;
    font-size: 10px;
    line-height: 100%;
    letter-spacing: 0%;
    color: #8F8F8F;
}


.bg-green-1 {
    background-color: #38CB894D;
}

.bg-orange-1 {
    background-color: #FFA60066;
}

.box-icon-primary {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: var(--bs-primary);
    border-radius: 0.2rem;
    padding: 0.25rem;
}

.box-icon-purple {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: var(--bs-purple);
    border-radius: 0.2rem;
    padding: 0.25rem;
}

/* Drag Drop file upload */
.box-upload {
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 24px;
    gap: 12px;
    background: #FFFFFF;
    border: 1px dashed #1849D6;
    border-radius: 8px;
    min-height: 186px;
}

.box-upload .drag-text {
    /* font-family: 'Inter'; */
    font-style: normal;
    font-weight: 400;
    font-size: 14px;
    /* line-height: 10px; */
    color: #0B0B0B;
    flex: none;
    order: 0;
    flex-grow: 0;
}

.box-upload .upload-btn {
    box-sizing: border-box;
    padding: 6px 12px;
    background: #FFFFFF;
    border: 1px solid #1849D6;
    border-radius: 8px;
    color: #1849D6;
    font-weight: 600;
}

.grid-4{
    display: grid;
    grid-template-columns: repeat(4,1fr);
    gap: 1.5rem;
}
.grid-3{
    display: grid;
        grid-template-columns: repeat(3,1fr);
    gap: 1.5rem;
}

.bg-circle-pattern {
background-image: url("data:image/svg+xml,%3Csvg width='176' height='170' viewBox='0 0 176 170' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cg opacity='0.2'%3E%3Ccircle cx='178.25' cy='169.25' r='177.25' stroke='white'/%3E%3Ccircle cx='178.25' cy='169.25' r='153.219' stroke='white'/%3E%3Ccircle cx='178.25' cy='169.25' r='125.872' stroke='white'/%3E%3Ccircle cx='178.25' cy='169.25' r='98.5262' stroke='white'/%3E%3Ccircle cx='178.25' cy='169.25' r='72.0087' stroke='white'/%3E%3Ccircle cx='178.25' cy='169.25' r='47.9773' stroke='white'/%3E%3Ccircle cx='178.25' cy='169.25' r='28.75' stroke='white'/%3E%3C/g%3E%3C/svg%3E");  background-repeat: no-repeat;
  background-size: contain;
  background-position: bottom right;
}

</style>

<body>

    

            @yield('content')

  <!-- scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

      <script>
    // Wait for 3 seconds (3000 ms) then remove the alert messages
    setTimeout(function() {
      // Remove success message if exists
      const successAlert = document.getElementById('successMessage');
      if(successAlert) {
        successAlert.style.display = 'none';
      }
      const errors = document.getElementById('errors');
      if(errors) {
        errors.style.display = 'none';
      }
      // Remove error message if exists
      const errorAlert = document.getElementById('errorMessage');
      if(errorAlert) {
        errorAlert.style.display = 'none';
      }
    }, 3000);
  </script>

  @stack('script')
</body>
</html>
