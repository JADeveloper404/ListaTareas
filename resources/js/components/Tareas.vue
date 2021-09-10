<template>
  <div>
      <h1 class="text-primary text-center">Gestión de Tareas</h1>
      <hr>
      <button class="btn btn-primary" @click="modificar=false;seleccionar()">Nuevo</button>
      <hr>
      <div class="alert alert-dismissible fade my-4 d-none" :class="[config.show, config.color, config.display]" role="alert">
          {{ mensaje }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="row">
          <div class="col-md-4">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" placeholder="Escribe el Nombre" v-model="tarea.nombre">
                </div>
                <div class="form-group">
                    <label for="decripcion">Descripcion</label>
                    <textarea class="form-control" name="decripcion" placeholder="Escribe la Descripción" v-model="tarea.descripcion"></textarea>
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="date" class="form-control" name="fecha" placeholder="Escribe la Fecha" v-model="tarea.fecha">
                </div>
                <button class="btn btn-success" @click="guardar()">Guardar</button>
          </div>
          <div class="col-md-8">
              <table class="table table-success table-striped">
                  <thead>
                      <tr>
                          <th scope="col">#</th>
                          <th scope="col">Nombre</th>
                          <th scope="col">Descripción</th>
                          <th scope="col">Fecha</th>
                          <th scope="col">Realizada</th>
                          <th colspan="2" class="text-center">Acción</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr v-for="task in tareas" :key="task.id">
                          <th scope="row">{{ task.id }}</th>
                          <td>{{ task.nombre }}</td>
                          <td>{{ task.descripcion }}</td>
                          <td>{{ task.fecha }}</td>
                          <td class="text-center">
                              <div class="form-check form-switch">
                                  <input type="checkbox" class="form-check-input" @click="checked(task.check,task.id)" :checked="task.check" id="check" @input="task.check = $event.target.checked">
                              </div>
                          </td>
                          <td>
                              <div class="btn-group" role="group" aria-label="">
                                  <button type="button" class="btn btn-warning mx-2" @click="modificar=true;seleccionar(task)">Editar</button>
                                  <button type="button" class="btn btn-danger mx-2" @click="eliminar(task.id)">Eliminar</button>
                              </div>
                          </td>
                      </tr>
                  </tbody>
              </table>
          </div>
      </div>
  </div>
</template>

<script>
export default {
    data() {
        return {
            tarea: {
                nombre: '',
                descripcion: '',
                fecha: '',
                check: false
            },
            tareas: [],
            mensaje: '',
            modificar: false,
            id: 0,
            config: {
                show: '',
                color: '',
                display: '',
            }
        }
    },
    methods: {
        listar(){
            axios.get('/tareas')
            .then(res => {
                this.tareas = res.data;
            })    
        },
        checked(value, id){
            if (value) {
                value = false;
            }else {
                value = true;
            }
            axios.put('/check/' + id, {data: value})
            .then(res => {
                this.mensaje = res.data.mensaje;
                this.config.color = 'alert-warning';
                this.config.show = 'show';
                this.config.display = 'd-block';
            })
        },
        seleccionar(data={}){
            if (this.modificar) {
                this.tarea.nombre = data.nombre;
                this.id = data.id;
                this.tarea.descripcion = data.descripcion;
                this.tarea.fecha = data.fecha;
                this.tarea.check = data.check;
            }else{
                this.tarea.nombre = '';
                this.tarea.descripcion = '';
                this.tarea.fecha = '';
                this.tarea.check = false;
            }
        },
        guardar() {
            if (this.modificar) {
                axios.put('/tareas/' + this.id, {data: this.tarea})
                .then(res => {
                    this.mensaje = res.data.mensaje;
                    this.listar();
                    this.config.color = 'alert-success';
                    this.config.show = 'show';
                    this.config.display = 'd-block';
                })
            }else{
                axios.post('/tareas', {data: this.tarea})
                .then(res => {
                    this.mensaje = res.data.mensaje;
                    this.listar();
                    this.config.color = 'alert-success';
                    this.config.show = 'show';
                    this.config.display = 'd-block';
                })
            }
        },
        eliminar(id){
            axios.delete('/tareas/' + id)
            .then(res => {
                this.mensaje = res.data.mensaje;
                this.listar();
                this.config.color = 'alert-danger';
                this.config.show = 'show';
                this.config.display = 'd-block';
            })
        }        
    },
    created() {
        this.listar();
    }
}
</script>

<style>

</style>