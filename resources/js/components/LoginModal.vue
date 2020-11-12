<template>
    <div ref="login-modal-wrapper">
        <form class="login-modal">
            <div class="title-wrapper">
                <h2 class="d-inline mt-1">Login</h2>
            </div>

            <div class="input-field-wrapper">
                <div class="input-field-wrapper-left">
                    <label for="email">E-mail</label>
                    <input
                        type="text"
                        id="email"
                        v-model="email"
                    >
                </div>
                <div class="input-field-wrapper-right">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        v-model="password"
                    >
                </div>
            </div>

            <div class="button-wrapper">
                <button
                    type="submit"
                    @click="handleSubmit"
                    id="btn-ok"
                    class="btn btn-secondary btn-lg">OK</button>
                <button
                    type="button"
                    @click="handleCancel"
                    id="btn-cancel"
                    class="btn btn-secondary btn-lg">Cancel</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                email: "",
                password: ""
            }
        },
        methods: {
            handleSubmit(e){
                e.preventDefault()

                if (this.password.length > 0) {
                    axios.post('/api/user/login', {
                        email: this.email,
                        password: this.password
                        })
                        .then(response => {
                        localStorage.setItem('user',response.data.success.name)
                        localStorage.setItem('jwt',response.data.success.token)

                        // this.$store.state.email =

                        // if (localStorage.getItem('jwt') != null){
                        //     this.$router.go('/board')
                        // }
                        })
                        .catch(function (error) {
                        console.error(error);
                        });
                }
            },
            handleCancel(e) {
                this.$store.commit('toggleLoginModalVisibleState');
                this.$store.commit('toggleLoginBtnVisibleState');
            }
        }
    }
</script>

<style scoped lang="scss">
    label {
        font-size: 20px;
    }

    .btn {
        padding: 0 20px;
    }

    .login-modal-wrapper {
        top: 20px;
        width: 500px;
        position: fixed;
        z-index: 999;
        display: flex;
        flex-direction: column;
    }

    .login-modal {
        background: black;
        opacity: 70%;
        display: flex;
        flex-direction: column;
    }

    .title-wrapper {
        justify-content: center;
        display: flex;
        margin: 20px 0 70px;
    }

    .input-field-wrapper {
        display: flex;
        justify-content: space-around;
    }

    .input-field-wrapper-left, .input-field-wrapper-right {
        display: flex;
        flex-direction: column;
    }

    .button-wrapper {
        display: flex;
        justify-content: space-around;
        margin: 20px 0 20px 0;
    }
</style>
