<?php
    $mongoClient = new MongoClient("mongodb://" . "localhost");
    $db = $mongoClient->course;

        
    $cDemo = $db->course->find(
        array('$or' => array(
            array('course_name' => new MongoRegex("/.*{$_POST['keywords']}.*/i")),
            array('teacher' => new MongoRegex("/.*{$_POST['keywords']}.*/i")), 
            array("_id" => 0)
        )));
    $jokesArray = iterator_to_array($cDemo);

    echo json_encode($jokesArray);
