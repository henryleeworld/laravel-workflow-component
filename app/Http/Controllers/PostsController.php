<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use ZeroDaHero\LaravelWorkflow\Facades\WorkflowFacade as Workflow;

class PostsController extends Controller
{
    public function index()
    {
        $post = Post::find(1);
        $workflow = Workflow::get($post);
        echo '目前的貼文是否可以發佈：' . ($workflow->can($post, 'publish') ? '是' : '否') . PHP_EOL;
        echo '目前的貼文是否可以審核：' . ($workflow->can($post, 'to_review') ? '是' : '否') . PHP_EOL;
        $transitions = $workflow->getEnabledTransitions($post);
        echo '目前的貼文狀態可啟用轉換：' . PHP_EOL;
        var_dump($transitions);
        // Apply a transition
        $workflow->apply($post, 'to_review');
        $post->save(); // Don't forget to persist the state
        echo '目前的貼文是否可以發佈：' . ($workflow->can($post, 'publish') ? '是' : '否') . PHP_EOL;
        echo '目前的貼文是否可以審核：' . ($workflow->can($post, 'to_review') ? '是' : '否') . PHP_EOL;
        echo '目前的貼文可啟用轉換：' . PHP_EOL;
        foreach ($post->workflow_transitions() as $key => $transition) {
            echo ($key + 1) . '：' . $transition->getName() . PHP_EOL;
        }
        $workflow->apply($post, 'publish');
        $post->save();
    }
}
