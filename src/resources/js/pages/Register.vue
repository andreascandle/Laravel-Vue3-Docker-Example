<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="alert alert-danger" role="alert" v-if="error !== null">
                    {{ error }}
                </div>

                <div class="card card-default">
                    <div class="card-header">Register</div>
                    <div class="card-body">
                        <form>
                             <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" v-model="name">
                        </div>
                        <div class="form-group">
                            <label for="position">Username</label>
                            <input type="text" class="form-control" name="username" v-model="username">
                        </div>
                        <div class="form-group">
                            <label for="email">Phone</label>
                            <input type="text" class="form-control" name="phone" v-model="phone">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" v-model="email">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                            <input id="password" type="password" class="form-control" v-model="password" required autocomplete="off">                                
                        </div>

                            <div class="form-group  mt-2 mb-0">
                                <button type="submit" class="btn btn-success" @click="handleSubmit">
                                        Register
                                    </button>
                                <button type="button" class="btn btn-primary" @click="goToLogin">
                                        Login
                                    </button>
                                                                    
                                
                            </div>
                        </form>
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
            name: "",
            email: "",
            username: "",
            phone: "",
            password: "",
            error: null
        }
    },
    methods: {
        goToLogin(e){
            e.preventDefault()
            this.$router.push({ name: "login"})
        },
        handleSubmit(e) {
            e.preventDefault()
            if (this.password.length > 0) {
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.post('api/register', {
                        name: this.name,
                        email: this.email,
                        username: this.username,
                        phone: this.phone,
                        password: this.password
                    })
                        .then(response => {
                            if (response.data.success) {
                                window.location.href = "/login"
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
    beforeRouteEnter(to, from, next) {
        if (window.Laravel.isLoggedin) {
            return next('dashboard');
        }
        next();
    }
}
</script>