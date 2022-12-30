<template>

	<div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">	
			
			<div class="col-12">
				<div class="row justify-content-center no-gutters">
					<div class="col-lg-5 col-md-5 col-12">
						<div class="bg-white rounded30 shadow-lg">
							<div class="content-top-agile p-20 pb-0">
								<h2 class="text-primary">Let's Get Started</h2>
								<p class="mb-0">Sign in to continue to WebkitX.</p>							
							</div>
							<div class="p-40">
								<form action="index.html" method="post">
									<div class="form-group">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
											</div>
											<input v-model="email"  type="text" class="form-control pl-15 bg-transparent" placeholder="Username">
										</div>
									</div>
									<div class="form-group">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text  bg-transparent"><i class="ti-lock"></i></span>
											</div>
											<input  v-model="password" type="password" class="form-control pl-15 bg-transparent" placeholder="Password">
										</div>
									</div>
									  <div class="row">
										<div class="col-6">
										  <div class="checkbox">
											<input type="checkbox" id="basic_checkbox_1" >
											<label for="basic_checkbox_1">Remember Me</label>
										  </div>
										</div>
										<!-- /.col -->
										<div class="col-6">
										 <div class="fog-pwd text-right">
											<a href="javascript:void(0)" class="hover-warning"><i class="ion ion-locked"></i> Forgot pwd?</a><br>
										  </div>
										</div>
										<!-- /.col -->
										<div class="col-12 text-center">
										  <button @click="handleSubmit"  type="submit" class="btn btn-danger mt-10">SIGN IN</button>
										</div>
										<!-- /.col -->
									  </div>
								</form>	
								<div class="text-center">
									<p class="mt-15 mb-0">Don't have an account? <a href="auth_register.html" class="text-warning ml-5">Sign Up</a></p>
								</div>	
							</div>						
						</div>
						<div class="text-center">
						  <p class="mt-20 text-white">- Sign With -</p>
						  <p class="gap-items-2 mb-20">
							  <a class="btn btn-social-icon btn-round btn-facebook" href="#"><i class="fa fa-facebook"></i></a>
							  <a class="btn btn-social-icon btn-round btn-twitter" href="#"><i class="fa fa-twitter"></i></a>
							  <a class="btn btn-social-icon btn-round btn-instagram" href="#"><i class="fa fa-instagram"></i></a>
							</p>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	
</template>

<script  setup>

import {  ref, computed } from "vue";
const hidePassword = ref(true);
const passwordFieldIcon = computed(() => hidePassword.value ? "fa-eye" : "fa-eye-slash");
const passwordFieldType = computed(() => hidePassword.value ? "password" : "text");
</script>

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

		async checkSession() {
			this.$axios.get("/sanctum/csrf-cookie").then((response) => {
                this.$axios
                    .get(`/api/getSession/`)
                    .then((response) => {
						let logueo=response.data.success;
					
					   if (response.data.success) {
            				this.$router.push({name: 'dashboard'})
       		 			}else{
							this.$router.push("/")
						}
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            });
        },
		addStyleWrapper() {
			let height_now = window.innerHeight + "px";
			this.style_height = {
				"min-height": height_now + " !important",
			};

		},
		handleSubmit(e) {
			console.log("entro");
			
			e.preventDefault()
			console.log("aa");
			if (this.password.length > 0) {
				console.log("aaxxx");
				this.$axios.get('/sanctum/csrf-cookie').then(response => {
					this.$axios.post('api/login', {
						email: this.email,
						password: this.password
					})
						.then(response => {
							if (response.data.success) {
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



div.is-relative{
  max-width: 420px;
  position: relative;
}
#icon{
  position: absolute;
  display: block;
  bottom: 1.5rem;
  right: 1.5rem;
  user-select: none;
  cursor: pointer;
}
/* import */
.input-icon {
  color: #191919;
  position: absolute;
  width: 80px;
  height: 20px;
  left: 12px;
  top: 50%;
  margin-left: 20px;
  transform: translateY(-50%);
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

input.form-control{
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


