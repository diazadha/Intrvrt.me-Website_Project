<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Kategori Merchandise</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">HOME</a></li>
            <li class="breadcrumb-item active">MERCHANDISE</li>
            <li class="breadcrumb-item active">KATEGORI</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-primary">
            <div class="card-header">
              <h3 class="card-title">
                Kategori Merchandise
              </h3>
              <div class="card-tools">
                <button type="button" class="add btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default">
                  Tambah Kategori
                </button>
              </div>
            </div>
            <div class="card-body">
              <table id="table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Kategori</th>
                    <th width="10%">Status</th>
                    <th width="15%"></th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" id="form">
        <div class="modal-body">
          <div class="form-group">
            <label for="kategori">Nama Kategori</label>
            <input type="hidden" class="form-control" id="id" name="id" value="">
            <input type="text" class="form-control" id="kategori" name="kategori">
          </div>
          <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" name="status">
              <option></option>
              <option value="1">On</option>
              <option value="0">Off</option>
            </select>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="submit" class="btn btn-primary save btn-name"></button>
        </div>
      </form>
    </div>
  </div>
</div>