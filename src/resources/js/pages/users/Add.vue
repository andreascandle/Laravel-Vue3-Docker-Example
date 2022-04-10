<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Create New Record</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" v-model="user.name">
                        </div>
                        <div class="form-group">
                            <label for="position">Username</label>
                            <input type="text" class="form-control" name="username" v-model="user.username">
                        </div>
                        <div class="form-group">
                            <label for="email">Phone</label>
                            <input type="text" class="form-control" name="phone" v-model="user.phone">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" v-model="user.email">
                        </div>

                        <div class="form-group mt-2">
                            <button @click.prevent="add" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted(){
        this.getEmployee()
    },
    data() {
        return {
            user: {}
        }
    },
    methods: {        
        add() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/api/user/add', this.user).then((response) => {
                    console.log('record created!')
                    this.$router.push('/')
                    this.$toaster.success('User updated successfully.')
                }).catch((error) => {
                    console.log(error)
                });
            });
        }
    }
}
</script>