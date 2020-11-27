<template>
    <div ref="register-modal-wrapper">
        <form class="register-modal">
            <div class="title-wrapper">
                <h2 class="d-inline mt-1">Register</h2>
            </div>

            <div class="input-field-wrapper">
                <div class="name-wrapper input-field-wrapper-left">
                    <div class="name-wrapper">
                        <label for="name">Name</label>
                        <input
                            type="text"
                            id="name"
                            v-model="name"
                            required
                        >
                    </div>
                    <div class="email-wrapper">
                        <label for="email">E-mail</label>
                        <input
                            type="text"
                            id="email"
                            v-model="email"
                            required
                        >
                    </div>
                </div>

                <div class="password-wrapper input-field-wrapper-right">
                    <div class="password-wrapper-top">
                        <label for="password">Password</label>
                        <input
                            type="password"
                            id="password"
                            ref="password"
                            v-model="password"
                            required
                        >
                    </div>
                    <div class="password-wrapper-bottom" v-if="password.length > 0">
                        <label for="password-confirmation">Confirm</label>
                        <input
                            type="password"
                            id="password-confirmation"
                            ref="passwordConfirmation"
                            v-model="passwordConfirmation"
                            required
                        >
                    </div>
                </div>
            </div>

            <div class="button-wrapper">
                <button
                    type="submit"
                    @click="handleSubmit"
                    id="btn-ok"
                    class="btn btn-secondary btn-lg"
                    :disabled="submitEnabled"
                >OK</button>
                <button
                    type="button"
                    @click="handleCancel"
                    id="btn-cancel"
                    class="btn btn-secondary btn-lg"
                >Cancel</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: "",
                email: "",
                password: "",
                passwordConfirmation: "",
            }
        },
        computed: {
            submitEnabled() {
                return this.password.length < 4  || this.name.length < 3 || this.email.length < 7 ? true : false;
            }
        },
        methods: {
            handleSubmit(e){
                e.preventDefault()

                if (this.password !== this.passwordConfirmation) {
                    this.$refs.password.classList.add('border');
                    this.$refs.passwordConfirmation.classList.add('border');
                    this.$refs.password.classList.add('border-danger');
                    this.$refs.passwordConfirmation.classList.add('border-danger');
                    return;
                }
                else {
                    this.$refs.password.classList.remove('border');
                    this.$refs.passwordConfirmation.classList.remove('border');
                    this.$refs.password.classList.remove('border-danger');
                    this.$refs.passwordConfirmation.classList.remove('border-danger');
                }

                if (this.password.length > 0) {
                    axios.post('/api/user/register', {
                        name: this.name,
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
                                this.$store.commit('toggleRegisterModalVisibleState');
                            }
                            else
                            {
                                // this.$router.push('/');
                                JSON.stringify(response);
                            }
                        })
                        .catch(function (error) {
                            console.error(error);
                        });
                }
            },
            handleCancel(e) {
                this.$store.commit('toggleRegisterModalVisibleState');
            }
        }
    }
</script>

<style scoped lang="scss">
    @import '~/abstracts/_mixins.scss';

    .password-wrapper-top, .password-wrapper-bottom {
        display: flex;
        flex-direction: column;
    }

    label {
        font-size: 20px;
    }

    .btn {
        padding: 0 20px;
    }

    .register-modal-wrapper {
        width: 78%;
        top: 40px;
        position: fixed;
        z-index: 999;
        display: flex;
        flex-direction: column;

        @media #{$tabletPortrait} {
            width: 600px;
        }
    }

    .register-modal {
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

    .input-field-wrapper-left,
    .input-field-wrapper-right,
    .name-wrapper,
    .email-wrapper {
        display: flex;
        flex-direction: column;
    }

    .button-wrapper {
        display: flex;
        justify-content: space-around;
        margin: 20px 0 20px 0;
    }
</style>
