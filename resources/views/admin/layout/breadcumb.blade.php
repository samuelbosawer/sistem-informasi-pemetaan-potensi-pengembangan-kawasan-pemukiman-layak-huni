<!-- BREADCRUMB -->
<div class="page-meta mb-3">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            @if((Request::segment(1)) && Request::segment(2) == null)
                <li class="breadcrumb-item"><a class="text-capitalize" href="/{{Request::segment(1)}}">{{Request::segment(1)}}</a></li>
            @endif

            @if(Request::segment(2))
                <li class="breadcrumb-item"><a class="text-capitalize" href="/{{Request::segment(1).'/'.Request::segment(2)}}">{{Request::segment(2)}}</a></li>
            @endif

            @if(Request::segment(3) && Request::segment(3) != 'detail' && Request::segment(4) == 'ubah' )
                <li class="breadcrumb-item"><a class="text-capitalize" href="/{{Request::segment(1).'/'.Request::segment(2).'/'.Request::segment(3).'/'.Request::segment(4)}}">{{Request::segment(4)}}</a></li>

            @elseif((Request::segment(2)) && (Request::segment(3)) && Request::segment(4) == null )
            <li class="breadcrumb-item"><a class="text-capitalize" href="/{{Request::segment(1).'/'.Request::segment(2).'/'.Request::segment(3)}}">{{Request::segment(3)}}</a></li>


            @elseif(Request::segment(3) && Request::segment(3) == 'detail' )
            <li class="breadcrumb-item"><a class="text-capitalize" href="/{{Request::segment(1).'/'.Request::segment(2).'/'.Request::segment(3).'/'.Request::segment(4)}}">{{Request::segment(3)}}</a></li>
            @endif

        </ol>
    </nav>
</div>
<!-- /BREADCRUMB -->
