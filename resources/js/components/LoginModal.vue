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
                            if (response.data.success)
                            {
                                localStorage.setItem('user',response.data.success.user_email)
                                localStorage.setItem('jwt',response.data.success.access_token)

                                this.$store.state.loggedInUser = response.data.success.user_email;
                                this.$store.state.userToken = response.data.success.access_token;
                                this.$store.state.isLoggedIn = true;
                                this.$store.state.logoutBtnVisible = true;
                                this.$store.state.loginEmailVisible = true;
                                this.$store.commit('toggleLoginModalVisibleState');
                            }
                            else
                            {
                                JSON.stringify(response);
                            }
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
    @import '~/abstracts/_mixins.scss';

    label {
        font-size: 20px;
    }

    .btn {
        padding: 0 20px;
    }

    .login-modal-wrapper {
        width: 78%;
        top: 40px;
        position: fixed;
        z-index: 999;
        display: flex;
        flex-direction: column;

        @media #{$tabletPortrait} {
            width: 500px;
        }
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
        flex-direction: column;
        padding: 0 2.5rem;

        @media #{$tabletPortrait} {
            flex-direction: row;
            padding: 0;
        }
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
