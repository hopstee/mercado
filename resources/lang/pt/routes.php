<?php

return [
    'countries' => 'countries',
    'login' => 'entrar',
    'register' => 'registre',
    'post' => '{slug}/{id}',
    'v-post' => ':slug/:id',
    'page' => 'pagina/{slug}',
    't-page' => 'pagina',
    'v-page' => 'pagina/:slug',
    'contact' => 'contact',
    'contact-us' => 'contacte-nos',
    'sitemap' => 'mapa-do-site',
    'v-sitemap' => 'mapa-do-site',
    'search' => 'buscar',
    't-search' => 'buscar',
    'v-search' => 'buscar',
    'job-search' => 'categoria/empregos',
    'search-subCat' => 'categoria/{catSlug}/{subCatSlug}',
    't-search-subCat' => 'categoria',
    'v-search-subCat' => 'categoria/:catSlug/:subCatSlug',
    'search-cat' => 'categoria/{catSlug}',
    't-search-cat' => 'categoria',
    'v-search-cat' => 'categoria/:catSlug',
    'search-city' => 'free-ads/{city}/{id}',
    't-search-city' => 'free-ads',
    'v-search-city' => 'free-ads/:city/:id',
    'search-user' => 'utilizador/{id}/publicados',
    't-search-user' => 'utilizador',
    'v-search-user' => 'utilizador/:id/publicados',
    'search-username' => 'profile/{username}',
    't-search-username' => 'profile',
    'v-search-username' => 'profile/:username',
    'search-tag' => 'tag/{tag}',
    't-search-tag' => 'tag',
    'v-search-tag' => 'tag/:tag',

    'category' => 'categoria',
    'personal-data' => 'dados-pessoais',
    'my-ads' => 'meus-anúncios',
    'favourite-ads' => 'anúncios-favoritos',
    'rejected-ads' => 'anúncios-reprovados',
    'archived-ads' => 'anúncios-arquivados',
    'conversations' => 'conversas',
    'logout' => 'sair',
    'delete-account' => 'apagar-conta',
    'photo' => 'imagem',
    'photo-delete' => 'imagem-remover',
    'delete'=>'remover',
    'reply'=>'resposta',
    'messages'=>'mensagem',

    'create' => 'crio',
    'posts' => 'publicados',
    'photos' => 'fotos',


    'user' => 'utilizador',
    'posts-create' => 'publicados/crio',
    
    'posts-create-back' => 'publicados/crio/{tmpToken}',
    'v-posts-create-back' => 'publicados/crio/:tmpToken',

    'posts-create-photo' => 'publicados/crio/{tmpToken}/fotos',
    'v-posts-create-photo' => 'publicados/crio/:tmpToken/fotos',

    'posts-create-finish' => 'publicados/crio/{tmpToken}/finish',
    'v-posts-create-finish' => 'publicados/crio/:tmpToken/finish',

    'personal-data' => 'dados-pessoais',

    'pers-photo' => 'dados-pessoais/{id}/imagem',
    'v-pers-photo' => 'dados-pessoais/:id/imagem',
    'pers-photo-delete' => 'dados-pessoais/{id}/imagem-remover',
    'v-pers-photo-delete' => 'dados-pessoais/:id/imagem-remover',

    'conversations' => 'conversas',
    'pers-conversations-delete' => 'conversas/remover',
    'v-pers-conversations-delete' => 'conversas/remover',
    'pers-conversations-delete-id' => 'conversas/{id}/remover',
    'v-pers-conversations-delete-id' => 'conversas/:id/remover',

    'conversations-reply' => 'conversas/{id}/resposta',
    'v-conversations-reply' => 'conversas/:id/resposta',

    'conversations-messages' => 'conversas/{id}/mensagem',
    'v-conversations-messages' => 'conversas/:id/mensagem',

    'pers-ads' => 'dados-pessoais/{pagePath}',
    'v-pers-ads-my' => 'dados-pessoais/meus-anúncios',   
    'v-pers-ads-archived' => 'dados-pessoais/anúncios-arquivados',
    'v-pers-ads-favourite' => 'dados-pessoais/anúncios-favoritos',
    'v-pers-ads-rejected' => 'dados-pessoais/anúncios-reprovados',

    'pers-ads-delete' => 'dados-pessoais/{pagePath}/remover',
    'v-pers-ads-delete' => 'dados-pessoais/:pagePath/remover',

    'pers-ads-delete-id' => 'dados-pessoais/{pagePath}/{id}/remover',
    'v-pers-ads-delete-id' => 'dados-pessoais/:pagePath/:id/remover',

    'logout' => 'logout',
    'pers-settings' => 'configurações',
    'pers-delete-account' => 'pdados-pessoais/apagar-conta',
    'pers-delete-account-accept' => 'dados-pessoais/apagar-conta/remover',

    'terms-of-use' => 'termos-de-uso',
    'privacy-policy' => 'politica-de-privacidade',
    'posting-rules' => 'pegras-de-postagem',
    'tips' => 'dicas-utilizadores',
    'faq' => 'perguntas-frequentes',

    'edit' => 'editar',

    'posts-edit' => 'publicados/{id}/editar',
    'v-posts-edit' => 'publicados/:id/editar',

    'posts-photos' => 'publicados/{id}/fotos',
    'v-posts-photos' => 'publicados/:id/fotos',

    'unban' => 'destravar',
    'request' => 'solicitação',
    'unban-request' => 'destravar/{phone}/solicitação',
    'v-unban-request' => 'destravar/:phone/solicitação',
    
    'report' => 'reportar',
    'posts-report' => 'publicados/{id}/reportar',
    'v-posts-report' => 'publicados/:id/reportar',
];
