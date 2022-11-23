<template>
	<div class="wrapper pa-0">
		<header class="sp-header">
			<div class="sp-logo-wrap pull-left">
				<a href="index.html">
					<img class="brand-img mr-10" src="assets/dist/img/logo.png" alt="brand" />
					<span class="brand-text">Philbert</span>
				</a>
			</div>
			<div class="clearfix"></div>
		</header>

		<div class="page-wrapper pa-0 ma-0 auth-page" :style="style_height">
			<div class="container-fluid">
				<div class="table-struct full-width full-height">
					<div class="table-cell vertical-align-middle auth-form-wrap">
						<div class="auth-form  ml-auto mr-auto no-float">
							<div class="row login-border">
								<div class="col-sm-12 mt-30 col-xs-12">
									<div class="mb-30">
										<div class="imgcontainer">
											<img src="assets/img_avatar2.png" alt="Avatar" class="avatar">
										</div>
										<h2 class="text-center txt-dark mb-10 login-title">SISTEMA VENTAS</h2>
										<h6 class="text-center nonecase-font txt-grey">Ingrese sus datos a continuación
										</h6>
									</div>
									<div class="form-wrap">
										<form action="#">
											<div class="form-group">
												<label class="control-label mb-10"
													for="psw">Usuario</label>
												<div class="input-group">
													<div class="input-group-addon"><i class="icon-user"></i></div>
													<input type="text" v-model="email" class="form-control"
														id="exampleInputuname_1" placeholder="Usuario">
												</div>
											</div>
											<div class="form-group">
												<label class="pull-left control-label mb-10"
													for="psw">Contraseña</label>
												<div class="clearfix"></div>
												<div class="input-group">
													<div class="input-group-addon"><i class="icon-lock"></i></div>
													<input type="password" v-model="password" class="form-control"
														id="exampleInputpwd_1" placeholder="Contraseña">
												</div>
											</div>

											<div class="form-group">
												<div class="clearfix"></div>
											</div>
											<div class="form-group text-center boton">
												<button @click="handleSubmit" type="submit"
													class="btn btn-info btn-success btn-rounded">Iniciar</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>

export default {
	data() {
		return {
			email: "",
			password: "",
			error: null,
			styleObject: {
				"min-height": "661px !important",
			}
		}
	},
	created() {
		this.checkSession();
		this.addStyleWrapper();
	},


	methods: {

		checkSession() {
			let logueo = window.localStorage.getItem("logueo");

			if (logueo) {

				this.$router.push({ name: 'dashboard' })
			} else {

				this.$router.push("/")
			}
		},
		addStyleWrapper() {
			let height_now = window.innerHeight + "px";
			this.style_height = {
				"min-height": height_now + " !important",
			};

		},
		handleSubmit(e) {
			e.preventDefault()
			if (this.password.length > 0) {
				this.$axios.get('/sanctum/csrf-cookie').then(response => {
					this.$axios.post('api/login', {
						email: this.email,
						password: this.password
					})
						.then(response => {
							if (response.data.success) {
								window.localStorage.setItem(
									'logueo', JSON.stringify("TRUE")
								);
								window.localStorage.setItem(
									'session_information', JSON.stringify(response.data)
								);
								this.$router.push({ name: 'dashboard' })
							} else {
								this.error = response.data.message
							}
						})
						.catch(function (error) {
							console.error(error);
						});
				})
			}
		}
	},

}
</script>

<style scoped>
.modal {
	background-color: rgba(69, 48, 53, 0.5) !important;
}

.login-border {
	background-color: #fff;
	border-radius: 10px;
	box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
		0 10px 10px rgba(0, 0, 0, 0.22);
	position: relative;
	overflow: hidden;
	width: 378px;
	max-width: 100%;
	/* min-height: 500px; */
	max-height: 100%;

}

.body-login {
	background-color: #f6f5f7;
}

.login-title {
	/* font-weight: bold; */
	font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif
}

.form-control {
	border-radius: 10px;
}
.imgcontainer {
  text-align: center;
  margin: 0.5px 0 12px 0;
}

img.avatar {
  width: 20%;
  border-radius: 50%;
}

span.psw {
  float: right;
  padding-top: 16px;
}

.nicescroll-bar {
    overflow-x: hidden;
}

@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }

}


</style>


