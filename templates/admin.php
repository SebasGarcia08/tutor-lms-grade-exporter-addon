<div class="wrap">
    <?php settings_errors() ?>
</div>

<h1>Exportador de notas</h1>

<div class="box">
    <label for="cars">Escoge un curso:</label>
    <select name="course_names" id="course_names" onchange=hello(this)>
        <option value="Ninguno" default>Ninguno</option>
    </select>

    <label for="cars">Escoge un quiz:</label>
    <select name="quizzes_names" id="quizzes_names">
        <option value="Ninguno" default>Ninguno</option>
    </select>

</div>
<?php
    global $wpdb;

    $user_id = get_current_user_id();

    $get_assigned_courses_ids = $wpdb->get_col("SELECT meta_value from {$wpdb->usermeta} WHERE meta_key = '_tutor_instructor_course_id' AND user_id = {$user_id}");

    $custom_author_query = "AND {$wpdb->posts}.post_author = {$user_id}";
    if (is_array($get_assigned_courses_ids) && count($get_assigned_courses_ids)){
        $in_query_pre = implode(',', $get_assigned_courses_ids);
        // $custom_author_query = " ( {$wpdb->posts}.post_author = {$user_id} AND {$wpdb->posts}.ID IN({$in_query_pre}) ) ";
    }

    //  First, get the courses names
    $courses_query = "SELECT post_title, ID FROM {$wpdb->posts} WHERE {$wpdb->posts}.ID IN({$in_query_pre})";
    $course_list = $wpdb->get_results($courses_query);    
    $quizzes_list = $wpdb -> get_results(
        "SELECT DISTINCT p.post_title 
        FROM {$wpdb->prefix}tutor_quiz_attempts AS qa 
        INNER JOIN {$wpdb->posts} AS p 
        ON qa.quiz_id = p.ID 
        WHERE qa.course_id = $course_id"
    );
?> 

<script>
    var courses =  <?php echo json_encode($course_list); ?>;
    
    var coursesPublishedByUser = document.getElementById("course_names");
    // Display the array elements 
    for(let i = 0; i < courses.length; i++){ 
        console.log(courses[i]);
        const courseName = courses[i]["post_title"];
        option = document.createElement("option");
        option.setAttribute("value", courses[i]["ID"]);
        option.innerHTML = courseName;
        coursesPublishedByUser.appendChild(option);
    } 
</script>