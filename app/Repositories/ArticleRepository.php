<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Category;
use App\User;
use App\Models\WidgetItem;
use App\Contracts\ArticleInterface;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ArticleRepository implements ArticleInterface
{

    protected $_article;
    protected $_user;
    protected $_postCategory;
    protected $_widgetItem;


    public function __construct()
    {
        $this->_article = new Post();
        $this->_user = new User();
        $this->_postCategory = new PostCategory();
        $this->_category = new Category();
        $this->_widgetItem = new WidgetItem();
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
                'posts.code',
                'posts.title',
                'posts.slug',
                'posts.description',
                'posts.content',
                'posts.image',
                'posts.images',
                'posts.price',
                'posts.price_sale',
                'posts.meta_keyword',
                'posts.meta_description',
                'posts.status',
                'users.username',
                'makers.name as maker_name',
                'makers.id as maker_id',
                'makers.slug as maker_slug'
            )->leftjoin('users', function ($q) {
                $q->on('posts.user_id', 'users.id');
            })->leftjoin('makers', function ($q) {
                $q->on('posts.maker_id', 'makers.id');
            })
                ->where('posts.type', config('global.post_type.article'))->where('posts.status', '!=', config('global.status.trash'));
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
     * Get list article
     * @param $limit
     * @author huynhtuvinh87@gmail.com
     */
    public function search($request)
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
                'posts.price',
                'posts.price_sale',
                'posts.meta_keyword',
                'posts.meta_description',
                'posts.status',
                'users.username',
                'makers.name as maker_name',
                'makers.id as maker_id',
                'makers.slug as maker_slug'
            )->leftjoin('users', function ($q) {
                $q->on('posts.user_id', 'users.id');
            })->leftjoin('makers', function ($q) {
                $q->on('posts.maker_id', 'makers.id');
            })->where('posts.type', config('global.post_type.article'))->where('posts.status', '!=', config('global.status.trash'));

            if ($request->category) {
                $query->rightjoin('post_categories', function ($q) {
                    $q->on('posts.id', 'post_categories.post_id');
                })->where('post_categories.category_id', $request->category);
            }
            if ($request->keywords) {
                $query->where(function ($q) use ($request) {
                    $q->where('posts.title', 'LIKE', '%' . $request->keywords . '%')
                        ->orWhere('posts.slug', 'LIKE', '%' . $request->keywords . '%')
                        ->orWhere('posts.meta_keyword', 'LIKE', '%' . $request->keywords . '%')
                        ->orWhere('posts.meta_description', 'LIKE', '%' . $request->keywords . '%');
                });
            }
            if ($request->from_price) {
                $query = $query->where('posts.price', '>', $request->from_price);
            }
            if ($request->to_price) {
                $query = $query->where('posts.price', '<', $request->to_price);
            }
            if ($request->maker) {
                $query = $query->where('posts.maker_id', $request->maker);
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
                'posts.price',
                'posts.price_sale',
                'posts.meta_keyword',
                'posts.meta_description',
                'posts.status',
                'users.username',
                'makers.name as maker_name',
                'makers.id as maker_id',
                'makers.slug as maker_slug'
            )->leftjoin('users', function ($q) {
                $q->on('posts.user_id', 'users.id');
            })->leftjoin('makers', function ($q) {
                $q->on('posts.maker_id', 'makers.id');
            })->where('posts.type', config('global.post_type.article'))->where('posts.status', config('global.status.trash'));
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
                'posts.maker_id',
                'posts.title',
                'posts.slug',
                'posts.description',
                'posts.content',
                'posts.image',
                'posts.images',
                'posts.price',
                'posts.price_sale',
                'posts.meta_keyword',
                'posts.meta_description',
                'posts.status',
                'users.username',
                'categories.id as category_id',
                'categories.title as category_name',
                'categories.slug as category_slug',
                'makers.name as maker_name',
                'makers.id as maker_id',
                'makers.slug as maker_slug'
            )->leftjoin('users', function ($q) {
                $q->on('posts.user_id', 'users.id');
            })->leftjoin('makers', function ($q) {
                $q->on('posts.maker_id', 'makers.id');
            })
                ->leftjoin('post_categories', function ($q) {
                    $q->on('posts.id', 'post_categories.post_id');
                })
                ->leftjoin('categories', function ($q) {
                    $q->on('categories.id', 'post_categories.category_id');
                })
                ->where('posts.id', $id)->first();
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
                'code' => str_random(6),
                'maker_id' => $request->maker_id,
                'type' => config('global.post_type.article'),
                'title' => $request->title,
                'slug' => Str::slug($request->title, '-'),
                'description' => $request->description,
                'content' => $request->content,
                'price' => $request->price,
                'price_sale' => $request->price_sale,
                'image' => $request->images[0] ? \Constant::resize($request->images[0]) : null,
                'images' => $request->images ? implode(',', $request->images) : null,
                'meta_keyword' => $request->meta_keyword,
                'meta_description' => $request->meta_description,
                'status' => $request->status
            ]);
            if ($request->category_id) {
                foreach ($request->category_id as $id) {
                    $this->_postCategory->create([
                        'category_id' => $id,
                        'post_id' => $result->id,
                    ]);
                }
            }
            \Storage::disk('local')->put('img_product_{$result->id}.json', json_encode($request->images));
            $this->storage();
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
                'maker_id' => $request->maker_id,
                'title' => $request->title,
                'slug' => Str::slug($request->title, '-'),
                'description' => $request->description,
                'content' => $request->content,
                'meta_keyword' => $request->meta_keyword,
                'meta_description' => $request->meta_description,
                'price' => $request->price,
                'price_sale' => $request->price_sale,
                'status' => $request->status
            ];
            if ($request->images[0]) {
                $data = array_merge($data, ['image' => $request->images[0]]);
            }
            if ($request->images && count($request->images) > 0) {
                $data = array_merge($data, ['images' => $this->images($request->images)]);
            }
            $result = $this->_article->where('id', $id)->update($data);
            if ($request->category_id) {
                $this->_postCategory->where('post_id', $id)->delete();
                foreach ($request->category_id as $cid) {
                    $this->_postCategory->create([
                        'category_id' => $cid,
                        'post_id' => $id,
                    ]);
                }
            }
            $this->storage();
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
     * Post category
     * @param int post_id
     *
     * @author huynhtuvinh87@gmail.com
     */
    public function postCategory($post_id)
    {
        try {
            return $this->_postCategory->select('category_id')->where('post_id', $post_id)->get()->toArray();
        } catch (Exception $e) {
            throw $e;
        }
    }



    /**
     * Get list article
     * @param $limit
     * @author huynhtuvinh87@gmail.com
     */
    public function listPostInCategory($array, $limit)
    {
        try {
            $post_id = array_pluck($this->_postCategory->select('post_id')->whereIn('category_id', $array)->get()->toArray(), 'post_id');
            $query = $this->_article->select(
                'posts.id',
                'posts.title',
                'posts.slug',
                'posts.description',
                'posts.content',
                'posts.image',
                'posts.images',
                'posts.price',
                'posts.price_sale',
                'posts.meta_keyword',
                'posts.meta_description',
                'posts.status',
                'users.username',
                'makers.name as maker_name',
                'makers.id as maker_id',
                'makers.slug as maker_slug'
            )->leftjoin('users', function ($q) {
                $q->on('posts.user_id', 'users.id');
            })->leftjoin('makers', function ($q) {
                $q->on('posts.maker_id', 'makers.id');
            })->where('posts.type', config('global.post_type.article'))->where('posts.status', '!=', config('global.status.trash'));

            $query = $query->whereIn('posts.id', $post_id);


            return $query->orderBy('posts.created_at', 'desc')->paginate($limit);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get find category by slug
     * @param $id
     * @author huynhtuvinh87@gmail.com
     */
    public function getByCategory($slug)
    {
        try {
            $query = $this->_article->select('posts.*')
                ->rightjoin('post_categories', function ($q) {
                    $q->on('posts.id', 'post_categories.post_id');
                })
                ->rightjoin('categories', function ($q) {
                    $q->on('post_categories.category_id', 'categories.id');
                })
                ->where('categories.slug', $slug)
                ->paginate(20);
            return $query;
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function storage()
    {
        try {
            $categories = $this->_category->select('id', 'slug', 'title')->where('status', '!=', config('global.status.trash'))->get();
            $data = [];
            foreach ($categories as $value) {

                $data[$value->id] = ['id' => $value->id, 'title' => $value->title, 'slug' => $value->slug, 'posts' => $value->post_limit];
            }
            \Storage::disk('local')->put('public/category.json', json_encode($data));

            $widget = $this->_widgetItem->select(
                'post_id as id',
                'widget_id',
                'widgets.prefix',
                'posts.type',
                'title',
                'slug',
                'image',
                'price',
                'price_sale',
                \DB::raw('(CASE WHEN posts.type = "widget" THEN posts.content ELSE "" END) AS content')
            )->leftjoin('posts', function ($q) {
                $q->on('posts.id', 'widget_items.post_id');
            })->leftjoin('widgets', function ($q) {
                $q->on('widgets.id', 'widget_items.widget_id');
            })->get()->toArray();
            $data = [];
            foreach ($widget as $key => $value) {
                $data[$value['prefix']][] = $value;
            }
            \Storage::disk('local')->put('public/widget.json', json_encode($data));
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
    public function findByCode($code)
    {
        try {
            $query = $this->_article->select(
                'posts.id',
                'posts.code',
                'posts.slug'
            )->where('posts.code', $code)->first();
            return $query;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function images($data)
    {
        $array = [];
        foreach ($data as $value) {
            $array[] = \Constant::resize($value);
        }
        return explode(',', $array);
    }
}
