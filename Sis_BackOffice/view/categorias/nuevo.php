

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
                            <label for="nombre">Nombre de la Alternativa</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                </div>
                                <input type="text" placeholder="Ingrese nombre" name="titulo" id="titulo" class="form-control">
                            </div>
                        </div>

                      
                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                <input type="number" step="5" placeholder="Ingrese el Precio de la Alternativa" name="costo" id="costo" class="form-control" min="0" max="1000">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
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

                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar Alternativa</button>
                        <a href="?c=principal" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Regresar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
 <!-- Load Leaflet from CDN -->
 <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>

  <!-- Load Esri Leaflet from CDN -->
  <script src="https://unpkg.com/esri-leaflet@2.5.0/dist/esri-leaflet.js"
    integrity="sha512-ucw7Grpc+iEQZa711gcjgMBnmd9qju1CICsRaryvX7HJklK0pGl/prxKvtHwpgm5ZHdvAil7YPxI1oWPOWK3UQ=="
    crossorigin=""></script>

  <!-- Load Esri Leaflet Geocoder from CDN -->
  <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.3.3/dist/esri-leaflet-geocoder.css"
    integrity="sha512-IM3Hs+feyi40yZhDH6kV8vQMg4Fh20s9OzInIIAc4nx7aMYMfo+IenRUekoYsHZqGkREUgx0VvlEsgm7nCDW9g=="
    crossorigin="">
  <script src="https://unpkg.com/esri-leaflet-geocoder@2.3.3/dist/esri-leaflet-geocoder.js"
    integrity="sha512-HrFUyCEtIpxZloTgEKKMq4RFYhxjJkCiF5sDxuAokklOeZ68U2NPfh4MFtyIVWlsKtVbK5GD2/JzFyAfvT5ejA=="
    crossorigin=""></script>



<script>
    document.getElementById('frm-nuevo').addEventListener('submit', function(event) {
  
    })
</script>
