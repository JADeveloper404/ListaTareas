<template>
  <div>
      <h1 class="text-primary text-center">Gestión de Tareas</h1>
      <hr>
      <div class="row">
          <div class="col-md-4">
              <form>
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
                  <button class="btn btn-success">Guardar</button>
              </form>
          </div>
          <div class="col-md-8">
              <table class="table table-dark">
                  <thead>
                      <tr>
                          <th scope="col">#</th>
                          <th scope="col">Nombre</th>
                          <th scope="col">Descripción</th>
                          <th scope="col">Fecha</th>
                          <th scope="col">Realizada</th>
                          <th colspan="2">Acción</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <th scope="row">1</th>
                          <td>Estudiar Programación</td>
                          <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatem, repudiandae!</td>
                          <td>10-20-2021</td>
                          <td class="text-center">
                              <div class="form-check form-switch">
                                  <input type="checkbox" class="form-check-input" v-if="{checked : 'checked'}">
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
            check: false
        }
    },
}
</script>

<style>

</style>