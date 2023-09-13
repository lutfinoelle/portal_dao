@extends('layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Ubah Uker</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Ubah Uker
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Basic Tables start -->
    <section class="section">
        <div class="card">
            <div class="card-body">
                <form class="row" id="updateBranchCode">
                    @csrf
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">Branch Code</label>
                            <input type="text" class="form-control" name="branch_code" id="branch_code"
                                onkeyup="checkBranchCode(this.value)">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">Branch Name</label>
                            <input type="text" class="form-control" name="branch_name" id="branch_name" disabled>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">Type</label>
                            <input type="text" class="form-control" disabled id="type">
                            <input type="hidden" name="branch_type_before" value="">
                        </div>
                    </div>
                    <div class="col-3">
                        <label for="">Change Into</label>
                        <select name="branch_type" id="" class="form-control">
                            <option value="KC-PIL">KC-PIL</option>
                            <option value="KC">KC</option>
                            <option value="KCK">KCK</option>
                            <option value="KCP">KCP</option>
                            <option value="KK">KK</option>
                        </select>
                    </div>

                    {{-- button --}}
                    <div class="col-3">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">History</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No PN</th>
                                <th>Nama Lengkap</th>
                                <th>Kegiatan</th>
                                <th>Waktu</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                            @foreach ($histories as $history)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $history->user->name }}</td>
                                <td>{{ $history->action }}</td>
                                <td>{{ $history->created_at->format('d F Y H:i:s') }}</td>
                                <td>{{ $history->detail }}</td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@push('js')
<script>
    let jquery_datatable = $("#table1").DataTable()

const setTableColor = () => {
    document.querySelectorAll('.dataTables_paginate .pagination').forEach(dt => {
        dt.classList.add('pagination-primary')
    })
}
setTableColor()
jquery_datatable.on('draw', setTableColor)

function checkBranchCode(code) {
    $.ajax('http://localhost:8001/api/uker?branch_code=' + code, {
        method: 'GET',
        success: function (data) {
            $('#branch_name').val(data.data.nama_uker)
            $('#type').val(data.data.tipe_uker)
            $('input[name=branch_type_before]').val(data.data.tipe_uker)
        },
        error: function (error) {
            $('#branch_name').val('')
            $('#type').val('')
        }
    });
}

$('#updateBranchCode').submit(function (e) {
    e.preventDefault()
    let data = $(this).serialize()
    $.ajax('http://localhost:8001/api/uker/update', {
        method: 'POST',
        data: data,
        success: function (data) {

            $.ajax(`{{ route('uker.history.store') }}`, {
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    branch_code: $('input[name=branch_code]').val(),
                    branch_type_before: $('input[name=branch_type_before]').val(),
                    branch_type: $('select[name=branch_type]').val(),
                    action: 'Ubah Tipe Uker',
                    detail: `${$('input[name=branch_code]').val()} | ${$('input[name=branch_type_before]').val()} -> ${$('select[name=branch_type]').val()}`
                },
                success: function (data) {
                    if (data.status == 200) {
                        Toast.fire({
                            icon: 'success',
                            title: 'Berhasil mengubah tipe uker'
                        })
                    } else {
                       Toast.fire({
                            icon: 'error',
                            title: 'Gagal mengubah tipe uker'
                        })
                    }
                },
                error: function (error) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Gagal mengubah tipe uker'
                    })
                }
            })

        },
        error: function (error) {
            console.log(error);
        }
    });
})
</script>
@endpush