@extends('admin.layouts.main')

@section('content')
<!--begin::Toolbar-->
<div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
            data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
            class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Kategori</h1>
            <!--begin::Separator-->
            <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
            <!--end::Separator-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Home</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-200 w-5px h-2px"></span>
                </li>
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">Kategori</li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-200 w-5px h-2px"></span>
                </li>
                <!--begin::Item-->
                <li class="breadcrumb-item text-dark">Edit</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
            </h1>
            <!--end::Title-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Container-->
</div>
<!--end::Toolbar-->
<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container">
        <div class="row gy-5 g-xl-8">
            <div class="col-xxl-12">
                <div class="card shadow-sm">
                    <form method="POST" action="{{ route('category.update', $item->id) }}">
                        @method('PUT')
                        @csrf
                        <div class="card-header">
                            <h3 class="card-title fs-2 fw-bolder">Edit Category</h3>
                        </div>
                        <div class="card-body row gap-10">
                            <div>
                                <label for="category_name" class="required form-label">Edit Kategori</label>
                                <input id="category_name" name="category_name" type="text"
                                    class="form-control form-control-solid" required
                                    value="{{ $item->category_name }}" />
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="card-toolbar">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    Tambah
                                </button>
                                <a href="{{ url()->previous() }}" class="btn btn-sm btn-secondary ms-3">
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end::Container-->
</div>

@push('scripts')
<script>
    $("#kt_datatable_example_1").DataTable();

</script>
@endpush
<!--end::Post-->
@endsection
