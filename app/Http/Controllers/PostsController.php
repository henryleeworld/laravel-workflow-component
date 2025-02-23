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
        echo __('Whether the current post can be published: ') . ($workflow->can($post, 'publish') ? __('Yes') : __('No')) . __('.') . PHP_EOL;
        echo __('Whether the current post can be reviewed: ') . ($workflow->can($post, 'to_review') ? __('Yes') : __('No')) . __('.') . PHP_EOL;
        $transitions = $workflow->getEnabledTransitions($post);
        echo __('Current post status enables transitions: ') . PHP_EOL;
        var_dump($transitions);
        // Apply a transition
        $workflow->apply($post, 'to_review');
        $post->save(); // Don't forget to persist the state
        echo __('Whether the current post can be published: ') . ($workflow->can($post, 'publish') ? __('Yes') : __('No')) . __('.') . PHP_EOL;
        echo __('Whether the current post can be reviewed: ') . ($workflow->can($post, 'to_review') ? __('Yes') : __('No')) . __('.') . PHP_EOL;
        echo __('The current post can be converted: ') . PHP_EOL;
        foreach ($post->workflow_transitions() as $key => $transition) {
            echo ($key + 1) . '：' . $transition->getName() . PHP_EOL;
        }
        $workflow->apply($post, 'publish');
        $post->save();
    }
}
