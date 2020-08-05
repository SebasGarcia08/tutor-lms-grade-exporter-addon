window.addEventListener('load', () => {
    console.log("Helou");
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        console.log("Conexión hecha ");
        var courses = JSON.parse(this.responseText);
        //here I do all the treatments I need on my dataset

    };

    xmlhttp.open("GET", "../Queries/courses.php", true);
    xmlhttp.send();

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
});