<?php
/**
 * LaraClassified - Classified Ads Web Application
 * Copyright (c) BedigitCom. All Rights Reserved
 *
 * Website: http://www.bedigit.com
 *
 * LICENSE
 * -------
 * This software is furnished under a license and may be used and copied
 * only in accordance with the terms of such license and with the inclusion
 * of the above copyright notice. If you Purchased from Codecanyon,
 * Please read the full License from here - http://codecanyon.net/licenses/standard
 */

namespace App\Http\Controllers\Search;

use App\Helpers\ArrayHelper;
use App\Helpers\DBTool;
use App\Helpers\UrlGen;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Search\Traits\TitleTrait;
use App\Models\Post;
use App\Models\SubAdmin1;
use App\Models\PostType;
use App\Models\Category;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Helpers\Localization\Helpers\Country as CountryLocalizationHelper;
use App\Helpers\Localization\Country as CountryLocalization;

class BaseController extends FrontController
{
    use TitleTrait;

    public $request;
	public $countries;

	public $searchClass;

	/**
     * All Types of Search
     * Variables declaration required
     */
	public $isIndexSearch = false;
    public $isCatSearch = false;
    public $isSubCatSearch = false;
    public $isCitySearch = false;
    public $isAdminSearch = false;
    public $isUserSearch = false;
    public $isTagSearch = false;

	private $cats;

    public $cat = null;
    public $subCat = null;
    /**
     * @var Collection
     */
    public $categoryTree = null;
    protected $catChildren = null;
    protected $baseCatURL = null;
    protected $baseURL = null;

