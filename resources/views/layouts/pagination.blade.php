<nav aria-label="Page navigation pagination--one" class="pagination-wrapper" style="padding-top: 20px;">
    <ul class="pagination justify-content-center">
        <li class="page-item pagination-item @if($data->onFirstPage()) disabled @endif">
            <a class="page-link pagination-link" href="{{$data->previousPageUrl()}}" tabindex="-1">
                <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.91663 1.16634L1.08329 6.99967L6.91663 12.833" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </a>
        </li>
        @for ($i = 1; $i <= $data->lastPage(); $i++)
        <li class="page-item pagination-item">
            <a class="page-link pagination-link @if($data->currentPage() == $i) active @endif" href="{{$data->url($i)}}">{{$i}}</a>
        </li>
        @endfor
        
        <li class="page-item pagination-item @if($data->currentPage() == $data->lastPage()) disabled @endif">
            <a class="page-link pagination-link" href="{{$data->nextPageUrl()}}">
                <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.08337 1.16634L6.91671 6.99967L1.08337 12.833" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </a>
        </li>
    </ul>
</nav>