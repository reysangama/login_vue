<template>
    <!-- Row -->

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default border-panel  card-view ">
                <div class="panel-heading cpy-1  d-flex flex-content-between">
                    <div class="col-md-9 mb-0 pb-0 mt-0">
                        <div class="button-list mt-0 mb-10 ml-0 mr-0 pt-5">
                            <button class="btn btn-primary btn-icon left-icon mt-0" data-toggle="modal"
                                data-target="#modal_perfil" data-whatever="@mdo" @click="cleanForm" ref="open"> <i
                                    class="fa fa-plus"></i> <span>{{ title }}</span></button>
                            <button class="btn btn-success btn-icon left-icon mt-0" @click="editProfile"
                                data-whatever="@mdo"> <i class="fa fa-pencil-square-o"></i>
                                <span>Editar</span></button>
                            <button class="btn btn-danger btn-icon left-icon mt-0" data-toggle="modal"
                                data-target="#modal_perfil" data-whatever="@mdo"> <i class="fa  fa-trash-o"></i>
                                <span>Elimianr</span></button>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex flex-content-end flex-aling-items">
                        <h5>Administrar Perfiles</h5>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <grid-table :path="path" :columns="columns" ref="GridTable" @edit="editProfile"></grid-table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_perfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h5 class="modal-title" id="exampleModalLabel1">Registrar Perfil</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label mb-10">Perfil:</label>
                            <input type="text" class="form-control" v-model="form_profile.description">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" ref="close" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" @click="registerProfile">Registrar</button>
                </div>
            </div>
        </div>
    </div>
    <notifications position="top right" width="300"   />
</template>


<script>
import GridTable from "../../components/GridTable.vue";
export default {
    name: "Perfil",
    components: {
        GridTable
    },
    data() {
        return {
            columns: [
                {
                    text: '#',
                    sortable: false,
                    value: false,
                    id: 1
                },
                {
                    text: 'Perfil',
                    sortable: false,
                    value: "description",
                    id: 2
                },
            ],
            list_profile: [],
            path: 'profiles',
            form_profile: {
                id: null,
                description: null,
            },
        };
    },
    computed:{
        title(){
            let title='Registrar Perfil';
            if(this.form_profile.id!=null){
                title='Actualizar Perfil';
            }
            return title;
        }
    },
    created() {

    },
    methods: {
        editProfile() {
            const row = this.$refs.GridTable.getSelectedRow();
            if (row == null) {
                this.$notify({
                    title: "<div class='title-notify'>Aviso</div>",
                    text: "<div class='content-notify'>!Seleccione un registro</div>",
                    type: 'warn',
                    });
                return;
            }
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.get(`/api/profiles/edit/${row}`)
                    .then(response => {
                         this.form_profile = response.data;
                        console.log(response.data);
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
       
            this.$refs.open.click();
        },

        registerProfile() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/profiles/', this.form_profile)
                    .then(response => {
                        console.log(response.data.status);
                        this.$refs.close.click();
                        this.$refs.GridTable.list();
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        },

        cleanForm() {
            this.form_profile = {
                id: null,
                description: null,
            };
        }


    }
}
</script>
<style>

</style>