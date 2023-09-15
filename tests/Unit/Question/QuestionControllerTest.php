<?php

namespace Tests\Unit\Question;

use App\Http\Controllers\QuestionsController;
use PHPUnit\Framework\TestCase;

class QuestionControllerTest extends TestCase
{
    public function test_that_controller_questions_list(): void
    {
        $controller = new QuestionsController();
        $list = json_decode($controller->index(), true);
        $size = count($list);
        $this->assertTrue($size == 9);
    }
}
