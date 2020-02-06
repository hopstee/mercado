<?php 

return [
    'countries' => 'countries',
    'login' => 'login',
    'logout' => 'logout',
    'register' => 'register',
    'post' => '{slug}/{id}',
    'v-post' => ':slug/:id',
    'page' => 'page/{slug}',
    't-page' => 'page',
    'v-page' => 'page/:slug',
    'contact-us' => 'contact-us',
    'sitemap' => 'sitemap',
    'v-sitemap' => 'sitemap',
    'search' => 'search',
    't-search' => 'search',
    'v-search' => 'search',
    'job-search' => 'category/jobs',
    'search-subCat' => 'category/{catSlug}/{subCatSlug}',
    't-search-subCat' => 'category',
    'v-search-subCat' => 'category/:catSlug/:subCatSlug',
    'search-cat' => 'category/{catSlug}',
    't-search-cat' => 'category',
    'v-search-cat' => 'category/:catSlug',
    'search-city' => 'free-ads/{city}/{id}',
    't-search-city' => 'free-ads',
    'v-search-city' => 'free-ads/:city/:id',
    'search-user' => 'users/{id}/ads',
    't-search-user' => 'users',
    'v-search-user' => 'users/:id/ads',
    'search-username' => 'profile/{username}',
    't-search-username' => 'profile',
    'v-search-username' => 'profile/:username',
    'search-tag' => 'tag/{tag}',
    't-search-tag' => 'tag',
    'v-search-tag' => 'tag/:tag',

    'category' => 'category',

    'user' => 'user',
    'personal-data' => 'personal-data',

    'pers-photo' => 'personal-data/{id}/photo',
    'v-pers-photo' => 'personal-data/:id/photo',
    'pers-photo-delete' => 'personal-data/{id}/photo-delete',
    'v-pers-photo-delete' => 'personal-data/:id/photo-delete',

    'conversations' => 'conversations',
    'pers-conversations-delete' => 'conversations/{id}/delete',
    'v-pers-conversations-delete' => 'conversations/:id/delete',
    'pers-conversations-delete-id' => 'conversations/{id}/delete',
    'v-pers-conversations-delete-id' => 'account/conversations/:id/messages/delete',

    'conversations-reply' => 'conversations/{id}/reply',
    'v-conversations-reply' => 'conversations/:id/reply',

    'conversations-messages' => 'conversations/{id}/messages',
    'v-conversations-messages' => 'conversations/:id/messages',

    'pers-ads' => 'personal-data/{pagePath}',
    'v-pers-ads-my' => 'personal-data/my-ads',   
    'v-pers-ads-archived' => 'personal-data/archived-ads',
    'v-pers-ads-favourite' => 'personal-data/favourite-ads',
    'v-pers-ads-rejected' => 'personal-data/rejected-ads',

    'pers-ads-delete' => 'personal-data/{pagePath}/delete',
    'v-pers-ads-delete' => 'personal-data/:pagePath/delete',

    'pers-ads-delete-id' => 'personal-data/{pagePath}/{id}/delete',
    'v-pers-ads-delete-id' => 'personal-data/:pagePath/:id/delete',

    'my-ads'=>'my-ads',
    'favourite-ads' => 'favourite-ads',
    'rejected-ads' => 'rejected-ads',
    'archived-ads' => 'archived-ads',

    'logout' => 'logout',
    'pers-settings' => 'settings',
    'pers-delete-account' => 'personal-data/delete-account',
    'pers-delete-account-accept' => 'personal-data/delete-account/delete',
    'delete'=>'delete',
    'reply'=>'reply',
    'messages'=>'messages',

    'create' => 'create',
    'posts' => 'posts',
    'photos' => 'photos',

    'posts-create' => 'posts/create',

    'posts-create-back' => 'posts/create/{tmpToken}',
    'v-posts-create-back' => 'posts/create/:tmpToken',

    'posts-create-photo' => 'posts/create/{tmpToken}/photos',
    'v-posts-create-photo' => 'posts/create/:tmpToken/photos',

    'posts-create-finish' => 'posts/create/{tmpToken}/finish',
    'v-posts-create-finish' => 'posts/create/:tmpToken/finish',

    'terms-of-use' => 'terms-of-use',
    'privacy-policy' => 'privacy-policy',
    'posting-rules' => 'posting-rules',
    'tips' => 'tips',
    'faq' => 'faq',

];