	/**
	 * SearchController constructor.
	 *
     * SearchController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct();

        $this->searchClass = config('larapen.core.searchClass');

        // From Laravel 5.3.4 or above
        $this->middleware(function ($request, $next) {
            $this->commonQueries();
            return $next($request);
        });

        $this->request = $request;
    }

    /**
     * Common Queries
     */
    public function commonQueries()
    {
        $countries = CountryLocalizationHelper::transAll(CountryLocalization::getCountries());
        $this->countries = $countries;
        view()->share('countries', $countries);


        // Get all Categories
        $cacheId = 'categories.all.' . config('app.locale');
        $cats = Cache::remember($cacheId, $this->cacheExpiration, function () {
            $cats = Category::trans()->orderBy('lft')->get();
            return $cats;
        });
        if ($cats->count() > 0) {
            $cats = collect($cats)->keyBy('tid');
        }
        view()->share('cats', $cats);
        $this->cats = $cats;

        // LEFT MENU VARS
        if (config('settings.listing.left_sidebar')) {
            // Count Categories Posts
            $sql = 'SELECT sc.id, c.parent_id, count(*) as total' . '
				FROM ' . DBTool::table('posts') . ' as a
				INNER JOIN ' . DBTool::table('categories') . ' as sc ON sc.id=a.category_id AND sc.active=1
				INNER JOIN ' . DBTool::table('categories') . ' as c ON c.id=sc.parent_id AND c.active=1
				WHERE a.country_code = :countryCode AND (a.verified_email=1 AND a.verified_phone=1) AND (a.reviewed IN(1,2)) AND  a.archived!=1 AND a.deleted_at IS NULL
				GROUP BY sc.id';
            $bindings = [
                'countryCode' => config('country.code')
            ];
            $countSubCatPosts = DB::select(DB::raw($sql), $bindings);
            $countSubCatPosts = collect($countSubCatPosts)->keyBy('id');
            // var_dump($countSubCatPosts);
            view()->share('countSubCatPosts', $countSubCatPosts);

            // Count Parent Categories Posts
            $sql1 = 'SELECT c.id as id, count(*) as total' . '
                FROM ' . DBTool::table('posts') . ' as a
                INNER JOIN ' . DBTool::table('categories') . ' as c ON c.id=a.category_id AND c.active=1
                WHERE a.country_code = :countryCode AND (a.verified_email=1 AND a.verified_phone=1) AND (a.reviewed IN(1,2)) AND a.archived!=1 AND a.deleted_at IS NULL
                GROUP BY c.id';
            $sql2 = 'SELECT c.id as id, count(*) as total' . '
                FROM ' . DBTool::table('posts') . ' as a
                INNER JOIN ' . DBTool::table('categories') . ' as sc ON sc.id=a.category_id AND sc.active=1
                INNER JOIN ' . DBTool::table('categories') . ' as c ON c.id=sc.parent_id AND c.active=1
                WHERE a.country_code = :countryCode AND (a.verified_email=1 AND a.verified_phone=1) AND (a.reviewed IN(1,2)) AND a.archived!=1 AND a.deleted_at IS NULL
                GROUP BY c.id';
            $sql = 'SELECT cat.id, SUM(total) as total' . '
                FROM ((' . $sql1 . ') UNION ALL (' . $sql2 . ')) cat
                GROUP BY cat.id';
            $bindings = [
                'countryCode' => config('country.code')
            ];
            
            $countCatPosts = DB::select(DB::raw($sql), $bindings);
            $countCatPosts = collect($countCatPosts)->keyBy('id');
                        // var_dump($countCatPosts);
            view()->share('countCatPosts', $countCatPosts);

            // Get the 100 most populate Cities
            $limit = 100;
            $cacheId = config('country.code') . '.cities.take.' . $limit;
            $cities = Cache::remember($cacheId, $this->cacheExpiration, function () use ($limit) {
                $cities = City::currentCountry()->take($limit)->orderBy('population', 'DESC')->orderBy('name')->get();
                return $cities;
            });
            // var_dump($cities);
            view()->share('cities', $cities);

            //E.K.
//        $this->cacheExpiration
            $time = 180;
            $ads = [];
            foreach ($cities as $city){
                $ads[$city->name] = Cache::remember('ads' . $city->name, $time, function () use ($city){
                    return DB::select('SELECT
                                            count(title) AS ads
                                        FROM
                                            posts
                                        INNER JOIN cities ON posts.city_id = cities.id
                                        WHERE
                                            cities.`name` = "' . $city->name . '"
                                        AND posts.verified_phone = 1
                                        AND posts.archived != 1 
                                        AND posts.deleted_at IS NULL
                                        AND (posts.reviewed IN(1,2))');
                });
            }
            view()->share('ads', $ads);

            // Get Date Ranges
            $dates = ArrayHelper::toObject([
                '2'  => '24 ' . t('hours'),
                '4'  => '3 ' . t('days'),
                '8'  => '7 ' . t('days'),
                '31' => '30 ' . t('days'),
            ]);
            $this->dates = $dates;
            view()->share('dates', $dates);
        }
        // END - LEFT MENU VARS


        // Get Post Types
        $cacheId = 'postTypes.all.' . config('app.locale');
        $postTypes = Cache::remember($cacheId, $this->cacheExpiration, function () {
            $postTypes = PostType::trans()->orderBy('lft')->get();
            return $postTypes;
        });
        view()->share('postTypes', $postTypes);


        // Get the Country first Administrative Division
        $cacheId = config('country.code') . '.subAdmin1s.all';
        $modalAdmins = Cache::remember($cacheId, $this->cacheExpiration, function () {
            $modalAdmins = SubAdmin1::currentCountry()->orderBy('name')->get(['code', 'name'])->keyBy('code');
            return $modalAdmins;
        });
        view()->share('modalAdmins', $modalAdmins);

        // Get Distance Range
		$distanceRange = [];
		if (config('settings.listing.cities_extended_searches')) {
			for (
				$iDist = 0;
				$iDist <= config('settings.listing.search_distance_max', 500);
				$iDist += config('settings.listing.search_distance_interval', 50)
			) {
				$distanceRange[$iDist] = $iDist;
			}
		}
		view()->share('distanceRange', $distanceRange);
    }

    public function makeRootTree($root)
    {
        $result = [intval($root)];
        $children = Category::trans()->where('parent_id', $root)->orderBy('lft', 'asc')->get();
        foreach ($children as $child) {
//            $result = array_merge($result, $this->makeRootTree($child->id));
            $result = array_merge($result, $this->makeRootTree($child->tid));
        }
        return $result;
    }

    public function countPostsInCategoryWithChildren($root)
    {
        $chCatId = $root;
        $cacheId = 'childCats.' . $root;
        $childCats = Cache::remember($cacheId, new \DateInterval('PT1S'), function () use ($chCatId) {
            $childCats = $this->makeRootTree($chCatId);
            return $childCats;
        });

        $cacheId = 'postsOfchildCats.' . $chCatId;
        $posts = Cache::remember($cacheId, new \DateInterval('PT1M'), function () use ($childCats) {
            $posts = Post::whereIn('category_id', $childCats)->where('archived', 0)->get()->count();
            return $posts;
        });

        return $posts;
    }

    public function getSubsTree(?Collection $collection, $baseURL)
    {
        $result = [];
        if (isset($collection)) {
            $current = $collection->shift();
        } else {
            $current = $this->cat;
            $collection = collect([]);
        }
        if ($collection->count() > 0) {
            $result[] = [
                'name' => $current->name,
                'url' => lurl($baseURL . "/" . $current->slug),
                'bold' => true,
                'children' => $this->getSubsTree($collection, $baseURL . "/" . $current->slug),
                'count' => $this->countPostsInCategoryWithChildren($current->tid)
            ];
        } else {
            $children = Category::trans()->where('parent_id', $current->parent_id)->orderBy('lft', 'asc')->get();
            foreach ($children as $child) {
                $maybeChildren = [];
                if ($current->slug == $child->slug) {
                    $subchildren = Category::trans()->where('parent_id', $current->tid)->orderBy('lft', 'asc')->get();
                    foreach ($subchildren as $subchild) {
                        $maybeChildren[] = [
                            'name' => $subchild->name,
                            'url' => lurl($baseURL . "/" . $child->slug . "/" . $subchild->slug),
                            'bold' => false,
                            'count' => $this->countPostsInCategoryWithChildren($subchild->tid),
                            'children' => []
                        ];
                    }
                }
                $result[] = [
                    'name' => $child->name,
                    'url' => lurl($baseURL . "/" . $child->slug),
                    'bold' => $current->slug == $child->slug,
                    'count' => $this->countPostsInCategoryWithChildren($child->tid),
                    'children' => $maybeChildren
                ];
            }
        }
        return $result;
    }

    public function getSubsTreeSearch(?Collection $collection, $baseURL)
    {
        $result = [];
        if (isset($collection)) {
            $current = $collection->shift();
        } else {
            $current = $this->cat;
            $collection = collect([]);
        }
        $input = request()->all();

        if ($collection->count() > 0) {
            $tempInput = $input;
            $tempInput['c'] = $current->parent_id;
            $tempInput['sc'] = $current->id;

            $result[] = [
                'name' => $current->name,
                'url' => $baseURL . "?" . httpBuildQuery($tempInput),
                'bold' => true,
                'children' => $this->getSubsTreeSearch($collection, $baseURL),
                'count' => $this->countPostsInCategoryWithChildren($current->tid)
            ];
        } else {
            $children = Category::trans()->where('parent_id', $current->parent_id)->orderBy('lft', 'asc')->get();
            foreach ($children as $child) {
                $maybeChildren = [];
                if ($current->slug == $child->slug) {
                    $subchildren = Category::trans()->where('parent_id', $current->tid)->orderBy('lft', 'asc')->get();
                    foreach ($subchildren as $subchild) {
                        $tempInput = $input;
                        $tempInput['c'] = $subchild->parent_id;
                        $tempInput['sc'] = $subchild->id;

                        $maybeChildren[] = [
                            'name' => $subchild->name,
                            'url' => $baseURL . "?" . httpBuildQuery($tempInput),
                            'bold' => false,
                            'count' => $this->countPostsInCategoryWithChildren($subchild->tid),
                            'children' => []
                        ];
                    }
                }
                $tempInput = $input;
                $tempInput['c'] = $child->parent_id;
                $tempInput['sc'] = $child->id;

                $result[] = [
                    'name' => $child->name,
                    'url' => $baseURL . "?" . httpBuildQuery($tempInput),
                    'bold' => $current->slug == $child->slug,
                    'count' => $this->countPostsInCategoryWithChildren($child->tid),
                    'children' => $maybeChildren
                ];
            }
        }
        return $result;
    }

    /**
     * Трансформирует путь в коллекцию категорий
     * @param string $fullPath Полный путь категорий (Vehicles/cars/bmw)
     * @return Collection
     */
    public function makeCategoryTreeFromPath(string $fullPath): Collection
    {
        $slugs = explode('/', $fullPath);
        $tree = collect([]);
        foreach ($slugs as $s) {
            $cat = Category::where('slug', '=', $s)->firstOrFail();
            $tree->push($cat);
        }
        return $tree;
    }

    /**
     * Трансформирует путь в коллекцию категорий
     * @param string $fullPath Полный путь категорий (Vehicles/cars/bmw)
     * @return Collection
     */
    public function makeCategoryTreeFromId($id): Collection
    {
        $tree = collect([]);
//        $cat = Category::trans()->where('id', '=', $id)->firstOrFail();
        $cat = Category::where('id', '=', $id)->firstOrFail();
        $tree->push($cat);
        while ($cat->parent_id != 0) {
//            $cat = Category::trans()->where('id', '=', $cat->parent_id)->firstOrFail();
            $cat = Category::where('id', '=', $cat->parent_id)->firstOrFail();
            $tree->prepend($cat);
        }
        return $tree;
    }

}

