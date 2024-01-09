@extends('admin.master.main')
@section('bartitle','Transaksi')
@section('pagetitle')
Transaksi
@endsection
@section('pagebreadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
<li class="breadcrumb-item active">Transaksi</li>
@endsection
@section('pagecontent')
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <a class="btn btn-sm btn-primary" href="{{route('admin.transactions.add')}}"><i class="fa fa-plus"></i></a>
      </div>
      <form action="{{route('admin.transactions.save')}}" enctype="multipart/form-data" method="post"><!---->
        <div class="modal fade" id="addModal">
          <div class="modal-dialog">
            <div class="modal-content bg-primary">
              <div class="modal-header">
                <h4 class="modal-title">Tambah Transaksi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                @csrf
                <div class="form-group">
                  <label for="no_transaction">Kode Transaksi</label>
                  <input type="text" name="no_transaction" class="form-control" id="no_transaction" placeholder="Misal : 001">
                </div>
                <div class="form-group">
                  <label for="transaction_date">Tanggal</label>
                  <input name="transaction_date" type="date" id="transaction_date" class="form-control">
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success">Simpan</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar Transaksi</h3>
      </div>
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>Kode Transaksi</th>
            <th>Total Item</th>
            <th>Total Quantity</th>
            <th>Tanggal</th>
            <th>Opsi</th>
          </tr>
          </thead>
          <tbody>
            @foreach($transactions as $transaction)
              <tr>
                <td>{{$transaction->no_transaction}}</td>
                <td>{{\App\Models\transaction_details::where('transaction_id',$transaction->id)->count()}}</td>
                <td>{{\App\Models\transaction_details::where('transaction_id',$transaction->id)->sum('quantity')}}</td>
                <td>{{$transaction->transaction_date}}</td>
                <td>
                  <a class="btn btn-primary btn-sm" href="{{route('admin.transactions.view',['id'=>$transaction->id])}}"><i class="fa fa-eye"></i></a>
                  <a class="btn btn-success btn-sm" href="{{route('admin.transactions.edit',['id'=>$transaction->id])}}"><i class="fa fa-edit"></i></a>
                  <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_transaksi_{{ $transaction->id }}"><i class="fa fa-trash"></i></button>
                  <!--modal edit-->
                  <form action="{{route('admin.transactions.update',['id'=>$transaction->id])}}" enctype="multipart/form-data" method="post">
                    <div class="modal fade" id="edit_kategori_{{ $transaction->id }}">
                      <div class="modal-dialog">
                        <div class="modal-content bg-primary">
                          <div class="modal-header">
                            <h4 class="modal-title">Edit Transaksi</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            @csrf
                            {{method_field('PUT')}}
                            <div class="form-group">
                              <label for="no_transaction">Kode Transaksi</label>
                              <input type="text" name="no_transaction" value="{{ $transaction->no_transaction }}" class="form-control" id="no_transaction" placeholder="Misal : 001">
                            </div>
                            <div class="form-group">
                              <label for="transaction_date">Tanggal</label>
                              <input name="transaction_date" value="{{ $transaction->transaction_date }}" type="date" id="transaction_date" class="form-control">
                            </div>
                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                  <!--modal delete-->
                  <form method="POST" action="{{route('admin.transactions.delete',['id'=>$transaction->id])}}">
                    <div class="modal fade" id="hapus_transaksi_{{$transaction->id}}">
                      <div class="modal-dialog">
                        <div class="modal-content bg-danger">
                          <div class="modal-header">
                            <h4 class="modal-title">Peringatan!</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p>Yakin ingin hapus transaksi ini?</p>
                            @csrf
                            {{method_field('DELETE')}}
                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Ya, hapus</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
@section('customscripts')
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
  @if(Session::has('added'))
    toastr.success("{{Session::get('added')}}")
  @endif
  @if(Session::has('updated'))
    toastr.success("{{Session::get('updated')}}")
  @endif
  @if(Session::has('deleted'))
    toastr.success("{{Session::get('deleted')}}")
  @endif
</script>
@endsection