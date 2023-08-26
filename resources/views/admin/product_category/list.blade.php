@extends('admin.layout.master')

@section('content')
<div class="content-wrapper">

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if (session('message'))
                        <div class="alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
            </div>

          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Product Category</h3>
                  <div class="d-flex justify-content-end">
                    <a class="btn btn-primary"href="{{ route('admin.product_category.create') }}">Create</a>
                </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Number of child</th>
                        <th style="width: 40px">Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($productCategories as $productCategory)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $productCategory->name }}</td>
                                <td>{{ $productCategory->slug }}</td>
                                <td>{{ $productCategory->products->count() }}</td>
                                <td>
                                    <a class="btn btn-{{ $productCategory->status ? 'success' : 'danger' }}">
                                        {{ $productCategory->status ? 'Show' : 'Hide' }}
                                    </a>
                                </td>
                                <td>
                                    <form method="post" action="{{ route('admin.product_category.delete', ['id' => $productCategory->id]) }}">
                                        @csrf
                                        <a href="{{ route('admin.product_category.detail', ['id' => $productCategory->id]) }}" class="btn btn-primary">Edit</a>
                                        <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No Product Category</td>
                            </tr>
                        @endforelse
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    {{-- vendor\laravel\framework\src\Illuminate\Pagination\resources\views\bootstrap-5.blade.php --}}
                    {{ $productCategories->links('admin.pagination.custom') }}
                  {{-- <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                    @for ($page = 1; $page <= $numberOfPage; $page++)
                        <li class="page-item"><a class="page-link" href="?page={{ $page }}">{{ $page }}</a></li>
                    @endfor
                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                  </ul> --}}
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
</div>
@endsection
