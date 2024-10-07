@forelse ($pages as $page )
    <tr>
        <td>
            <a href="{{url('/')}}/{{$page->slug}}" class="text-decoration-none">
                {{$page->title}} 
                @if ($page->is_home)<b class="text-black fw-medium"> - Home page </b>@endif
            </a>
        </td>
        <td>
            {{url('/')}}/{{$page->slug}}
        </td>
        <td>
            @if ($page->status == 'active')
                <span class="badge bg-label-success">Active</span>
            @elseif ($page->status == 'inactive')
                <span class="badge bg-label-danger">Inactive</span>
            @else
                <span class="badge bg-label-warning">Draft</span>
            @endif
        </td>
        <td>
            <div class="d-flex align-items-center">
                <a href="{{route('admin.pages.widgets.edit', ['page_id' => $page->id])}}" class="btn btn-sm btn-icon btn-icon-secondary rounded-pill" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Edit Widgets">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.5 7.35008L7.4 10.1601C7.26972 10.2195 7.12819 10.2503 6.985 10.2503C6.84181 10.2503 6.70028 10.2195 6.57 10.1601L0.5 7.35008M13.5 10.6001L7.4 13.4101C7.26972 13.4695 7.12819 13.5003 6.985 13.5003C6.84181 13.5003 6.70028 13.4695 6.57 13.4101L0.5 10.6001M7.47 6.90008C7.32168 6.96449 7.1617 6.99772 7 6.99772C6.8383 6.99772 6.67832 6.96449 6.53 6.90008L0.83 4.26008C0.737441 4.2134 0.659658 4.14194 0.605312 4.05366C0.550966 3.96538 0.52219 3.86375 0.52219 3.76008C0.52219 3.65642 0.550966 3.55479 0.605312 3.46651C0.659658 3.37823 0.737441 3.30677 0.83 3.26008L6.53 0.600083C6.67832 0.535676 6.8383 0.502441 7 0.502441C7.1617 0.502441 7.32168 0.535676 7.47 0.600083L13.17 3.24008C13.2626 3.28677 13.3403 3.35823 13.3947 3.44651C13.449 3.53479 13.4778 3.63642 13.4778 3.74008C13.4778 3.84375 13.449 3.94538 13.3947 4.03366C13.3403 4.12194 13.2626 4.1934 13.17 4.24008L7.47 6.90008Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                      </svg>
                </a>

                <a href="{{route('admin.pages.edit', $page->id)}}" class="btn btn-sm btn-icon btn-icon-secondary rounded-pill" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Edit">
                    <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.9516 2.31982C10.4732 1.75466 10.734 1.47208 11.0112 1.30725C11.6799 0.909531 12.5034 0.897164 13.1833 1.27463C13.465 1.43106 13.7339 1.70568 14.2715 2.25493C14.8092 2.80418 15.078 3.07881 15.2312 3.36665C15.6007 4.06118 15.5886 4.90235 15.1992 5.58549C15.0379 5.86861 14.7613 6.13504 14.208 6.66791L7.62544 13.008C6.57701 14.0178 6.0528 14.5227 5.39764 14.7786C4.74248 15.0345 4.02224 15.0157 2.58176 14.978L2.38576 14.9729C1.94723 14.9614 1.72797 14.9557 1.60051 14.811C1.47305 14.6664 1.49045 14.443 1.52526 13.9963L1.54415 13.7538C1.64211 12.4965 1.69108 11.8678 1.9366 11.3028C2.18211 10.7377 2.6056 10.2788 3.4526 9.36115L9.9516 2.31982Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                        <path d="M9.19922 2.39996L14.0992 7.29996" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                        <path d="M9.89941 15L15.4994 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
                
                @if (!$page->is_home)
                <form action="{{route('admin.pages.destroy', $page->id)}}" method="POST" class="d-inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-icon btn-icon-secondary rounded-pill page-del-btn" data-page_id="{{$page->id}}" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete">
                        <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.0508 3.44995L12.617 10.4675C12.5061 12.2605 12.4507 13.1569 12.0013 13.8015C11.7791 14.1201 11.493 14.3891 11.1613 14.5912C10.4903 15 9.59207 15 7.7957 15C5.99696 15 5.09759 15 4.42612 14.5904C4.09414 14.3879 3.80798 14.1185 3.58586 13.7993C3.13659 13.1538 3.0824 12.256 2.97401 10.4606L2.55078 3.44995" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M14.1 3.44998H1.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M10.6371 3.45L10.1592 2.46421C9.84181 1.80938 9.6831 1.48197 9.40931 1.27776C9.34858 1.23247 9.28428 1.19218 9.21703 1.15729C8.91385 1 8.54999 1 7.82228 1C7.07629 1 6.7033 1 6.39509 1.16388C6.32678 1.20021 6.2616 1.24213 6.20022 1.28922C5.92326 1.50169 5.76855 1.84109 5.45913 2.51988L5.03516 3.45" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M6.05078 11.15L6.05078 6.95003" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M9.55078 11.15L9.55078 6.94995" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                    </button>
                </form>
                @endif
                
            </div>

        </td>
    </tr>
@empty
    
@endforelse