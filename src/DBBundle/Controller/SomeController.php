<?php
/**
 * Created by PhpStorm.
 * User: Виталий
 * Date: 30.03.2016
 * Time: 18:07
 */

namespace DBBundle\Controller;


class SomeController
{

    /**
     * @Route("/students", name = "students_home")
     */
    public function studentAction(){

    }

    /**
     * @Route("/students/article/{articleId}", name="student_article")
     */
    public function ArticleAction($articleId)
    {
        // ... 
    }
}