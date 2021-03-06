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

namespace App\Http\Controllers\Search\Traits;

use App\Helpers\DBTool;
use App\Helpers\UrlGen;
use Illuminate\Support\Arr;

trait TitleTrait
{
    /**
     * Get Search Title
     *
     * @return string
     */
    public function getTitle()
    {
        $title = '';

        // Init.
        $title .= t('Free ads');

        // Keyword
        if (request()->filled('q')) {
            $title .= ' ' . t('for') . ' ';
            $title .= '"' . rawurldecode(request()->get('q')) . '"';
        }

        // Category
        if (isset($this->isCatSearch) && $this->isCatSearch) {
            if (isset($this->cat) && !empty($this->cat)) {
                // SubCategory
                if (isset($this->isSubCatSearch) && $this->isSubCatSearch) {
                    if (isset($this->subCat) && !empty($this->subCat)) {
                        $title .= ' ' . $this->subCat->name . ',';
                    }
                }

                $title .= ' ' . $this->cat->name;
            }
        }

        // User
        if (isset($this->isUserSearch) && $this->isUserSearch) {
            if (isset($this->sUser) && !empty($this->sUser)) {
                $title .= ' ' . t('of') . ' ';
                $title .= $this->sUser->name;
            }
        }

        // Tag
        if (isset($this->isTagSearch) && $this->isTagSearch) {
            if (isset($this->tag) && !empty($this->tag)) {
                $title .= ' ' . t('for') . ' ';
                $title .= $this->tag . ' (' . t('Tag') . ')';
            }
        }

        // Location
        if ((isset($this->isCitySearch) && $this->isCitySearch) || (isset($this->isAdminSearch) && $this->isAdminSearch)) {
            if (request()->filled('r') && !request()->filled('l')) {
                // Administrative Division
                if (isset($this->admin) && !empty($this->admin)) {
                    $title .= ' ' . t('in') . ' ';
                    $title .= $this->admin->name;
                }
            } else {
                // City
                if (isset($this->city) && !empty($this->city)) {
                    $title .= ' ' . t('in') . ' ';
                    $title .= $this->city->name;
                }
            }
        }

        // Country
        $title .= ', ' . config('country.name');

        view()->share('title', $title);

        return $title;
    }

