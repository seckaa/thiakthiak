<div class="pl-200 pr-200 overflow clearfix">

    <div class="categori-menu-slider-wrapper clearfix">
        <div class="categories-menu">

            <div class="category-heading">
                <h3>Our Menu<i class="pe-7s-angle-down" id="up-down"></i></h3>
            </div>

            <div class="category-menu-list hide-show" id="hide-show">
                <ul>
                    @foreach ($categories as $category)
                        <li>
                            <a href="{{ route('products.index', ['category_id' => $category->id]) }}">{{ $category->name }}<i
                                    class="pe-7s-angle-right"></i></a>


                            @php
                                // $children = $category->parentId();
                                // $children = $category->children;
                                $children = TCG\Voyager\Models\Category::where('parent_id', $category->id)->get();
                            @endphp

                            @if ($children->isNotEmpty())
                                <div class="category-menu-dropdown">

                                    @foreach ($children as $child)
                                        <div class="category-dropdown-style category-common3">
                                            <h4 class="categories-subtitle">
                                                <a href="{{ route('products.index', ['category_id' => $child->id]) }}">
                                                    {{ $child->name }}
                                                </a>

                                            </h4>
                                            @php
                                                // $grandChild = $child->children;
                                                $grandChild = TCG\Voyager\Models\Category::where(
                                                    'parent_id',
                                                    $child->id,
                                                )->get();
                                            @endphp
                                            @if ($grandChild && $grandChild->isNotEmpty())
                                                <ul>
                                                    @foreach ($grandChild as $c)
                                                        <li>
                                                            <a
                                                                href="{{ route('products.index', ['category_id' => $c->id]) }}">{{ $c->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    @endforeach


                                </div>
                            @endif
                        </li>
                    @endforeach

                </ul>
            </div>

        </div>

        <div class="menu-slider-wrapper">

            <div class="menu-style-3 menu-hover text-center">
                @include('_navbar')
            </div>

            <div class="slider-area">
                @include('_slider')
            </div>

        </div>

    </div>

</div>
