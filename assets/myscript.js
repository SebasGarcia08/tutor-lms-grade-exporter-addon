jQuery(document).ready(() => {
    console.log('making ajax');

    jQuery.ajax({
        method: 'get',
        dataType : "json",
        url: ipAjaxVar.ajaxurl,
        data: {
            action: 'get_courses',
        },
        success: (courses) => {
            console.log(courses);
            for (var i = 0; i < courses.length; i++) {
                jQuery('#course_names').append('<option value="' + courses[i].ID + '">' + courses[i].post_title + '</option>');
            }       
        },
        error: function(xhr) {
            jQuery('#quizzes_names').empty();
            console.log(xhr);
        }
    });

    jQuery(document).on('change', '#course_names', (e) => {
        var course_id = jQuery('#course_names').val();
        console.log(course_id);
        
        jQuery.ajax({
            method: 'post',
            dataType : "json",
            url: ipAjaxVar.ajaxurl,
            data: {
                course_id: course_id,
                action: 'get_quizzes_by_course'
            },
            success: function(quizz_list) {
                jQuery('#quizzes_names').empty();
                for (var i = 0; i < quizz_list.length; i++) {
                    jQuery('#quizzes_names').append('<option value="' + quizz_list[i].quiz_id + '">' + quizz_list[i].post_title + '</option>');
                }           
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
        e.preventDefault();
    });
});
