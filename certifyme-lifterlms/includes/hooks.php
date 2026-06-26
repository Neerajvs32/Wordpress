<?php
add_action( 'lifterlms_course_completed', 'certifyme_on_course_complete', 10, 2 );

function certifyme_on_course_complete( $student_id, $course_id ) {
    certifyme_log_info( 'Course completion triggered', [
        'student_id' => $student_id,
        'course_id'  => $course_id,
    ]);

    $student = get_userdata( $student_id );
    if ( ! $student ) {
        certifyme_log_error( 'Could not retrieve user data', [ 'student_id' => $student_id ] );
        return;
    }

    $course_name = get_the_title( $course_id );
    $api_token   = get_option('certifyme_api_token');
    $template_id = get_option('certifyme_template_id');

    if ( empty($api_token) || empty($template_id) ) {
        certifyme_log_warning( 'API token or template ID missing in settings' );
        return;
    }

    certifyme_log_info( 'Issuing credential', [
        'student'     => $student->user_email,
        'course'      => $course_name,
        'template_id' => $template_id,
        'server'      => get_option('certifyme_server', 'apac'),
    ]);

    $success = certifyme_issue_credential([
        'name'              => $student->display_name,
        'email'             => $student->user_email,
        'template_ID'       => $template_id,
        'text'              => '',
        'verify_mode'       => 'None',
        'Custom.CourseName' => $course_name,
        'Custom.eventdate'  => wp_date('d M Y'),
    ]);

    if ( $success ) {
        certifyme_log_info( 'Credential issued successfully', [
            'student' => $student->user_email,
            'course'  => $course_name,
        ]);
    }
}