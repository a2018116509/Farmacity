<template>
    <div class="container">
    <h3>Registro de Laboratorios</h3>
    <!--Listado de Registros-->
    <form action="" method="POST">
        <table>
            <tr>
                <td>Nombre</td>
                <td><input type="text" v-model="nombre" placeholder="Nombre Laboratorio"></td>
            </tr>
            <tr>
                    <td colspan="3">
                        <button type="button" @click="nuevo()">Nuevo</button>
                        <button type="button" @click="guardar()">Guardar</button>
                    </td>
            </tr>
        </table>
        <input type="text" v-model="buscar" placeholder="Nombre Laboratorio">
        <button type="button" @click="listar(buscar)">Buscar por Nombre</button>
    </form>
    <table border="1">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="laboratorio in arrayLaboratorio" :key="laboratorio.id">
                    <td v-text="laboratorio.id"></td>
                    <td v-text="laboratorio.nombre"></td>
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
                buscar : '',
                arrayLaboratorio : []
            }
        },
        methods:{
            listar(buscar){
                let me = this;
                var url='/laboratorio?buscar=' + buscar;
                axios.get(url).then(function(response){
                    me.arrayLaboratorio= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            guardar(){
                let me = this;
                axios.post('laboratorio/registrar',{
                    'nombre': this.nombre
                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });
            },
            nuevo(){
                this.nombre = '';
            },
        },
        mounted() {
            this.listar(this.buscar);
        }
    }
</script>
