@if (isset($catChildren) and !empty($catChildren) and isset($baseCatURL) and !empty($baseCatURL))
{{--        <div class="container hide-xs">--}}
        <div class="container">
            <div class="category-links">
                <ul>
                    <?php 
                        $urlWithLang= $_SERVER['REQUEST_URI'];
                        if(strpos($urlWithLang,'?')!==false){
                            $urlWithLang=substr($urlWithLang,0,strpos($urlWithLang,'?'));
                        }

                    ?>
                    @foreach ($catChildren as $iSubCat)
                        <li>
                            <a href="{{ $urlWithLang }}/{{ $iSubCat->slug }}">
                                {{ $iSubCat->name }}
                            </a>
                        </li>
                        <li class="separator-mob">|</li>
                    @endforeach
                </ul>
            </div>
        </div>
@endif
