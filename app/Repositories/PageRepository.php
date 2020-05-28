<?php

namespace App\Repositories;

use App\Models\Post;
use App\User;
use App\Contracts\PageInterface;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PageRepository implements PageInterface
{

    protected $_article;
    protected $_user;

    public function __construct()
    {
        $this->_article = new Post();
        $this->_user = new User();
    }
    /**
     * Get list article
     * @param $limit
     * @author huynhtuvinh87@gmail.com
     */
    public function list($request)
    {
        try {

            $query = $this->_article->select(
                'posts.id',
                'posts.title',
                'posts.slug',
                'posts.description',
                'posts.content',
                'posts.image',
                'posts.images',
                'posts.meta_keyword',
                'posts.meta_description',
                'posts.status',
                'users.username'
            )->leftjoin('users', function ($q) {
                $q->on('posts.user_id', 'users.id');
            })->where('posts.type', config('global.post_type.page'))->where('posts.status', '!=', config('global.status.trash'));
            if ($request->search) {
                $query = $query->where('title', 'LIKE', '%' . $request->search . '%');
                $query = $query->orWhere('slug', 'LIKE', '%' . $request->search . '%');
                $query = $query->orWhere('meta_keyword', '%' . $request->search . '%');
                $query = $query->orWhere('meta_description', '%' . $request->search . '%');
            }
            return $query->orderBy('posts.id', 'desc')->paginate($request->limit);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get list trash
     * @param $limit
     * @author huynhtuvinh87@gmail.com
     */
    public function listTrash($request)
    {
        try {
            $query = $this->_article->select(
                'posts.id',
                'posts.title',
                'posts.slug',
                'posts.content',
                'posts.description',
                'posts.image',
                'posts.images',
                'posts.meta_keyword',
                'posts.meta_description',
                'posts.status',
                'users.username'
            )->leftjoin('users', function ($q) {
                $q->on('posts.user_id', 'users.id');
            })->where('posts.type', config('global.post_type.page'))->where('posts.status', config('global.status.trash'));
            if ($request->search) {
                $query = $query->where('title', 'LIKE', '%' . $request->search . '%');
                $query = $query->orWhere('slug', 'LIKE', '%' . $request->search . '%');
                $query = $query->orWhere('meta_keyword', '%' . $request->search . '%');
                $query = $query->orWhere('meta_description', '%' . $request->search . '%');
            }
            return $query->orderBy('posts.id', 'desc')->paginate($request->limit);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get find article
     * @param $id
     *
     * @author huynhtuvinh87@gmail.com
     */
    public function find($id)
    {
        try {
            $query = $this->_article->select(
                'posts.id',
                'posts.title',
                'posts.slug',
                'posts.content',
                'posts.image',
                'posts.images',
                'posts.meta_keyword',
                'posts.meta_description',
                'posts.status',
                'users.username'
            )->leftjoin('users', function ($q) {
                $q->on('posts.user_id', 'users.id');
            })->where('posts.id', $id)->first();
            return $query;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Create article
     * @param $id
     * @param string title
     * @param string content
     * @param string image
     * @param string images
     * @param string status
     *
     * @author huynhtuvinh87@gmail.com
     */
    public function create($request)
    {
        try {
            $result = $this->_article->create([
                'user_id' => Auth::user()->id,
                'type' => config('global.post_type.page'),
                'title' => $request->title,
                'slug' => Str::slug($request->title, '-'),
                'description' => $request->description,
                'content' => $request->content,
                'image' => $request->image ? $request->image : null,
                'meta_keyword' => $request->meta_keyword,
                'meta_description' => $request->meta_description,
                'status' => $request->status
            ]);
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Update article
     * @param $id
     * @param string title
     * @param string content
     * @param string image
     * @param string images
     * @param string status
     *
     * @author huynhtuvinh87@gmail.com
     */
    public function update($id, $request)
    {
        try {
            $data = [
                'title' => $request->title,
                'slug' => Str::slug($request->title, '-'),
                'description' => $request->description,
                'content' => $request->content,
                'meta_keyword' => $request->meta_keyword,
                'meta_description' => $request->meta_description,
                'status' => $request->status
            ];
            if ($request->image) {
                $data = array_merge($data, ['image' => $request->image]);
            }
            $result = $this->_article->where('id', $id)->update($data);

            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Delete employees
     * @param string id
     *
     * @author huynhtuvinh87@gmail.com
     */
    public function delete($id)
    {
        try {
            $result = $this->_article->where('id', $id)->delete();
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }
    /**
     * Trash article
     * @param string id
     *
     * @author huynhtuvinh87@gmail.com
     */
    public function trash($id)
    {
        try {
            $result = $this->_article->where('id', $id)->update([
                'status' => config('global.status.trash')
            ]);
            $this->_postCategory->where('post_id', $id)->delete();
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Rolback
     * @param string id
     *
     * @author huynhtuvinh87@gmail.com
     */
    public function rolback($id)
    {
        try {
            $result = $this->_article->where('id', $id)->update([
                'status' => config('global.status.active')
            ]);
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get list article
     * @param $limit
     * @author huynhtuvinh87@gmail.com
     */
    public function toArray()
    {
        try {

            $query = $this->_article->select(
                'posts.id',
                'posts.title',
                'posts.slug'
            )->where('posts.type', config('global.post_type.page'))->where('posts.status', '!=', config('global.status.trash'));
            return $query->get()->toArray();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
