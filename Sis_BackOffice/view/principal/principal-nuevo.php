
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />


    <div class="container-fluid">
    <h1 class="page-header text-center">Registro Nueva Pedido</h1>
    <div class="row">
        <div class="col-lg-12 m-auto">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Alternativa
                </div>
                <div class="card-body">
                    <form id="frm-nuevo" action="?c=alternativa&a=Guardar" method="post" autocomplete="off" enctype="multipart/form-data">
                

                        <div class="form-group">
                            <label for="categoria">Cliente</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-list"></i></span>
                                </div>
                                <select class="custom-select" name="categoria" id="categoria" required>
                                    <option value="0">Seleccionar</option>
                                    <!-- Opciones generadas dinámicamente -->
                                    <?php foreach ($this->model->MenuTipo() as $Tipo): ?>
                                        <option  value="<?php echo $Tipo->Categoria_id; ?>">
                                            <?php echo $Tipo->Categoria_nombre; ?> <!-- Reemplaza "Nombre" con el nombre real de la columna que deseas mostrar en el select -->
                                        </option>       
                                    <?php endforeach; ?>
                                
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="precio">Nit / Ci</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                <input type="number" step="5" placeholder="Ingrese el Precio de la Alternativa" name="costo" id="costo" class="form-control" min="0" max="1000">
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
            event.preventDefault(); // Detener el envío del formulario tradicional

            var formData = new FormData(this);

            fetch('?c=alternativa&a=Guardar', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: data.message
                    }).then(() => {
                        window.location.href = 'index.php?c=alternativa&a=NuevoIN';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al procesar la solicitud.'
                });
            });
        });
    $(document).ready(function(){
            
        var map = L.map('map').setView([-16.489689,-68.119293], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var gcs = L.esri.Geocoding.geocodeService();
        var currentMarker;

        map.on('click', (e)=>{
        var lat = Number(e.latlng.lat.toFixed(6));
        var lng = Number(e.latlng.lng.toFixed(6));
        if (currentMarker) {
            map.removeLayer(currentMarker);
        }
        currentMarker = L.marker(e.latlng).addTo(map);
        
        gcs.reverse().latlng(e.latlng).run((err, res)=>{
            if(err) return;
          //  alert(res.latlng);

         //   document.getElementById("text1").value = lat;
            document.getElementById("text2").value = lng;

       
            let latLngStr = e.latlng;

          //  let latLngStr = "LatLng(-16.485331, -68.119304)";
            document.getElementById("text1").value = lat;
            document.getElementById("latlong").value = lat + "," + lng ;
          //  currentMarker = L.marker(res.latlng).addTo(map).bindPopup(res.address.Match_addr).openPopup();
          //  currentMarker.bindPopup(res.address.Match_addr).openPopup();
          var popupContent = "";
          var inputContent = "";
            if (res.address.Match_addr) {
                popupContent += res.address.Match_addr + "<br>";
             //   popupContentInfo += res.address.Match_addr ;
            }
            if (res.address.Street) {
                popupContent += "Calle: " + res.address.Street + "<br>";
                inputContent += "Calle: " + res.address.Street + ", ";
  
            }
            if (res.address.Neighborhood) {
                popupContent += "Barrio: " + res.address.Neighborhood + "<br>";
           //    inputContent += "Barrio: " + res.address.Neighborhood + ", ";
       }
            // ... (puedes agregar más detalles aquí)

            // Mostrar la información en el popup
            currentMarker.bindPopup(popupContent).openPopup();

            document.getElementById("text3").value = res.address.Match_addr;

            });
        });
        // Objeto para mantener el registro de los archivos seleccionados
        var archivosSeleccionados = {};
        function esExtensionValida(nombreArchivo) {
            // Define las extensiones de archivo permitidas
            var extensionesPermitidas = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            
            // Comprueba si la extensión del archivo actual está permitida
            return extensionesPermitidas.test(nombreArchivo);
        }


                
        function actualizarRegistroYUI(inputElement, infoElementId) {
            var files = $(inputElement)[0].files;
            var fileInfo = "";

            if (files.length > 0) {
                var archivo = files[0].name;

                // Verificar si el archivo tiene una extensión de imagen válida
                if (!esExtensionValida(archivo)) {
                    fileInfo = "Formato no permitido. Seleccione un archivo de imagen (.jpg, .jpeg, .png, .gif).";
                    $(inputElement).val(''); // Limpiar el input file
                } else if (Object.values(archivosSeleccionados).includes(archivo)) {
                    // Comprobar si el archivo ya ha sido seleccionado en otro input
                    fileInfo = "Este archivo ya ha sido seleccionado.";
                    $(inputElement).val(''); // Deseleccionar el archivo actual
                } else {
                    // Actualizar el registro con el nuevo archivo
                    var inputId = $(inputElement).attr('id');
                    archivosSeleccionados[inputId] = archivo;
                    fileInfo = `Archivo seleccionado: ${archivo}`;
                }
            } else {
                fileInfo = "No se ha seleccionado ningún archivo.";
            }

            $('#' + infoElementId).html(fileInfo); // Actualizar la interfaz de usuario
        }

        // Manejadores de eventos para los cambios de archivos
        $('#img1').on('change', function() { actualizarRegistroYUI(this, 'file-info1'); });
        $('#img2').on('change', function() { actualizarRegistroYUI(this, 'file-info2'); });
        $('#img3').on('change', function() { actualizarRegistroYUI(this, 'file-info3'); });
        $('#img4').on('change', function() { actualizarRegistroYUI(this, 'file-info4'); });
        $('#img5').on('change', function() { actualizarRegistroYUI(this, 'file-info5'); });



        


        $('#myModal').on('shown.bs.modal', function () {
                map.invalidateSize();
            });


        $('#saveChangesButton').on('click', function() {
            var txt = document.getElementById("text3").value;
            document.getElementById("ubicacion").value = txt;

            if (txt && txt.trim() !== "") {
                $('#myModal').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            }
        });
        // Obtiene el botón que abre el modal
        var modal = document.getElementById("myModal1");

        // Obtiene el botón que abre el modal


        $('#saveChangesButtonImg').on('click', function(e) {
            e.preventDefault(); // Esto evita que el botón realice su acción por defecto.
            // Aquí iría el código para manejar los cambios, como validar y guardar los datos.
            
            // Para cerrar el modal manualmente si todo está correcto:
             $('#myModal1').modal('hide');
             $('.modal-backdrop').remove();
             $('body').removeClass('modal-open'); // Esto devuelve el scroll al body si se había quitado.
        });


        var modal = document.getElementById("myModal");

            // Obtiene el botón que abre el modal
            var btn = document.getElementById("openModalButton");

            // Obtiene el elemento <span> que cierra el modal
            var span = document.getElementsByClassName("close")[0];

            // Cuando el usuario hace clic en el botón, abre el modal 
            btn.onclick = function() {
                modal.style.display = "block";
            }

            // Cuando el usuario hace clic en <span> (x), cierra el modal
            span.onclick = function() {
                modal.style.display = "none";
            }

            // Cuando el usuario hace clic en cualquier lugar fuera del modal, lo cierra
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

        // Función para guardar los cambios
        document.getElementById("saveChangesButton").onclick = function() {
            var text1Value = document.getElementById("text1").value;
            var text2Value = document.getElementById("text2").value;

            // Aquí puedes agregar el código para modificar el contenido en tu archivo original.
            console.log("Text1: " + text1Value + ", Text2: " + text2Value);
        }

        $("#frm-nuevo").submit(function(){
            return $(this).validate();
        });
    })
</script>
