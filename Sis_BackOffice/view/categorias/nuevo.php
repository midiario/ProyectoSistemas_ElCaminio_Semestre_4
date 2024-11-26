

    <div class="container-fluid">
    <h1 class="page-header text-center">Registro Nueva Categoria</h1>
    <div class="row">
        <div class="col-lg-12 m-auto">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Alternativa
                </div>
                <div class="card-body">
                    <form id="frm-nuevo" action="?c=alternativa&a=Guardar" method="post" autocomplete="off" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nombre">Nombre de la Categoria</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                </div>
                                <input type="text" placeholder="Ingrese nombre" name="titulo" id="titulo" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="descripcion">Detalle de la Categoria</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-info-circle"></i></span>
                                </div>
                                <input type="text" placeholder="Ingrese descripción" name="descripcion" id="descripcion" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                                </div>
                                <select name="estado" id="estado" class="custom-select">
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                        <a href="?c=principal" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Regresar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
 <!-- Load Leaflet from CDN -->



<script>
    document.getElementById('frm-nuevo').addEventListener('submit', function(event) {
  
    })
</script>
