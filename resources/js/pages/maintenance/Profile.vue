<template>
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h5 class="txt-dark">Perfiles</h5>
        </div>
        <!-- Breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
          <ol class="breadcrumb">
            <li><a href="index.html">Dashboard</a></li>
            <li><a href="#"><span>table</span></a></li>
            <li class="active"><span>data-table</span></li>
          </ol>
        </div>
        <!-- /Breadcrumb -->
    </div>
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <button class="btn btn-success btn-icon left-icon" data-toggle="modal" data-target="#modal_perfil" data-whatever="@mdo"  @click="cleanForm"> <i class="fa fa-plus"></i> <span>Nuevo</span></button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="datable_1" class="table table-hover display  pb-30" >
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Perfil</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in list_profile" :key="index">
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ item.description }}</td>
                                            <td class="text-nowrap">
                                                <a href="#" class="mr-25" data-toggle="tooltip" data-original-title="Edit"> 
                                                    <i class="fa fa-pencil text-inverse m-r-10"></i> 
                                                </a> 
                                                <a href="#" data-toggle="tooltip" data-original-title="Close"> 
                                                    <i class="fa fa-close text-danger"></i> 
                                                </a> 
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>	
        </div>
    </div>
    <div class="modal fade" id="modal_perfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary"  @click="registerProfile" >Registrar</button>
                    </div>
                </div>
            </div>
    </div>
</template>


<script>
export default {
name: "Perfil",
data() {
        return {
            list_profile: [],
            form_profile: {
                id: null,
                description: null,
            },
        };
    },
created() {
        this.listProfile();
},
methods: {

        async listProfile() {
            this.$axios.get("/sanctum/csrf-cookie").then((response) => {
                this.$axios
                    .get(`/api/profiles/`)
                    .then((response) => {
                        this.list_profile = response.data.profiles;
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            });
        },
        registerProfile() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/profiles/', this.form_profile)
                    .then(response => {
                      console.log(response.data.status);
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        },

        cleanForm(){
            this.form_profile={
                id: null,
                description: null,
            };
        }


}
}
</script>