    /**
     * Get Search HTML Title
     *
     * @return string
     */
    public function getHtmlTitle()
    {
        $fullUrl = rawurldecode(url(request()->getRequestUri()));
        $tmpExplode = explode('?', $fullUrl);
        $fullUrlNoParams = current($tmpExplode);

        // Title
        $htmlTitle = '';

        // Init.
        $attr = ['countryCode' => config('country.icode')];
        $htmlTitle .= '<a href="' . lurl(trans('routes.v-search', $attr), $attr) . '" class="current">';
        $htmlTitle .= '<span>' . t('All ads') . '</span>';
        $htmlTitle .= '</a>';

        // Location
        if ((isset($this->isCitySearch) && $this->isCitySearch) || (isset($this->isAdminSearch) && $this->isAdminSearch)) {
            if (request()->filled('l') || request()->filled('r')) {
                $searchUrl = qsurl($fullUrlNoParams, request()->except(['l', 'r', 'location']), null, false);
            } else {
                $attr = ['countryCode' => config('country.icode')];
                $searchUrl = lurl(trans('routes.v-search', $attr), $attr);
                $searchUrl = qsurl($searchUrl, request()->except(['l', 'r', 'location']), null, false);
            }

            if (request()->filled('r') && !request()->filled('l')) {
                // Administrative Division
                if (isset($this->admin) && !empty($this->admin)) {
                    $htmlTitle .= ' ' . t('in') . ' ';
                    $htmlTitle .= '<a rel="nofollow" class="jobs-s-tag" href="' . $searchUrl . '">';
                    $htmlTitle .= $this->admin->name;
                    $htmlTitle .= '</a>';
                }
            } else {
                // City
                if (isset($this->city) && !empty($this->city)) {
                    if (DBTool::checkIfMySQLDistanceCalculationFunctionExists(config('settings.listing.distance_calculation_formula'))) {
                        $htmlTitle .= ' ' . t('within') . ' ';
                        $htmlTitle .= '<a rel="nofollow" class="jobs-s-tag" href="' . $searchUrl . '">';
                        $htmlTitle .= t(':distance :unit around :city', [
                            'distance' => ($this->searchClass::$distance == 1) ? 0 : $this->searchClass::$distance,
                            'unit' => getDistanceUnit(config('country.code')),
                            'city' => $this->city->name]);
                        $htmlTitle .= '</a>';
                    } else {
                        $htmlTitle .= ' ' . t('in') . ' ';
                        $htmlTitle .= '<a rel="nofollow" class="jobs-s-tag" href="' . $searchUrl . '">';
                        $htmlTitle .= $this->city->name;
                        $htmlTitle .= '</a>';
                    }
                }
            }
        }
        

        // Category
        if (isset($this->isCatSearch) && $this->isCatSearch) {
            if (isset($this->cat) && !empty($this->cat)) {
                // SubCategory
                if (isset($this->isSubCatSearch) && $this->isSubCatSearch) {
                    if (isset($this->categoryTree) && !empty($this->categoryTree)) {

                        $baseURL = UrlGen::category($this->cat);
                        $result = '';

                        $this->categoryTree->each(function($item, $key) use (&$result, &$baseURL, $fullUrlNoParams) {
                            $temp = ' ' . t('in') . ' ';
                            if (request()->filled('sc')) {
                                $searchUrl = qsurl($fullUrlNoParams, request()->except(['sc']), null, false);
                            } else {
                                $searchUrl = $baseURL;
                                $searchUrl = qsurl($searchUrl, request()->except(['sc']), null, false);
                            }
                            $temp .= '<a rel="nofollow" class="jobs-s-tag" href="' . $searchUrl . '">';
                            $temp .= $item->name;
                            $temp .= '</a>';
                            $result = $temp . $result;
                            $baseURL .= "/".$item->slug;
                        });

                        $htmlTitle .= $result;


                    } elseif (isset($this->subCat) && !empty($this->subCat)) {
                        $htmlTitle .= ' ' . t('in') . ' ';

                        if (request()->filled('sc')) {
                            $searchUrl = qsurl($fullUrlNoParams, request()->except(['sc']), null, false);
                        } else {
                            $searchUrl = UrlGen::category($this->cat);
                            $searchUrl = qsurl($searchUrl, request()->except(['sc']), null, false);
                        }

                        $htmlTitle .= '<a rel="nofollow" class="jobs-s-tag" href="' . $searchUrl . '">';
                        $htmlTitle .= $this->subCat->name;
                        $htmlTitle .= '</a>';
                    }
                }

                $htmlTitle .= ' ' . t('in') . ' ';

                if (request()->filled('c')) {
                    $searchUrl = qsurl($fullUrlNoParams, request()->except(['c']), null, false);
                } else {
                    $attr = ['countryCode' => config('country.icode')];
                    $searchUrl = lurl(trans('routes.v-search', $attr), $attr);
                    $searchUrl = qsurl($searchUrl, request()->except(['c']), null, false);
                }

                $htmlTitle .= '<a rel="nofollow" class="jobs-s-tag" href="' . $searchUrl . '">';
                $htmlTitle .= $this->cat->name;
                $htmlTitle .= '</a>';
            }
        }

        // Tag
        if (isset($this->isTagSearch) && $this->isTagSearch) {
            if (isset($this->tag) && !empty($this->tag)) {
                $htmlTitle .= ' ' . t('for') . ' ';
                $attr = ['countryCode' => config('country.icode')];
                $htmlTitle .= '<a rel="nofollow" class="jobs-s-tag" href="' . lurl(trans('routes.v-search', $attr), $attr) . '">';
                $htmlTitle .= $this->tag;
                $htmlTitle .= '</a>';
            }
        }

        // Date
        if (request()->filled('postedDate') && isset($this->dates) && isset($this->dates->{request()->get('postedDate')})) {
            $htmlTitle .= t('last');
            $htmlTitle .= '<a rel="nofollow" class="jobs-s-tag" href="' . qsurl($fullUrlNoParams, request()->except(['postedDate']), null, false) . '">';
            $htmlTitle .= $this->dates->{request()->get('postedDate')};
            $htmlTitle .= '</a>';
        }

        // Condition
        if (request()->filled('new') && isset($this->conditions) && isset($this->conditions->{request()->get('new')})) {
            $htmlTitle .= '<a rel="nofollow" class="jobs-s-tag" href="' . qsurl($fullUrlNoParams, request()->except(['new']), null, false) . '">';
            $htmlTitle .= $this->conditions->{request()->get('new')};
            $htmlTitle .= '</a>';
        }

        view()->share('htmlTitle', $htmlTitle);

        return $htmlTitle;
    }

