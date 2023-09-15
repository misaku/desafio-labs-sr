<?php

namespace Tests\Unit\Question;

use App\Models\Question;
use PHPUnit\Framework\TestCase;

class QuestionModelTest extends TestCase
{
    public function test_that_model_questions_list(): void
    {
        $model = new Question();
        $list = $model->index();
        $size = count($list);
        $this->assertTrue($size == 9);
    }
}
