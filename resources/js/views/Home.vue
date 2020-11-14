<template>
    <div class="wrapper">
        <div class="header-bg">
            <button
                class="btn btn-outline-dark py-0"
                v-if="!isLoggedIn"
                @click="showLoginModal()"
                >LOGIN
            </button>

            <h4
                class="user-name d-inline-block"
                v-if="isLoggedIn"
            >
                {{ userName }}
            </h4>

            <button
                class="btn btn-outline-dark py-0"
                v-if="isLoggedIn"
                @click="logout()"
                >LOGOUT
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            showLoginModal() {
                this.$store.commit('toggleLoginModalVisibleState');
                this.$store.commit('toggleLoginBtnVisibleState');
            },
            logout() {
                this.$store.dispatch('logout');
            }
        },
        computed: {
            btnLoginVisible() {
                return this.$store.state.loginBtnVisible
            },
            btnLogoutVisible() {
                return this.$store.state.logoutBtnVisible
            },
            isLoggedIn() {
                return this.$store.state.isLoggedIn
            },
            userName() {
                if (this.$store.state.loggedInUser)
                {
                    return this.$store.state.loggedInUser
                }

                return this.$store.state.loggedInUser;
            }
        }
    }
</script>

<style lang="scss" scoped>
    .header-bg {
        background-image: url('/images/header_bg.jpg');
        height: 100vh;
        width: 100%;
        background-size: cover;
        background-attachment: fixed;
        background-position: top;
        background-repeat: no-repeat;
        padding: 12px 50px;
    }
</style>
