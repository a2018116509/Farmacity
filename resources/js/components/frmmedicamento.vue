<template>
    <div class="container">
    <h3>Registro de Medicamentos</h3>
    <!--Listado de Registros-->
    <form action="" method="POST">
        <table>
            <tr>
                <td>Nombre</td>
                <td><input type="text" v-model="nombre" placeholder="Nombre Medicamento"></td>
            </tr>
            <tr>
                <td>Descripcion</td>
                <td><input type="text" v-model="descripcion" placeholder="Descripcion"></td>
            </tr>
            <tr>
                <td>Precio</td>
                <td><input type="number" v-model="precio"></td>
            </tr>
            <tr>
                <td>Laboratorio</td>
                <td>
                    <select v-model="id_laboratorio">
                    <option value="0" disabled>Seleccione</option>
                            <option v-for="laboratorio in arrayLaboratorio" :key="laboratorio.id" :value="laboratorio.id" 
                            v-text="laboratorio.nombre"></option>
                    </select>
                </td>
            </tr>
            <tr>
                    <td colspan="3">
                        <button type="button" @click="nuevo()">Nuevo</button>
                        <button type="button" @click="guardar()">Guardar</button>
                        <button type="button" @click="modificar()">Modificar</button>
                        <button type="button" @click="eliminar()">Eliminar</button>
                    </td>
            </tr>
        </table>
        <input type="text" v-model="buscar" placeholder="Nombre Medicamento">
        <button type="button" @click="listar(buscar)">Buscar por Nombre</button>
    </form>
    <table border="1">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>Laboratorio</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="medicamento in arrayMedicamento" :key="medicamento.id">
                    <td v-text="medicamento.id"></td>
                    <td v-text="medicamento.nombre"></td>
                    <td v-text="medicamento.descripcion"></td>
                    <td v-text="medicamento.precio"></td>
                    <td v-text="medicamento.nom_laboratorio"></td>
                    <td><a href="#" @click="llenar(medicamento)">Editar</a></td>
                </tr>
            </tbody>
    </table>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                nombre :'',
                descripcion :'',
                precio : 0,
                id_laboratorio : 0,
                id_medicamento : 0,
                nom_laboratorio: '',
                buscar : '',
                arrayMedicamento: [],
                arrayLaboratorio : []
            }
        },
        methods:{
            listar(buscar){
                let me = this;
                var url='/medicamento?buscar=' + buscar;
                axios.get(url).then(function(response){
                    me.arrayMedicamento= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            selectLaboratorio(){
                let me = this;
                axios.get('/laboratorio/selectLaboratorio').then(function(response){
                    me.arrayLaboratorio= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            guardar(){
                let me = this;
                axios.post('medicamento/registrar',{
                    'nombre': this.nombre,
                    'descripcion': this.descripcion,
                    'precio': this.precio,
                    'id_laboratorio': this.id_laboratorio
                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });
            },
            modificar(){
                let me = this;
                axios.put('medicamento/modificar',{
                    'nombre': this.nombre,
                    'descripcion': this.descripcion,
                    'precio' : this.precio,
                    'id_laboratorio' : this.id_laboratorio,
                    'id': this.id_medicamento
                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });  
            },
            eliminar(){
                let me = this;
                axios.put('medicamento/eliminar',{
                    'id': this.id_medicamento
                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });  
            },
            llenar(data=[]){
                this.id_medicamento=data['id'];
                this.nombre=data['nombre'];
                this.descripcion=data['descripcion'];
                this.precio=data['precio'];
                this.id_laboratorio=data['id_laboratorio'];
            },         
            nuevo(){
                this.nombre = '';
                this.descripcion = '';
                this.precio = 0;
                this.id_laboratorio = 0;
            },
        },
        mounted() {
            this.listar(this.buscar);
            this.selectLaboratorio();
        }
    }
</script>