    /**
     * Get Breadcrumbs Tabs
     *
     * @return array
     */
    public function getBreadcrumb()
    {
        $bcTab = [];

        // City
        if (isset($this->city) && !empty($this->city)) {
            $title = t('in :distance :unit around :city', [
                'distance' => ($this->searchClass::$distance == 1) ? 0 : $this->searchClass::$distance,
                'unit' => getDistanceUnit(config('country.code')),
                'city' => $this->city->name,
            ]);

            $bcTab[] = [
                'name' => (isset($this->cat) ? t('All ads') . ' ' . $title : $this->city->name),
                'url' => UrlGen::city($this->city),
                'position' => (isset($this->cat) ? 5 : 3),
                'location' => true,
            ];
        }

        // Admin
        if (isset($this->admin) && !empty($this->admin)) {
            $title = $this->admin->name;

            $attr = ['countryCode' => config('country.icode')];
            $bcTab[] = [
                'name' => (isset($this->cat) ? t('All ads') . ' ' . $title : $this->admin->name),
                'url' => lurl(trans('routes.v-search', $attr), $attr) . '?d=' . config('country.icode') . '&r=' . $this->admin->name,
                'position' => (isset($this->cat) ? 5 : 3),
                'location' => true,
            ];
        }

        // Category
        if (isset($this->cat) && !empty($this->cat)) {
            if (isset($this->categoryTree) && !empty($this->categoryTree)) {

                $count = 3;
                $baseURL = $this->baseURL;

                $this->categoryTree->each(function($item, $key) use (&$count, &$bcTab, &$baseURL) {
                    $baseURL .= "/".$item->slug;
                    $bcTab[] = [
                        'name'     => $item->name,
                        'url'      => $baseURL,
                        'position' => $count,
                    ];
                    $count++;
                });


            } elseif (isset($this->subCat) && !empty($this->subCat)) {
                $title = t('in :category', ['category' => $this->subCat->name]);

                $bcTab[] = [
                    'name' => $this->cat->name,
                    'url' => UrlGen::category($this->cat),
                    'position' => 3,
                ];

                $bcTab[] = [
                    'name' => (isset($this->city) ? $this->subCat->name : t('All ads') . ' ' . $title),
                    'url' => UrlGen::category($this->subCat, 1),
                    'position' => 4,
                ];
            } else {
                $title = t('in :category', ['category' => $this->cat->name]);

                $bcTab[] = [
                    'name' => (isset($this->city) ? $this->cat->name : t('All ads') . ' ' . $title),
                    'url' => UrlGen::category($this->cat),
                    'position' => 3,
                ];
            }
        }

        // Sort by Position
        $bcTab = array_values(Arr::sort($bcTab, function ($value) {
            return $value['position'];
        }));

        view()->share('bcTab', $bcTab);

        return $bcTab;
    }

    public function getBreadcrumbSearch()
    {
        $bcTab = [];
        $query = request()->query();
        $uri = request()->path();


        // City
        if (isset($this->city) && !empty($this->city)) {
            $title = t('in :distance :unit around :city', [
                'distance' => ($this->searchClass::$distance == 1) ? 0 : $this->searchClass::$distance,
                'unit' => getDistanceUnit(config('country.code')),
                'city' => $this->city->name,
            ]);

            $bcTab[] = [
                'name' => (isset($this->cat) ? t('All ads') . ' ' . $title : $this->city->name),
                'url' => UrlGen::city($this->city),
                'position' => (isset($this->cat) ? 5 : 3),
                'location' => true,
            ];
        }

        // Admin
        if (isset($this->admin) && !empty($this->admin)) {
            $title = $this->admin->name;

            $attr = ['countryCode' => config('country.icode')];
            $bcTab[] = [
                'name' => (isset($this->cat) ? t('All ads') . ' ' . $title : $this->admin->name),
                'url' => lurl(trans('routes.v-search', $attr), $attr) . '?d=' . config('country.icode') . '&r=' . $this->admin->name,
                'position' => (isset($this->cat) ? 5 : 3),
                'location' => true,
            ];
        }

        // Category
        if (isset($this->cat) && !empty($this->cat)) {
            if (isset($this->categoryTree) && !empty($this->categoryTree)) {

                $count = 3;


                $this->categoryTree->each(function($item, $key) use (&$count, &$bcTab, &$baseURL, $query) {
                    $bURL = "/search";
                    $tmpQuery = $query;
                    unset($tmpQuery['sc']);
                    $tmpQuery['c'] = $item->id;

                    $bcTab[] = [
                        'name'     => $item->name,
                        'url'      => $bURL . "?" . httpBuildQuery($tmpQuery),
                        'position' => $count,
                    ];
                    $count++;
                });


            } elseif (isset($this->subCat) && !empty($this->subCat)) {
                $title = t('in :category', ['category' => $this->subCat->name]);

                $bcTab[] = [
                    'name' => $this->cat->name,
                    'url' => UrlGen::category($this->cat),
                    'position' => 3,
                ];

                $bcTab[] = [
                    'name' => (isset($this->city) ? $this->subCat->name : t('All ads') . ' ' . $title),
                    'url' => UrlGen::category($this->subCat, 1),
                    'position' => 4,
                ];
            } else {
                $title = t('in :category', ['category' => $this->cat->name]);

                $bcTab[] = [
                    'name' => (isset($this->city) ? $this->cat->name : t('All ads') . ' ' . $title),
                    'url' => UrlGen::category($this->cat),
                    'position' => 3,
                ];
            }
        }

        // Sort by Position
        $bcTab = array_values(Arr::sort($bcTab, function ($value) {
            return $value['position'];
        }));

        view()->share('bcTab', $bcTab);

        return $bcTab;
    }
}
