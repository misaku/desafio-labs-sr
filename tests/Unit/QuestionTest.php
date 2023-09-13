<?php

namespace Tests\Unit;

use App\Models\Question;
use App\Http\Controllers\QuestionsController;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class QuestionTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_model_questions_list(): void
    {
        $model = new Question();
        $list = $model->index();
        $size = count($list);
        $this->assertTrue($size==9);
    }
    public function test_that_controller_questions_list(): void
    {
        $controller = new QuestionsController();
        $list = json_decode($controller->index(),true);
        $size = count($list);
        $this->assertTrue($size==9);
    }

}
